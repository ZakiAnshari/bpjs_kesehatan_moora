<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $masyarakats = Masyarakat::all();
        $penilaians = Penilaian::with('masyarakat', 'subkriteria', 'subkriteria.kriteria')->get();

        // Matriks keputusan awal: [masyarakat_id][kriteria_id] = nilai
        $matrix = [];
        foreach ($penilaians as $penilaian) {
            $matrix[$penilaian->masyarakat_id][$penilaian->kriteria_id] = $penilaian->nilai;
        }

        // Tahap 1: Hitung akar kuadrat jumlah kuadrat tiap kriteria
        $akarPembagi = [];
        foreach ($kriterias as $kriteria) {
            $totalKuadrat = 0;
            foreach ($masyarakats as $m) {
                $nilai = $matrix[$m->id][$kriteria->id] ?? 0;
                $totalKuadrat += pow($nilai, 2);
            }
            $akarPembagi[$kriteria->id] = sqrt($totalKuadrat);
        }

        // Tahap 2: Hitung nilai normalisasi dan preferensi akhir
        $nilaiNormalisasi = [];
        $preferensi = [];

        foreach ($masyarakats as $m) {
            $totalBenefit = 0;
            $totalCost = 0;

            foreach ($kriterias as $kriteria) {
                $nilaiAwal = $matrix[$m->id][$kriteria->id] ?? 0;
                $akar = $akarPembagi[$kriteria->id] ?: 1; // Cegah pembagian nol
                $r = $nilaiAwal / $akar; // Normalisasi
                $bobot = $kriteria->bobot_normalisasi;
                $y = $r * $bobot; // Dikalikan bobot

                $nilaiNormalisasi[$m->id][$kriteria->id] = round($y, 4);

                if (strtolower($kriteria->jenis) === 'benefit') {
                    $totalBenefit += $y;
                } else {
                    $totalCost += $y;
                }
            }

            $preferensi[$m->id] = round($totalBenefit - $totalCost, 4);
        }

        // Urutkan hasil preferensi
        arsort($preferensi);
        // ✅ Perbaikan di sini
        $penilaians    = Penilaian::with(['masyarakat', 'subkriteria'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.perhitungan.index', compact(
            'kriterias',
            'masyarakats',
            'matrix',
            'nilaiNormalisasi',
            'preferensi',
            'penilaians'
        ));
    }
}
