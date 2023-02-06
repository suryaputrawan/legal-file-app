@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Settings</a></div>
            <div class="breadcrumb-item">User</div>
          </div>
    </div>

    <div class="section-body">
        <div class="col-12">
            <!-- Flass Message -->
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div> 
            @endif
            <!-- End Flass Message -->
            <div class="card">
              <form action="{{ route('settings.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="card-header">
                    <h4>Edit Data Users</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Nama User</label>
                      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" autocomplete="off">
                      @error('name')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" autocomplete="off">
                      @error('alias')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label>Roles</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="">Please select</option>
                                <option value="Admin" {{ old('role', $user->role) == "Admin" ? 'selected' : null }}>Admin</option>
                                <option value="Legal" {{ old('role', $user->role) == "Legal" ? 'selected' : null }}>Legal</option>
                                <option value="User" {{ old('role', $user->role) == "User" ? 'selected' : null }}>User</option>
                        </select>
                        @error('role')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save</button>
                  <a href="{{ route('settings') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
@endsection