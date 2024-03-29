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
                        <label for="name">Name</label><input type='text' name="name" class="form-control" id='name' />
                    </div>
                    <div class='col-sm-3'>
                        <label for="datetimepicker4">Date</label><input type='text' name="date" class="form-control" id='datetimepicker4' />
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
            @if($dateError != '')
            <div class="alert alert-danger">
                {{ $dateError }}
            </div>
            @endif
            @if($nameError != '')
            <div class="alert alert-danger">
                <p>{{ $nameError }}</p>
            </div>
            @endif
        </div>

    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birthday</th>
                <th>Years</th>
                <th>Days</th>
                <th>Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dates as $date)
                <tr class="">
                    <td>{{ $date['Name'] }}</td>
                    <td>{{ $date['Birthdate'] }}</td>
                    <td>{{ $date['Years'] }}</td>
                    <td>{{ $date['Days'] }}</td>
                    <td>{{ $date['Hours'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
