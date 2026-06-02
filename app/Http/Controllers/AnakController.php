<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Services\ZScoreService;
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
            'jenis_kelamin'      => 'required|in:Laki - Laki,Perempuan',
            'berat_badan'        => 'required|numeric|min:0.1|max:200',
            'tinggi_badan'       => 'required|numeric|min:10|max:250',
            'keterangan'         => 'nullable|string',
        ]);

        $umurBulan = Anak::hitungUmurBulan($validated['tanggal_lahir'], $validated['tanggal_pengukuran']);
        $imt       = Anak::hitungIMT($validated['berat_badan'], $validated['tinggi_badan']);
        $jk        = $validated['jenis_kelamin'];
        $bb        = $validated['berat_badan'];
        $tb        = $validated['tinggi_badan'];

        // BB/U
        $sdBBU     = ZScoreService::getSDtabelBBU($umurBulan, $jk);
        $zBBU      = $sdBBU ? ZScoreService::hitungZScore($bb, $sdBBU) : null;
        // TB/U
        $sdTBU     = ZScoreService::getSDtabelTBU($umurBulan, $jk);
        $zTBU      = $sdTBU ? ZScoreService::hitungZScore($tb, $sdTBU) : null;
        // BB/TB
        $sdBBTB    = ZScoreService::getSDtabelBBTB($tb, $jk);
        $zBBTB     = $sdBBTB ? ZScoreService::hitungZScore($bb, $sdBBTB) : null;
        // IMT/U
        $sdIMTU    = ZScoreService::getSDtabelIMTU($umurBulan, $jk);
        $zIMTU     = $sdIMTU ? ZScoreService::hitungZScore($imt, $sdIMTU) : null;

        Anak::create(array_merge($validated, [
            'umur_bulan'   => $umurBulan,
            'imt'          => $imt,
            'zscore_bbu'   => $zBBU,
            'status_bbu'   => $zBBU !== null ? ZScoreService::statusBBU($zBBU) : null,
            'zscore_tbu'   => $zTBU,
            'status_tbu'   => $zTBU !== null ? ZScoreService::statusTBU($zTBU) : null,
            'zscore_bbtb'  => $zBBTB,
            'status_bbtb'  => $zBBTB !== null ? ZScoreService::statusBBTB($zBBTB) : null,
            'zscore_imtu'  => $zIMTU,
            'status_imtu'  => $zIMTU !== null ? ZScoreService::statusIMTU($zIMTU) : null,
        ]));

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
            'jenis_kelamin'      => 'required|in:Laki - Laki,Perempuan',
            'berat_badan'        => 'required|numeric|min:0.1|max:200',
            'tinggi_badan'       => 'required|numeric|min:10|max:250',
            'keterangan'         => 'nullable|string',
        ]);

        $umurBulan = Anak::hitungUmurBulan($validated['tanggal_lahir'], $validated['tanggal_pengukuran']);
        $imt       = Anak::hitungIMT($validated['berat_badan'], $validated['tinggi_badan']);
        $jk        = $validated['jenis_kelamin'];
        $bb        = $validated['berat_badan'];
        $tb        = $validated['tinggi_badan'];

        $sdBBU     = ZScoreService::getSDtabelBBU($umurBulan, $jk);
        $zBBU      = $sdBBU ? ZScoreService::hitungZScore($bb, $sdBBU) : null;
        $sdTBU     = ZScoreService::getSDtabelTBU($umurBulan, $jk);
        $zTBU      = $sdTBU ? ZScoreService::hitungZScore($tb, $sdTBU) : null;
        $sdBBTB    = ZScoreService::getSDtabelBBTB($tb, $jk);
        $zBBTB     = $sdBBTB ? ZScoreService::hitungZScore($bb, $sdBBTB) : null;
        $sdIMTU    = ZScoreService::getSDtabelIMTU($umurBulan, $jk);
        $zIMTU     = $sdIMTU ? ZScoreService::hitungZScore($imt, $sdIMTU) : null;

        $anak->update(array_merge($validated, [
            'umur_bulan'  => $umurBulan,
            'imt'         => $imt,
            'zscore_bbu'  => $zBBU,
            'status_bbu'  => $zBBU !== null ? ZScoreService::statusBBU($zBBU) : null,
            'zscore_tbu'  => $zTBU,
            'status_tbu'  => $zTBU !== null ? ZScoreService::statusTBU($zTBU) : null,
            'zscore_bbtb' => $zBBTB,
            'status_bbtb' => $zBBTB !== null ? ZScoreService::statusBBTB($zBBTB) : null,
            'zscore_imtu' => $zIMTU,
            'status_imtu' => $zIMTU !== null ? ZScoreService::statusIMTU($zIMTU) : null,
        ]));

        return redirect()->route('anak.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Anak $anak)
    {
        $anak->delete();
        return redirect()->route('anak.index')->with('success', 'Data berhasil dihapus.');
    }
}
