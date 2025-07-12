<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Masyarakat;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenilaianController extends Controller
{
    public function index()
    {

        $masyarakats   = Masyarakat::orderBy('created_at', 'desc')->get(); // Data masyarakat terbaru
        $kriterias     = Kriteria::with('subkriterias')->get();            // Kriteria + sub
        $subkriterias  = Subkriteria::all();

        // ✅ Perbaikan di sini
        $penilaians    = Penilaian::with(['masyarakat', 'subkriteria'])
            ->orderBy('created_at', 'desc')
            ->get();



        return view('admin.penilaian.index', compact('kriterias', 'subkriterias', 'masyarakats', 'penilaians'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'masyarakat_id'     => 'required|exists:masyarakats,id',
            'subkriteria_id'    => 'required|array',
            'subkriteria_id.*'  => 'required|exists:subkriterias,id',
        ]);

        // Cek apakah penilaian untuk masyarakat ini sudah ada
        $sudahDinilai = Penilaian::where('masyarakat_id', $request->masyarakat_id)->exists();

        if ($sudahDinilai) {
            return redirect()->back()->withErrors(['masyarakat_id' => 'Penilaian untuk masyarakat ini sudah ada.']);
        }

        // Simpan setiap penilaian
        foreach ($request->subkriteria_id as $kriteria_id => $subkriteria_id) {
            $sub = Subkriteria::find($subkriteria_id);

            Penilaian::create([
                'masyarakat_id'   => $request->masyarakat_id,
                'kriteria_id'     => $kriteria_id,
                'subkriteria_id'  => $subkriteria_id,
                'nilai'           => optional($sub)->berat_kepentingan ?? 0, // ✅ disesuaikan
            ]);
        }

        Alert::success('Berhasil', 'Penilaian berhasil ditambahkan');
        return back();
    }

    public function destroy($masyarakat_id)
    {
        $penilaians = Penilaian::where('masyarakat_id', $masyarakat_id)->get();

        if ($penilaians->isEmpty()) {
            return back()->with('error', 'Data penilaian tidak ditemukan');
        }

        foreach ($penilaians as $penilaian) {
            $penilaian->delete();
        }
        Alert::success('Berhasil', 'Data penilaian berhasil dihapus');
        return back();
    }
}
