<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Alamat/Posyandu</th>
            <th>Tgl Pengukuran</th>
            <th>Nama Orang Tua</th>
            <th>NIK Anak</th>
            <th>Nama Anak</th>
            <th>Tanggal Lahir</th>
            <th>Umur (Bln)</th>
            <th>Jenis Kelamin</th>
            <th>BB (kg)</th>
            <th>TB/PB (cm)</th>
            <th>IMT</th>
            <th>Z-Score BB/U</th>
            <th>Status BB/U</th>
            <th>Z-Score TB/U</th>
            <th>Status TB/U</th>
            <th>Z-Score BB/TB</th>
            <th>Status BB/TB</th>
            <th>Z-Score IMT/U</th>
            <th>Status IMT/U</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $a)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $a->alamat ?? '-' }}</td>
                <td>{{ $a->tanggal_pengukuran->format('d/m/Y') }}</td>
                <td>{{ $a->nama_orang_tua ?? '-' }}</td>
                <td>{{ $a->nik_anak ?? '-' }}</td>
                <td>{{ $a->nama_anak }}</td>
                <td>{{ $a->tanggal_lahir->format('d/m/Y') }}</td>
                <td>{{ $a->umur_bulan }}</td>
                <td>{{ $a->jenis_kelamin }}</td>
                <td>{{ $a->berat_badan }}</td>
                <td>{{ $a->tinggi_badan }}</td>
                <td>{{ $a->imt ?? '-' }}</td>
                <td>{{ $a->zscore_bbu ?? '-' }}</td>
                <td>{{ $a->status_bbu ?? '-' }}</td>
                <td>{{ $a->zscore_tbu ?? '-' }}</td>
                <td>{{ $a->status_tbu ?? '-' }}</td>
                <td>{{ $a->zscore_bbtb ?? '-' }}</td>
                <td>{{ $a->status_bbtb ?? '-' }}</td>
                <td>{{ $a->zscore_imtu ?? '-' }}</td>
                <td>{{ $a->status_imtu ?? '-' }}</td>
                <td>{{ $a->keterangan ?? '' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="21" style="text-align:center;">Tidak ada data untuk ditampilkan.</td>
            </tr>
        @endforelse
    </tbody>
</table>
