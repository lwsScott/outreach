
// allow the click of a table cell to add to the theme item list
let table = $('#table1').DataTable();


$('#table').on( 'dblclick', 'tr', function () {
    //alert( table.cell( this ).data() );
    let add = table.row( this ).data();
    console.log(add);
} );

$('#table1 tbody').on( 'dblclick', 'tr', function () {
    if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
    }
    else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        let add = table.row( this ).data();
        console.log(add);
        let taskID = add[6];
        let taskIDedit = add[6];
        console.log(taskID);
        console.log(taskIDedit);
        document.getElementById('taskID').value = taskID;
        document.getElementById('taskIDedit').value = taskID;
        console.log(document.getElementById('taskID').value);
    }
} );

