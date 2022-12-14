@extends('layouts.master')

@section('title', 'Aarons Department | Employees')

@section('content')

<body>
    <div class="container mt-5 py-5">

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                            {{-- <a name="delete-{{$user->id}}" id="delete-{{$user->id}}" class="btn btn-danger" href="{{route('employees.show', $user->id)}}" role="button">Delete</a> --}}
                                            <a name="edit-{{$user->id}}" id="edit-{{$user->id}}" class="btn btn-success" href="{{route('employees.show', $user->id)}}" role="button">View</a>
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
