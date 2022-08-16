@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->


    <!-- Main Content goes here -->
    <div class="row">
            <a href='{{ route('form_permohonan',$data->id ) }}' class="card border-left-success shadow h-100 py-2 m-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                FORMULIR<br>
                                PERMOHONAN<br>
                                REKOMENDASI<br>
                            </div>
                        </br>
                        <div class="text-sm font-weight-bold text-success  mb-1 text-center">
                            @if ($data->ttd == 'y')
                            <i class="fa fa-check fa-3x"></i>
                            @else
                            <i class="fa fa-ban fa-3x"></i>
                            @endif
                        </div>

                        <div class="text-sm font-weight-bold text-success  mb-1 text-center">
                                Klik Untuk Melihat Data
                        </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href='{{ route('status_permohonan',$data->id ) }}' class="card border-left-warning shadow h-100 py-2 m-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                                STATUS<br>
                                PERMOHONAN<br>
                                <br>
                            </div>
                        </br>
                        <div class="text-sm font-weight-bold text-warning  mb-1 text-center">
                            @if ($statusPermohonan=='Approved')
                                <i class="fa fa-check fa-3x"></i>
                            @else
                                    <i class="fa fa-ban fa-3x"></i>
                            @endif
                        </div>
                        <div class="text-sm font-weight-bold text-warning  mb-1 text-center">
                                Klik Untuk Melihat Data
                        </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    
