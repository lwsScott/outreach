/* Team AZAP
 * Alex, Zach, Antonio, Pavel
 * http://azap.greenrivertech.net/index.php
 * 2.0 - Kaephas
 */

// adds a listener to window.onload
$(document).ready(function() {
	let main = $("#guestInfo");

	main.DataTable( {
		// ID = 0
		"order": [[ 0, "asc" ]]
	});
	$("#needInfo").DataTable( {
		"order": [[ 5, "desc" ]]
	});

	// set row click redirect
	$("#guestInfoRequest tbody").on('click', 'tr', function() {
		window.location = $(this).attr('data-href');
	});

	$("#needInfo tbody").on('click', 'tr', function() {
		window.location = $(this).attr('data-href');
	});

	// Display dataTables only after initial search is chosen

	$("#search").on('click', function() {
		// Get search value
		let filter = $("#startFilter").val();
		// redraw tables with filter
		main.DataTable().search(filter).draw();

		// set filter on all secondary tables
		$("#needInfo").DataTable().search(filter).draw();

		// un-hide table
		$("#hideTable").show();
		// hide the initial search box
		$("#searchFilter").hide();

		showTable();
	});

	// "click" if enter is pressed
	$("#startFilter").keyup(function(event) {
		// keyCode 13 = enter
		if(event.keyCode === 13) {
			search.click();
		}
	});
});


function showTable()
{
	$guest = $("#info"); // main guest table button
	$needs = $("#needs"); // needs table button

	$("#guestbtn").on({
		// after clicking button
		click : function() {
			// show table
			$guest.css("display", "block");
			// hide others
			$needs.css("display", "none");
		}
	});

	$("#needbtn").on({
		// after clicking button
		click : function() {
			// show table
			$needs.css("display", "block");
			// hide others
			$guest.css("display", "none");
		}
	});
}
