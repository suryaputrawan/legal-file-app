@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Izin Nakes</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Perizinan</a></div>
            <div class="breadcrumb-item">Izin Nakes</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="section-header-back">
                            <a href="{{ route('izinNakes') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                        </div>
                      <h4>Detail Data Izin Nakes</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <!-- Merubah Format Tanggal yang ditampilkan -->
                            <?php
                            $tglterbit = strtotime($izinNakes->tglterbit);
                            $newtglterbit = date('d M Y',$tglterbit);
                  
                            $tglexp = strtotime($izinNakes->tglexp);
                            $newtglexp = date('d M Y',$tglexp);
                            ?>
                            <!-- End Merubah Format tanggal yang ditampilkan -->
                            <tr>
                              <td style="width: 30%"><strong>Nomor Surat</strong></td>
                              <td style="width: 2%"><strong>:</strong></td>
                              <td style="width: 65%">{{ $izinNakes->nomor }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>Nama Karyawan</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $izinNakes->employee->name }}</td>
                              </tr>
                              <tr>
                                <td style="width: 30%"><strong>Department</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $izinNakes->department->name }}</td>
                              </tr>
                              <tr>
                                <td style="width: 30%"><strong>Tanggal Terbit Izin</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $newtglterbit }}</td>
                              </tr>
                              <tr>
                                <td style="width: 30%; color:red"><strong>Tanggal Exp Izin</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%; color:red"><strong>{{ $newtglexp }}</strong></td>
                              </tr>
                              <tr>
                                <td style="width: 30%"><strong>Unit</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $izinNakes->unit->name }} - {{ $izinNakes->unit->alias }}</td>
                              </tr>
                          </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>SURAT IZIN</h4>
                    <div class="card-header-action">
                        @if ($izinNakes->picture_path != null)
                            <a href="{{ route('izinNakes.downloadImage', Crypt::encryptString($izinNakes->id)) }}" class="btn btn-primary">Download</a>
                        @endif
                    </div>
                  </div>
                  <div class="card-body">
                        @if ($izinNakes->picture_path != null)
                            <div class="mb-2 text-muted">Tekan Gambar Untuk Memperbesar !</div> 
                        @else
                            <div class="mb-2 text-muted">File Tidak Ada !</div>
                        @endif
                    <div class="chocolat-parent">
                        @if ($izinNakes->picture_path != null)
                            <a href="{{ $izinNakes->takeImage }}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285" style="overflow: hidden; position: relative; height: 285px;">
                                    <img alt="image" src="{{ $izinNakes->takeImage }}" class="img-fluid">
                                </div>
                            </a>
                        @else
                            <a href="{{ asset('assets/img/image-not-available.jpg') }}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285" style="overflow: hidden; position: relative; height: 285px;">
                                    <img alt="image" src="{{ asset('assets/img/image-not-available.jpg') }}" class="img-fluid">
                                </div>
                            </a>
                        @endif
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-12 col-sm-8 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>FILE PENDUKUNG</h4>
                    <div class="card-header-action">
                        @if ($izinNakes->file_path != null)
                            <a href="{{ route('izinNakes.downloadFile', Crypt::encryptString($izinNakes->id)) }}" class="btn btn-primary">Download</a>
                        @endif
                    </div>
                  </div>
                  <div class="card-body">
                        @if ($izinNakes->file_path != null)
                            <div class="mb-2 text-muted">File Available !</div> 
                        @else
                            <div class="mb-2 text-muted">File Not Available !</div>
                        @endif
                    <div class="chocolat-parent">
                        @if ($izinNakes->file_path != null)
                            <a href="{{ $izinNakes->takeFile }}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285" style="overflow: hidden; position: relative; height: 285px;">
                                    <img alt="image" src="{{ asset('assets/img/fileReady.png') }}" class="img-fluid">
                                </div>
                            </a>
                        @else
                            <a href="{{ asset('assets/img/image-not-available.jpg') }}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285" style="overflow: hidden; position: relative; height: 285px;">
                                    <img alt="image" src="{{ asset('assets/img/image-not-available.jpg') }}" class="img-fluid">
                                </div>
                            </a>
                        @endif
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection