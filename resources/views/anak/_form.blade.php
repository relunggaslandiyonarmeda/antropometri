@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <h6 class="fw-semibold text-primary border-bottom pb-2 mb-3">
            <i class="bi bi-person-fill me-1"></i> Data Anak
        </h6>

        <div class="mb-3">
            <label class="form-label fw-medium">Nama Anak <span class="text-danger">*</span></label>
            <input type="text" name="nama_anak" class="form-control @error('nama_anak') is-invalid @enderror"
                   value="{{ old('nama_anak', $anak->nama_anak ?? '') }}" required>
            @error('nama_anak')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">NIK Anak</label>
            <input type="text" name="nik_anak" class="form-control @error('nik_anak') is-invalid @enderror"
                   value="{{ old('nik_anak', $anak->nik_anak ?? '') }}" maxlength="20">
            @error('nik_anak')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Nama Orang Tua</label>
            <input type="text" name="nama_orang_tua" class="form-control"
                   value="{{ old('nama_orang_tua', $anak->nama_orang_tua ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                   value="{{ old('tanggal_lahir', isset($anak) ? $anak->tanggal_lahir->format('Y-m-d') : '') }}" required>
            @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Jenis Kelamin <span class="text-danger">*</span></label>
            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="Laki - Laki" {{ old('jenis_kelamin', $anak->jenis_kelamin ?? '') == 'Laki - Laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="Perempuan"   {{ old('jenis_kelamin', $anak->jenis_kelamin ?? '') == 'Perempuan'   ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6">
        <h6 class="fw-semibold text-primary border-bottom pb-2 mb-3">
            <i class="bi bi-rulers me-1"></i> Data Pengukuran
        </h6>

        <div class="mb-3">
            <label class="form-label fw-medium">Tanggal Pengukuran <span class="text-danger">*</span></label>
            <input type="date" name="tanggal_pengukuran" class="form-control @error('tanggal_pengukuran') is-invalid @enderror"
                   value="{{ old('tanggal_pengukuran', isset($anak) ? $anak->tanggal_pengukuran->format('Y-m-d') : date('Y-m-d')) }}" required>
            @error('tanggal_pengukuran')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Alamat / Posyandu</label>
            <input type="text" name="alamat" class="form-control"
                   value="{{ old('alamat', $anak->alamat ?? '') }}">
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label class="form-label fw-medium">Berat Badan (kg) <span class="text-danger">*</span></label>
                <input type="number" name="berat_badan" step="0.01" min="0.1" max="200"
                       class="form-control @error('berat_badan') is-invalid @enderror"
                       value="{{ old('berat_badan', $anak->berat_badan ?? '') }}" required>
                @error('berat_badan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-6 mb-3">
                <label class="form-label fw-medium">Tinggi/Panjang (cm) <span class="text-danger">*</span></label>
                <input type="number" name="tinggi_badan" step="0.1" min="10" max="250"
                       class="form-control @error('tinggi_badan') is-invalid @enderror"
                       value="{{ old('tinggi_badan', $anak->tinggi_badan ?? '') }}" required>
                @error('tinggi_badan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $anak->keterangan ?? '') }}</textarea>
        </div>
    </div>
</div>
