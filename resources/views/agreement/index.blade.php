@extends('layouts.app2')

@section('content')
<section class="section">
    <!-- Flass Message -->
    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div> 
    @endif
    <!-- End Flass Message -->
    <div class="section-header">
        <h1>Perjanjian Kerjasama</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Perizinan</a></div>
            <div class="breadcrumb-item">Perjanjian Kerjasama</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Agreement</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <a href="{{ route('agreement.create') }}" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-plus"></i> Add</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-striped table-md" id="agreement-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Agreement</th>
                                    <th>Nomor</th>
                                    <th>Counter</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Tanggal Exp</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
    var table = $('#agreement-table').DataTable({
            responsive : true,
            processing : true,
            serverSide : true,
            ajax: "{!! route('agreement') !!}?type=datatable",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'nomor', name: 'nomor' },
                { data: 'counter', name: 'counter' },
                { data: 'tglterbit', name: 'tglterbit' },
                { data: 'tglexp', name: 'tglexp' },
                { data: 'unit', name: 'unit' },
                { data: 'action', name: 'action', orderable:false },
            ],
            "order":[[0,"DESC"]]
        });
    });
</script>
@endpush