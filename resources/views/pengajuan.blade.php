@include('partials.navbar')


    <!-- Hero Start -->
    <div class="container-fluid pb-5 bg-primary hero-header">
        <div class="container py-5">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-1 mb-0 animated slideInLeft">Pengajuan</h1>
                </div>
                <div class="col-lg-6 animated slideInRight">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center justify-content-lg-end mb-0">
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-primary" href="#!">Pages</a></li>
                            <li class="breadcrumb-item text-secondary active" aria-current="page">Pengajuan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container p-4 shadow" style="border-radius: 10px">
            <div class="head d-flex justify-content-between">
                <h1>Data Pengajuan</h1>
                <button class="btn btn-primary h-25"  data-bs-toggle="modal" data-bs-target="#modalPengajuan"><i class="bi bi-plus-circle"></i> Tambah Pengajuan</button>

            </div>
            <div style="overflow-x:auto;">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Kategori</th>
                        <th>Tanggal Pengajuan</th>
                        <th>No. NPAK</th>
                        <th>Nama Koperasi</th>
                        <th>Alamat Koperasi</th>
                        <th>Simpanan Pokok</th>
                        <th>Simpanan Wajib</th>
                        <th>Jumlah Pengurus</th>
                        <th>Nama Ketua</th>
                        <th>Nama Wakil</th>
                        <th>Nama Sekretaris</th>
                        <th>Nama Bendahara</th>
                        <th>Pengawas</th>
                        <th>Rencana Kegiatan</th>
                        <th>Data NPAK</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($data as $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->kategoriKoperasi->jenis_koperasi ?? '-' }}</td>
                            <td>{{ $item->tgl_pengajuan }}</td>
                            <td>{{ $item->no_npak }}</td>
                            <td>{{ $item->nama_koperasi }}</td>
                            <td>{{ $item->alamat_koperasi }}</td>
                            <td>{{ number_format($item->simpanan_pokok, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->simpanan_wajib, 0, ',', '.') }}</td>
                            <td>{{ $item->jumlah_pengurus }}</td>
                            <td>{{ $item->nama_ketua }}</td>
                            <td>{{ $item->nama_wakil }}</td>
                            <td>{{ $item->nama_sekretaris }}</td>
                            <td>{{ $item->nama_bendahara }}</td>
                            <td>{{ $item->pengawas }}</td>
                            <td>{{ $item->rencana_kegiatan }}</td>
                            <td>
                                @if($item->data_npak)
                                <a href="{{ asset('storage/' . $item->data_npak) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="bi bi-download"></i>
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                @if ($item->status == "Menunggu Konfirmasi")
                                    <span class="badge bg-warning"><i class="bi bi-clock-history"></i> {{ $item->status }}</span></td>
                                    
                                @else
                                    <span class="badge bg-success"><i class="bi bi-patch-check"></i> {{ $item->status }}</span></td>

                                @endif
                            <td>
                                <div class="d-flex">

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdatePengajuan{{ $item->id }}" class="btn btn-sm btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
                                    <form action="/pengajuan/delete/{{ $item->id }}" method="POST" class="d-inline" id="form-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>


                                {{-- form update pengajuan --}}
                                <!-- Modal Update Pengajuan -->
                                <div class="modal fade" id="modalUpdatePengajuan{{ $item->id }}" tabindex="-1" aria-labelledby="modalUpdatePengajuanLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        
                                        <!-- Header -->
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title text-white" id="modalPengajuanLabel">Update Data Pengajuan</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Body -->
                                        <div class="modal-body">
                                            <form action="/pengajuan/update/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <!-- Nama Lengkap -->
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama Lengkap</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-person-fill"></i></span>
                                                        <input type="text" value="{{ Auth::user()->name }}" readonly name="name" id="name" class="form-control" required>
                                                    </div>
                                                </div>

                                                <!-- Kategori -->
                                                <div class="mb-3">
                                                    <label for="kategoriId" class="form-label">Kategori Koperasi</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-list-check"></i></span>
                                                        <select name="kategoriId" id="kategoriId" class="form-select" required>
                                                            <option value="">-- Pilih Kategori --</option>
                                                            @foreach ($kategori_koperasi as $items)
                                                                <option value="{{ $items->id }}" @if($items->id === $item->kategoriId) selected @endif>{{ $items->jenis_koperasi}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Tanggal Pengajuan -->
                                                <div class="mb-3">
                                                    <label for="tgl_pengajuan" class="form-label">Tanggal Pengajuan</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-calendar-date"></i></span>
                                                        <input type="date" name="tgl_pengajuan" id="tgl_pengajuan" class="form-control" value="{{ $item->tgl_pengajuan }}" required>
                                                    </div>
                                                </div>

                                                <!-- Nomor NPAK -->
                                                <div class="mb-3">
                                                    <label for="no_npak" class="form-label">Nomor NPAK</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-hash"></i></span>
                                                        <input type="text" name="no_npak" id="no_npak" class="form-control" value="{{ $item->no_npak }}" required>
                                                    </div>
                                                </div>

                                                <!-- Nama Koperasi -->
                                                <div class="mb-3">
                                                    <label for="nama_koperasi" class="form-label">Nama Koperasi</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                                                        <input type="text" name="nama_koperasi" id="nama_koperasi" class="form-control" value="{{ $item->nama_koperasi }}" required>
                                                    </div>
                                                </div>

                                                <!-- Alamat -->
                                                <div class="mb-3">
                                                    <label for="alamat_koperasi" class="form-label">Alamat Koperasi</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-geo-alt"></i></span>
                                                        <textarea name="alamat_koperasi" id="alamat_koperasi" class="form-control" rows="2" required>{{ $item->alamat_koperasi }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Simpanan Pokok -->
                                                <div class="mb-3">
                                                    <label for="simpanan_pokok" class="form-label">Simpanan Pokok</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-cash"></i></span>
                                                        <input type="number" name="simpanan_pokok" id="simpanan_pokok" class="form-control" value="{{ $item->simpanan_pokok }}" required>
                                                    </div>
                                                </div>

                                                <!-- Simpanan Wajib -->
                                                <div class="mb-3">
                                                    <label for="simpanan_wajib" class="form-label">Simpanan Wajib</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-wallet2"></i></span>
                                                        <input type="number" name="simpanan_wajib" id="simpanan_wajib" class="form-control" value="{{ $item->simpanan_wajib }}" required>
                                                    </div>
                                                </div>

                                                <!-- Jumlah Pengurus -->
                                                <div class="mb-3">
                                                    <label for="jumlah_pengurus" class="form-label">Jumlah Pengurus</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-people"></i></span>
                                                        <input type="number" name="jumlah_pengurus" id="jumlah_pengurus" class="form-control" value="{{ $item->jumlah_pengurus }}" required>
                                                    </div>
                                                </div>

                                                <!-- Nama Ketua -->
                                                <div class="mb-3">
                                                    <label for="nama_ketua" class="form-label">Nama Ketua</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-person-badge"></i></span>
                                                        <input type="text" name="nama_ketua" id="nama_ketua" class="form-control" value="{{ $item->nama_ketua }}" required>
                                                    </div>
                                                </div>

                                                <!-- Nama Wakil -->
                                                <div class="mb-3">
                                                    <label for="nama_wakil" class="form-label">Nama Wakil</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                                                        <input type="text" name="nama_wakil" id="nama_wakil" class="form-control" value="{{ $item->nama_wakil }}" required>
                                                    </div>
                                                </div>

                                                <!-- Nama Sekretaris -->
                                                <div class="mb-3">
                                                    <label for="nama_sekretaris" class="form-label">Nama Sekretaris</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-pencil-square"></i></span>
                                                        <input type="text" name="nama_sekretaris" id="nama_sekretaris" class="form-control" value="{{ $item->nama_sekretaris }}" required>
                                                    </div>
                                                </div>

                                                <!-- Nama Bendahara -->
                                                <div class="mb-3">
                                                    <label for="nama_bendahara" class="form-label">Nama Bendahara</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-briefcase"></i></span>
                                                        <input type="text" name="nama_bendahara" id="nama_bendahara" class="form-control" value="{{ $item->nama_bendahara }}" required>
                                                    </div>
                                                </div>

                                                <!-- Pengawas -->
                                                <div class="mb-3">
                                                    <label for="pengawas" class="form-label">Pengawas</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-shield-check"></i></span>
                                                        <input type="text" name="pengawas" id="pengawas" class="form-control" value="{{ $item->pengawas }}" required>
                                                    </div>
                                                </div>

                                                <!-- Rencana Kegiatan -->
                                                <div class="mb-3">
                                                    <label for="rencana_kegiatan" class="form-label">Rencana Kegiatan</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-journal-text"></i></span>
                                                        <textarea name="rencana_kegiatan" id="rencana_kegiatan" class="form-control" rows="2" required>{{ $item->rencana_kegiatan }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Upload Data NPAK -->
                                                <div class="mb-3">
                                                    <label for="data_npak" class="form-label">Upload Data NPAK</label>
                                                    <input type="file" name="data_npak" id="data_npak" class="form-control" accept=".pdf,.jpg,.png,.jpeg">
                                                    @if($item->data_npak)
                                                        <small>File saat ini: <a href="{{ Storage::url($item->data_npak) }}" target="_blank">{{ $item->data_npak }}</a></small>
                                                    @endif
                                                </div>

                                                <!-- Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <!-- Service End -->

    {{-- form pengajuan --}}
    <!-- Modal Tambah Pengajuan -->
    <div class="modal fade" id="modalPengajuan" tabindex="-1" aria-labelledby="modalPengajuanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="modalPengajuanLabel">Tambah Data Pengajuan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form action="/pengajuan" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="no_npak" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person-fill"></i></span>
                    <input type="text" value="{{ Auth::user()->name }}" readonly name="name" id="name" class="form-control" required>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategoriId" class="form-label">Kategori Koperasi</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-list-check"></i></span>
                    <select name="kategoriId" id="kategoriId" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori_koperasi as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->jenis_koperasi }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <!-- Tanggal Pengajuan -->
                <div class="mb-3">
                    <label for="tgl_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-calendar-date"></i></span>
                    <input type="date" name="tgl_pengajuan" id="tgl_pengajuan" class="form-control" required>
                    </div>
                </div>

                
                <!-- No NPAK -->
                <div class="mb-3">
                    <label for="no_npak" class="form-label">Nomor NPAK</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-hash"></i></span>
                    <input type="text" name="no_npak" id="no_npak" class="form-control" required>
                    </div>
                </div>

                <!-- Nama Koperasi -->
                <div class="mb-3">
                    <label for="nama_koperasi" class="form-label">Nama Koperasi</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                    <input type="text" name="nama_koperasi" id="nama_koperasi" class="form-control" required>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat_koperasi" class="form-label">Alamat Koperasi</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-geo-alt"></i></span>
                    <textarea name="alamat_koperasi" id="alamat_koperasi" class="form-control" rows="2" required></textarea>
                    </div>
                </div>

                <!-- Simpanan Pokok -->
                <div class="mb-3">
                    <label for="simpanan_pokok" class="form-label">Simpanan Pokok</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-cash"></i></span>
                    <input type="number" name="simpanan_pokok" id="simpanan_pokok" class="form-control" required>
                    </div>
                </div>

                <!-- Simpanan Wajib -->
                <div class="mb-3">
                    <label for="simpanan_wajib" class="form-label">Simpanan Wajib</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-wallet2"></i></span>
                    <input type="number" name="simpanan_wajib" id="simpanan_wajib" class="form-control" required>
                    </div>
                </div>

                <!-- Jumlah Pengurus -->
                <div class="mb-3">
                    <label for="jumlah_pengurus" class="form-label">Jumlah Pengurus</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-people"></i></span>
                    <input type="number" name="jumlah_pengurus" id="jumlah_pengurus" class="form-control" required>
                    </div>
                </div>

                <!-- Nama Ketua -->
                <div class="mb-3">
                    <label for="nama_ketua" class="form-label">Nama Ketua</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person-badge"></i></span>
                    <input type="text" name="nama_ketua" id="nama_ketua" class="form-control" required>
                    </div>
                </div>

                <!-- Nama Wakil -->
                <div class="mb-3">
                    <label for="nama_wakil" class="form-label">Nama Wakil</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                    <input type="text" name="nama_wakil" id="nama_wakil" class="form-control" required>
                    </div>
                </div>

                <!-- Nama Sekretaris -->
                <div class="mb-3">
                    <label for="nama_sekretaris" class="form-label">Nama Sekretaris</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-pencil-square"></i></span>
                    <input type="text" name="nama_sekretaris" id="nama_sekretaris" class="form-control" required>
                    </div>
                </div>

                <!-- Nama Bendahara -->
                <div class="mb-3">
                    <label for="nama_bendahara" class="form-label">Nama Bendahara</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-briefcase"></i></span>
                    <input type="text" name="nama_bendahara" id="nama_bendahara" class="form-control" required>
                    </div>
                </div>

                <!-- Pengawas -->
                <div class="mb-3">
                    <label for="pengawas" class="form-label">Pengawas</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-shield-check"></i></span>
                    <input type="text" name="pengawas" id="pengawas" class="form-control" required>
                    </div>
                </div>

                <!-- Rencana Kegiatan -->
                <div class="mb-3">
                    <label for="rencana_kegiatan" class="form-label">Rencana Kegiatan</label>
                    <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-journal-text"></i></span>
                    <textarea name="rencana_kegiatan" id="rencana_kegiatan" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
                <!-- Upload Data NPAK -->
                <div class="mb-3">
                    <label for="data_npak" class="form-label">Upload Data NPAK</label>
                    <input type="file" name="data_npak" id="data_npak" class="form-control" accept=".pdf,.jpg,.png,.jpeg" required>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

                </form>
            </div>
        </div>
    </div>

</div>

  
    @include('partials.footer')