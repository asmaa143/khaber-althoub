@extends('layouts.app')
@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        .active .page-link{
            background-color: rgba(0, 0, 0, 0.65) !important;
            color:#d0ad54 !important; ;
        }
    </style>
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Appointment</h1>
        <div class="my-3">
            <a style="color: #d0ad54" href="{{route('appointment.create')}}" class="btn btn-dark btn-icon-split">
            <span class="icon text-white-600">
                <i class="fas fa-arrow-right"></i>
            </span>
                <span class="text">Add Appointment</span>
            </a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Appointment Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Day Name</th>
                            <th>Active</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Open</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Day Name</th>
                            <th>Active</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Open</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($work_days as $day)
                        <tr>
                            <td>{{array_flip((new \ReflectionClass(\App\Enum\WeekDaysEnum::class))->getConstants())[$day->week_day]}}</td>
                            <td>{{$day->is_active==1? 'Active':'DeActive'}}</td>
                            <td>
                                @if($day->is_active==1)
                                @foreach ($day->workHours as $index => $time)
                                    <span>{{$index ===0 ? '':' , '}} {{ \Carbon\Carbon::parse($time->from)->format('H:i') }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if($day->is_active==1)
                                @foreach ($day->workHours as $index => $time)
                                    <span>{{$index ===0 ? '':' , '}} {{ \Carbon\Carbon::parse($time->to)->format('H:i') }}</span>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if($day->is_active==1)
                                    @foreach ($day->workHours as $index => $time)
                                        <span>{{$index ===0 ? '':' , '}} {{ $time->open==1?'open':'close' }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <div class="row text-center">
                                   <div class="col-12">
                                       <a style="color: #d0ad54" href="{{route('appointment.edit',$day->id)}}" class="btn btn-dark btn-circle btn-sm ">
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
