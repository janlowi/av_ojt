<?php 
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../Login/index.php");
    exit();
};
$title="User Dashboard";
include '../Layouts/main-user.php'; 
 include '../Layouts/sidebar-user.php';
 include '../Layouts/navbar-user.php';
 include '../Php/db_connect.php';

  ?>

        <!-- Content wrapper -->
         <div class="content-wrapper">
            <!-- Content --> 
          <!-- Layout container -->
          <div class="layout-page">

            <div class="container-xxl flex-grow-1 container-p-y">
                  <div class="row">



 <!-- Modal  for report-->
 
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="modalCenterTitle">Write your weekly report.</h2>

                                              <a href="../Biweekly/DisplayReports.php"><button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                              </button>
                                              </a>
                                            </div>

                                            <?php 

                                            if(isset($_GET['update_report'])){
                                               $user_id=$_SESSION['user_id'];
                                                $row_id= $_GET['update_report'];;
                                            $sql = "SELECT rp.*,
                                                            tr.ojt_id,
                                                            tr.id
                                            
                                            
                                                    FROM trainees tr, reports rp, users us

                                                    WHERE  us.id=rp.user_id
                                                     AND tr.user_id=us.id 
                                                     AND us.id='$user_id'
                                                     AND rp.id='$row_id'
                                                    
                                                    
                                                    
                
                                            "; 
                                            
                                            // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
   
                                                while ($row = mysqli_fetch_assoc($query)) { 
                                                    
                                            ?>

                                            <div class="row">
                                               <div class="col-xl">
                                               <div class="card mb-4">
                                               <div class="card-body">

                                               <form class="row g-3" id="reportForm" action="../Php/php-weekly-update.php" method="post">
                                                         
                                               <div class="col-12">
                                                          <label for="department">Assigned Department:</label><br>
                                                          <select id="department" name="department" required class="form-control">
                                                              <option value="">Select Department</option>
                                                              <option value="IT" <?php if ($row['assigned_dept'] == 'IT' ) {
                                                                                echo 'selected'; }?>>Information Technology</option>
                                                              <option value="Accounting" <?php if ($row['assigned_dept'] == 'Accounting' ) {
                                                                                echo 'selected'; }?>>Accounting</option>
                                                              <option value="Finance" <?php if ($row['assigned_dept'] == 'Finance' ) {
                                                                                echo 'selected'; }?>>Finance</option>
                                                              <option value="Admin" <?php if ($row['assigned_dept'] == 'Admin' ) {
                                                                                echo 'selected'; }?>>Admin</option>
                                                              <option value="Purchasing" <?php if ($row['assigned_dept'] == 'Purchasing' ) {
                                                                                echo 'selected'; }?>>Purchasing</option>
                                                              <option value="Warehouse" <?php if ($row['assigned_dept'] == 'Warehouse' ) {
                                                                                echo 'selected'; }?>>Warehouse</option>
                                                          </select><br>
                                               </div>
                                                          <label for="start_date">Assignment Period Start:</label>
                                                          <input type="date" id="start_date" name="start_date" required class="form-control" value="<?= $row['dos']?>">

                                                          <label for="end_date">Assignment Period End:</label>
                                                          <input type="date" id="end_date" name="end_date" required class="form-control" value="<?= $row['doe']?>">
                                                          <br>

                                                          <label for="summary">Summary or Scope of Work:</label>
                                                          <textarea id="summary" name="summary" rows="4" required class="form-control" ><?= $row['summary']?></textarea>

                                                          <label for="accomplishments">Accomplishments:</label><br>
                                                          <textarea id="accomplishments" name="accomplishments" rows="4" class="form-control" ><?= $row['accomplishment']?></textarea>

                                                          <label for="challenges">Challenges:</label>
                                                          <textarea id="challenges" name="challenges" rows="4" class="form-control"><?= $row['challenges']?></textarea>

                                                          <label for="learning">Learning:</label>
                                                          <textarea id="learning" name="learning" rows="4" class="form-control" ><?= $row['learnings']?></textarea>

                                                          <input type="text" name="report_id" value="<?= $_SESSION['id']?>" hidden >
                                                          <input type="submit" name="update_report" value="Submit" class="btn btn-dark">
                                                      </form>

                                                      </div>

                                            <?php
                                                }
                                            }
                                            }
                                            ?>

                                                      <!-- update php -->

                        <!-- right layout -->
                    </div>
                  </div>
                </div>

            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          <!-- </div> -->
        </div>
          <!-- Content wrapper -->