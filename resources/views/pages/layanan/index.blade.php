@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="row">
        

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">REKOMENDASI</div>
                        </br>
                            <div class="text-md font-weight-bold text-gray-800  mb-1 ">Pengajuan rekomendasi pembuatan sistem eletronik</div>
                        </br>
                        </br>
                            <a href={{route('form_nama_sistem')}} class="text-md font-weight-bold text-success  mb-1 text-right">Pilih <i class="fa fa-arrow-right"></i></a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>

      

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">SUBDOMAIN & HOSTING</div>
                        </br>
                            <div class="text-md font-weight-bold text-gray-800  mb-1 ">
                                Gunakan Subdomain untuk memberi nama dan hosting untuk menyimpan file sistem eletronik anda
                            </div>
                        </br>
                            <div class="text-md font-weight-bold text-success  mb-1 text-right">Pilih <i class="fa fa-arrow-right"></i></div>
                        </div>
                       
                    </div>
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
