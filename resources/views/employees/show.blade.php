@extends('layouts.master')

@section('title', 'Aarons Department | {{$user->name}}')

@section('content')
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-5">{{$user->name}} averages a <span class="text-primary">total pay</span> of <span class="text-primary">{{round($avg_totalpay->avg, 2)}}</span> and an average <span class="text-warning">pay per hour</span> of <span class="text-warning">{{round($avg_perhour, 2)}}</span></h2>
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
                                <th>Total Pay</th>
                                <th>Taxable</th>
                                <th>Status</th>
                                <th>Shift Type</th>
                                <th>Paid At</th>
                                <th>Actions</th>
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
                                        <td>£{{$shift->total_pay}}</td>
                                        <td>{{$shift->taxable}}</td>
                                        <td>{{$shift->status}}</td>
                                        <td>{{$shift->shift_type}}</td>
                                        <td>{{$shift->paid_at}}</td>
                                        <td>
                                            <button name="delete" data-url='{{route('shifts.destroy', $shift->id)}}' class="btn btn-danger del-btn" role="button">Delete</button>
                                            <button name="edit" data-url='{{ route('shifts.show', $shift->id) }}'data-id='{{ $shift->id }}' class="btn btn-success edit-btn" role="button" data-bs-toggle="modal" data-bs-target="#update-modal">Edit</button>
                                        </td>
                                    </tr>

                                @endforeach

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('components.update-modal')
    <script src="{{ asset('js/table-actions.js') }}"></script>
    <script src="{{ asset('js/total-pay.js') }}"></script>
</body>
@stop
