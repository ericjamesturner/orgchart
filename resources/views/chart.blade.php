@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">OrgChart</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th><a href="{{ route('chart', ['orderBy' => 'name']) }}">Name</a></th>
                            <th><a href="{{ route('chart', ['orderBy' => 'boss']) }}">Boss</a></th>
                            <th><a href="{{ route('chart') }}">Distance from CEO</a></th>
                        </tr>
                        @foreach ($chart as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->boss }}</td>
                                <td>{{ $employee->depth }}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $chart->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
