@extends('layouts.master')

@section('title', 'Aarons Department | Shifts')

@section('content')

<body>
    <div class="container">
        <div class="d-grid gap-2">
            <div class="mb-3">
              <label for="total_pay" class="form-label">Name</label>
              <input type="text"
                class="form-control" name="total_pay" id="total_pay_input" aria-describedby="total_pay" placeholder="Total Pay">
              <small id="total_pay" class="form-text text-muted">Add a numeric input that will filter the data according to shifts with the total amount paid</small>
              <button type="button" name="total_pay" id="total_pay_button" class="btn btn-primary">Button</button>
            </div>
        </div>
        <button type="button" name="total_pay" id="total_pay_button" class="btn btn-primary">Create Shift</button>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive table-striped">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Employer</th>
                                <th>Hours</th>
                                <th>Rate Per Hour</th>
                                <th>Taxable</th>
                                <th>Status</th>
                                <th>Shift Type</th>
                                <th>Paid At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a name="delete/id" id="delete/id" class="btn btn-danger" href="#" role="button">Delete</a>
                                    <a name="edit/id" id="edit/id" class="btn btn-success" href="#" role="button">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
