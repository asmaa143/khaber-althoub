@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('work-time.update',$work_time->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="description" class="form-label">Work Day</label>
                                <input  type="text" name="description" value="{{$work_time->description}}" class="form-control" id="description">
                            </div>
                            <div class="mb-3">
                                <label for="label" class="form-label">Shift Name</label>
                                <input type="text" name="label" value="{{$work_time->label}}" class="form-control" id="label">
                            </div>
                            <div class="mb-3">
                                <label for="from" class="form-label">Shift From</label>
                                <input type="time" name="from" value="{{$work_time->from}}" class="form-control" id="from">
                            </div>
                            <div class="mb-3">
                                <label for="to" class="form-label">Shift To</label>
                                <input type="time" name="to" value="{{$work_time->to}}" class="form-control" id="to">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

