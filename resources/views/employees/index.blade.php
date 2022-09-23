@extends('layouts.master')

@section('title', 'Aarons Department | Employees')

@section('content')

<body>
    <div class="container mt-5 py-5">
        <button type="button" name="total_pay" id="total_pay_button" class="btn btn-info">+ Create Shift</button>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive table-striped">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Table for all the users --}}
                            @if(count($users))
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            <a name="delete/id" id="delete/id" class="btn btn-danger" href="#" role="button">Delete</a>
                                            <a name="edit/id" id="edit/id" class="btn btn-success" href="#" role="button">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
