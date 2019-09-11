<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "Forgot Password";
 
// include login checker
include_once "login_checker.php";
 
// include classes
include_once "config/database.php";
include_once 'objects/Accounts.php';
include_once "libs/php/utils.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new Accounts($db);
$utils = new Utils();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
      <?php 
        if($_POST){

            // check if username and password are in the database
            $user->email=$_POST['email'];

            if($user->emailExists()){

                // update access code for user
                $access_code=$utils->getToken();

                $user->access_code=$access_code;
                if($user->updateAccessCode()){
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
                        $mail->addAddress($send_to_email);     // Add a recipient
                        // $mail->addAddress('ellen@example.com');               // Name is optional
                        // $mail->addReplyTo('info@example.com', 'Information');
                        // $mail->addCC('cc@example.com');
                        // $mail->addBCC('bcc@example.com');
                    
                        // Attachments
                        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        
                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = "Reset Password";
                        $mail->Body    = "Hi there.<br /><br />";
                        $mail->Body    .= "Please click the following link to reset your password: {$home_url}reset_password.php?access_code={$access_code}";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        
        
                        $mail->send();
                        echo "<div class='alert alert-info'>
                                Password reset link was sent to your email.
                                Click that link to reset your password.
                            </div>";
                        
                        } catch (Exception $e) {
                            echo "<div class='alert alert-danger'>ERROR: Unable to send reset link.</div>";
                        }
                }

                // message if unable to update access code
                else{ echo "<div class='alert alert-danger'>ERROR: Unable to update access code.</div>"; }

            }

            // message if email does not exist
            else { echo "<div class='alert alert-danger'>Your email cannot be found.</div>"; }
        }
      ?>
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Enter email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Enter email address</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="login.php">Login Page</a>
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
