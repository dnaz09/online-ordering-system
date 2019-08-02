<?php 

  if(isset($_POST['save_post'])) {
      $menus = new Menus($db);
      $menus->id = $_POST['id'];
      $menus->title = $_POST['title'];
      $menus->content = $_POST['content'];
      $menus->price = $_POST['price'];
      $target_dir = "../uploads/";
      $target_file =  $target_dir . basename($_FILES["file"]["name"]);
      $uploadOk = 1;
      move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $menus->image = $target_file;
      $menus->posted_by = $firstname." ".$lastname;

      if($menus->create()) {
        echo "  
          <script type='text/javascript'>
            Swal.fire({ 
              title: 'Successfully Added!',
              type: 'success', 
              }).then(function() {
                  window.location.href = 'upload_menu.php';
              });   
          </script>
        ";
      }
  }

?>