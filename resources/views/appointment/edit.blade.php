@extends('layouts.app')
@section('styles')

@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{route('appointment.update',$day->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="my-3 form-check ">
                                <input type="checkbox" name="is_active" class="form-check-input" id="exampleCheck1"
                                       {{$day->is_active==1?'checked':''}}
                                >
                                <label class="form-check-label" for="exampleCheck1">Active</label>
                            </div>
                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($day->workHours as $index=>$time)
                                <tr>
                                        <td><input type="time" name="from[{{$index}}]" value="{{$time->from}}" class="form-control" /></td>
                                        <td><input type="time" name="to[{{$index}}]" value="{{$time->to}}"  class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>

                                </tr>
                                @endforeach
                                <tr>

                                    <td colspan="3"><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>

                                </tr>

                            </table>
                            <button type="submit" class="btn btn-primary my-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
            crossorigin="anonymous"></script>

    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="time" name="from['+i+']"  class="form-control" /></td><td><input type="time" name="to['+i+']"  class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
@endsection
