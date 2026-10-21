<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->get();
        return view('research-records.material_create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'type'     => 'required|string|max:255',
            'file'     => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Hitung ukuran file otomatis
            $bytes = $file->getSize();
            if ($bytes >= 1048576) {
                $validated['size'] = number_format($bytes / 1048576, 1) . ' MB';
            } elseif ($bytes >= 1024) {
                $validated['size'] = round($bytes / 1024) . ' KB';
            } else {
                $validated['size'] = $bytes . ' B';
            }

            // Simpan gambar langsung ke folder public/images/materials
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/materials'), $filename);
            
            $validated['file_path'] = 'images/materials/' . $filename;
        } else {
            $validated['size'] = '1.0 MB';
            $validated['file_path'] = 'images/materials/Module_Data_Block.png';
        }

        Material::create($validated);

        return redirect()->back()->with('status', 'Material berhasil ditambahkan!');
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'type'     => 'required|string|max:255',
            'file'     => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            $bytes = $file->getSize();
            if ($bytes >= 1048576) {
                $validated['size'] = number_format($bytes / 1048576, 1) . ' MB';
            } elseif ($bytes >= 1024) {
                $validated['size'] = round($bytes / 1024) . ' KB';
            } else {
                $validated['size'] = $bytes . ' B';
            }

            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/materials'), $filename);
            
            $validated['file_path'] = 'images/materials/' . $filename;
        }

        $material->update($validated);

        return redirect()->route('materials.index')->with('status', 'Material berhasil diperbarui!');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->back()->with('status', 'Material berhasil dihapus!');
    }
}