<div id='create-modal' class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="create-shift-form" method="POST" action="#">
                <div class="row">
                    <div class="col-md-6">
                        <label for="create-employee" class="form-label">Employee</label>
                        <select class="form-control" id="create-employee" aria-describedby="employee-help">
                            @if (count($users))
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <div id="employee-help" class="form-text">Please select an employee</div>
                    </div>
                    <div class="col-md-6">
                        <label for="create-employer" class="form-label">Employer</label>
                        <select class="form-control" id="create-employer" aria-describedby="employer-help">
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
                        <label for="create-hours" class="form-label">Hours</label>
                        <input type="number" id="create-hours" class="input-field" placeholder=" " />
                    </div>
                    <div class="col-md-6">
                        <label for="create-avghour" class="form-label">Rate Per Hour</label>
                        <input type="number" id="create-avghour" class="input-field" placeholder=" " />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="create-taxable" class="form-label">Taxable</label>
                        <select class="form-control" id="create-taxable">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="create-status" class="form-label">Status</label>
                        <select class="form-control" id="create-status">
                            <option value="complete">Complete</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                            <option value="processing">Processing</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="create-shift" class="form-label">Shift Type</label>
                        <select class="form-control" id="create-shift">
                            <option value="day">Day</option>
                            <option value="night">Pending</option>
                            <option value="holiday">Holiday</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="create-paidat" class="form-label">Paid At</label>
                        <input type="datetime-local" id="create-paidat" class="form-control"  />
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary create-btn">Create</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
