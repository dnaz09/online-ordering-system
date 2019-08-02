<div class='modal fade' id='orderForm<?php echo $id; ?>'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header bg-dark text-white'>
                <h5 class="modal-title">*Please enter your details below</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name='menu_form<?php echo $id; ?>' role='form' method='POST' onsubmit='return validateForm<?php echo $id;?>()'>
                <div class='modal-body'>
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-sm-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold">Product*</span>
                            </div>
                            <input type='text' name='title' id='id_title' class='form-control font-weight-bold' value='<?php echo $title; ?>' readonly>
                        </div>
                        <div class="col-sm-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold">Price*</span>
                            </div>
                            <input type='text' name='price' id='id_price<?php echo $id ;?>' class='form-control font-weight-bold' value='<?php echo $price; ?>' readonly>
                        </div>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold">Total*</span>
                            </div>
                            <input type='text' name='total' id='id_total<?php echo $id; ?>' class='form-control font-weight-bold' value='0' readonly>
                        </div>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold">Quantity*</span>
                            </div>
                            <input type='text' name='quantity' id='id_quantity<?php echo $id; ?>' class='form-control calculate' minlength='1' maxlength='2' required>
                        </div>
                        <div class="col-sm-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold"><i class='fa fa-user'></i></span>
                            </div>
                            <input type='text' required patrmsiltern='\S(.*\S)?' minlength='3' maxlength='30' name='firstname' id='id_firstname<?php echo $id; ?>' class='form-control' placeholder='Enter Firstname' required>
                        </div>  
                        <div class="col-sm-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold"><i class='fa fa-user'></i></span>
                            </div>
                            <input type='text' required pattern='\S(.*\S)?' minlength='3' maxlength='30' name='lastname' id='id_lastname<?php echo $id; ?>' class='form-control' placeholder='Enter Lastname' required>
                        </div>  
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold"><i class='fa fa-at'></i></span>
                            </div>
                            <input type='text' name='email' id='id_email<?php echo $id; ?>' class='form-control' placeholder='Enter Email Address' required>
                        </div> 
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white font-weight-bold">+639</span>
                            </div>
                            <input type='text' required pattern='\S(.*\S)?' minlength='9' maxlength='9' name='contact' id='id_contact<?php echo $id; ?>' class='form-control' placeholder='Enter Contact Number' required>
                            <div class="input-group-append">
                                <span class='input-group-text bg-dark text-white font-weight-bold'><i class='fa fa-mobile'></i></span>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='submit' name='send' class='btn btn-success'>
                        <i class='fa fa-check'></i> Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type='text/javascript'>
  function validateForm<?php echo $id; ?>() {
      var x = document.forms['menu_form<?php echo $id; ?>']['id_email<?php echo $id; ?>'].value;
      var atpos = x.indexOf('@');
      var dotpos = x.lastIndexOf('.');
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
          swal('Not a valid e-mail address!');
          return false;
      }
      else{
        return true;
      }
  }
</script>



<script>
    var input = document.getElementById('id_contact<?php echo $id; ?>');
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
  var input = document.getElementById('id_firstname<?php echo $id; ?>');
  input.onkeypress = function(evt) {
      evt = evt || window.event;
      var charCode = evt.which || evt.keyCode;
      var charStr = String.fromCharCode(charCode);
      if (/[A-Za-z]/.test(charStr)) {
          return true;
      }
      else{
        return false;
      }
  };
</script>

<script>
  var input = document.getElementById('id_lastname<?php echo $id; ?>');
  input.onkeypress = function(evt) {
      evt = evt || window.event;
      var charCode = evt.which || evt.keyCode;
      var charStr = String.fromCharCode(charCode);
      if (/[A-Za-z]/.test(charStr)) {
          return true;
      }
      else{
        return false;
      }
  };
</script>



<script type='text/javascript'>
$(document).ready(function () {
    //Calculate both inputs value on the fly
    $('.calculate').keyup(function () {
        var price = parseFloat($('#id_price<?php echo $id; ?>').val().replace(/[^\d\.\-]/g, ''));
        var quantity = parseFloat($('#id_quantity<?php echo $id;?>').val());
        var total = price * quantity; 
        var num = parseFloat(total).toFixed(2).split(".");
        var final = num[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (num[1] ? "." + num[1] : "");
        $('#id_total<?php echo $id; ?>').val(final);
    });

    //Clear both inputs first time when user focus on each inputs and clear value 00
    $('.calculate').focus(function (event) {
        $(this).val('').unbind(event);
    });
});
</script>


                  