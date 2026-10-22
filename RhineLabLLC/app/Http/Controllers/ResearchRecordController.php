<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Material;
use App\Models\ResearchProject;
use App\Models\ResearchRecord;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ResearchRecordController extends Controller
{
    /**
     * Menampilkan daftar catatan riset milik operatif yang sedang login.
     */
    public function index(): View
    {
        $userId = Auth::id();

        // Mengambil data catatan riset khusus milik user yang sedang login
        $records = ResearchRecord::with(['project.division', 'user'])
            ->where('user_id', $userId)
            ->latest('recorded_at')
            ->latest('created_at')
            ->paginate(10);

        return view('research-records.index', compact('records'));
    }

    /**
     * Menampilkan formulir pembuatan catatan riset baru.
     */
    public function create(): View
    {
        return view('research-records.create', [
            'classifications' => $this->classifications(),
            'statuses'        => $this->statuses(),
            'divisions'       => $this->divisions(),
            'materials'       => Material::latest()->get(),
        ]);
    }

    /**
     * Menyimpan catatan riset baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'division_id'    => ['required', Rule::exists('divisions', 'id')],
            'classification' => ['required', Rule::in($this->classifications())],
            'status'         => ['required', Rule::in($this->statuses())],
            'recorded_at'    => ['nullable', 'date'],
            'summary'        => ['required', 'string'],
            'file'           => ['nullable', 'file', 'max:20480'],
            'thumbnail'      => ['nullable', 'image', 'max:5120'],
            'image'          => ['nullable', 'image', 'max:4096'],
            'material_ids'   => ['nullable', 'array'],
        ]);

        $divisionId = (int) $data['division_id'];
        $division   = Division::findOrFail($divisionId);

        // Cari atau buat proyek riset baru dengan reference_code unik
        $project = ResearchProject::where('title', $data['title'])
            ->where('division_id', $divisionId)
            ->first();

        if (!$project) {
            // Generasi reference_code unik dinamis (Contoh: MATH-20261022-849-PROJ)
            $divCode = strtoupper($division->code ?: 'DIV');
            $uniqueCode = $divCode . '-' . date('Ymd') . '-' . rand(100, 999) . '-PROJ';

            $project = ResearchProject::create([
                'title'          => $data['title'],
                'division_id'    => $divisionId,
                'reference_code' => $uniqueCode,
                'status'         => 'aktif',
            ]);
        }

        $recordCode = $this->generateRecordCode($project);
        
        $filePath  = $request->hasFile('file') ? $this->storeFile($request->file('file'), 'documents') : null;
        $thumbPath = $request->hasFile('thumbnail') ? $this->storeFile($request->file('thumbnail'), 'thumbnails') : null;
        
        // Gunakan foto dokumentasi jika ada, jika tidak ada gunakan thumbnail otomatis
        $imagePath = $request->hasFile('image') 
            ? $this->storeFile($request->file('image'), 'research_records') 
            : $thumbPath;

        $record = ResearchRecord::create([
            'research_project_id' => $project->id,
            'division_id'         => $divisionId,
            'user_id'             => Auth::id(), // Mengikat langsung ke ID user yang login
            'record_code'         => $recordCode,
            'classification'      => $data['classification'],
            'status'              => $data['status'],
            'recorded_at'         => $data['recorded_at'] ?? now(),
            'summary'             => $data['summary'],
            'file_path'           => $filePath,
            'thumbnail_path'      => $thumbPath,
            'image_path'          => $imagePath,
        ]);

        if (!empty($data['material_ids']) && method_exists($record, 'materials')) {
            $record->materials()->sync($data['material_ids']);
        }

        return redirect()->route('research-records.index')->with('status', 'Catatan riset berhasil dibuat!');
    }

    /**
     * Menampilkan detail catatan riset.
     */
    public function show(ResearchRecord $researchRecord): View
    {
        $this->ensureOwnership($researchRecord);
        $researchRecord->load(['project.division', 'user']);
        return view('research-records.show', ['record' => $researchRecord]);
    }

    /**
     * Menampilkan formulir edit catatan riset.
     */
    public function edit(ResearchRecord $researchRecord): View
    {
        $this->ensureOwnership($researchRecord);
        return view('research-records.edit', [
            'record'          => $researchRecord,
            'classifications' => $this->classifications(),
            'statuses'        => $this->statuses(),
            'divisions'       => $this->divisions(),
            'materials'       => Material::latest()->get(),
        ]);
    }

    /**
     * Memperbarui data catatan riset.
     */
    public function update(Request $request, ResearchRecord $researchRecord): RedirectResponse
    {
        $this->ensureOwnership($researchRecord);
        $data = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'division_id'    => ['required', Rule::exists('divisions', 'id')],
            'classification' => ['required', Rule::in($this->classifications())],
            'status'         => ['required', Rule::in($this->statuses())],
            'recorded_at'    => ['nullable', 'date'],
            'summary'        => ['required', 'string'],
            'file'           => ['nullable', 'file', 'max:20480'],
            'thumbnail'      => ['nullable', 'image', 'max:5120'],
            'image'          => ['nullable', 'image', 'max:4096'],
        ]);

        $divisionId = (int) $data['division_id'];
        $division   = Division::findOrFail($divisionId);

        $project = ResearchProject::where('title', $data['title'])
            ->where('division_id', $divisionId)
            ->first();

        if (!$project) {
            $divCode = strtoupper($division->code ?: 'DIV');
            $uniqueCode = $divCode . '-' . date('Ymd') . '-' . rand(100, 999) . '-PROJ';

            $project = ResearchProject::create([
                'title'          => $data['title'],
                'division_id'    => $divisionId,
                'reference_code' => $uniqueCode,
                'status'         => 'aktif',
            ]);
        }

        $filePath = $researchRecord->file_path;
        if ($request->hasFile('file')) {
            $filePath = $this->storeFile($request->file('file'), 'documents');
            $this->deleteFile($researchRecord->file_path);
        }

        $thumbPath = $researchRecord->thumbnail_path;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $this->storeFile($request->file('thumbnail'), 'thumbnails');
            $this->deleteFile($researchRecord->thumbnail_path);
        }

        $imagePath = $researchRecord->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeFile($request->file('image'), 'research_records');
            $this->deleteFile($researchRecord->image_path);
        } elseif ($request->hasFile('thumbnail')) {
            $imagePath = $thumbPath;
        }

        $researchRecord->update([
            'research_project_id' => $project->id,
            'division_id'         => $divisionId,
            'classification'      => $data['classification'],
            'status'              => $data['status'],
            'recorded_at'         => $data['recorded_at'] ?? $researchRecord->recorded_at,
            'summary'             => $data['summary'],
            'image_path'          => $imagePath,
            'file_path'           => $filePath,
            'thumbnail_path'      => $thumbPath,
        ]);

        return redirect()->route('research-records.index')->with('status', 'Catatan riset berhasil diperbarui!');
    }

    /**
     * Menghapus catatan riset.
     */
    public function destroy(ResearchRecord $researchRecord): RedirectResponse
    {
        $this->ensureOwnership($researchRecord);
        $this->deleteFile($researchRecord->image_path);
        $this->deleteFile($researchRecord->file_path);
        $this->deleteFile($researchRecord->thumbnail_path);
        $researchRecord->delete();

        return redirect()->route('research-records.index')->with('status', 'Catatan riset berhasil dihapus!');
    }

    /**
     * Mengunduh berkas riset.
     */
    public function download(ResearchRecord $researchRecord)
    {
        if (!$researchRecord->file_path) {
            return back()->with('error', 'Berkas dokumen tidak ditemukan.');
        }

        // Jika tersimpan via Supabase Storage (URL HTTP/HTTPS)
        if (Str::startsWith($researchRecord->file_path, ['http://', 'https://'])) {
            return redirect($researchRecord->file_path);
        }

        $fullPath = public_path($researchRecord->file_path);
        if (!File::exists($fullPath)) {
            return back()->with('error', 'Berkas fisik tidak ditemukan di server.');
        }
        return Response::download($fullPath);
    }

    protected function ensureOwnership(ResearchRecord $record): void
    {
        if ($record->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke catatan riset ini.');
        }
    }

    protected function divisions(): array
    {
        return Division::orderBy('name')->get(['id', 'name', 'code', 'lead_scientist'])->toArray();
    }

    protected function classifications(): array
    {
        return ['internal', 'restricted', 'rahasia'];
    }

    protected function statuses(): array
    {
        return ['draft', 'revisi_1', 'revisi_2', 'revisi_3', 'final'];
    }

    protected function generateRecordCode(ResearchProject $project): string
    {
        $base = $project->reference_code ?: 'REC';
        $base = Str::upper(Str::slug($base, '-'));
        $sequence = ResearchRecord::where('research_project_id', $project->id)->count() + 1;
        $code = sprintf('%s-%03d', $base, $sequence);

        while (ResearchRecord::where('record_code', $code)->exists()) {
            $sequence += 1;
            $code = sprintf('%s-%03d', $base, $sequence);
        }
        return $code;
    }

    /**
     * Menyimpan file dengan aman di Vercel / Supabase Storage & Localhost PC.
     */
    protected function storeFile(UploadedFile $file, string $subfolder): string
    {
        $filename = uniqid($subfolder . '_', true) . '.' . $file->getClientOriginalExtension();
        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_SERVICE_ROLE_KEY');

        // 1. Upload ke Supabase Storage jika konfigurasi terisi
        if (!empty($supabaseUrl) && !empty($supabaseKey)) {
            $bucket = 'uploads';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $supabaseKey,
                'Content-Type'  => $file->getMimeType(),
            ])->withBody(
                file_get_contents($file->getRealPath()), $file->getMimeType()
            )->post("{$supabaseUrl}/storage/v1/object/{$bucket}/{$subfolder}/{$filename}");

            if ($response->successful()) {
                return "{$supabaseUrl}/storage/v1/object/public/{$bucket}/{$subfolder}/{$filename}";
            }
        }

        // 2. Fallback folder /tmp jika berjalan di Vercel
        if (isset($_ENV['VERCEL']) || getenv('VERCEL') || app()->environment('production')) {
            $tmpDirectory = '/tmp/uploads/' . $subfolder;
            if (!File::exists($tmpDirectory)) {
                File::makeDirectory($tmpDirectory, 0755, true, true);
            }
            $file->move($tmpDirectory, $filename);

            return 'uploads/' . $subfolder . '/' . $filename;
        }

        // 3. Simpan biasa jika berjalan di localhost PC
        $directory = public_path('uploads/' . $subfolder);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        $file->move($directory, $filename);

        return 'uploads/' . $subfolder . '/' . $filename;
    }

    protected function deleteFile(?string $path): void
    {
        if (!$path || Str::startsWith($path, ['http://', 'https://'])) return;
        $fullPath = public_path($path);
        if (File::exists($fullPath)) File::delete($fullPath);
    }
}