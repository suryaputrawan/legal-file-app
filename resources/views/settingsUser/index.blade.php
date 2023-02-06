@extends('layouts.app2')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Settings</a></div>
            <div class="breadcrumb-item">User</div>
          </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Users</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <a href="#" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-plus"></i> Add</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-striped table-md" id="user-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
    var table = $('#user-table').DataTable({
            responsive : true,
            processing : true,
            serverSide : true,
            ajax: "{!! route('settings') !!}?type=datatable",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action', orderable: false },
            ],
            "order":[[1,"asc"]]
        });
    });
</script>
@endpush