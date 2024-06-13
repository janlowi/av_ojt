<?php 
session_start();
$usertype = 'Trainee';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title="User Dashboard";
include '../Layouts/main-user.php'; 
 include '../Php/db_connect.php';
 
  ?>


            <div class="container-xxl flex-grow-1 container-p-y">
                  <div class="row">

 
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="modalCenterTitle">Update Report.</h2>

                                              <a href="../Reports/DisplayReports.php"><button
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
                                                    dp.departments,
                                                    dp.id AS department_id
                                            FROM reports rp
                                            INNER JOIN users us ON rp.user_id = us.id
                                            INNER JOIN trainees tr ON tr.user_id = rp.user_id
                                            INNER JOIN departments dp ON rp.department_id = dp.id
                                            WHERE tr.user_id = '$user_id'
                                            AND rp.id = '$row_id'";

                                            // Fetch data from the reports table
                                            $query = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($query) > 0) {
   
                                                while ($row = mysqli_fetch_assoc($query)) { 
                                                  $selected_department_id=$row['department_id'];
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
                                                    <?php       
                                                    $selected_department_id = $row['department_id'];
                                                    $sql = "SELECT * FROM departments";
                                                    $department_query = mysqli_query($connect, $sql);
                                                    
                                                    if ($department_query && mysqli_num_rows($department_query) > 0) {
                                                        while ($department_row = mysqli_fetch_assoc($department_query)) {
                                                            ?>
                                                            <option value="<?php echo $department_row['id']; ?>" <?php if ($selected_department_id == $department_row['id']) echo 'selected'; ?>>
                                                                <?php echo $department_row['departments']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
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
                                                          <input type="text" name="report_id" value="<?= $row_id ;?>" hidden>
                                                          <input type="submit" name="update_report" value="Submit" class="btn btn-dark">
                                                      </form>

                                                      </div>

                                            <?php
                                                }
                                            }
                                            }
                                            ?>
                    </div>
                  </div>
                </div>

  <?php include '../Layouts/footer.php'; ?>