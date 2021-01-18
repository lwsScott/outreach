// Form Status
$.post('includes/formDisplay.php', function (display) {
        $('#onLabel').removeClass("active");
        $('#offLabel').removeClass("active");
        $('#scheduleLabel').removeClass("active");
        if (display == 0) {
            $('#on').prop("checked", true);
            $('#onLabel').addClass("active");
        } else if (display == 1) {
            $('#off').prop("checked", true);
            $('#offLabel').addClass("active");
        } else if (display == 2) {
            $('#schedule').prop("checked", true);
            $('#scheduleLabel').addClass("active");

        }
    }
);

$('#on').click(function () {
    $.post('includes/formSet.php', {display: 0});
});

$('#off').click(function () {
    $.post('includes/formSet.php', {display: 1});
});

$('#schedule').click(function () {
    $.post('includes/formSet.php', {display: 2});
});

// Sort the table - newest first
$(document).ready(function () {

    $('#user-table').DataTable({
        "order": [[0, "desc"]]
    });
});

// Notes column edit
$('#tableData .notes').each(function () {
    $(this).blur(function () {
        let id = (this.id).substring(4);
        $.post('includes/edit.php', {id: id, text: ($(this).html())}, function () {
        });
    });
});

// Checkbox to highlight the row
// Set status of the checkbox and save on the database
$('#tableData .completed').each(function () {
    let id = (this.id).substring(8);

    $(this).click(function () {
        if ($(this).is(':checked')) {
            $.post('includes/setCompleted.php', {id: id, checked: 1});
        } else {
            $.post('includes/setCompleted.php', {id: id, checked: 0});
        }
    });
});
// Get status of the checkbox and save on the database
$('#tableData .completed').each(function () {
    let id = (this.id).substring(8);
    let checkbox = this;
    $.post('includes/getCompleted.php', {id: id}, function (checked) {
        if (checked == "1") {
            $(checkbox).prop('checked', true);
        } else {
            $(checkbox).prop('checked', false);
        }
        $(checkbox).is(':checked') ? $(checkbox).closest('tr').css({background: '#d1dce7'}) : $(checkbox).closest('tr').css({background: ''});

    });
});
// Change the color of the row
$('.completed').on('change', function () {
    //update row color
    $(this).is(':checked') ? $(this).closest('tr').css({background: '#d1dce7'}) : $(this).closest('tr').css({background: ''});
});
