@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="row">
        <a href='{{ route('form_permohonan',$permohonan_id ) }}' class="card border-left-warning shadow h-100 py-2 m-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                            FORMULIR<br>
                            PERMOHONAN<br>
                            REKOMENDASI<br>
                        </div>
                    </br>
                    <div class="text-sm font-weight-bold text-warning  mb-1 text-center">
                            @if ($ttd == 'y')
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

        <a href='{{ route('status_permohonan',$permohonan_id ) }}' class="card border-left-success shadow h-100 py-2 m-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">
                            STATUS<br>
                            PERMOHONAN<br>
                            <br>
                        </div>
                    </br>
                    <div class="text-sm font-weight-bold text-success  mb-1 text-center">

                       @if ($statusPermohonan=='Approved')
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

    </div>
    


    <!-- Main Content goes here -->


    @if ($role==='admin')
    <div class="card">
        <div class="card-body">
            <h2 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h2>
            <div class="row">
                <div class="col">
                    <form action={{ route('simpan_status') }} method="post" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nomer Surat</label>
                            <input type="text" class="form-control" name="nosurat" id="nosurat" placeholder="nomer surat " value="{{ $dataStatus->nosurat    }}" required >
                            <input type="hidden" value="{{ $dataStatus->secondary_id }}" name="secondary_id">
                        </div>
                         <div class="form-group">
                            <label for="name">DESKRIPSI</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="{{ $dataStatus->deskripsi }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">STATUS PERMOHONAN REKOMENDASI</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_permohonan" id="inlineRadio1" value="Disetujui" @if ($dataStatus->status_permohonan === 'Disetujui')
                                CHECKED @endif>
                                <label class="form-check-label" for="inlineRadio1">Disetujui</label>
                              </div>
                              <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_permohonan" id="inlineRadio2" value="Ditolak" @if ($dataStatus->status_permohonan === 'Ditolak')
                                CHECKED @endif>
                                <label class="form-check-label" for="inlineRadio2">Ditolak</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_permohonan" id="inlineRadio2" value="Disetujui dengan catatan" @if ($dataStatus->status_permohonan === 'Disetujui dengan catatan')
                                CHECKED @endif>
                                <label class="form-check-label" for="inlineRadio2">Disetujui dengan catatan</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
                <div class="col">
                    <form action={{ route('simpan_poin_rekomendasi') }} method="post" aria-label="{{ __('Upload') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Poin Rekomendasi</label>
                            <input type="text" class="form-control" name="poin_rekomendasi" id="poin_rekomendasi" placeholder="Poin rekomendasi " value="" required >
                            <input type="hidden" value="{{ $dataStatus->secondary_id }}" name="permohonan_id">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>POIN</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach ($points as $val)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $val->poin_rekomendasi }}</td>
                        <td>
                                <form action="{{ route('deletepoin') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" value="{{ $val->id }}" name="id">
                                    <input type="hidden" value="{{ $val->permohonan_id }}" name="permohonan_id">
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
    @else
    <div class="card">
        <div class="card-body">
            
            <table class="table">
                <tbody>
                    <tr>
                        <td>ID.PERMOHONAN</td>
                        <td>:</td>
                        <td>{{ $permohonan_id }}</td>
                    </tr>
                    <tr>
                        <td>STATUS PERMOHONAN</td>
                        <td>:</td>
                        <td>{{ $dataStatus['status_permohonan'] }}</td>
                    </tr>
                    <tr>
                        <td>NO.SURAT</td>
                        <td>:</td>
                        <td>{{ $dataStatus['nosurat'] }}</td>
                    </tr>
                    <tr>
                        <td>DESKRIPSI</td>
                        <td>:</td>
                        <td>{{ $dataStatus['deskripsi'] }}</td>
                    </tr>
                    <tr>
                        <td>POIN REKOMENDASI</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif



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
