@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit / Perusahaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Utilities</a></div>
            <div class="breadcrumb-item">Unit</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Unit / Perusahaan</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <a href="{{ route('unit.create') }}" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-plus"></i> Add</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-striped table-md" id="unit-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alias</th>
                                    <th>Alamat</th>
                                    <th>Telphone</th>
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
    var table = $('#unit-table').DataTable({
            responsive : true,
            processing : true,
            serverSide : true,
            ajax: "{!! route('unit') !!}?type=datatable",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'alias', name: 'alias' },
                { data: 'address', name: 'address' },
                { data: 'telphone', name: 'telphone' },
                { data: 'npwp', name: 'npwp' },
                { data: 'action', name: 'action', orderable: false },
            ],
            "order":[[1,"asc"]]
        });
    });
</script>
@endpush