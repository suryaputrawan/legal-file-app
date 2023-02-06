@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Counter / Rekanan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Utilities</a></div>
            <div class="breadcrumb-item">Counter</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Rekanan</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <a href="{{ route('counter.create') }}" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-plus"></i> Add</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-striped table-md" id="counter-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Rekanan</th>
                                    <th>Alamat</th>
                                    <th>Telphone</th>
                                    <th>Email</th>
                                    <th>NPWP</th>
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
    var table = $('#counter-table').DataTable({
            responsive : true,
            processing : true,
            serverSide : true,
            ajax: "{!! route('counter') !!}?type=datatable",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'alamat', name: 'alamat' },
                { data: 'telphone', name: 'telphone' },
                { data: 'email', name: 'email' },
                { data: 'npwp', name: 'npwpw' },
                { data: 'action', name: 'action', orderable:false },
            ],
            "order":[[1,"asc"]]
        });
    });
</script>
@endpush