<div class="card">
    <div class="card-body">
        <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>
        <div class="row">
            <div class="col">
                
                <div class="text-sm font-weight-bold  mb-1 text-left">
                    @if ($data->status == 'Draft')
                        <span><i class='fa fa-ban'></i> Simpan Data</span>
                    @else
                    <span class='text-success'><i class='fa fa-check'></i> Simpan Data</span>
                    @endif
                    |
                    @if ($data->ttd == 'n')
                    <span><i class="fa fa-ban"></i> Tanda Tangan</span>
                    @else
                    <span class='text-success'><i class="fa fa-check"></i> Tanda Tangan</span>
                    @endif
                    |
                    @if ($data->status == 'Approved')
                    <span class='text-success'><i class="fa fa-check"></i> Disetujui</span>
                    @else
                    <span><i class="fa fa-ban"></i> Disetujui</span>  
                    @endif
                </div>

                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                @endif

                
                <form action={{ route('simpan_rekomendasi') }} method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">NO SURAT</label>
                        <input type="text" class="form-control" name="nosurat" id="nama_sistem" placeholder="No surat" value="{{ $data->no_surat }}" required>
                        <input type="hidden" class="form-control" name="rekomendasi_id" id="rekomendasi_id"  value="{{ $data->id }}" required>
                    </div>
                     <div class="form-group">
                        <label for="name">ESTIMASI BIAYA</label>
                        <input type="number" class="form-control" name="estimasibiaya" id="estimasibiaya" placeholder="Estimasi Biaya" value="{{ $data->estimasi_biaya }}" required>
                    </div>
                
                    
                    <div class="form-group">
                      <label for="instansi">NAMA PERANGKAT DAERAH</label>
                      <select name="instansi" id="instansi" class="form-control">
                        {{-- @foreach ($instansis as $instansi)
                              <option value="{{ $instansi->name }}">{{ $instansi->name }}</option>
                        @endforeach --}}
                        @foreach ($instansis as $instansi)
                          <option value="{{ $instansi->name }}" @if ($instansi->name === $data->instansi)
                            SELECTED @endif >{{ $instansi->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">NAMA KEPALA DINAS/ UPT</label>
                        <input type="text" class="form-control" name="namakepaladinas" id="namakepaladinas" placeholder="Nama Kepala Dinas" value="{{ $data->nama_kepala_dinas }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">NIP KEPALA DINAS/ UPT</label>
                        <input type="text" class="form-control" name="nipkepaladinas" id="nipkepaladinas" placeholder="Nip Kepala Dinas" value="{{ $data->nip_kepala_dinas }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">BIDANG/BAGIAN/UPTD</label>
                        <input type="text" class="form-control" name="bidang" id="bidang" placeholder="Bidang" value="{{ $data->bidang }}" required>
                    </div>
    
                    <div class="form-group">
                        <label for="name">DESKRIPSI INVESTASI</label>
                        <input type="text" class="form-control" name="deskripsiinvestasi" id="deskripsiinvestasi" placeholder="Uraikan secara detail deskripsi investasi/Aplikasi" value="{{ $data->deskripsi_investasi }}" required>
                    </div>
    
                    <div class="form-group">
                        <label for="name">KONDISI SEKARANG</label>
                        <input type="text" class="form-control" name="kondisisekarang" id="kondisisekarang" placeholder="Dapat berupa narasi atau bagan proses bisnis saat ini" value="{{ $data->kondisi_sekarang }}" required>
                    </div>
    
                    <div class="form-group">
                        <label for="name">KONDISI YANG DIHARAPKAN</label>
                        <input type="text" class="form-control" name="kondisidiharapkan" id="kondisidiharapkan" placeholder="Kondisi yang diharapkan" value="{{ $data->kondisi_diharapkan }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">MANFAAT APLIKASI</label>
                        <input type="text" class="form-control" name="manfaataplikasi" id="manfaataplikasi" placeholder="Manfaat Aplikasi" value="{{ $data->manfaat_aplikasi }}" required>
                    </div>
    
                    <div class="form-group">
                        <label for="name">FITUR APLIKASI</label>
                        <input type="text" class="form-control" name="fituraplikasi" id="fituraplikasi" placeholder="Fitur Aplikasi" value="{{ $data->fitur_aplikasi }}" required>
                    </div>
    
                    <div class="form-group">
                        <label for="name">KEBUTUHAN DATA</label>
                        <input type="text" class="form-control" name="kebutuhandata" id="kebutuhandata" placeholder="Kebutuhan data" value="{{ $data->kebutuhan_data }}" required>
                    </div>
    
                    <div class="form-group">
                        <label for="name">NOMER KONTAK PIC</label>
                        <input type="text" class="form-control" name="kontakpic" id="kontakpic" placeholder="Nomer kontak PIC" value="{{$data->kontak_pic}}" required>
                    </div>
    
                    <div class="form-group">
                        <label for="name">RUANG LINGKUP ALIKASI</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ruanglingkupaplikasi" id="inlineRadio1" value="Public" @if ($data->ruang_lingkup_aplikasi === 'Public')
                            CHECKED @endif>
                            <label class="form-check-label" for="inlineRadio1">PUBLIC</label>
                          </div>
    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ruanglingkupaplikasi" id="inlineRadio2" value="Internal" @if ($data->ruang_lingkup_aplikasi === 'Internal')
                            CHECKED @endif>
                            <label class="form-check-label" for="inlineRadio2">INTERNAL</label>
                        </div>
    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ruanglingkupaplikasi" id="inlineRadio2" value="Public dan Internal" @if ($data->ruang_lingkup_aplikasi === 'Public dan Internal')
                            CHECKED @endif>
                            <label class="form-check-label" for="inlineRadio2">PUBLIC DAN INTERNAL</label>
                        </div>
                    </div>
                    <br>

                    @if($role==='client')
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='{{ route('print',$data->id)}}' target='_blank' class="btn btn-danger">Print</a>
                    @endif

                </form>
                <br>

                @if($role==='client')
                <form action={{ route('simpan_attachment') }} method="post" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
                    @csrf
                 
                    <div class="form-group">
                        <label for="name">Upload file yang telah ditandatangani</label>
                        <input type="hidden" value="{{ $data->id }}" name="rekomendasi_id">
                        <input type="hidden" value="Form Rekomendasi" name="judul">
                        <input type="hidden" value="Form Rekomendasi Telah ditandatangani" name="deskripsi">
                        <input type="file" class="form-control" name="file" id="file"  value="" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                    
                </form>
                @else
                <a class="btn btn-success" href="{{ route('downloadfile',$file_ttd) }}" target="_blank">
                    <i class="fa fa-check"></i> Dokumen Telah ditandatangni, Lihat Dokument
                </a>    
                @endif


            </div>
            <div class="col">
                <h3>Informasi</h3>
                <p>
                    Sesuai Peraturan Gubernur DIY Nomor 2 Tahun 2018 tentang Tata Kelola Teknologi Informasi dan Komunikasi Pasal 7 Ayat 3, seluruh investasi Teknologi Informasi dan Komunikasi (TIK) harus mendapatkan rekomendasi TIK dari Dinas Komunikasi dan Informatika DIY.
                </p>
                <h3>Attachment</h3>
                <p>Silakan tambahkan file-file pendukung jika diperlukan (opsional)</p>
                
                @if ($role === 'client')
                <form action={{ route('simpan_attachment') }} method="post" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">JUDUL</label>
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul " value="" required >
                        <input type="hidden" value="{{ $data->id }}" name="rekomendasi_id">
                    </div>
                     <div class="form-group">
                        <label for="name">DESKRIPSI</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="name">LAMPIRAN</label>
                        <input type="file" class="form-control" name="file" id="file"  value="" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>JUDUL</th>
                            <th>DESKRIPSI</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach ($attachment as $val)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $val->judul }}</td>
                    <td>{{ $val->deskripsi }}</td>
                    <td>
                    

                            <a  href={{ route('downloadfile',$val->filename) }} class="btn btn-xs btn-primary" target="_blank"><i class="fa fa-download"></i></a>
                         
                            <form action="{{ route('deletefile') }}" method="post">
                                @csrf
                                @method('post')
                                <input type="hidden" value="{{ $val->filename }}" name="filename">
                                <input type="hidden" value="{{ $data->id }}" name="rekomendasi_id">
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash"></i></button>
                            </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>


  
            
            

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
