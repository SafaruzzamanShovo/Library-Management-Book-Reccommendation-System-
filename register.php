<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");

// Check if the 'agree-term' checkbox is set
if (!isset($_POST['agree-term'])) {
    echo '<script type="text/javascript">
        alert("You must agree to the terms before registering.");
        window.history.back(); // Go back to the previous page
    </script>';
} else {
    $query = "insert into users values('', '$_POST[name]', '$_POST[email]', '$_POST[password]', '$_POST[mobile]', '$_POST[address]')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script type="text/javascript">
            alert("Registration successful...You may Login now!!");
            window.location.href = "index.php";
        </script>';
    } else {
        echo '<script type="text/javascript">
            alert("Registration failed. Please try again.");
            window.history.back(); // Go back to the previous page
        </script>';
    }
}
?>
