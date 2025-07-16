<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasyarakatController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input keyword pencarian dan jumlah item per halaman
        $nama = $request->input('search'); // bisa nama atau NIK
        $paginate = $request->input('itemsPerPage', 5); // default 5 item per halaman

        // Mulai query
        $query = Masyarakat::query();

        // Jika ada keyword pencarian
        if (!empty($nama)) {
            $query->where(function ($q) use ($nama) {
                $q->where('nama', 'like', '%' . $nama . '%')
                    ->orWhere('nik', 'like', '%' . $nama . '%');
            });
        }

        // Eksekusi query dengan paginasi
        $masyarakats = $query->paginate($paginate);

        // Kirim data ke view
        return view('admin.masyarakat.index', compact('masyarakats', 'nama'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'pekerjaan'         => 'required|string|max:100',
            'penghasilan'       => 'required|string',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'status_rumah'      => 'required|string|max:100',
            'pendidikan'        => 'required|string|max:100',
        ]);

        Masyarakat::create($validated);

        Alert::success('Sukses', 'Data masyarakat berhasil ditambahkan');
        return redirect()->route('masyarakat.index');
    }

    public function edit($id)
    {
        $masyarakats = Masyarakat::find($id);
        // Validasi apakah data ditemukan
        if (!$masyarakats) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('admin.masyarakat.edit', compact('masyarakats'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'pekerjaan'         => 'required|string|max:100',
            'penghasilan'       => 'required|string',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'status_rumah'      => 'required|string|max:100',
            'pendidikan'        => 'required|string|max:100',
        ]);

        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->update($validated);

        Alert::success('Sukses', 'Data masyarakat berhasil diperbarui');
        return redirect()->route('masyarakat.index');
    }


    public function show($id)
    {
        $masyarakats = Masyarakat::findOrFail($id);
        return view('admin.masyarakat.show', compact('masyarakats'));
    }

    public function destroy($id)
    {

        $masyarakats = Masyarakat::where('id', $id)->first();
        $masyarakats->delete();

        Alert::success('Success', 'Data berhasil di Hapus');
        return redirect()->route('masyarakat.index');
    }
}
