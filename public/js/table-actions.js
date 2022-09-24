
// Getting the current location, public string to be used through the other functions
let loc = window.location.protocol + '//' + window.location.host


$(document).on('click', '.create-btn', function(e){
    e.PreventDefault;
    // Getting the url of the current location through loc variable
    let data_url = loc + '/shifts/';
    // Getting values from the form
    let employee =  $('#create-employee').val();
    let employer =  $('#create-employer').val();
    let hours =     $('#create-hours').val();
    let avghour =   $('#create-avghour').val();
    let taxable =   $('#create-taxable').val();
    let status =    $('#create-status').val();
    let shift =     $('#create-shift').val();
    let paid_at =   $('#create-paidat').val();
    let total_pay = parseInt(hours * avghour);

    // if(paid_at){
    //     paid_at = moment(paid_at).format('YYYY-MM-DD HH:mm:ss');
    // } else {
    //     paid_at = null
    // }

    if (Object.prototype.toString.call(paid_at) === "[object Date]") {
        paid_at = moment(paid_at).format('YYYY-MM-DD HH:mm:ss');
        if (isNaN(paid_at)) { // d.getTime() or d.valueOf() will also work
            paid_at = null
        } else {
            paid_at = moment(paid_at).format('YYYY-MM-DD HH:mm:ss');
        }
      }


    // Getting the current date and time with moment.js
    let date = moment().format('YYYY-MM-DD HH:mm:ss')

    $.ajax({
        url:data_url,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            date:date,
            user_id:employee,
            employer_id:employer,
            hours:hours,
            avg_hour:avghour,
            taxable:taxable,
            status:status,
            total_pay:total_pay,
            shift_type:shift,
            paid_at:paid_at,
        }
    }).done(function(data){
        iziToast.success({
            title: 'Success',
            message: data.message,
        });
        // Closing modal
        $('#create-modal').modal('toggle');
    }).fail(function() {
        // Display error notification.
        iziToast.error({
            title: 'Error',
            message: 'Error occured.'
        });
    });
})



$(document).on('click', '.edit-btn', function(e) {
    e.PreventDefault;

    // Creating variable data_url and getting the value from data attribute url
    let data_url = $(this).data('url');
    $.ajax({
        url: data_url,
        type:'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(data){

        // Collecting Shift data so its shown in the modal

        $('#update-modal').data('id', data.message.id);
        $('#update-employee').val(data.message.user_id);
        $('#update-employer').val(data.message.employer_id);
        $('#update-hours').val(data.message.hours);
        $('#update-avghour').val(data.message.avg_hour);
        $('#update-taxable').val(data.message.taxable);
        $('#update-status').val(data.message.status);
        $('#update-shift').val(data.message.shift_type);

        $('#update-modal').modal('toggle');
    })
})

$(document).on('click', '.update-btn', function(e){

    e.PreventDefault;

    let id = $('#update-modal').data('id');
    // Getting url from public variable loc and given id from the already set data attribute id
    let data_url = loc + '/shifts/' + id;

    let employee =  $('#update-employee').val();
    let employer =  $('#update-employer').val();
    let hours =     $('#update-hours').val();
    let avghour =   $('#update-avghour').val();
    let taxable =   $('#update-taxable').val();
    let status =    $('#update-status').val();
    let shift =     $('#update-shift').val();

    let total_pay = parseInt(hours * avghour);

    // Getting the current date and time with moment.js
    let date = moment().format('YYYY-MM-DD HH:mm:ss')
    // Clearing the british pound and sending an int variable to server
    hours = hours.replace('£', '')
    hours = parseInt(hours)
    $.ajax({
        url:data_url,
        type: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            date:date,
            user_id:employee,
            employer_id:employer,
            hours:hours,
            avg_hour:avghour,
            taxable:taxable,
            status:status,
            total_pay:total_pay,
            shift_type:shift,
        }
    }).done(function(data){
        iziToast.success({
            title: 'Success',
            message: data.message,
        });
        $('#update-modal').modal('toggle');
    }).fail(function() {
        // Display error notification
        iziToast.error({
            title: 'Error',
            message: 'Error occured.'
        });
    });
})

$(document).on('click', '.del-btn', function(e){
    e.preventDefault;
    let data_url = $(this).data('url');
    let table_row = $(this).parent().parent();
    $.confirm({
        title: 'Are you sure?',
        content: 'Please confirm you are sure to remove this data. This action cannot be undone.',
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Confirm',
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        url:data_url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    }).done(function(data) {
                            // If the selected shift is deleted, display success notification with iziToast.
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                });
                            // Removing the table row with animation.
                            table_row.fadeOut( "slow", function() {
                                // Animation complete.
                            }).fail(function(data){
                                iziToast.error({
                                    title: 'Failed',
                                    message: data.message,
                                })
                            })
                    })
                }
            },
            close: function () {
            }
        }
    });
})
