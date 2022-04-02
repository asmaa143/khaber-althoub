@extends('layouts.app')
@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Work Time</h1>
        <div class="my-3">
            <a href="{{route('work-time.create')}}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-600">
                <i class="fas fa-arrow-right"></i>
            </span>
                <span class="text">Add Work Time</span>
            </a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Work Time Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Work Day</th>
                            <th>Shift Name</th>
                            <th>Shift From</th>
                            <th>Shift to</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Work Day</th>
                            <th>Shift Name</th>
                            <th>Shift From</th>
                            <th>Shift to</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($work_time as $time)
                            <tr>

                                <td>
                                 {{$time->description}}
                                </td>
                                <td>
                                    {{$time->label}}
                                </td>
                                <td>
                                    {{$time->from}}
                                </td>
                                <td>
                                    {{$time->to}}
                                </td>
                                <td>
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <a href="{{route('work-time.edit',$time->id)}}" class="btn btn-info btn-circle btn-sm ">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
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
