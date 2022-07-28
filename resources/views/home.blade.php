@extends('layouts.app')
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table table-bordered" id="invoices-table">
                        <thead>
                            <tr>
                                <th>No Invoice</th>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Perusahaan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- App scripts -->
        <script>
            $(function() {
                $('#invoices-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/invoices',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'firstname', name: 'firstname' },
                        { data: 'lastname', name: 'lastname' },
                        { data: 'companyname', name: 'companyname' },
                        { data: 'address1', name: 'address1' },
                        { data: 'action', name: 'action' }
                    ]
                });
            });
            </script>
@stop