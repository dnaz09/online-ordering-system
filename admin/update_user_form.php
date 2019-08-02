<div class="modal fade" id="editModal<?php echo $id?>" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
          <h4 class="modal-title">Update Users</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="row">
            <div class="col-sm-6 input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
              </div>
              <input type="text" name="user_id" class="form-control" value="<?php echo $user_id; ?>" readonly>
            </div>
            <div class="col-sm-6 input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-info"></i></span>
              </div>
              <input type="text" name="userlevel" id="userlevel" class="form-control" value="<?php echo $userlevel;?>" readonly>
            </div>
            <div class="col-sm-12 input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" name="firstname" id="id_firstname" required pattern='\S(.*\S)?' class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
            </div>
            <div class="col-sm-12 input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" name="lastname" id="id_lastname" required pattern='\S(.*\S)?' class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
            </div>
          </div>   
        </div>   
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="update_users"><i class="fa fa-check"></i> Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Javascripts   -->
<script>
  var input = document.getElementById('id_firstname');
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
  var input = document.getElementById('id_lastname');
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