@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
             <div class="row">
                <div class="col-12">
                    <form action="{{route('work-time.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="morning_time" class="form-label">Morning Time</label>
                            <input type="text" name="morning_time" class="form-control" id="morning_time">
                        </div>
                        <div class="mb-3">
                            <label for="evening_time" class="form-label">Evening Time</label>
                            <input type="text" name="evening_time" class="form-control" id="evening_time">
                        </div>
                        <div class="mb-3">
                            <label for="friday" class="form-label">Friday</label>
                            <input type="text" name="friday" class="form-control" id="friday">
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

