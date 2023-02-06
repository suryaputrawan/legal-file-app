@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>LETTER TEMPLATE</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Template Surat</a></div>
            <div class="breadcrumb-item">Template</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Template Surat</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <a href="{{ route('template.create') }}" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-plus"></i> Add</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-striped table-md" id="template-table">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th>FILES</th>
                                    <th>CATEGORY</th>
                                    <th>ACTION</th>
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
    var table = $('#template-table').DataTable({
            responsive : true,
            processing : true,
            serverSide : true,
            ajax: "{!! route('template') !!}?type=datatable",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'files', name: 'files' , orderable:false},
                { data: 'category', name: 'category' },
                { data: 'action', name: 'action', orderable:false },
            ],
            "order":[[0,"asc"]]
        });
    });
</script>
@endpush