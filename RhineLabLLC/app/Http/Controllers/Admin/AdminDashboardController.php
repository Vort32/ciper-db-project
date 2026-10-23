<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ResearchRecord;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $records = ResearchRecord::with(['project', 'user'])->latest()->get();
        $materials = Material::latest()->get();

        return view('admin.dashboard', compact('users', 'records', 'materials'));
    }

    public function destroyUser(User $user)
    {
        // Hindari admin menghapus akunnya sendiri yang sedang login
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Otorisasi ditolak: Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return back()->with('status', 'Akun operatif berhasil dihapus dari sistem.');
    }

    public function destroyResearch(ResearchRecord $record)
    {
        $record->delete();
        return back()->with('status', 'Catatan riset berhasil dimusnahkan dari arsip.');
    }

    public function destroyMaterial(Material $material)
    {
        $material->delete();
        return back()->with('status', 'Material riset berhasil dihapus.');
    }
}