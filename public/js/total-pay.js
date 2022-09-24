

$(document).on('click', '#total_pay_button', function(e){
    e.preventDefault;
    let filter = $('.total_pay_input').val();
    let data_url = loc + '/shifts/filter/' + filter;
    window.location.href = data_url;

})
