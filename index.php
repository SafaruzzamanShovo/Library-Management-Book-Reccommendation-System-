<?php
session_start();
ob_start(); // Start output buffering
?>
<!DOCTYPE html>
<html>
<head>
    <title>LMS</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>

		<!-- Font Icon -->
		<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

		<!-- Main css -->
		<link rel="stylesheet" href="css/registerStyle.css">

</head>
<style type="text/css">
    #main_content{
        padding: 50px;
        background-color: whitesmoke;
    }
    #side_bar{
        background-color: whitesmoke;
        padding: 50px;
        width: 300px;
        height: 450px;
    }
</style>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">FEC LMS</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="admin/index.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <span><marquee>This is the library management system of Faridpur Engineering College. Library opens at 9:00 AM and closes at 7:00 PM</marquee></span>
    <br><br>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4" id="side_bar">
            <h5>Library Timing</h5>
            <ul>
                <li>Opening: 8:00 AM</li>
                <li>Closing: 8:00 PM</li>
                <li>(Sunday Off)</li>
            </ul>
            <h5>What We Provide?</h5>
            <ul>
                <li>Full furniture</li>
                <li>Free Wi-Fi</li>
                <li>Newspapers</li>
                <li>Discussion Room</li>
                <li>RO Water</li>
                <li>Peaceful Environment</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-8" id="main_content">
            <section class="sign-in">
                <div class="container">
									<div class="signin-content">
												<div class="signin-image">
														<figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
														<a href="#" class="signup-image-link">Create an account</a>
												</div>
                        <div class="signin-form">
                            <h2 class="form-title">Sign In</h2>
                            <form method="post" class="register-form" id="login-form">
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="email" id="email" placeholder="Email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remember-me" id="remember-me" class="agree-term">
                                    <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="login" id="signin" class="btn btn-primary" value="Log in">
                                </div>
                            </form>
                            <div class="social-login">
                                <span class="social-label">Or login with</span>
                                <ul class="socials">
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                                </ul>
                            </div>

                            <!-- PHP Logic -->
                            <?php 
                            if (isset($_POST['login'])) {
                                $connection = mysqli_connect("localhost", "root", "");
                                $db = mysqli_select_db($connection, "lms");
                                $query = "SELECT * FROM users WHERE email = '$_POST[email]'";
                                $query_run = mysqli_query($connection, $query);
                                $user_found = false;
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    if ($row['email'] == $_POST['email']) {
                                        $user_found = true;
                                        if ($row['password'] == $_POST['password']) {
                                            $_SESSION['name'] = $row['name'];
                                            $_SESSION['email'] = $row['email'];
                                            $_SESSION['id'] = $row['id'];
                                            header("Location: user_dashboard.php");
                                        } else {
                                            echo '<br><br><center><span class="alert-danger">Wrong Password !!</span></center>';
                                        }
                                        break;
                                    }
                                }
                                if (!$user_found) {
                                    echo '<br><br><center><span class="alert-danger">No such user found !!</span></center>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
<?php
ob_end_flush(); // Flush the buffer
?>