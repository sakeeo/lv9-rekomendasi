@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile_update') }}" method="post">
                @csrf
                @method('post')

                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="First name" autocomplete="off" value="{{ old('name') ?? $user->name }}">
                  <input type="hidden" class="form-control" name="id" id="id" value="{{ $user->id }}">
                </div>

                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" autocomplete="off" value="{{ old('last_name') ?? $user->last_name }}">
                </div>

                <div class="form-group">
                  <label for="last_name">N I P</label>
                  <input type="text" class="form-control" name="nip" id="nip" placeholder="N I P" autocomplete="off" value="{{ old('nip') ?? $user->nip }}">
                </div>

                <div class="form-group">
                  <label for="instansi">Instansi</label>
                  <select name="instansi" id="instansi" class="form-control">
                    @foreach ($instansis as $instansi)
                          <option value="{{ $instansi->name }}" @if ($instansi->name === $user->instansi)
                            SELECTED @endif >{{ $instansi->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="role">Role</label>
                  <select name="role" id="role" class="form-control">
              
                          <option value="admin" @if ($instansi->role === 'admin')
                            SELECTED @endif >ADMIN PELADEN</option>
                          <option value="client" @if ($instansi->role === 'client')
                            SELECTED @endif >ADMIN ODP</option>

                  </select>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" value="{{ old('email') ?? $user->email }}">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('dasboard') }}" class="btn btn-danger">Back to Home</a>

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
