<!--
    Ben Chadwick
    Jessica Sestak
    Husrav Homidov

    Team Dotcom
    12/8/20
    This website is the resources for St. James Outreach
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
                <a href="resources.php" class="nav-item nav-link active">RESOURCES</a>
            </div>
        </div>
    </div>
</nav> <!-- Navbar End -->

<div class="pageStyle container mb-5 bg-white rounded">
    <div class="w3-container w3-content w3-center w3-padding-64 band shadow-lg p-3 mb-5 rounded pageStyle">

        <!-- Page Top Title -->
        <h2 class="mb-3">Community Resources</h2>
        <p class="w3-opacity w3-center">
            <i>You can find additional help by following the resources below</i>
        </p>
        <div class="container">
            <hr>
            <!-- 211.ORG -->
            <div class="row text-left">
                <div class="card mb-5 col-md-8 mx-auto">
                    <h3 class="card-header text-center">211.ORG</h3>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="images/211-logo.png" class="card-img" alt="211 Logo">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">2-1-1 is a free confidential community service and your one-stop
                                    connection to the local services you need, from utility assistance, food, housing,
                                    health, child care, after school programs, elder care, crisis intervention and much
                                    more.
                                </p>
                                <a href="https://www.211.org" target="_blank"
                                   class="btn btn-primary stretched-link pull-right mb-2">Visit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- 211.ORG End-->

            <!-- Kent United Methodist Church -->
            <div class="row text-left">
                <div class="card mb-5 col-md-8 mx-auto">
                    <h3 class="card-header text-center">Kent United Methodist Church</h3>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="images/KentUMC-logo.png" class="card-img" alt="Kent Methodist Logo">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">Kent United Methodist Church joyfully embraces God's acceptance and
                                    love of all people. We affirm that all individuals are persons of sacred worth.
                                </p>
                                <a href="http://kentmethodist.com/assistance" target="_blank"
                                   class="btn btn-primary stretched-link pull-right mb-2">Visit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Kent United Methodist Church End-->

            <!-- DSHS -->
            <div class="row text-left">
                <div class="card mb-5 col-md-8 mx-auto">
                    <h3 class="card-header text-center">Washington State Department of Social and Health Services</h3>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="images/dshs.png" class="card-img" alt="DSHS Logo">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">As a Department we are tied together by a single mission: to
                                    transform lives. Each administration within DSHS has a refined focus on this
                                    mission.
                                </p>
                                <a href="https://www.dshs.wa.gov/" target="_blank"
                                   class="btn btn-primary stretched-link pull-right mb-2">Visit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- DSHS End -->

            <!-- St. James -->
            <div class="row text-left">
                <div class="card mb-5 col-md-8 mx-auto">
                    <h3 class="card-header text-center">St. James Episcopal Church</h3>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="images/stjameslogo.png" class="card-img" alt="St. James Logo">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text">“Every person is welcome at God’s Table”—this is what we say every
                                    Sunday morning, and we truly mean it. It guides our lives and our ministries here at
                                    St. James, Kent. Whoever you are—whatever your story, your circumstances, your
                                    hopes, and your gifts—you are truly and completely welcome with us.
                                </p>
                                <a href="https://stjameskent.org/" target="_blank"
                                   class="btn btn-primary stretched-link pull-right mb-2">Visit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- St.James End -->
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
                            <p><i class="fa fa-envelope contactFont"></i> Email:<a href="mailto: postrander@stjameskent.org">postrander@stjameskent.org</a></p>
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
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
></script>
<script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"
></script>
<script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"
></script>
</body>
</html>