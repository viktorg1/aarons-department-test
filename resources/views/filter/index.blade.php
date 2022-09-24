@extends('layouts.master')

@section('title', 'Aarons Department | Shifts')

@section('content')

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive table-wrapper">
                    <table class="table fl-table">
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
                            {{-- Table for all shifts --}}
                            @if (count($shifts))
                                @foreach ($shifts as $shift)
                                <tr>
                                    <td>{{$shift->id}}</td>
                                    <td>{{$shift->date}}</td>
                                    <td>{{$shift->user->name}}</td>
                                    <td>{{$shift->employer->company}}</td>
                                    <td>{{$shift->hours}}</td>
                                    <td>£{{$shift->avg_hour}}</td>
                                    <td>£{{$shift->avg_hour * $shift->hours}}</td>
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
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $shifts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.create-modal')
    @include('components.update-modal')
    <script src="{{ asset('js/table-actions.js') }}"></script>
</body>
@stop
