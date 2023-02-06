@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Perjanjian Kerjasama</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Perizinan</a></div>
            <div class="breadcrumb-item">Perjanjian Kerjasama</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="section-header-back">
                            <a href="{{ route('agreement') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                        </div>
                      <h4>Detail Data Agreement</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <!-- Merubah Format Tanggal yang ditampilkan -->
                            <?php
                            $tglterbit = strtotime($agreement->tglterbit);
                            $newtglterbit = date('d M Y',$tglterbit);
                  
                            $tglexp = strtotime($agreement->tglexp);
                            $newtglexp = date('d M Y',$tglexp);
                            ?>
                            <!-- End Merubah Format tanggal yang ditampilkan -->
                            <tr>
                                <td style="width: 30%"><strong>Nama Perjanjian</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $agreement->name }}</td>
                              </tr>
                            <tr>
                              <td style="width: 30%"><strong>Nomor Perjanjian</strong></td>
                              <td style="width: 2%"><strong>:</strong></td>
                              <td style="width: 65%">{{ $agreement->nomor }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>Counter</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $agreement->counter->name }}</td>
                              </tr>
                              <tr>
                                <td style="width: 30%"><strong>Tanggal Terbit Perjanjian</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $newtglterbit }}</td>
                              </tr>
                              <tr>
                                <td style="width: 30%; color:red"><strong>Tanggal Exp Perjanjian</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%; color:red"><strong>{{ $newtglexp }}</strong></td>
                              </tr>
                              <tr>
                                <td style="width: 30%"><strong>Unit</strong></td>
                                <td style="width: 2%"><strong>:</strong></td>
                                <td style="width: 65%">{{ $agreement->unit->name }} - {{ $agreement->unit->alias }}</td>
                              </tr>
                          </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>AGREEMENT LETTER</h4>
                    <div class="card-header-action">
                        @if ($agreement->picture_path != null)
                            <a href="{{ route('agreement.downloadImage', Crypt::encryptString($agreement->id)) }}" class="btn btn-primary">Download</a>
                        @endif
                    </div>
                  </div>
                  <div class="card-body">
                        @if ($agreement->picture_path != null)
                            <div class="mb-2 text-muted">Tekan Gambar Untuk Memperbesar !</div>
                        @else
                            <div class="mb-2 text-muted">File Tidak Ada !</div>
                        @endif
                    <div class="chocolat-parent">
                        @if ($agreement->picture_path != null)
                            <a href="{{ $agreement->takeImage }}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285" style="overflow: hidden; position: relative; height: 285px;">
                                    <img alt="image" src="{{ $agreement->takeImage }}" class="img-fluid">
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
                        @if ($agreement->file_path != null)
                        <a href="{{ route('agreement.downloadFile', Crypt::encryptString($agreement->id)) }}" class="btn btn-primary">Download</a>
                        @endif
                    </div>
                  </div>
                  <div class="card-body">
                        @if ($agreement->file_path != null)
                            <div class="mb-2 text-muted">File Available !</div>
                        @else
                            <div class="mb-2 text-muted">File Not Available !</div>
                        @endif
                    
                    <div class="chocolat-parent">
                        @if ($agreement->file_path != null)
                            <a href="{{ $agreement->takeFile }}" class="chocolat-image" title="Just an example">
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