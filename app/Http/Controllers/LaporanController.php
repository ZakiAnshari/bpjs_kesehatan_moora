<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class LaporanController extends Controller
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

        // Urutkan hasil preferensi (descending)
        arsort($preferensi);

        // Ambil ulang penilaian (jika diperlukan untuk ditampilkan di tabel)
        $penilaians = Penilaian::with(['masyarakat', 'subkriteria', 'subkriteria.kriteria'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan.index', compact(
            'masyarakats',
            'kriterias',
            'penilaians',
            'matrix',
            'nilaiNormalisasi',
            'preferensi'
        ));
    }

    public function cetaklaporan()
    {
        $kriterias = Kriteria::all();
        $masyarakats = Masyarakat::all();
        $penilaians = Penilaian::with('masyarakat', 'subkriteria', 'subkriteria.kriteria')->get();

        // Matriks keputusan awal
        $matrix = [];
        foreach ($penilaians as $penilaian) {
            $matrix[$penilaian->masyarakat_id][$penilaian->kriteria_id] = $penilaian->nilai;
        }

        // Tahap 1: Akar pembagi normalisasi
        $akarPembagi = [];
        foreach ($kriterias as $kriteria) {
            $totalKuadrat = 0;
            foreach ($masyarakats as $m) {
                $nilai = $matrix[$m->id][$kriteria->id] ?? 0;
                $totalKuadrat += pow($nilai, 2);
            }
            $akarPembagi[$kriteria->id] = sqrt($totalKuadrat);
        }

        // Tahap 2: Hitung normalisasi & preferensi
        $nilaiNormalisasi = [];
        $preferensi = [];

        foreach ($masyarakats as $m) {
            $totalBenefit = 0;
            $totalCost = 0;

            foreach ($kriterias as $kriteria) {
                $nilaiAwal = $matrix[$m->id][$kriteria->id] ?? 0;
                $akar = $akarPembagi[$kriteria->id] ?: 1;
                $r = $nilaiAwal / $akar;
                $bobot = $kriteria->bobot_normalisasi;
                $y = $r * $bobot;

                $nilaiNormalisasi[$m->id][$kriteria->id] = round($y, 4);

                if (strtolower($kriteria->jenis) === 'benefit') {
                    $totalBenefit += $y;
                } else {
                    $totalCost += $y;
                }
            }

            $preferensi[$m->id] = round($totalBenefit - $totalCost, 4);
        }

        // Urutkan hasil preferensi (ranking)
        arsort($preferensi);

        return view('admin.laporan.cetak', compact(
            'masyarakats',
            'kriterias',
            'penilaians',
            'matrix',
            'nilaiNormalisasi',
            'preferensi'
        ));
    }
}
