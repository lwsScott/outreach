<?php
// Start session
session_start();

// Initialize variables
$err = false;
$username = "";

// Load credentials
require ('/home/stjamesk/dotcom/creds/creds.php');

//If the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //echo "Form has been submitted";

    //Get the username and password
    $username = strtolower(trim($_POST['username']));
    $password = trim($_POST['password']);

    // Check entered credentials and redirect
    if ($username == $adminUser && $password == $adminPassword) {
        $_SESSION['loggedin'] = true;
        //Redirect to page the user was on
        if (!isset($_SESSION['page'])) {
            $_SESSION['page'] = 'control.php';
        }
        header("location: " . $_SESSION['page']);
    }

    //Set an error flag
    $err = true;
}
// Include header file
include('includes/head.html');

?>
<!--
Ben Chadwick
Jessica Sestak
Husrav Homidov

Team Dotcom
12/8/20
This is the login page for st. James Outreach
-->
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
</nav><!-- NAVBAR END -->

<div class="pageStyle container mb-5 bg-white rounded">
    <div class="container shadow-lg p-3 mb-5 bg-white rounded">
        <!-- Form -->
        <form class="needs-validation col-md-4 mx-auto" novalidate action="#" method="POST">
            <div class="form">

                <h3>Login</h3>
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required <?php echo "value='$username'" ?>>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Error message if wrong credentials -->
                <?php
                if ($err){
                    echo '<div class="alert alert-danger" role="alert">
                                  <strong>Wrong username or password</strong>
                                </div>';
                }
                ?>
                <hr class="my-4 rgba-white-light">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </form><!-- Form End-->
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