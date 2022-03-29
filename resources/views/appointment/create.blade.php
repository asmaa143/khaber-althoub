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
                        <form action="{{route('appointment.store')}}" method="POST">
                            @csrf
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="radio" name="type" value="every_day"
                                       id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Every Day
                                </label>
                            </div>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="radio" name="type" value="day_by_day"
                                       id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Day By Day
                                </label>
                            </div>
                            <div id="every_day" class=" d-none">
                                <div class="my-3 form-check ">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="exampleCheck1"
                                           checked>
                                    <label class="form-check-label" for="exampleCheck1">Active</label>
                                </div>
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td><input type="time" name="from[0]"  class="form-control" /></td>
                                        <td><input type="time" name="to[0]"  class="form-control" /></td>
                                        <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>
                                    </tr>
                                </table>
                            </div>

                            <div id="day_by_day">
                                @foreach((new ReflectionClass(\App\Enum\WeekDaysEnum::class))->getConstants() as $day_name => $day_value)
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label for="{{$day_name}}_cont">{{$day_name}}<span
                                                    style="color: red;">*</span>
                                            </label>
                                        </div>
                                        <div class="mt-0 form-check col-lg-10">
                                            <input type="checkbox" name="is_active_{{$day_value}}"
                                                   class="form-check-input"
                                                   id="active_{{$day_value}}">
                                            <label class="form-check-label" for="active_{{$day_value}}">Active</label>
                                        </div>
                                    </div>
                                    <table class="table table-bordered" id="dynamicAddRemove_{{$day_value}}">
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="time" name="from_{{$day_value}}[0]"  class="form-control" />
                                            </td>
                                            <td>
                                                <input type="time" name="to_{{$day_value}}[0]" class="form-control" />
                                            </td>
                                            <td><button data-day="{{$day_value}}" type="button" name="add" id="add-btn-{{$day_value}}" class="btn btn-success add-btn">Add More</button></td>
                                        </tr>
                                    </table>
                                @endforeach
                            </div>
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
    <script>
        $(document).ready(function () {
            $('input[type=radio][name="type"]').change(function () {

                if ($(this).val() == 'every_day') {
                    $('#every_day').removeClass('d-none')
                    $('#day_by_day').addClass('d-none')
                } else {
                    $('#day_by_day').removeClass('d-none')
                    $('#every_day').addClass('d-none')
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
            crossorigin="anonymous"></script>

    <script type="text/javascript">
        var i = 0;
        $(".add-btn").click(function(){
            ++i;
            var day=$(this).data('day')
            $(`#dynamicAddRemove_${day}`).append('<tr><td><input type="time" name="from_'+day+'['+i+']"  class="form-control" /></td><td><input type="time" name="to_'+day+'['+i+']"  class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
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
