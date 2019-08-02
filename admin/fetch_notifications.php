<?php
// include("../config/connection.php");
include("../config/database.php");
include("../objects/Notifications.php");
$database = new Database();
$db = $database->getConnection();
$order = new Notifications($db);

if(isset($_POST["view"])) {
  if($_POST["view"] != '') {
    $order->update();
    // $update_query = "UPDATE tbl_orders SET status = 1 WHERE status = 0";
    // $conn->query($update_query);
  }
  $stmt = $order->read();
  // $query = "SELECT * FROM tbl_orders ORDER BY id DESC LIMIT 5";
  // $result = $conn->query($query);
  $output = '';
  if($stmt->rowCount()) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
  // if($result->num_rows > 0) {
  //   while($row = $result->fetch_assoc()) {
    $output .= '
    <div>
      <a href="order_tracking.php" class="dropdown-item">
        <div class="dropdown-message small"><strong>'.$row["firstname"].' '.$row["lastname"].'</strong>
        ordered '.$row["title"].'.  </div>
        <span class="small text-muted">'.$row["order_date"].'</span>
      </a>
      <div class="dropdown-divider"></div>
    </div>
    ';
    }
    $output .= '<a class="dropdown-item small" href="order_tracking.php">View All Orders</a>';
  }
  else {
  $output .= 
      '<li class="dropdown-item">
        <h6 class="text-bold">No Notification Found</h6>
      </li>';
  }
 
  // $query_1 = "SELECT * FROM tbl_orders WHERE status = 0";
  // $result_1 = $conn->query($query_1);
  // $count = $result_1->num_rows;
  $stmt = $order->readOne();
  $count = $stmt->rowCount();
  $data = array(
    'notification'   => $output,
    'unseen_notification' => $count
  );
  echo json_encode($data);
}
?>
