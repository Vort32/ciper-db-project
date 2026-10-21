<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\ResearchDocument;
use App\Models\ResearchProject;
use App\Models\ResearchRecord;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResearchDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan data lama
        ResearchDocument::query()->delete();
        ResearchRecord::query()->delete();
        ResearchProject::query()->delete();
        Division::query()->delete();

        // 2. Buat 1 Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@rhine-lab.com'],
            [
                'name'             => 'Administrator Rhine Lab',
                'password'         => Hash::make('admin123'),
                'position'         => 'System Administrator',
                'affiliation'      => 'Rhine Lab',
                'origin'           => 'Universitas',
                'photo_path'       => 'images/users/Silence.png',
                'biography'        => 'Pengelola pusat sistem informasi & basis data Rhine Lab.LLC',
                'is_division_head' => true,
            ]
        );

        // 3. Master Data Divisi Berbasis Jurusan / Kuliah
        $divisions = [
            [
                'code'           => 'IF-01',
                'name'           => 'Informatika & Rekayasa Perangkat Lunak',
                'lead_scientist' => 'Silence',
                'mission'        => 'Pengembangan arsitektur perangkat lunak, sistem terdistribusi, dan aplikasi web.',
                'photo_path'     => 'images/divisions/bio.svg',
            ],
            [
                'code'           => 'SEC-02',
                'name'           => 'Cyber Security & Network Engineering',
                'lead_scientist' => 'Saria',
                'mission'        => 'Keamanan jaringan internal, pengujian penetrasi, dan enkripsi data.',
                'photo_path'     => 'images/divisions/eng.svg',
            ],
            [
                'code'           => 'DS-03',
                'name'           => 'Sains Data & Kecerdasan Buatan',
                'lead_scientist' => 'Ptilopsis',
                'mission'        => 'Pengolahan data skala besar, analisis spasial, dan pemodelan machine learning.',
                'photo_path'     => 'images/divisions/arc.svg',
            ],
            [
                'code'           => 'SI-04',
                'name'           => 'Sistem Informasi & Tata Kelola IT',
                'lead_scientist' => 'Mayer',
                'mission'        => 'Analisis proses bisnis, integrasi sistem informasi, dan manajemen basis data.',
                'photo_path'     => 'images/divisions/dev.svg',
            ],
            [
                'code'           => 'MATH-05',
                'name'           => 'Matematika Komputasi & Kriptografi',
                'lead_scientist' => 'Heidi',
                'mission'        => 'Pemodelan matematika, komputasi numerik, dan algoritma kriptografi.',
                'photo_path'     => 'images/divisions/med.svg',
            ],
        ];

        foreach ($divisions as $div) {
            Division::create($div);
        }
    }
}