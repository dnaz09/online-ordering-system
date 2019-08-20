<?php
  include_once '../objects/Accounts.php';
  include '../config/database.php';
  $database = new Database();
  $db = $database->getConnection();
  date_default_timezone_set('Asia/Manila');
  session_start();
  $firstname=$_SESSION['firstname'];
  $lastname=$_SESSION['lastname'];
?>

<?php 
  $page_title = "User Accounts";
  include_once ('../layouts/layout_header.php'); 
?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">User Accounts</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-user"></i>
        Accounts
        <div class="float-right">
          <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus"></i> Add Users</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr class="text-center font-weight-bold">
                <th>User ID</th>
                <th>Name</th>
                <th>Userlevel</th>
                <th>Status</th>
                <th>Account</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $accounts = new Accounts($db);
              $stmt = $accounts->read();

              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              
              echo "
                <tr class='text-center'>
                  <td>$user_id</td>
                  <td>$firstname $lastname</td>
                  <td>$userlevel</td>
              ";
            ?>
                  <td>
                  <?php
                      if ($user_status == 'active') {
                        echo "<span class='badge badge-pill badge-success'>Active</span>";
                      }
                      else if ($user_status == 'inactive') {
                        echo "<span class='badge badge-pill badge-danger'>Inactive</span>";
                      }     
                  ?>
                  </td>
                  <td>
                    <form method="POST">      
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                      <?php
                        if ($user_status == 'active') {
                          echo '<button type="submit" class="btn btn-danger btn-sm" name="disable"><i class="fa fa-times"></i> Disable</button>';
                        }

                        else if ($user_status == 'inactive') {
                          echo '<button type="submit" class="btn btn-success btn-sm" name="enable"><i class="fa fa-check"></i> Enable</button>';
                        }
                      ?>
                    </form>
                  </td>
                  <td>
                    <a href="#editModal<?php echo $id; ?>" class="btn btn-secondary btn-sm" title="Edit" data-toggle="modal">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-danger btn-sm delete-object" title="Delete" delete-id="<?php echo $id; ?>">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
                <?php 
                  include 'update_user_form.php';
                ?>

                <?php
                  } 
                
                ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

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
          $.post('delete_user.php', {
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
  $number = mt_rand(100000,999999);
  $parts = str_split($number, 3);
  include 'add_user_form.php';
  include 'add_user.php';
  include 'update_user.php';

  if (isset($_POST['enable'])) {
    $user = new Accounts($db);
    $user->id = $_POST['id'];

    if($user->enable()) {
     echo "
          <script type='text/javascript'>
            Swal.fire({ 
              title: 'Account Enabled!',
              text: 'You have activated an account!',
              type: 'success' 
              }).then(function() {
                window.location.href = 'user_accounts.php';
              });    
          </script>
      ";
    }
  }

  if(isset($_POST['disable'])) {
    $user = new Accounts($db);
    $user->id = $_POST['id'];

    if($user->disable()) {
      echo "
      <script type='text/javascript'>
        Swal.fire({ 
          title: 'Account Disabled!',
          text: 'You have deactivated an account!',
          type: 'error' 
          }).then(function() {
            window.location.href = 'user_accounts.php';
          });    
      </script>
    "; 
    }
  }

  
?>

