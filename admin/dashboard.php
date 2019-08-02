<?php
  require_once '../config/connection.php';
  include_once '../objects/Dashboards.php';
  include '../config/database.php';
  // core configuration
  include_once "../config/core.php";
  // check if logged in as admin
  include_once "login_checker.php";
  $database = new Database();
  $db = $database->getConnection();
  $count = new Dashboard($db);
  date_default_timezone_set('Asia/Manila');

  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
?>

<?php 
  $query = "SELECT title, count(total) AS Total FROM tbl_sales group by title";
  $result = $conn->query($query);
?>

<?php 
  $page_title = "Dashboard";
  include_once ('../layouts/layout_header.php'); 
?>
 
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Title', 'Sales'],
        
        <?php 
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "['".$row['title']."',".$row['Total']."],";
          }
        }
        else {
          echo "No Results";
        }
        ?>

      ]);

      var options = {
        // title: 'Events Chart',
        // is3D:true,

      };

      var chart = new google.visualization.AreaChart(document.getElementById('areachart'));

      chart.draw(data, options);
    }
  </script>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>

      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">
              <?php 
                
                $stmt = $count->readUser();
                $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // $query = "SELECT count(1) AS total FROM tbl_users where userlevel = 'admin'";
                // $stmt = $conn->query($query);
                // $stmt->num_rows;
                // $row = $stmt->fetch_assoc();
                $sum = $row['total'];
                if ($sum == 0) {
                  echo "No User Accounts";
                }

                elseif ($sum == 1) {
                  echo $sum.' '."User Account";
                }

                else {
                echo  $sum.' '."User Accounts";
                }

              ?>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="user_accounts.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">
              <?php 
                $stmt = $count->readOrder();
                $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // $query = "SELECT count(1) AS total FROM tbl_orders";
                // $stmt = $conn->query($query);
                // $stmt->num_rows;
                // $row = $stmt->fetch_assoc();
                $sum = $row['total'];
                if ($sum == 0) {
                  echo "No New Orders";
                }

                elseif ($sum == 1) {
                  echo  $sum.' '."Order";
                }

                else {
                  echo  $sum.' '."Orders";
                }

              ?>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="order_tracking.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-list"></i>
              </div>
              <div class="mr-5">
              <?php 
                $stmt = $count->readSales();
                $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // $query = "SELECT count(1) AS total FROM tbl_sales";
                // $stmt = $conn->query($query);
                // $stmt->num_rows;
                // $row = $stmt->fetch_assoc();
                $sum = $row['total'];
                if ($sum == 0) {
                  echo "No Sales Report";
                }

                else {
                echo  $sum.' '."Sales Report";
                }
              ?>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="sales_report.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-envelope"></i>
              </div>
              <div class="mr-5">
              <?php 
                $stmt = $count->readMessage();
                $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                  // $query = "SELECT count(1) AS total FROM tbl_contacts";
                  // $stmt = $conn->query($query);
                  // $stmt->num_rows;
                  // $row = $stmt->fetch_assoc();
                $sum = $row['total'];
                if ($sum == 0) {
                  echo "No New Messages";
                }

                elseif ($sum == 1) {
                  echo $sum.' '."Message";
                }

                else {
                echo  $sum.' '."Messages";
                }
              ?>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="feedbacks.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>

      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Sales Chart</div>
        <div class="card-body">
          <div id="areachart" width="100%" height="30"></div>
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

<?php include_once ('../layouts/layout_footer.php');
