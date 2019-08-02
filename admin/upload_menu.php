<?php
  include '../config/database.php';
  include '../objects/Menus.php';
  $database = new Database();
  $db = $database->getConnection();
  date_default_timezone_set('Asia/Manila');
  session_start();
    if($_SESSION['id']) {
      $id = $_SESSION['id'];
      $firstname = $_SESSION['firstname'];
      $lastname = $_SESSION['lastname'];
    }
    else {
      header("location:../login.php");
    }  
?>

<?php 
  $page_title = "Upload Menu";
  include_once ('../layouts/layout_header.php'); 
?>

<div id="content-wrapper">

  <div class="container-fluid">

    <?php 
    if (isset($_GET['edit_id'])) {
      $menus = new Menus($db);
      $stmt = $menus->readOne();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        include 'update_menu_form.php';  
      }
    ?>  
  
    <?php } else { ?>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Upload Menu</a>
      </li>
      <li class="breadcrumb-item active">Menu</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Menu
        <div class="float-right">
          <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createPost">
            <i class="fa fa-upload"></i> Upload Menu
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr class="text-center font-weight-bold">
                <th>Title</th>
                <th>Price</th>
                <th>Posted By</th>
                <th>Date & Time Posted</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $menus = new Menus($db);
              $stmt = $menus->read();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
            
              echo "
                <tr class='text-center'>
                    <td>$title</td>
                    <td>$price</td>
                    <td>$posted_by</td>
                    <td>$created_at</td>
                    <td><img src='$image' style='width:100px;height:100px'/></td>
              ";
            ?>
                    <td>
                        <a href="upload_menu.php?edit_id=<?php echo $id; ?>" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-danger btn-sm delete-object" delete-id="<?php echo $id; ?>">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                </tr>

                <?php
                  }  
                ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    <?php } ?>
  </div>
  <!-- /.container-fluid -->

  <!-- Sticky Footer -->
  <!-- <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © Your Website 2019</span>
      </div>
    </div>
  </footer> -->

</div>
<!-- /.content-wrapper -->

<?php include_once ('../layouts/layout_footer.php'); ?>

<script>
  // JavaScript for deleting product
  $(document).on('click', '.delete-object', function(){
  
      var id = $(this).attr('delete-id');
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.post('delete_menu.php', {
                id: id
            }, function(data){
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              ).then(function() {
                  location.reload();
              });    
            }).fail(function() {
                alert('Unable to delete.');
            });
        }
      });
      return false;
  });
</script>

<?php 
  include 'add_menu_form.php'; 
  include 'add_menu.php';
  include 'update_menu.php';
?>


<!-- Javascripts -->
<script type="text/javascript">
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});
</script>


<script type="text/javascript">
  $('#id_price').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40){
    event.preventDefault();
  }

  $(this).val(function(index, value) {
    return value
      .replace(/\D/g, "")
      .replace(/([0-9])([0-9]{2})$/, '$1.$2')  
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
    ;
  });
});
</script>
<!-- end of javascripts -->

