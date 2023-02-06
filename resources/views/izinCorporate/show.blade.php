@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Izin Corporate</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Perizinan</a></div>
            <div class="breadcrumb-item">Izin Corporate</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="section-header-back">
                            <a href="{{ route('izinCorporate') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                        </div>
                      <h4>Detail Data Izin Corporate</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <!-- Merubah Format Tanggal yang ditampilkan -->
                            <?php
                            $tglterbit = strtotime($izinCorporate->tglterbit);
                            $newtglterbit = date('d M Y',$tglterbit);
                  
                            $tglexp = strtotime($izinCorporate->tglexp);
                            $newtglexp = date('d M Y',$tglexp);
                            ?>
                            <!-- End Merubah Format tanggal yang ditampilkan -->
                            <tr>
                                <td style="width: 30%"><strong>Nama Izin</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $izinCorporate->name }}</td>
                              </tr>
                            <tr>
                              <td style="width: 30%"><strong>Nomor Surat</strong></td>
                              <td style="width: 2%"><strong>:</strong></td>
                              <td style="width: 65%">{{ $izinCorporate->nomor }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>Di Terbitkan Oleh</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $izinCorporate->penerbit->name }}</td>
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
                                <td style="width: 65%">{{ $izinCorporate->unit->name }} - {{ $izinCorporate->unit->alias }}</td>
                              </tr>
                          </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>GAMBAR SURAT IZIN</h4>
                    <div class="card-header-action">
                        @if ($izinCorporate->picture_path != null)
                            <a href="{{ route('izinCorporate.downloadImage', Crypt::encryptString($izinCorporate->id)) }}" class="btn btn-primary">Download</a>
                        @endif
                    </div>
                  </div>
                  <div class="card-body">
                        @if ($izinCorporate->picture_path != null)
                            <div class="mb-2 text-muted">Tekan Gambar Untuk Memperbesar !</div>
                        @else
                            <div class="mb-2 text-muted">File Tidak Ada !</div>
                        @endif
                    <div class="chocolat-parent">
                        @if ($izinCorporate->picture_path != null)
                            <a href="{{ $izinCorporate->takeImage }}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285" style="overflow: hidden; position: relative; height: 285px;">
                                    <img alt="image" src="{{ $izinCorporate->takeImage }}" class="img-fluid">
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
                        @if ($izinCorporate->file_path != null)
                            <a href="{{ route('izinCorporate.downloadFile', Crypt::encryptString($izinCorporate->id)) }}" class="btn btn-primary">Download</a>
                        @endif
                    </div>
                  </div>
                  <div class="card-body">
                        @if ($izinCorporate->file_path != null)
                            <div class="mb-2 text-muted">File Available !</div>
                        @else
                            <div class="mb-2 text-muted">File Not Available !</div>
                        @endif
                    <div class="chocolat-parent">
                        @if ($izinCorporate->file_path != null)
                            <a href="{{ $izinCorporate->takeFile }}" class="chocolat-image" title="Just an example">
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