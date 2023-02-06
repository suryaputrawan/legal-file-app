@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Counter / Rekanan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Utilities</a></div>
            <div class="breadcrumb-item">Counter</div>
          </div>
    </div>

    <div class="section-body">
        <div class="col-12">
            <!-- Flass Message -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                        {{ session('error') }}
                    </div> 
                </div> 
            @endif
            <!-- End Flass Message -->
            <div class="card">
              <form action="{{ route('counter.update', $counter->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                <div class="card-header">
                  <h4>Edit Data Rekanan</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                  <div class="form-group">
                    <label>Nama Rekanan</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $counter->name }}" autocomplete="off">
                    @error('name')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $counter->alamat }}" autocomplete="off">
                    @error('alamat')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Telphone</label>
                    <input type="text" name="telphone" id="telphone" class="form-control @error('telphone') is-invalid @enderror" value="{{ $counter->telphone }}" autocomplete="off">
                    @error('telphone')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $counter->email }}" autocomplete="off">
                    @error('email')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" name="npwp" id="npwp" class="form-control @error('npwp') is-invalid @enderror" value="{{ $counter->npwp }}" autocomplete="off">
                    @error('npwp')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save</button>
                  <a href="{{ route('counter') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
@endsection