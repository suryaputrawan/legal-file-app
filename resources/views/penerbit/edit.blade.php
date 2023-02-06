@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penerbit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Utilities</a></div>
            <div class="breadcrumb-item">Penerbit</div>
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
              <form action="{{ route('penerbit.update', $penerbit->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="card-header">
                  <h4>Edit Data Penerbit</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Penerbit Surat</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" value="{{ $penerbit->name }}">
                    @error('name')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" autocomplete="off" value="{{ $penerbit->address }}">
                    @error('address')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Telphone</label>
                    <input type="text" name="telphone" id="telphone" class="form-control @error('telphone') is-invalid @enderror" autocomplete="off" value="{{ $penerbit->telphone }}">
                    @error('telphone')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save</button>
                  <a href="{{ route('penerbit.index') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
@endsection