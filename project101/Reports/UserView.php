<?php 
session_start();
$usertype = 'Trainee';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
include '../Php/db_connect.php';
include '../Layouts/main-user.php';

?>


<div class="col-2 col-xl-12 col-md-6" >
    <div class="card  p-4">

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-m-0-p-0">
              <div class="row">

                               <!-- <h2 class="modal-title" id="modalCenterTitle">Responses</h2> -->
                               <a href="../Reports/DisplayReports.php?view_report=<?=$_SESSION['user_report_id']?>" class="d-flex justify-content-end">
                               <button
                                 type="button"
                                class="btn btn-dark d-flex"
                                 data-bs-dismiss="modal"
                                 aria-label="Close">
                                    Back
                               </button>
                               </a>

      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['reportname']."'s", " ", "Response";?> </h5>
        </div>
        </div>

<div class="card-body">
            <?php
            if (isset($_GET['view_report'])) {
                $report_id = $_GET['view_report'];
                $user_id = $_SESSION['user_report_id'];

                $sql = "SELECT rp.*,
                                us.id,
                                dp.id,
                                dp.departments,
                                tr.ojt_id
                        FROM reports rp
                        INNER JOIN departments dp ON dp.id = rp.department_id
                        INNER JOIN trainees tr ON tr.user_id=rp.user_id
                        INNER JOIN users us ON rp.user_id= us.id
                        WHERE  rp.id=? 
                        AND us.id=? ";

                $stmt = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($stmt, "ii", $report_id, $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        $timestamp = $row['timestamp'];
                        $dos = $row['dos'];
                        $doe = $row['doe'];
                        $departments = $row['departments'];
                        $summary = $row['summary'];
                        $accomplishment = $row['accomplishment'];
                        $challenges = $row['challenges'];
                        $learnings = $row['learnings'];
                            echo '<div class="container">';
                            echo "<div class='section'><strong><label for='summary'>Summary:</label></strong><p>$timestamp</p></div>";
                            echo "<div class='section'><strong><label for='summary'>Summary:</label></strong><p>$dos</p></div>";
                            echo "<div class='section'><strong><label for='summary'>Summary:</label></strong><p>$doe</p></div>";
                            echo "<div class='section'><strong><label for='summary'>Summary:</label></strong><p>$departments</p></div>";
                            echo "<div class='section'><strong><label for='summary'>Summary:</label></strong><p>$summary</p></div>";
                            echo "<div class='section'><strong><label for='accomplishments'>Accomplishments:</label></strong><p>$accomplishment</p></div>";
                            echo "<div class='section'><strong><label for='challenges'>Challenges:</label></strong><p>$challenges</p></div>";
                            echo "<div class='section'><strong><label for='learnings'>Learnings:</label></strong><p>$learnings</p></div>";
                            echo '</div>';

                        echo '</div>';
                    }
                } else {
                    echo "No data found!";
                }
            }
            ?>
        </div> <!-- End of card-body -->
    </div> <!-- End of card -->
</div>

<?php include '../Layouts/realfooter.php';?>
<?php include '../Layouts/footer.php'; ?>