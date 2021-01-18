	/* Team AZAP
	 * Alex, Zach, Antonio, Pavel
	 * http://azap.greenrivertech.net/index.php */
	
// adds a listener to window.onload
$(document).ready(function() {
	// test jQuery install
	checkZip();
});

function checkZip()
{
	$zipcode = $("#zipcode"); 
	
	$zipcode.on({
		// after selecting field
		keyup : function() {
			var validZip = ['98030','98031','98032','98042','98058'];
			// -1 if not in array, will print index of if in array
			if($.inArray($zipcode.val(), validZip) == -1) // red border when invalid
			{
				$zipcode.css("background-color", "#FFE8CC");
				$zipcode.css("border", "1px solid red");
			}
			else // green border when valid
			{
				$zipcode.css("background-color", "white");
				$zipcode.css("border", "1px solid #00A30A");
			}
		}
	});
}
