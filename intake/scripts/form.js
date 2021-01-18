/*
Ben Chadwick
Jessica Sestak
Husrav Homidov
Tiffany Welo

Team Dotcom
10/19/20

form.js validates the form, hides the form, shows the summary,
hides summary, formats the phone number,  and unhides the dropdowns for assistance.

*/

//Hides the address
window.onload = addressHide();

//Validates the ZipCode
document.getElementById("application").onsubmit = validateZip;

// Prevent the browser from filling out the phone number
$('#phone').attr('autocomplete', 'randomString');
//Autoformat phone number
$(function () {
  $('#phone').keydown(function (e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }

        }

        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });
});

//validate the form
function validate() {
    //create a flag variable
    let isValid = true;

    //validate first name
    let first = document.getElementById("fname").value;
    let errFname = document.getElementById("error-fname");
    if (first === "") {
        errFname.className = "errors";
        isValid = false;
    } else {
        errFname.className = "hidden";
    }
    // validate last name
    let last = document.getElementById("lname").value;
    let errLname = document.getElementById("error-lname");
    if (last === "") {
        errLname.className = "errors";
        isValid = false;
    } else {
        errLname.className = "hidden";
    }
    //validate email
    let phone = document.getElementById("phone").value;
    let email = document.getElementById("inputEmail").value;
    let errContact = document.getElementById("error-contact");
    let errAutofill = document.getElementById("error-autofill");
    let mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let errorEmail = document.getElementById("error-email");
    if (phone === "" && email === "") {
        errContact.className = "errors";
        errAutofill.className = "hidden";
        errorEmail.className = "hidden";
        isValid = false;
    } else if((!phone.includes("-") && phone !== "") && !(email.match(mailformat)) && (email !== "")){
        errContact.className = "hidden";
        errAutofill.className = "errors";
        errorEmail.className = "errors";
        isValid = false;
    } else if(!phone.includes("-") && phone !== "") {
        errAutofill.className = "errors";
        errContact.className = "hidden";
        errorEmail.className = "hidden";
        isValid = false;
    } else if(!(email.match(mailformat)) && (email !== "")) {
        errorEmail.className = "errors";
        errAutofill.className = "hidden";
        errContact.className = "hidden";
        isValid = false;
    } else {
        errContact.className = "hidden";
        errAutofill.className = "hidden";
        errorEmail.className = "hidden";
    }



        //validate to see if assistance was checked
    let assistance = document.getElementsByName("assistance[]");
    let count = 0;
    for (let i = 0; i < assistance.length; i++) {
        if (assistance[i].checked) {
            count++;
        }
    }
    let errAssistance = document.getElementById("error-assistance");
    let otherCheckBox = document.getElementById('other');
    if (count === 0 && (otherCheckBox.checked === false)) {
        errAssistance.className = "errors";
        isValid = false;
    } else {
        errAssistance.className = "hidden";
    }

    //validate zip is not null
    let zip = document.getElementById("inputZip").value;
    let zipError = document.getElementById("error-zip");
    if (window.location.hash !== '#residency') {
        if (zip === "") {
            zipError.className = "errors";
            isValid = false;
        } else {
            zipError.className = "hidden";
        }
    }


    //validate city is not empty
    let city = document.getElementById("inputCity").value;
    let cityError = document.getElementById("error-city");
    if (window.location.hash !== '#residency') {
        if (city === "") {
            cityError.className = "errors";
            isValid = false;
        } else {
            cityError.className = "hidden";
        }
    }

    //validate Address is not empty
    let address = document.getElementById("inputAddress").value;
    let addressError = document.getElementById("error-address");
    if (window.location.hash !== '#residency') {
        if (address === "") {
            addressError.className = "errors";
            isValid = false;
        } else {
            addressError.className = "hidden";
        }
    }

    return isValid;

}

//function utility displays extra information about utility when checkBox is checked 
function utility() {
    let checkBox = document.getElementById("utilities");
    // Get the output text
    let text = document.getElementById("util-info");
    // If the checkbox is checked, display the output text
    if (checkBox.checked === true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }


}

//function rentInfo displays extra information about rent when checkBox is checked 
function rentInfo() {
    let checkBox = document.getElementById("rent");
    // Get the output text
    let text = document.getElementById("rent-info");

    // If the checkbox is checked, display the output text
    if (checkBox.checked === true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }

}

