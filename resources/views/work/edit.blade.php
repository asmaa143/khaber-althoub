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
                                <label for="morning_time" class="form-label">Morning Time</label>
                                <input type="text" name="morning_time" value="{{$work_time->morning_time}}" class="form-control" id="morning_time">
                            </div>
                            <div class="mb-3">
                                <label for="evening_time" class="form-label">Evening Time</label>
                                <input type="text" name="evening_time" value="{{$work_time->evening_time}}" class="form-control" id="evening_time">
                            </div>
                            <div class="mb-3">
                                <label for="friday" class="form-label">Friday</label>
                                <input type="text" name="friday" value="{{$work_time->friday}}" class="form-control" id="friday">
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

