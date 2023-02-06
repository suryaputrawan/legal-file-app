@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit / Perusahaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Utilities</a></div>
            <div class="breadcrumb-item">Unit</div>
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
              <form action="{{ route('unit.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="card-header">
                    <h4>Edit Data Unit / Perusahaan</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Nama Perusahaan / PT</label>
                      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $unit->name }}" autocomplete="off">
                      @error('name')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Nama Alias</label>
                      <input type="text" name="alias" id="alias" class="form-control @error('alias') is-invalid @enderror" value="{{ $unit->alias }}" autocomplete="off">
                      @error('alias')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ $unit->address }}" autocomplete="off">
                      @error('address')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Telphone</label>
                      <input type="text" name="telphone" id="telphone" class="form-control @error('telphone') is-invalid @enderror" value="{{ $unit->telphone }}" autocomplete="off">
                      @error('telphone')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Nomor NPWP</label>
                      <input type="text" name="npwp" id="npwp" class="form-control @error('npwp') is-invalid @enderror" value="{{ $unit->npwp }}" autocomplete="off">
                      @error('npwp')
                          <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save</button>
                  <a href="{{ route('unit') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
@endsection