@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action={{ route('makedraft') }} method="post">
                @csrf

                <div class="form-group">
                    <label for="name">NAMA INVESTASI/SISTEM ELETRONIK</label>
                    <input type="text" class="form-control" name="nama_sistem" id="nama_sistem" placeholder="Nama Investasi/Sistem Eletronik" value="" required>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>

            </form>
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
