@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->
    <div class="card">
        <div class="card-body">
            <form action={{ route('user_store') }} method="post">
                @csrf

                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="First name" autocomplete="off" value="">
                </div>

                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" autocomplete="off" value="">
                </div>

                <div class="form-group">
                  <label for="nip">N I P</label>
                  <input type="text" class="form-control" name="nip" id="nip" placeholder="N I P" autocomplete="off" value="">
                </div>

                <div class="form-group">
                  <label for="instansi">Instansi</label>
                  <select name="instansi" id="instansi" class="form-control">
                    @foreach ($instansis as $instansi)
                          <option value="{{ $instansi->name }}">{{ $instansi->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="role">Role</label>
                  <select name="role" id="role" class="form-control">
              
                          <option value="admin">ADMIN PELADEN</option>
                          <option value="client">ADMIN ODP</option>
             
                  </select>
                </div>


                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" value="">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href={{ route('user') }} class="btn btn-danger">Back to list</a>

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
