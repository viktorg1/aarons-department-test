@extends('layouts.master')

@section('title', 'Aarons Department | {{$user->name}}')

@section('content')
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$user->name}} averages a total pay of {{round($avg_totalpay->avg, 2)}} and average pay per hour of {{round($avg_perhour, 2)}}</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Employee</th>
                                <th>Employer</th>
                                <th>Hours</th>
                                <th>Rate Per Hour</th>
                                <th>Taxable</th>
                                <th>Status</th>
                                <th>Shift Type</th>
                                <th>Paid At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($last_five))
                                @foreach ($last_five as $shift)
                                    <tr>
                                        <td>{{$shift->id}}</td>
                                        <td>{{$shift->date}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$shift->employer->company}}</td>
                                        <td>{{$shift->hours}}</td>
                                        <td>£{{$shift->avg_hour}}</td>
                                        <td>{{$shift->taxable}}</td>
                                        <td>{{$shift->status}}</td>
                                        <td>{{$shift->shift_type}}</td>
                                        <td>{{$shift->paid_at}}</td>
                                    </tr>

                                @endforeach

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
