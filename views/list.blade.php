@extends('index')

@section('content')

    <div class="page-header">
        <a href=""><h2 >List dates</h2></a>
    </div>
    <form method="POST" action="">
        <div class="form-group row navbar-right col-lg-12">
            <input type="hidden" name="csrf" id="_token" value="{{ $csrft }}">

            <div class="col-sm-4">
                <input type="text" name="date" value="" id="datetimepicker_mask">
                <label for="dupes">Duplicates</label>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Show me</button>
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
