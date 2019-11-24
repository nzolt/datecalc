@extends('index')

@section('content')

    <div class="page-header">
        <a href=""><h2 >List dates</h2></a>
    </div>
    <form method="POST" action="">
        <div class="form-group row navbar-right col-lg-12">
            <input type="hidden" name="csrf" id="_token" value="{{ $csrft }}">
            <div class="container">
                <div class="row col-sm-10">
                    <div class='col-sm-3'>
                        <input type='text' name="date" class="form-control" id='datetimepicker4' /><label for="datetimepicker4">Date</label>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker4').datetimepicker();
                        });
                    </script>
                </div>
                <div class="col-sm-2 float-right">
                    <button type="submit" class="btn btn-primary">Show me</button>
                </div>
            </div>
        </div>

    </form>
    <table class="table">
        <thead>
            <tr><th>Birthday</th>
                <th>Query date</th>
                <th>Years</th>
                <th>Days</th>
                <th>Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dates as $date)
                <tr class="">
                    <td>{{ $date['Birthdate'] }}</td>
                    <td>{{ $date['Currentdate'] }}</td>
                    <td>{{ $date['Years'] }}</td>
                    <td>{{ $date['Days'] }}</td>
                    <td>{{ $date['Hours'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
