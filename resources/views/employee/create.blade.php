@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Employees Nakes</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Utilities</a></div>
            <div class="breadcrumb-item">Nakes</div>
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
              <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="card-header">
                  <h4>Tambah Data Nakes</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>NIK *</label>
                    <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" autocomplete="off">
                    @error('nik')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Nama Karyawan *</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off">
                    @error('name')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Tempat Lahir *</label>
                    <input type="text" name="pob" id="pob" class="form-control @error('pob') is-invalid @enderror" value="{{ old('pob') }}" autocomplete="off">
                    @error('pob')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir *</label>
                    <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" autocomplete="off">
                    @error('dob')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin *</label>
                    <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror">
                        <option value="">Please select</option>
                            <option value="M" {{ old('sex') == "M" ? 'selected' : null }}>Laki-Laki</option>
                            <option value="F" {{ old('sex') == "F" ? 'selected' : null }}>Perempuan</option>
                    </select>
                    @error('sex')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" autocomplete="off">
                    @error('address')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Telphone</label>
                    <input type="text" name="telphone" id="telphone" class="form-control @error('telphone') is-invalid @enderror" value="{{ old('telphone') }}" autocomplete="off">
                    @error('telphone')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save</button>
                  <a href="{{ route('employee') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
@endsection