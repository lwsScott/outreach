<!--
Ben Chadwick
Jessica Sestak
Husrav Homidov

Team Dotcom
11/8/20
This is the form for St. James Outreach
-->
<?php
// Include header file
include('includes/head.html');
?>
<body>
<!--NAVBAR-->
<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
    <div class="container">
        <!-- Toggler For Mobile -->
        <button class="navbar-toggler" type="button"
                data-toggle="collapse" data-target="#myTogglerNav"
                aria-controls="myTogglerNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="index.php" class="navbar-brand">Kent Outreach</a>
        <div class="collapse navbar-collapse" id="myTogglerNav">
            <div class="navbar-nav">
                <a href="index.php#assistance" class="nav-item nav-link">ASSISTANCE</a>
                <a href="index.php#contact" class="nav-item nav-link">CONTACTS</a>
                <a href="getinvolved.php" class="nav-item nav-link">GET INVOLVED</a>
                <a href="resources.php" class="nav-item nav-link">RESOURCES</a>
            </div>
        </div>
    </div>
</nav>
<!-- NAVBAR END -->

<div class="w3-content pageStyle">
    <!-- The Application Form Section -->
    <div class="w3-white band shadow-lg p-3 mb-5 bg-white rounded" id="form">
        <div class="w3-container w3-content w3-padding-64" id="applicationContainer">
            <!-- Creation of user information form -->
            <form id="application" method="post" action="confirmation.php"  enctype="multipart/form-data">
                <div id="formSubmission">
                    <!-- This is the title, and the description of the form -->
                    <h2 class=" w3-center">St. James Resource Application Form</h2>
                    <p class="w3-opacity w3-center">
                        <i>This form will be collected and added to our assistance registry so that we may
                            contact you as soon as we are able to help</i>
                    </p>
                    <hr class="style13">
                    <!-- Creation of checklist with all the assistance options available -->
                    <fieldset class="form-group border p-2">
                        <legend>How can we assist you?</legend>
                        <div class="w3-row-padding  w3-margin-top">
                            <!--Name and Contact-->
                            <div class="w3-half">
                                <div class="form-group col-md-6">
                                    <label for="fname">First name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="John"/>
                                    <span id="error-fname" class="hidden">* required</span>
                                </div>
                                <!-- Last Name -->
                                <div class="form-group col-md-6">
                                    <label for="lname">Last name</label>
                                    <input type="text" class="form-control" id="lname" name="lname"
                                           placeholder="Smith"/>
                                    <span id="error-lname" class="hidden">* required</span>
                                </div>
                                <!-- Phone Number -->
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone number</label>
                                    <input  type="tel" class="form-control" id="phone" name="phone"
                                           maxlength="12"
                                           placeholder="xxx-xxx-xxxx">
                                </div>
                                <span id="error-autofill" class="hidden">*Please insert dashes (ex: XXX-XXX-XXXX)<br></span>
                                <!-- Email -->
                                <div class="form-group col-md-6">
                                    <label for="inputEmail">Email</label>
                                    <input name="emailFrom" type="email" class="form-control" id="inputEmail"
                                           placeholder="name@example.com"/>
                                </div>
                                <span id="error-email" class="hidden">*Please insert a valid email (ex: xxxx@xxxx.xxx)<br></span>
                                <span id="error-contact" class="hidden">*Please give contact method (preferably email)</span>
                            </div>
                            <!--Assistance Checkboxes-->
                            <div class="w3-half">
                                <!--Utilities Checkbox-->
                                <div class='form-check'>
                                    <input class='form-check-input'
                                           type='checkbox' name='assistance[]'
                                           id='utilities' value='Utilities' onclick="utility()">
                                    <label class='form-check-label'
                                           for='utilities'>Utilities (electricity or water)</label><br>
                                    <label class="w3-small" for='utilities'>Assisted once per year</label>
                                    <p class="alert alert-info" id="util-info" style="display:none">
                                        *If able, attach a photo of the bill below showing name submitted
                                    </p>
                                </div>
                                <!--Rent Checkbox-->
                                <div class='form-check'>
                                    <input class='form-check-input'
                                           type='checkbox' name='assistance[]'
                                           id='rent' value='Rent' onclick='rentInfo()'>
                                    <label class='form-check-label'
                                           for='rent'>Rent</label><br>
                                    <label class="w3-small" for='rent'>Assisted once per year</label>
                                    <p class="alert alert-info" id="rent-info" style="display:none">*If able, attach a photo of the bill
                                        below showing name submitted (must be urgent or shut-off notice)
                                    </p>
                                </div>
                                <!--Gas Voucher Checkbox-->
                                <div class='form-check'>
                                    <input class='form-check-input'
                                           type='checkbox' name='assistance[]'
                                           id='gas' value='Gas' onclick='gasInfo()'>
                                    <label class='form-check-label'
                                           for='gas'>Gas Voucher</label><br>
                                    <label class="w3-small" for='gas'>Assisted once per every six months</label>
                                    <p class="alert alert-info" id="gas-info" style="display:none">*Please attach a photo of your valid Driver's
                                        License with name submitted shown
                                    </p>
                                </div>
                                <!--Thrift Store Checkbox-->
                                <div class='form-check'>
                                    <input class='form-check-input'
                                           type='checkbox' name='assistance[]'
                                           id='thrift' value='Thrift Store' onclick='thriftInfo()'>
                                    <label class='form-check-label'
                                           for='thrift'>Thrift Store Voucher</label><br>
                                    <label class="w3-small" for='thrift'>Assisted once per every six months</label>
                                    <p class="alert alert-info" id="thrift-info" style="display:none">*Thrift store hours will be set by appointment </p>
                                </div>
                                <!--Driver's License or ID card Checkbox-->
                                <div class='form-check'>
                                    <input class='form-check-input'
                                           type='checkbox' name='assistance[]'
                                           id='driver' value='License or ID' onclick='driverInfo()'>
                                    <label class='form-check-label'
                                           for='driver'>Seeking Driver's License or ID Card</label><br>
                                    <label class="w3-small" for='driver'>Assisted by appointment</label>
                                    <p class="alert alert-info" id="id-info" style="display:none">*Please check DSHS to apply for a voucher,
                                        voucher's will be covered dependant on our resources
                                    </p>
                                </div>
                                <!--Food Checkbox-->
                                <div class='form-check'>
                                    <input class='form-check-input'
                                           type='checkbox' name='assistance[]'
                                           id='food' value='Food'>
                                    <label class='form-check-label'
                                           for='food'>Food</label><br>
                                    <label class="w3-small" for='food'>Assisted once per month</label>
                                </div>
                                <!--Other Checkbox-->
                                <div class='form-check'>
                                    <input class='form-check-input'
                                           type='checkbox' name='other'
                                           id='other' value='Other: ' onclick='otherChecked()'>
                                    <label class='form-check-label'
                                           for='other'>Other</label><br>
                                </div>
                                <!--Other input box-->
                                <label for="otherTextInput" id="otherText" style="display:none">What assistance are you
                                    looking for?</label>
                                <input type="text" id="otherTextInput" name="otherTextInput" style="display:none"/>
                                <span id="error-other" class="hidden">* required</span>
                                <span class="hidden" id="error-assistance">*Please select assistance</span>
                            </div>
                        </div>
                    </fieldset>
                    <!-- End of checklist portion of form -->

                    <!--Address Form-->
                    <div>
                        <div class="form-row">
                            <!--Address Input -->
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Address</label>
                                <input name="address" type="text" class="form-control" id="inputAddress"
                                       placeholder="1234 Main St">
                                <span id="error-address" class="hidden">* required</span>
                            </div>
                            <!--AddressTwo Input -->
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Address 2</label>
                                <input name="addressTwo" type="text" class="form-control" id="inputAddress2"
                                       placeholder="Apartment, studio, or floor">
                            </div>
                        </div>
                        <div class="form-row">
                            <!--City Input -->
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input name="city" type="text" class="form-control" id="inputCity">
                                <span id="error-city" class="hidden">* required</span>
                            </div>
                            <!--ZipCode Input -->
                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input name="zip" type="text" class="form-control" id="inputZip">
                                <span id="error-zip" class="hidden">* required</span>
                            </div>
                        </div>
                    </div>
                    <!-- Creation of comment and attachment box -->
                    <div class="form-row">
                        <div>
                            <div class="form-group ml-2 px-0">
                                <label for="commentBox">Optional comments and attachments</label>
                                <textarea name="inComment" id="commentBox"
                                          style="height: 100px; width: 80%;"></textarea>
                                <div class="mb-0">
                                    <label for="myfile"></label>
                                        <input type="file" id="myfile" name="myfile"><br><br>
                                </div>
                            </div>
                            <!-- End of form submit button -->
                            <button class="btn btn-secondary btn-lg ml-2" type="button"
                                    onclick="showSummary()">Next
                            </button>
                        </div>
                        <img class="w3-hide-medium w3-hide-small" src="images/stjameslogo.png" alt="St. James logo"
                             style="width: 40%; height: 40%; padding-top: 30px; margin-left: 60px">
                    </div>
                </div>
                <!--Submission Summary-->
                <div id="summary" class="d-none w3-container w3-content w3-padding-64 p-3 mb-5 bg-white band">
                    <header>
                        <h1>Submission Summary</h1>
                        <h6>Please confirm all the information below is accurate before final submission.</h6>
                    </header>
                    <div class="ml-2">
                        <table class="table">
                            <tr>
                                <th>First Name:</th>
                                <td id="fName-sum"></td>
                            </tr>
                            <tr>
                                <th>Last Name:</th>
                                <td id="lName-sum"></td>
                            </tr>
                            <tr>
                                <th>Phone Number:</th>
                                <td id="phone-sum"></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td id="inputEmail-sum"></td>
                            </tr>
                            <tr>
                                <th>Address 1:</th>
                                <td id="inputAddress-sum"></td>
                            </tr>
                            <tr>
                                <th>Address 2:</th>
                                <td id="inputAddress2-sum"></td>
                            </tr>
                            <tr>
                                <th>City:</th>
                                <td id="inputCity-sum"></td>
                            </tr>
                            <tr>
                                <th>Zip:</th>
                                <td id="inputZip-sum"></td>
                            </tr>
                            <tr>
                                <th>Assistance:</th>
                                <td id="assistance-sum"></td>
                            </tr>
                            <tr>
                                <th>Other:</th>
                                <td id="otherTextInput-sum"></td>
                            </tr>
                            <tr>
                                <th>Comments:</th>
                                <td id="commentBox-sum"></td>
                            </tr>
                        </table>
                        <hr class="style13">
                        <div class="w3-center">
                            <p class="lead">By clicking submit, you agree that all the information above is accurate and valid.</p>
                            <button class="btn btn-secondary btn-lg mr-5 px-4" id="edit" onclick="hideSummary()" type="button">Edit
                            </button>
                            <button class="btn btn-secondary btn-lg" type="submit" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End of user information form-->
            <!-- Resources redirection modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="redirectModal" aria-labelledby="redirectModal"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header w3-black">
                            <h2 class="<!--w3-black modal-title -->w3-modal-content">St. James Outreach</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="w3-large"><u>Sorry, it seems that you're out of the Outreach's range.</u></p>
                            <p class="w3-large">We have additional resources available for you to check. If you want to proceed,
                                click continue, otherwise click close.
                            </p>
                        </div>
                        <!-- Link to the resource page for continue -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href = '../resources.php';">Continue
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sub notes about submission confirmation -->
        <hr class="style13">
        <h3 class="w3-center mt-3">
            Once submitted, we will contact you as soon as we can
        </h3>
        <p class="w3-content w3-center w3-hide-small" style="width: 600px;">
            To ensure we can give the resources needed, please make sure the information above is accurate.
            Additionally please note our hours of operation at the bottom of the page.
        </p>
    </div>
