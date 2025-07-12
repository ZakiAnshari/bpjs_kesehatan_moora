<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Masyarakat;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();

        $masyarakatCount = Masyarakat::count();
        $kriteriaCount = Kriteria::count();
        $penilaianCount = Penilaian::count();
        $hakaksesCount = User::count();

        return view('admin.dashboard.index', compact(
            'user',
            'users',
            'masyarakatCount',
            'kriteriaCount',
            'penilaianCount',
            'hakaksesCount'
        ));
    }
}
