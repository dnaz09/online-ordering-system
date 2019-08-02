<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "Register";
 
// include login checker
include_once "login_checker.php";
 
// include classes
include_once 'config/database.php';
include_once 'objects/user.php';
include_once "libs/php/utils.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Register an Account</div>
            <div class="card-body">
            <?php 
                // if form was posted
                if($_POST) {
                
                    // get database connection
                    $database = new Database();
                    $db = $database->getConnection();
                
                    // initialize objects
                    $user = new User($db);
                    $utils = new Utils();
                
                    // set user email to detect if it already exists
                    $user->email=$_POST['email'];
                
                    // check if email already exists
                    if($user->emailExists()) {
                        echo "<div class='alert alert-danger'>";
                            echo "The email you specified is already registered. Please try again or <a href='{$home_url}login'>login.</a>";
                        echo "</div>";
                    }
                
                    else {
                        // set values to object properties
                        $firstname = $_POST['firstname'];
                        $user->firstname = $firstname;
                        $lastname = $_POST['lastname'];
                        $user->lastname = $lastname;
                        $user->contact_number=$_POST['contact_number'];
                        $user->address=$_POST['address'];
                        $user->password=$_POST['password'];
                        // $user->access_level='Customer';
                        $user->access_level='Admin';
                        $user->status=0;
                        // access code for email verification
                        $access_code=$utils->getToken();
                        $user->access_code = $access_code;
                        
                        // create the user
                        if($user->create()) {
                            // send confimation email
                            $send_to_email=$_POST['email'];

                            try {
                                //Server settings
                                $mail->SMTPDebug = false;                                       // Enable verbose debug output
                                $mail->isSMTP();                                            // Set mailer to use SMTP
                                $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                $mail->Username   = 'dnaz09.dn@gmail.com';                     // SMTP username
                                $mail->Password   = 'snnp@2018';                               // SMTP password
                                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                                $mail->Port       = 587;                                    // TCP port to connect to
                            
                                //Recipients
                                $mail->setFrom('admin@orderingsystem.com', 'Ordering System');
                                $mail->addAddress($send_to_email, $firstname.' '.$lastname);     // Add a recipient
                                // $mail->addAddress('ellen@example.com');               // Name is optional
                                // $mail->addReplyTo('info@example.com', 'Information');
                                // $mail->addCC('cc@example.com');
                                // $mail->addBCC('bcc@example.com');
                            
                                // Attachments
                                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                                
                                // Content
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Verification Email';
                                $mail->Body    = "Hi {$firstname} {$lastname}.<br /><br />";
                                $mail->Body    .= "Please click the following link to verify your email and login: {$home_url}verify/?access_code={$access_code}";
                                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                                

                                $mail->send();
                                    echo "<div class='alert alert-success'>
                                            Verification link was sent to your email. Click that link to login.
                                        </div>";
                                
                                } catch (Exception $e) {
                                    echo "<div class='alert alert-danger'>
                                        User was created but unable to send verification email. Please contact admin.
                                    </div>";
                                }
                            
                            // empty posted values
                            $_POST=array();
                        
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
                        }
                    }
                }
            ?>
            <form action="register.php" method="POST" id="register">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" required="required" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES) : "";  ?>" autofocus="autofocus">
                                <label for="firstname">First name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name" required="required" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES) : "";  ?>">
                                <label for="lastname">Last name</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>">
                                <label for="inputEmail">Email address</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="contact_number" name="contact_number" id="inputContact" class="form-control" placeholder="Contact number" required="required" value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : "";  ?>">
                                <label for="inputContact">Contact number</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="address" id="inputAddress" class="form-control" placeholder="Address" required="required" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : "";  ?>">
                        <label for="inputAddress">Address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                                <label for="inputPassword">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                                <label for="confirmPassword">Confirm password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="login.php">Login Page</a>
                    <a class="d-block small" href="forgot_password.php">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
