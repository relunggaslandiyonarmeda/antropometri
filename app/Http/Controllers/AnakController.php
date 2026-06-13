<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnakController extends Controller
{
    public function index(Request $request)
    {
        $query = Anak::query();

        if ($request->filled('search')) {
            $query->where('nama_anak', 'like', '%' . $request->search . '%')
                  ->orWhere('nik_anak', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status_gizi')) {
            $query->where('status_bbu', $request->status_gizi);
        }

        $data = $query->latest()->paginate(15)->withQueryString();
        return view('anak.index', compact('data'));
    }

    public function create()
    {
        return view('anak.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat'             => 'nullable|string|max:255',
            'tanggal_pengukuran' => 'required|date',
            'nama_orang_tua'     => 'nullable|string|max:255',
            'nik_anak'           => 'nullable|string|max:20',
            'nama_anak'          => 'required|string|max:255',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => ['required', Rule::in(Anak::GENDERS)],
            'berat_badan'        => 'required|numeric|min:0.1|max:200',
            'tinggi_badan'       => 'required|numeric|min:10|max:250',
            'keterangan'         => 'nullable|string',
        ]);
        $calculated = Anak::computeGizi($validated);

        Anak::create(array_merge($validated, $calculated));

        return redirect()->route('anak.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show(Anak $anak)
    {
        return view('anak.show', compact('anak'));
    }

    public function edit(Anak $anak)
    {
        return view('anak.edit', compact('anak'));
    }

    public function update(Request $request, Anak $anak)
    {
        $validated = $request->validate([
            'alamat'             => 'nullable|string|max:255',
            'tanggal_pengukuran' => 'required|date',
            'nama_orang_tua'     => 'nullable|string|max:255',
            'nik_anak'           => 'nullable|string|max:20',
            'nama_anak'          => 'required|string|max:255',
            'tanggal_lahir'      => 'required|date',
            'jenis_kelamin'      => ['required', Rule::in(Anak::GENDERS)],
            'berat_badan'        => 'required|numeric|min:0.1|max:200',
            'tinggi_badan'       => 'required|numeric|min:10|max:250',
            'keterangan'         => 'nullable|string',
        ]);
        $calculated = Anak::computeGizi($validated);

        $anak->update(array_merge($validated, $calculated));

        return redirect()->route('anak.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Anak $anak)
    {
        $anak->delete();
        return redirect()->route('anak.index')->with('success', 'Data berhasil dihapus.');
    }
}
