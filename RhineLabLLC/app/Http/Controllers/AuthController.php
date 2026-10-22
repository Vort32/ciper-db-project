<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(Request $request): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('logout.view');
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginField = filter_var($validated['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (!Auth::attempt([
            $loginField => $validated['username'],
            'password' => $validated['password'],
        ], false)) {
            return back()->withInput($request->except('password'))
                ->withErrors([
                    'username' => 'Kredensial yang dimasukkan tidak valid.',
                ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();
        if ($user?->division_id) {
            $request->session()->put('selected_division_id', (int) $user->division_id);
        } else {
            $request->session()->forget('selected_division_id');
        }

        $organizations = $this->organizations();
        $organizationKey = $this->resolveOrganizationKey($user?->affiliation, $organizations);

        if ($organizationKey !== null) {
            $request->session()->put('selected_organization_key', $organizationKey);
        } else {
            $request->session()->forget('selected_organization_key');
        }

        return redirect()->route('logout.view')->with('status', 'Anda berhasil masuk ke sistem.');
    }

    public function showRegistrationForm(Request $request): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('logout.view');
        }

        $divisionHeads = User::query()
            ->where('is_division_head', true)
            ->get(['id', 'name', 'division_id']);

        $divisions = Division::orderBy('name')
            ->get(['id', 'name', 'code', 'photo_path', 'lead_scientist'])
            ->map(function (Division $division) use ($divisionHeads) {
                $headUser = $divisionHeads->firstWhere('division_id', $division->id);

                return [
                    'id' => $division->id,
                    'name' => $division->name,
                    'code' => $division->code,
                    'photo_path' => $division->photo_path,
                    'lead_scientist' => $division->lead_scientist,
                    'has_head' => $headUser !== null,
                    'head_user_name' => $headUser?->name,
                ];
            });
        $organizations = $this->organizations();

        return view('auth.register', compact('divisions', 'organizations'));
    }

    public function register(Request $request): RedirectResponse
    {
        $organizations = $this->organizations();

        if (!$request->has('organization')) {
            $request->merge(['organization' => 'rhine-lab']);
        }

        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
            'division_id'  => ['required', Rule::exists('divisions', 'id')],
            'organization' => ['required', Rule::in(array_keys($organizations))],
            'photo'        => ['nullable', 'image', 'max:2048'],
        ], [
            'name.required'        => 'Nama lengkap wajib diisi.',
            'email.required'       => 'Email operatif wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'email.unique'         => 'Email ini sudah terdaftar di jaringan Rhine Lab.',
            'password.required'    => 'Kunci akses wajib diisi.',
            'password.min'         => 'Kunci akses minimal 8 karakter.',
            'password.confirmed'   => 'Konfirmasi kunci akses tidak cocok.',
            'division_id.required' => 'Divisi wajib dipilih.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $this->storeProfilePhoto($request->file('photo'));
        }

        $selectedOrganization = $organizations[$validated['organization']];

        $user = User::create([
            'division_id'      => (int) $validated['division_id'],
            'is_division_head' => false,
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'password'         => Hash::make($validated['password']),
            'photo_path'       => $photoPath,
            'affiliation'      => $selectedOrganization['name'],
            'position'         => 'Operative',
        ]);

        Auth::login($user);

        $request->session()->regenerate();
        $request->session()->put('selected_division_id', (int) $validated['division_id']);
        $request->session()->put('selected_organization_key', $validated['organization']);

        return redirect()->route('research-records.index')->with('status', 'Registrasi berhasil. Selamat datang di Rhine Lab.');
    }

    public function showLogoutView(Request $request): View
    {
        $divisions = Division::orderBy('name')->get(['id', 'name', 'code', 'photo_path']);
        $divisionId = $request->session()->get('selected_division_id');
        $selectedDivision = $divisionId ? $divisions->firstWhere('id', (int) $divisionId) : null;

        $organizations = $this->organizations();
        $organizationKey = $request->session()->get('selected_organization_key');
        $selectedOrganization = $organizationKey && isset($organizations[$organizationKey])
            ? $organizations[$organizationKey]
            : null;

        return view('auth.logout', [
            'user' => $request->user(),
            'selectedDivision' => $selectedDivision,
            'selectedOrganization' => $selectedOrganization,
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Anda telah keluar dari sistem.');
    }

    /**
     * @return array<string, array{name: string, logo: string, logo_url: string}>
     */
    protected function organizations(): array
    {
        $entries = [
            'rhine-lab' => [
                'name' => 'Rhine Lab',
                'logo' => 'images/logo.png',
            ],
            'rhodes-island' => [
                'name' => 'Rhodes Island',
                'logo' => 'images/logo1.png',
            ],
            'horizon-arc' => [
                'name' => 'Horizon Arc Initiative',
                'logo' => 'images/divisions/arc.svg',
            ],
        ];

        foreach ($entries as $key => $value) {
            $entries[$key]['logo_url'] = asset($value['logo']);
        }

        return $entries;
    }

    protected function resolveOrganizationKey(?string $affiliation, array $organizations): ?string
    {
        if ($affiliation === null) {
            return null;
        }

        foreach ($organizations as $key => $organization) {
            if (($organization['name'] ?? null) === $affiliation) {
                return $key;
            }
        }

        return null;
    }

    /**
     * Store profile photo safely on Serverless Vercel / Supabase Storage ('Uploads' Bucket) & Localhost.
     */
    protected function storeProfilePhoto(UploadedFile $file): string
    {
        $filename = uniqid('profile_', true) . '.' . $file->getClientOriginalExtension();
        $supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $supabaseKey = env('SUPABASE_SERVICE_ROLE_KEY');

        if (!empty($supabaseUrl) && !empty($supabaseKey)) {
            $bucket = 'Uploads';
            $objectPath = "profile_photos/{$filename}";

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
            $tmpDirectory = '/tmp/uploads/profile_photos';
            if (!File::exists($tmpDirectory)) {
                File::makeDirectory($tmpDirectory, 0755, true, true);
            }
            $file->move($tmpDirectory, $filename);

            return 'uploads/profile_photos/' . $filename;
        }

        $directory = public_path('uploads/profile_photos');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        $file->move($directory, $filename);

        return 'uploads/profile_photos/' . $filename;
    }
}