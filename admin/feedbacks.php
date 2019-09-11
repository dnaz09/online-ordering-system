<?php
  include '../config/database.php';
  include '../objects/Feedbacks.php';
  // core configuration
  include_once "../config/core.php";
  // check if logged in as admin
  include_once "login_checker.php";
  $database = new Database();
  $db = $database->getConnection();
  date_default_timezone_set('Asia/Manila');
  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
?>

<?php 
  $page_title = "Feedbacks";
  include_once ('../layouts/layout_header.php'); 
?>

<div id="content-wrapper">

  <div class="container-fluid">

    <?php 
      if (isset($_GET['view'])) {
        $feedbacks = new Feedbacks($db);
        $stmt = $feedbacks->readOne();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
    ?>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="feedbacks.php">Feedbacks</a>
      </li>
      <li class="breadcrumb-item active">View</li>
    </ol>

      <div class="card">
        <div class="card-header bg-secondary">
          <label>Message</label>
          
        </div>
        <div class="card-body">
          <p><?php echo $message;?></p>

          <div id="demo" class="collapse">
            <input type="text" name="subject" class="form-control" placeholder="Subject" style="border-color: black;">
            <br>
            <textarea rows="10" cols="10" style="resize: none; border-color: black;" class="form-control" placeholder="Message..."></textarea>
            <br>
            <button class="btn btn-success pull-right"><i class="fa fa-check"></i> Send</button>
          </div>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-secondary" data-toggle="collapse" data-target="#demo"><i class="fa fa-arrow-left"></i> Reply</a>
        </div>
      </div>
    <?php }}  else { ?>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-flag"></i>
        Feedbacks
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr class="text-center font-weight-bold">
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Email Address</th>
                <th>Message</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $feedbacks = new Feedbacks($db);
              $stmt = $feedbacks->read();

              if ($stmt->rowCount()) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              
              echo "
                <tr class='text-center'>
                  <td>$firstname $lastname</td>
                  <td>$mobile</td>
                  <td>$email</td>
                
              ";?>
              <td>
                <a href="feedbacks.php?view=<?php echo $id; ?>" class="btn btn-primary btn-sm">
                  <i class="fa fa-eye"></i>
                </a>
              </td>
              <td>
                  <button type="submit" class="btn btn-danger btn-sm delete-object" delete-id="<?php echo $id;?>" name="delete_feedback" id="delete_feedback"><i class="fa fa-trash"></i></button>
              </td>
              </tr>
            <?php
                }
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
          $.post('delete_feedback.php', {
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


