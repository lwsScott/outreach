	/* Team AZAP
	 * Alex, Zach, Antonio, Pavel
	 * http://azap.greenrivertech.net/index.php */

// adds a listener to window.onload
$(document).ready(function() {
	// test jQuery install
	formSubmit();
	// set number of fields from member value
	//showHouseholdMembers($("#members option:selected").text());
	// set number of fields from voucher amount value
	//showAmountOfVouchers($("#vouchernum option:selected").text());
});

function formSubmit()
{
	$household = $("#household"); // household member form group
	$members = $("#members"); // number of members in household dropdown
	$numMembers = $("#members option:selected").text(); // number of members selected value
	$checkVoucher = $("#checkvoucher"); // voucher amount form group
	$vouchers = $("#vouchernum"); // number of vouchers in voucher dropdown
	$numVouchers = $("#vouchernum option:selected").text(); // number of vouchers selected value

	$previewForm = $("#previewForm"); // preview modal content
	$preview = $("#preview"); // preview button
	$close = $("#close"); // close preview box
	$formPost = $("#formGuest"); // post method
	$update = $("#update"); // update or submit new dropdown

	$name = "";

	// $members.on({
	// 	// after selecting field
	// 	click : function() {
	// 		$numMembers = $("#members option:selected").text();
	// 		showHouseholdMembers($numMembers);
	// 	}
	// });
	//
	// $vouchers.on({
	// 	// after selecting field
	// 	click : function() {
	// 		$numVouchers = $("#vouchernum option:selected").text();
	// 		console.log($numVouchers);
	// 		showAmountOfVouchers($numVouchers);
	// 	}
	// });

	$preview.on({
		// after selecting field
		click : function() {
			$("#previewForm p").remove(); // remove content
			// add fields to preview
			$previewForm.append("<p>First Name: " + $("#first").val() + "</p>");
			$previewForm.append("<p>Last Name: " + $("#last").val() + "</p>");
			$previewForm.append("<p>Birthdate: " + $("#birthdate").val() + "</p>");
			$previewForm.append("<p>Ethnicity: " + $("#ethnicity").val() + "</p>");
			$previewForm.append("<p>Phone: " + $("#phone").val() + "</p>");
			$previewForm.append("<p>Email: " + $("#email").val() + "</p>");
			$previewForm.append("<p>Street: " + $("#street").val() + "</p>");
			$previewForm.append("<p>City: " + $("#city").val() + "</p>");
			$previewForm.append("<p>Zip: " + $("#zip").val() + "</p>");
			$previewForm.append("<p>Mental Disability: " + $("#mental").is(":checked") + "</p>");
			$previewForm.append("<p>Physical Disability: " + $("#physical").is(":checked") + "</p>");
			$previewForm.append("<p>Veteran: " + $("#veteran").is(":checked") + "</p>");
			$previewForm.append("<p>Homeless: " + $("#homeless").is(":checked") + "</p>");
			$previewForm.append("<p>Monthly Income: " + $("#income").val() + "</p>");
			$previewForm.append("<p>Monthly Rent: " + $("#rent").val() + "</p>");
			$previewForm.append("<p>Food Stamps: " + $("#foodStamp").val() + "</p>");
			$previewForm.append("<p>Additional Support: " + $("#addSupport").val() + "</p>");
			$previewForm.append("<p>Driver License or Photo ID #: " + $("#license").val() + "</p>");
			$previewForm.append("<p>Puget Sound Energy Account #: " + $("#pse").val() + "</p>");
			$previewForm.append("<p>Water Account #: " + $("#water").val() + "</p>");
			// $previewForm.append("<p>Members in household: " + $numMembers + "</p>");
			// $("#previewForm p:even").css({"float": "left", "width": "50%"});
			// for(var i = 1; i <= $numMembers; i++)
			// {
			// 	$previewForm.append("<div style=\"float:left; width:50%;\"><p>Name: " + $("#name" + i).val() + "</p>");
			// 	$previewForm.append("<p>Age: " + $("#age" + i).val() + "</p><style>");
			// 	$previewForm.append("<p>Gender: " + $("#gender" + i).val() + "</p></div.");
			// }
			// for(var j = 1; j <= $numVouchers; j++)
			// {
			// 	$previewForm.append("<div style=\"float:left; width:50%;\"><p>Voucher: " + $("#voucherNum" + j).val() + "</p>");
			// 	$previewForm.append("<p>Check: " + $("#checkNum" + j).val() + "</p><style>");
			// 	$previewForm.append("<p>Amount: " + $("#amount" + j).val() + "</p></div.");
			// 	$previewForm.append("<p>Resource needed: " + $("#resource" + j).val() + "</p></div.");
			// }
            //
			// /*
			// $text = "<div>";
			// 	$text += "<p>Something</p>";
			// $text += "</div>";
            //
			// $("#someDiv").append($text);
			// */
		}
	});

	$close.on({
		click : function() {
			$("#previewForm p").remove(); // remove content
		}
	});

	$("#first").on({
		// clicking out of field
		blur : function() {
			$name = $("#first").val() + " ";
		}
	});

	$("#last").on({
		// clicking out of field
		blur : function() {
			if($name != "") // must enter first name beforehand
			{
				$name += $("#last").val(); // add last name after first
				$("#name1").val($name); // put name into household name column
			}
		}
	});

	$("#birthdate").on({
		blur : function() {
			var bdate = $("#birthdate").val(); // only take year
			bdate = new Date(bdate); // save to date format
			var today = new Date(); // current date
			// divide birth year
			var age = Math.floor((today-bdate) / (365.25 * 24 * 60 * 60 * 1000));
			$('#age1').val(age);
		}
	});

	$('#submitBtn').click(function(){
		//when the submit button in the modal is clicked, submit the form
		alert('submitting');
		$('#formfield').submit();
	});

	$update.on({
		click : function() {
			var method = $("#update").val(); // selected value
			if (method == "update")
			{
				// will update existing guest
				$formPost.attr("action", "#"); // submit to self
			}
			if (method == "new")
			{
				// will add new guet
				$formPost.attr("action", "newGuest.php"); // submit to newGuest.php
			}
		}
	});

	// autofilling first household member
	var first = $("input[name='first']");
	var last = $("input[name='last']");
	var dob = $("input[name='birthdate']");
	var houseName = $("input[name='name[]']").first();
	var houseAge = $("input[name='age[]']").first();

	first.blur(function() {
		// if both values are filled, put it into thee first household input
		if(first.val().length > 0 && last.val().length > 0) {
			var name = first.val() + " " + last.val();
			houseName.val(name);
		}
	});

	last.blur(function() {
		// if both values are filled, put it into thee first household input
		if(first.val().length > 0 && last.val().length > 0) {
			var name = first.val() + " " + last.val();
			houseName.val(name);
		}
	});

	dob.blur(function() {
		// if both values are filled, put it into thee first household input
		var birthdate = new Date(dob.val());
		var ageDiff = Date.now() - birthdate.getTime();
		var ageDate = new Date(ageDiff); // in milliseconds
		var age = Math.abs(ageDate.getUTCFullYear() - 1970);
		houseAge.val(age);
	});


	// prevents form from submitting twice
	$("#submit").submit(function(){
		$("#submit").submit(function(){
			return false;
		});
	});
}