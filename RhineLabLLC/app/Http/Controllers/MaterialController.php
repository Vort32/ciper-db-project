<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->get();
        return view('research-records.material_create', compact('materials'));
    }

    public function create()
    {
        return redirect()->route('materials.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'type'        => 'nullable|string|max:255',
            'size'        => 'nullable|string|max:255',
            'file_upload' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
        ]);

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            
            $bytes = $file->getSize();
            if ($bytes >= 1048576) {
                $validated['size'] = number_format($bytes / 1048576, 1) . ' MB';
            } elseif ($bytes >= 1024) {
                $validated['size'] = round($bytes / 1024) . ' KB';
            } else {
                $validated['size'] = $bytes . ' B';
            }

            $validated['file_path'] = $this->storeMaterialImage($file);
        } else {
            $validated['size'] = $validated['size'] ?? '1.0 MB';
            $validated['file_path'] = 'images/materials/Module_Data_Block.png';
        }

        unset($validated['file_upload']);
        Material::create($validated);

        if ($this->isAdmin()) {
             return redirect()->route('admin.dashboard')->with('status', 'Material berhasil ditambahkan!');
        }

        return redirect()->back()->with('status', 'Material berhasil ditambahkan!');
    }

    public function edit(Material $material)
    {
        return redirect()->back();
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'type'        => 'nullable|string|max:255',
            'size'        => 'nullable|string|max:255',
            'file_upload' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
        ]);

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            
            $bytes = $file->getSize();
            if ($bytes >= 1048576) {
                $validated['size'] = number_format($bytes / 1048576, 1) . ' MB';
            } elseif ($bytes >= 1024) {
                $validated['size'] = round($bytes / 1024) . ' KB';
            } else {
                $validated['size'] = $bytes . ' B';
            }

            $validated['file_path'] = $this->storeMaterialImage($file);
        }

        unset($validated['file_upload']);
        $material->update($validated);

        if ($this->isAdmin()) {
             return redirect()->route('admin.dashboard')->with('status', 'Material berhasil diperbarui!');
        }

        return redirect()->back()->with('status', 'Material berhasil diperbarui!');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        
        if ($this->isAdmin()) {
             return redirect()->route('admin.dashboard')->with('status', 'Material berhasil dihapus!');
        }

        return redirect()->back()->with('status', 'Material berhasil dihapus!');
    }

    /**
     * Helper Pengecekan Akses Admin
     */
    protected function isAdmin(): bool
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        $emailIsAdmin    = $user->email === 'admin@rhine-lab.com';
        $positionIsAdmin = str_contains(strtolower($user->position ?? ''), 'admin');
        $flagIsAdmin     = (bool) ($user->is_admin ?? false);

        return $emailIsAdmin || $positionIsAdmin || $flagIsAdmin;
    }

    /**
     * Upload gambar material ke Supabase Storage (Bucket 'Uploads') atau fallback lokal.
     */
    protected function storeMaterialImage(UploadedFile $file): string
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $supabaseUrl = rtrim(env('SUPABASE_URL') ?? '', '/');
        $supabaseKey = env('SUPABASE_SERVICE_ROLE_KEY') ?? '';

        if (!empty($supabaseUrl) && !empty($supabaseKey)) {
            $bucket = 'UPLOADS';
            $objectPath = "materials/{$filename}";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $supabaseKey,
                'apikey'        => $supabaseKey,
                'x-upsert'      => 'true',
            ])->attach(
                'file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName(),
                ['Content-Type' => $file->getMimeType()]
            )->post("{$supabaseUrl}/storage/v1/object/{$bucket}/{$objectPath}");

            if ($response->successful()) {
                return "{$supabaseUrl}/storage/v1/object/public/{$bucket}/{$objectPath}";
            }
        }

        if (isset($_ENV['VERCEL']) || getenv('VERCEL') || app()->environment('production')) {
            $tmpDirectory = '/tmp/images/materials';
            if (!File::exists($tmpDirectory)) {
                File::makeDirectory($tmpDirectory, 0755, true, true);
            }
            $file->move($tmpDirectory, $filename);

            return 'images/materials/' . $filename;
        }

        $directory = public_path('images/materials');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        $file->move($directory, $filename);

        return 'images/materials/' . $filename;
    }
}