</div>
<!-- The Footer Section -->
<div class="w3-container w3-content w3-center w3-padding-64 shadow-lg mb-5 bg-white w3-black rounded" id="contact">
    <!-- Footer -->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <!-- Hours -->
                    <div class="col-md-4 col-lg-4 footer-about">
                        <h3 class="mb-5">Hours</h3>
                        <p><i class="fa fa-calendar contactFont"> </i>
                            Monday: 1:00pm to 4:00pm</p>
                        <p>Tuesday: 9:00am to 12:00 noon</p>
                        <p>Wednesday: 1:00pm to 4:00pm</p>
                    </div>
                    <!-- Contacts -->
                    <div class="col-md-4 col-lg-4 footer-contact">
                        <h3 class="mb-5">Contacts</h3>
                        <!-- Google Map insertion -->
                        <p><i class="fa fa-map-marker" id="google"></i>
                            <a
                                    href="https://goo.gl/maps/UEuiGpguDtXozPjN7"
                                    target="_blank"
                                    rel="noopener noreferrer"
                            >24447 94th Ave S, Kent, WA, 98030 </a>
                        </p>
                        <p><i class="fa fa-phone contactFont"></i> Phone:<a href="tel:253-852-4100">253-852-4100</a></p>
                        <p><i class="fa fa-envelope contactFont"></i> Email:<a href="postrander@stjameskent.org">postrander@stjameskent.org</a></p>
                        <a href="control.php" class="w3-text-white">Admin
                            Page</a>
                    </div>
                    <!--Google map-->
                    <div class="col-md-4 col-lg-3 footer-location">
                        <h3 class="mb-3">Our Location</h3>
                        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 200px">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10806.156076848025!2d-122.216393!3d47.381915!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54905eaea6606e61%3A0x206815f453c0e48b!2s24447%2094th%20Ave%20S%2C%20Kent%2C%20WA%2098030!5e0!3m2!1sen!2sus!4v1605391186289!5m2!1sen!2sus" width="300" height="150" style="border:0; max-width: 100%" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- All the scripts used for this document -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="scripts/form.js"></script>
</body>
</html>