@extends('layouts.app2')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Dashboard</div>
              </div>
        </div>

        <div class="section-body">
            <div class="row">
                @if (auth()->user()->role == "Admin" || auth()->user()->role == "Legal")
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Employees</h4>
                            </div>
                            <div class="card-body">
                            {{ $employee }}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Izin Corporates</h4>
                            </div>
                            <div class="card-body">
                            {{ $izinCorporate }}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                            <i class="far fa-file-alt"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Izin Nakes</h4>
                            </div>
                            <div class="card-body">
                                {{ $izinNakes }}
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                            <i class="far fa-file-alt"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Agreements</h4>
                            </div>
                            <div class="card-body">
                                {{ $agreement }}
                            </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                      <div class="card-icon bg-success">
                        <i class="far fa-file-alt"></i>
                      </div>
                      <div class="card-wrap">
                        <div class="card-header">
                          <h4>Template Surat</h4>
                        </div>
                        <div class="card-body">
                          {{ $template }}
                        </div>
                      </div>
                    </div>
                </div>                          
            </div>
        </div>
    </section>
@endsection