@extends('layouts.app')
@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Reservation</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reservation Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>User Name</th>
                            <th>User Phone </th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Items</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>User Name</th>
                            <th>User Phone </th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Items</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($reservation as $value)
                            <tr>
                                <td>{{$value->user_name}}</td>
                                <td>{{$value->user_phone}}</td>
                                <td>
                                      {{$value->date}}
                                </td>
                                <td>
                                  {{$value->from}} - {{$value->to}}
                                </td>
                                <td>
                                  {{$value->items}}
                                </td>
                                <td>
                                   {{$value->status}}
                                </td>
                            </tr>
                        @empty
                            <tr>No Data Found</tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
