<?php 

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("location: ../index.php");
    exit;
}

$title="Weekly Response";
include '../Layouts/main-user.php'; 
include '../Layouts/sidebar-user.php';
include '../Layouts/navbar-user.php';
include '../Php/db_connect.php';

?> <!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content --> 
  <!-- Layout container -->
  <div class="layout-page">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-2 col-xl-12 col-md-6">
          <div class="card p-4">
            <div class="card-header d-flex align-items-right justify-content-between">
              <div class="card-title mb-2">
                <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "Response";?> </h5>
              </div>
            </div>

            <div class="table-responsive text-nowrap">
              <table class="table table-bordered border-secondary">
                <thead class="border-bottom">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">OJT ID</th>
                    <th scope="col">TIMESTAMP</th>
                    <th scope="col">DEPARTMENT</th>
                    <th scope="col">START</th>
                    <th scope="col">END</th>
                    <th scope="col">SUMMARY</th>
                    <th scope="col">ACCOMPLISHMENTS</th>
                    <th scope="col">CHALLENGES</th>
                    <th scope="col">LEARNINGS</th>
                    <th scope="col">STATUS</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  <?php 
                  $sql = "SELECT rp.*,
                                  tr.ojt_id
                          FROM trainees tr
                          JOIN reports rp ON tr.user_id = rp.user_id
                          JOIN users us ON us.id = rp.user_id
                          WHERE us.id = {$_SESSION['user_id']}";
                  $query = mysqli_query($connect, $sql);
                  if(mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                          // Display data in table rows
                          echo "<tr>";
                          echo "<td>".$row['id']."</td>";
                          echo "<td>".$row['ojt_id']."</td>";
                          echo "<td>".$row['timestamp']."</td>";
                          echo "<td>".$row['department']."</td>";
                          echo "<td>".$row['start']."</td>";
                          echo "<td>".$row['end']."</td>";
                          echo "<td>".$row['summary']."</td>";
                          echo "<td>".$row['accomplishments']."</td>";
                          echo "<td>".$row['challenges']."</td>";
                          echo "<td>".$row['learnings']."</td>";
                          echo "<td>".$row['status']."</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='11'>No records found</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>