//function gasInfo displays extra information about gas when checkBox is checked 
function gasInfo() {
    let checkBox = document.getElementById("gas");
    // Get the output text
    let text = document.getElementById("gas-info");

    // If the checkbox is checked, display the output text
    if (checkBox.checked === true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }

}

//function thriftInfo displays extra information about thrift Store when checkBox is checked 
function thriftInfo() {
    let checkBox = document.getElementById("thrift");
    // Get the output text
    let text = document.getElementById("thrift-info");

    // If the checkbox is checked, display the output text
    if (checkBox.checked === true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }

}

//function driverInfo displays extra information about id/driverlicense when checkBox is checked 
function driverInfo() {
    let checkBox = document.getElementById("driver");
    // Get the output text
    let text = document.getElementById("id-info");

    // If the checkbox is checked, display the output text
    if (checkBox.checked === true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}

//otherChecked diplays the Other input text box
function otherChecked() {
    let checkBox = document.getElementById("other");
    let text = document.getElementById("otherText");
    let textTwo = document.getElementById("otherTextInput")
    if (checkBox.checked === true) {
        text.style.display = "block";
        textTwo.style.display = "block";
    } else {
        document.getElementById("otherTextInput").value = "";
        text.style.display = "none";
        textTwo.style.display = "none";
    }
}

//hides address when without a home
function addressHide() {
    if (window.location.hash === '#residency') {
        document.getElementById("inputAddress").disabled = "disabled";
        document.getElementById("inputAddress").placeholder = "Residency is not required";
        document.getElementById("inputAddress2").disabled = "disabled";
        document.getElementById("inputAddress2").placeholder = "";
        document.getElementById("inputCity").disabled = "disabled";
        document.getElementById("inputZip").disabled = "disabled";

    }

}



//hides summary and allows to re-edit form
function hideSummary() {
    document.getElementById("summary").classList.add("d-none");
    document.getElementById("formSubmission").classList.remove("d-none");
}


//shows the review of the form to the user
function showSummary() {

    if (validate()) {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
        document.getElementById("summary").classList.remove("d-none");
        document.getElementById("formSubmission").classList.add("d-none");

        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let phone = document.getElementById("phone").value;
        let email = document.getElementById("inputEmail").value;
        let addressOne = document.getElementById("inputAddress").value;
        let addressTwo = document.getElementById("inputAddress2").value;
        let city = document.getElementById("inputCity").value;
        let zip = document.getElementById("inputZip").value;
        let comments = document.getElementById("commentBox").value;
        let other = document.getElementById("otherTextInput").value;
        let assistance = document.getElementsByName("assistance[]");
        let assistanceArray = [];
        for (let i = 0; i < assistance.length; i++) {
            if (assistance[i].checked) {
                assistanceArray.push(" " + assistance[i].value);
            }
        }

        document.getElementById("fName-sum").innerHTML = fname;
        document.getElementById("lName-sum").innerHTML = lname;
        document.getElementById("phone-sum").innerHTML = phone;
        document.getElementById("inputEmail-sum").innerHTML = email;
        document.getElementById("inputAddress-sum").innerHTML = addressOne;
        document.getElementById("inputAddress2-sum").innerHTML = addressTwo;
        document.getElementById("inputCity-sum").innerHTML = city;
        document.getElementById("inputZip-sum").innerHTML = zip;
        document.getElementById("assistance-sum").innerHTML = assistanceArray;
        document.getElementById("commentBox-sum").innerHTML = comments;
        document.getElementById("otherTextInput-sum").innerHTML = other;
    }

}

//validates that zipcode
function validateZip() {
    if (document.getElementById("inputZip").disabled !== "disabled") {
        let zip = document.getElementById("inputZip").value;
        if (zip == "98030") {
            ("Correct Zip code");
            return true;
        } else if (zip == "98058") {
            ("Correct Zip code");
            return true;
        } else if (zip == "98031") {
            ("Correct Zip code");
            return true;
        } else if (zip == "98032") {
            ("Correct Zip code");
            return true;
        } else if (zip == "98042") {
            ("Correct Zip code");
            return true;
        } else if (zip == "") {
            return true;
        } else {
            ("incorrect zip code");
            $("#redirectModal").modal()
            return false;
        }
    } else {
        return true;
    }
}

