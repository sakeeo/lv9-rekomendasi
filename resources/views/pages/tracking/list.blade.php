@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-stripped" id="myTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>TIPE</th>
                        <th>NAMA APLIKASI</th>
                        <th>INSTANSI</th>
                        <th>CREATE AT</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $val)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $val->tipe }}</td>
                            <td>{{ $val->nama_sistem_eletronik }}</td>
                            <td>{{ $val->instansi }}</td>
                            <td>{{ $val->created_at }}</td>
                            <td>{{ $val->status }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('form_permohonan', $val->id) }}" class="btn btn-sm btn-primary mr-2">LIHAT DATA</a>
                                    <form action="{{ route('user_destroy', $val->id) }}" method="get">
                                        @csrf
                                        @method('get')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
