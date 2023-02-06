@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Perjanjian Kerjasama</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Perizinan</a></div>
            <div class="breadcrumb-item">Perjanjian Kerjasama</div>
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
                <form action="{{ route('agreement.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <div class="section-header-back">
                            <a href="{{ route('agreement') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                        </div>
                    <h4>Tambah Data Agreement</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Perjanjian</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off">
                            @error('name')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Perjanjian</label>
                            <input type="text" name="nomor" id="nomor" class="form-control @error('nomor') is-invalid @enderror" value="{{ old('nomor') }}" autocomplete="off">
                            @error('nomor')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Counter</label>
                            <select name="counter_id" id="counter_id" class="form-control @error('counter_id') is-invalid @enderror">
                                <option value="">Please select</option>
                                @foreach ($counter as $item)
                                    <option value="{{ $item->id }}" {{ old('counter_id') == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('counter_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Terbit</label>
                            <input type="date" name="tglterbit" id="tglterbit" class="form-control @error('tglterbit') is-invalid @enderror" value="{{ old('tglterbit') }}" autocomplete="off">
                            @error('tglterbit')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Expired</label>
                            <input type="date" name="tglexp" id="tglexp" class="form-control @error('tglexp') is-invalid @enderror" value="{{ old('tglexp') }}" autocomplete="off">
                            @error('tglexp')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit_id" id="unit_id" class="form-control @error('unit_id') is-invalid @enderror">
                                <option value="">Please select</option>
                                @foreach ($unit as $item)
                                    <option value="{{ $item->id }}" {{ old('unit_id') == $item->id ? 'selected' : null }}>{{ $item->name }} - {{ $item->alias }}</option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >Upload Picture</label>
                            <div class="col-sm-12 col-md-7">
                            <div id="image-preview" class="image-preview mb-2" style="width: 200px; height:200px">
                                <img src="{{ asset('assets/img/image-not-available.jpg') }}" id="image" width="200" alt="Preview Gambar" />
                            </div>
                            <input type="file" name="picture_path" id="picture">
                            @error('picture')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Upload File</label>
                            <div class="col-sm-12 col-md-7">
                            <input type="file" name="file_path" id="file">
                            @error('file_path')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save</button>
                        <a href="{{ route('agreement') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
    function bacaGambar(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#picture").change(function(){
        bacaGambar(this);
    });
</script>

<script type="text/javascript">
    function bacaFile(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#file2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file").change(function(){
        bacaFile(this);
    });
</script>
@endpush