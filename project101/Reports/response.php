<?php 
session_start();
$title="Weekly Response";
include '../Php/authenticate.php';
include '../Layouts/main-user.php'; 
 include '../Php/db_connect.php';

?>     
     
<div class="col-2 col-xl-12 col-md-6" >
    <div class="card  p-4">
      <div class="card-header d-flex align-items-right justify-content-between">
        <div class="card-title mb-2">
          <h5 class="m-0 me-2 text-uppercase"><?php echo $_SESSION['firstname']."'s", " ", "Response";?> </h5>
        </div>
        </div>



        <div class="table-responsive text-nowrap  pt-5">
        <table class="table table-bordered border-secondary " id="dataTable">
          <thead class="border-bottom">

                                         

                                                <?php 
$sql = "SELECT rp.*, tr.ojt_id
        FROM trainees tr, reports rp, users us
        WHERE  us.id=rp.user_id 
        -- AND us.id=tr.user_id
        AND us.id={$_SESSION['user_id']}"; 

$query = mysqli_query($connect, $sql);

if(mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) { 
?>
<tr>
    <td><?php echo $row['id']; ?></td>
   
</tr>
<?php
    }
} else {
  
}
?>
