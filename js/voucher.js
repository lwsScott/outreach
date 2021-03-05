// adds a listener to window.onload
$(document).ready(function() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }
    date = yyyy + '-' + mm + '-' + dd;
});



//Remove a direction from the direction list
$('.btn-voucher-delete').click(function() {
    var parent = this.parentElement;
    $(parent).remove();
});

//Adding a direction when submitting a form
$('#add-voucher-button').click(function(event) {
    event.preventDefault();
    const CLONE_HTML =

        '<div class="row">\n' +
        '<div class="form-group col">\n' +
        '<label class="form-control-label">Voucher#:</label><input class="form-control" type="text" name="voucher[]">\n' +
        '</div>\n' +
        '<div class="form-group col">\n' +
        '<label class="form-control-label">Check#:</label><input class="form-control" type="text" name="checkNum[]" >\n' +
        '</div>\n' +
        '<div class="form-group col">\n' +
        '<label class="form-control-label">Amount:</label>\n' +
        '<div class="input-group">\n' +
        '<span class="input-group-addon">$</span><input class="form-control" type="amount" name="amount[]">\n' +
        '</div>\n' +

        '</div>\n' +

        '<div class="form-group col-3">\n' +
        '<label class="form-control-label">Date:</label><input class="form-control" type="date" name="date[]" value="'+date+'">\n' +
        '</div>\n' +
        '<div class="form-group col"> \n' +
        '<label class="form-check-label">Resource:</label> \n' +
        '<label class="d-block"></label> \n' +
        '<select class="form-control dropdown" name="resource[]">\n' +
        '<option value="">-- select one --</option> \n' +
        '<option value="dol">Dol</option> \n' +
        '<option value="energybill">Energy Bill</option> \n' +
        '<option value="food">Food</option> \n' +
        '<option value="gas">Gas</option> \n' +
        '<option value="rent">Rent</option> \n' +
        '<option value="thriftshop">Thrift Shop</option> \n' +
        '<option value="waterbill">Water</option> \n' +
        '<option value="other">Other</option> \n' +
        '</select> \n' +
        '</div>  \n' +
        '<div class="form-group col">' +
        '<button class="btn btn-danger btn-voucher-delete" type="button">Delete</button>' +
        '</div> \n' +
        '</div>';

    console.log(CLONE_HTML);
    $('#voucher-div').append(CLONE_HTML);

    // Add event listener to new node.
    $('.btn-voucher-delete').click(function() {
        var parent = this.parentElement;
        $(parent).remove();
    });
});





//Remove a direction from the direction list
$('.btn-member-delete').click(function() {
    var parent = this.parentElement;
    $(parent).remove();
});

//Adding a direction when submitting a form
$('#add-member-button').click(function(event) {
    event.preventDefault();
    const CLONE_HTML =

        '<div class="row" > \n' +
        '<div class="form-group col-5"> \n' +
        '<label class="form-control-label">Name:</label><input class="form-control" type="text" name="name[]" > \n' +
        '</div> \n' +

        '<div class="form-group col-2"> \n' +
        '<label class="form-control-label">Age:</label><input class="form-control" type="text" name="age[]" maxlength="3"> \n' +
        '</div> \n' +

        '<div class="form-group col-2"> \n' +
        '<label class="form-check-label">Gender:</label> \n' +
        '<label class="d-block"></label> \n' +
        '<select class="form-control dropdown" name="gender[]"> \n' +
        '<option value="">select one</option> \n' +
        '<option value="male">Male</option>\n' +
        '<option value="female">Female</option> \n' +
        '<option value="other">Other</option>\n' +
        '<option value="Prefer not to answer">Prefer not to answer</option>\n' +
        '</select> \n' +
        '</div> \n' +
        '<button class="btn btn-danger btn-member-delete" type="button">Delete</button> \n' +
        '</div>';


    console.log(CLONE_HTML);
    $('#member-div').append(CLONE_HTML);

    // Add event listener to new node.
    $('.btn-member-delete').click(function() {
        var parent = this.parentElement;
        $(parent).remove();
    });
});