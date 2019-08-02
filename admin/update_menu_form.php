<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="upload_menu.php">Uploading Menus</a>
  </li>
  <li class="breadcrumb-item">Edit</li>
</ol>
<form method="POST" id="form" enctype="multipart/form-data">
  <div class="card-group">
    <div class="card">
      <img src="<?php echo $image; ?>" class="card-img-top" alt="Image" />
    </div>
    <div class="card">
      <div class="card-body">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row">  
          <div class="col-sm-12 input-group mb-3">
            <input type="text" class="form-control" value="<?php echo $image; ?>" readonly>
            <div class="input-group-append">
              <label class="input-group-btn">
                <span class="btn btn-dark">
                  <i class="fa fa-folder-open"></i>
                  Browse&hellip; <input type="file" name="file" id="file" style="display: none;" required>
                </span>
              </label>
            </div>
          </div>
          <div class="col-sm-12 input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-heading"></i></span>
            </div>
            <input type="text" name="title" id="id_title" required pattern='\S(.*\S)?' class="form-control" value="<?php echo $title;?>" placeholder="Title" required>
          </div>
          <div class="col-sm-12 input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
            </div>
            <input type="text" name="content" id="id_content" required pattern='\S(.*\S)?' class="form-control" value="<?php echo $content;?>" placeholder="Content" required>
          </div>
          <div class="col-sm-12 input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">₱</span>
            </div>
            <input type="text" name="price" id="id_price" class="form-control" value="<?php echo $price;?>" placeholder="Price" required>
          </div>
        </div>
      </div>
      <div class="card-footer float-right">
        <button type="submit" name="update_post" class="btn btn-success float-right"><i class="fa fa-check"></i> Update</button>
      </div>
    </div>
  </div>
</form>

<!-- Javascripts   -->
<script>
  var input = document.getElementById('id_title');
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
  var input = document.getElementById('id_content');
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

