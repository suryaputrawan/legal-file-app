@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>CATEGORY</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Utilities</a></div>
            <div class="breadcrumb-item">Category</div>
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
              <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="card-header">
                    <div class="section-header-back">
                        <a href="{{ route('category') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                    </div>
                  <h4>Tambah Data Category</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Category</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off">
                    @error('name')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save</button>
                  <a href="{{ route('category') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
@endsection