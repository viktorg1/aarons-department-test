<div id='update-modal' class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="update-shift-form" method="POST" action="#">
                <div class="row">
                    <div class="col-md-6">
                        <label for="update-employee" class="form-label">Employee</label>
                        <select class="form-control" id="update-employee" aria-describedby="employee-help">
                            @if (count($users))
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @else
                                <option disabled selected value="0"> There are no employees in the database.</option>
                            @endif
                        </select>
                        <div id="employee-help" class="form-text">Please select an employee</div>
                    </div>
                    <div class="col-md-6">
                        <label for="update-employer" class="form-label">Employer</label>
                        <select class="form-control" id="update-employer" aria-describedby="employer-help">
                            @if (count($employers))
                                @foreach ($employers as $employer)
                                    <option value="{{$employer->id}}">{{$employer->company}}</option>
                                @endforeach
                            @endif
                        </select>
                        <div id="employer-help" class="form-text">Please select an employer</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="update-hours" class="form-label">Hours</label>
                        <input type="number" id="update-hours" class="input-field" placeholder=" " />
                    </div>
                    <div class="col-md-6">
                        <label for="update-avghour" class="form-label">Rate Per Hour</label>
                        <input type="number" id="update-avghour" class="input-field" placeholder=" " />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="update-taxable" class="form-label">Taxable</label>
                        <select class="form-control" id="update-taxable">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="update-status" class="form-label">Status</label>
                        <select class="form-control" id="update-status">
                            <option value="Complete">Complete</option>
                            <option value="Pending">Pending</option>
                            <option value="Failed">Failed</option>
                            <option value="Processing">Processing</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="update-shift" class="form-label">Shift Type</label>
                        <select class="form-control" id="update-shift">
                            <option value="Day">Day</option>
                            <option value="Night">Pending</option>
                            <option value="Holiday">Holiday</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary update-btn">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
