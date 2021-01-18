<?php
// Start session
session_start();

// Checks to see if logged in. If not - redirects to index.php
if (!isset($_SESSION['loggedin'])) {
    // Store the page that I am currently on in the session
    $_SESSION['page'] = $_SERVER['SCRIPT_URI'];
    header("location: login.php");
}
// Include header file
include("includes/head.html");
require("/home/stjamesk/dotcom/creds/creds.php");
?>
<!--
Ben Chadwick
Jessica Sestak
Husrav Homidov

Team Dotcom
12/8/20
This website is the control page for the Admin user
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
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-item nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- NAVBAR END -->

<!-- Page Top Section -->
<div class="w3-content pageStyle">
    <div class="w3-container w3-content w3-center w3-padding-64 band shadow-lg p-3 bg-white rounded">
        <!-- Page Top Title -->
        <div class="w3-container w3-content w3-center w3-padding-64" id="welcomeMessage">
            <h1>Control Page</h1>
        </div>
    </div>
</div>

<!--Table-->
<div class="w3-content pageStyle mt-5">
    <div class="band shadow-lg p-3 mb-5 bg-white rounded table-responsive">
        <table class="table display table-hover" id="user-table">
            <!-- Table columns -->
            <thead class="thead-light">
            <tr>
                <th scope="col"></th>
                <th scope="col">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Zip</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Help List</th>
                <th scope="col">Comments</th>
                <th scope="col">Notes</th>
                <th scope="col">Attachments</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody id="tableData">
            <?php
            // Select column data from the database table
            $sql = "SELECT `completed`, `id`, `date`, `FirstName`, `LastName`, `Phone`, `Email`, 
                                `Address`, `AddressTwo`, `City`, `Zip`, `HelpList`, `Comments`, `Note`, `Attachments`
                                from outreach_form ORDER BY Date DESC";
            $result = $conn->query($sql);

            // Database content must contain at least one row
            if ($result->num_rows > 0) {
                // Print data while this condition is true
                while ($row = $result->fetch_assoc()) {
                    $recordId = $row["id"];
                    // If attachment is not empty, create a file path string
                    $clickText = "";
                    if (!($row['Attachments'] == 'uploads/')) {
                        $clickText = "<img class='img img-fluid' src='images/paperclip.png' style='max-width: 40px; height: auto;'>";
                    }
                    // Iterate through all the table row data
                    echo "<tr class='tableRow' id='row$recordId'><td>" .
                        "<input class='completed' type='checkbox' id='complete$recordId'>"
                        . "</td><td>" . date("M d, Y g:i a",
                            strtotime($row['date'] . "- 3 hours"))
                        . "</td><td>" . $row["FirstName"] . " " . $row["LastName"]
                        . "</td><td>" . $row["Zip"]
                        . "</td><td>" . $row["Email"]
                        . "</td><td>" . $row["Phone"]
                        . "</td><td>" . $row["HelpList"]
                        . "</td><td>" . $row["Comments"]
                        . "</td><td class='notes' id='note$recordId' contenteditable='true'>" . $row['Note']
                        . "</td><td class='text-center'><a href=" . $row['Attachments'] . " target='_blank'>$clickText</a>"
                        . "</td><td><a href='includes/delete.php?recordId=$recordId' class='btn btn-sm text-white mt-2'>Delete</a> 
                           </td></tr>";
                }
            } else {
                echo "0 Result";
            }
            ?>
            </tbody>
        </table>

        <!-- Form Status -->
        <div class="row text-left mt-2">
            <div class="card mb-2 col-md-12 mx-auto">
                <h3 class="card-header text-center">Form Status</h3>
                <div class="card-body mx-auto row">
                    <div id="displayToggle" class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label id="onLabel" class="btn btn-dark">
                            <input type="radio" name="options" id="on" value="0"> On
                        </label>
                        <label id="offLabel" class="btn btn-dark">
                            <input type="radio" name="options" id="off" value="1"> Off
                        </label>
                        <label id="scheduleLabel" class="btn btn-dark">
                            <input type="radio" name="options" id="schedule" value="2"> Schedule
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Status End-->
    </div>
</div>
<!--Table End -->

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
<!-- jQuery Data Table -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="scripts/control.js"></script>
</body>
</html>