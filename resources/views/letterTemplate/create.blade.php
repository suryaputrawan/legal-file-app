@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>LETTER TEMPLATE</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Template Surat</a></div>
            <div class="breadcrumb-item">Create Template</div>
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
              <form action="{{ route('template.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="card-header">
                    <div class="section-header-back">
                        <a href="{{ route('template') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                    </div>
                  <h4>Tambah Data Template Surat</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                  <div class="form-group">
                    <label>Nama Template Surat</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off">
                    @error('name')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Kategori Surat</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">Please select</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
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
                  <a href="{{ route('template') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
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