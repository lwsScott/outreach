// hide a guest on the home page

// adds a listener to window.onload
$(document).ready(function() {
    $("p.text-warning").hide()

    var table = $('#guestInfo').DataTable();
    var id;
    var name;

    // save table rows when clicking on them
    $('#guestInfo tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        var id = data[0];
        var name = data[1] + " " + data[2];

        // update message for deletion confirmation
        var message = "Are you sure you want to delete " + name + " (#" + id + ")?";
        $("#deleteMessage").html(message);

        // delete the guest
        $("#confirmDelete").click(function() {
            var hideGuest = $.post('model/hideGuest.php', {id: id});

            // display success, then reload the page
            hideGuest.done(function () {
                $("p.text-warning").show();
                setTimeout(location.reload.bind(location), 1500);
            });
        });
    });
});