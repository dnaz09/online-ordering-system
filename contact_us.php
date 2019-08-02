<?php 
      include_once 'objects/Feedbacks.php';
      include 'config/database.php';
      $database = new Database();
      $db = $database->getConnection();
?>

<?php include 'layouts/_layout_header.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header bg-dark text-white">
                        <h3>Send us a message</h3>
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="sentMessage" id="contactForm" onsubmit='return validateForm();'>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Firstname</label>
                                <input type="text" required pattern='\S(.*\S)?' class="form-control" id="id_fullname" name="firstname" required data-validation-required-message="Please enter your name.">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Lastname</label>
                                <input type="text" required pattern='\S(.*\S)?' class="form-control" id="id_fullname" name="lastname" required data-validation-required-message="Please enter your name.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <div class='input-group'>
                                <div class="input-group-prepend">
                                    <span class='input-group-text bg-dark text-white font-weight-bold'>+639</span>
                                </div>
                                <input type="text" required pattern='\S(.*\S)?' class="form-control" id="id_mobile" name="mobile" minlength="9" maxlength="9" required data-validation-required-message="Please enter your mobile number.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" required pattern='\S(.*\S)?' class="form-control" id="id_email" name="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea rows="10" cols="7" required pattern='\S(.*\S)' class="form-control" id="id_message" name="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-success btn-block" name="send" value="Send Message">
                    </div>
                    </form>
                    
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header bg-dark text-white">
                        <h3>Contact Details</h3>
                    </div>
                    <div class="card-body">
                        <h5>
                            <i class="fa fa-map-marker"></i> Lingayen, Pangasinan
                        </h5>
                        <h5 class="mt-3">
                            <i class="fa fa-phone"></i> +639XX XXX XXXX    
                        </h5>
                        <h5 class="mt-3">
                            <i class="fa fa-envelope"></i> <a href="mailto:name@example.com">name@example.com</a>
                        </h5>
                        <h5 class="mt-3">
                            <i class="fa fa-clock"></i>  Monday - Sunday: 9:00 AM to 13:00 PM
                        </h5>
                        <div class="mt-4" id="googleMap" style="width:100%;height:470px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer pt-3 pb-3 mt-5 bg-dark text-center text-white m-0">
        <p> &copy; Copyright Your Website 2018</p>
    </div>



<?php include 'layouts/_layout_footer.php'; ?>

<?php include 'send_feedbacks.php'; ?>

<script>
    var input = document.getElementById('id_mobile');
    input.onkeypress = function(evt) {
        evt = evt || window.event;
        var charCode = evt.which || evt.keyCode;
        var charStr = String.fromCharCode(charCode);
        if (/[0-9\s]/.test(charStr)) {
            return true;
        }
        else{
          return false;
        }
    };
</script>
<script>
  function validateForm() {
      var x = document.forms['sentMessage']['id_email'].value;
      var atpos = x.indexOf('@');
      var dotpos = x.lastIndexOf('.');
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
          swal('Not a valid e-mail address!');
          return false;
      }
      else {
        return true;
      }
  }
</script>
<script>
  var input = document.getElementById('id_fullname');
  input.onkeypress = function(evt) {
      evt = evt || window.event;
      var charCode = evt.which || evt.keyCode;
      var charStr = String.fromCharCode(charCode);
      if (/[A-Za-z0-9\s]/.test(charStr)) {
          return true;
      }
      else{
        return false;
      }
  };
</script>

<script>
$('#id_message').keyup(validateTextarea);

function validateTextarea() {
        var errorMsg = "Please match the format requested.";
        var textarea = this;
        var pattern = new RegExp('^' + $(textarea).attr('pattern') + '$');
        // check each line of text
        $.each($(this).val().split("\n"), function () {
            // check if the line matches the pattern
            var hasError = !this.match(pattern);
            if (typeof textarea.setCustomValidity === 'function') {
                textarea.setCustomValidity(hasError ? errorMsg : '');
            } else {
                // Not supported by the browser, fallback to manual error display...
                $(textarea).toggleClass('error', !!hasError);
                $(textarea).toggleClass('ok', !hasError);
                if (hasError) {
                    $(textarea).attr('title', errorMsg);
                } else {
                    $(textarea).removeAttr('title');
                }
            }
            return !hasError;
        });
    }
  </script>
