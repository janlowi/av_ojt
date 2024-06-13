<?php 
session_start();
$usertype = 'Trainee';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title=$_SESSION['firstname']." ". "Profile";

include '../Layouts/main-user.php'; 
 include '../Php/db_connect.php';
  ?>
      <?php
if(isset(  $_SESSION['success'])){
 ?>
     <div
     class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-success"
           role="alert"
           aria-live="assertive"
           aria-atomic="true">
           <div class="toast-header">
             <i class="bx bx-bell me-2"></i>
             <div class="me-auto fw-medium">Success</div>
             <small></small>
             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
           <div class="toast-body">
           <?= $_SESSION['success'] ?>
           </div>
         </div>
 <?php
     unset($_SESSION['success']);
 }
 ?>
     <?php
     if(isset($_SESSION['error'])){
     ?>
         <div
         class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-danger"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">
             <div class="toast-header">
               <i class="bx bx-bell me-2"></i>
               <div class="me-auto fw-medium">Error</div>
               <small></small>
               <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
             </div>
             <div class="toast-body">
             <?= $_SESSION['error'] ?>
             </div>
           </div>
     <?php
         unset($_SESSION['error']);
     }
     ?>
         <!-- profile pic -->
  <?php
      $user_id=$_SESSION['user_id'];
      $res = mysqli_query($connect, "SELECT us.*,
                                            tr.*

                      FROM users us
                      INNER JOIN trainees tr ON tr.user_id = us.id
                      WHERE us.id='$user_id'
                      
                  ");
      while($row = mysqli_fetch_assoc($res)) {
        $_SESSION['profile']=$row['profile'];
        $_SESSION['qoute']=$row['qoute'];
        $_SESSION['author']=$row['author'];
        date_default_timezone_set('Asia/Manila');// local timezone
        $contact_num = $row ['contact_num'];
        $dateOfBirth =   date($row['dob']);
        $dateOfStart =   date($row['dos']);
        $start = new DateTime($dateOfStart);
        // Calculate age
        $today = new DateTime();
        $birthdate = new DateTime($dateOfBirth);
     
        $age = $birthdate->diff($today)->y;
    
         $formatted_date=$birthdate->format('F j, Y'); 
         $formatted_date2=$start->format('F j, Y');

    ?>
                     
 <div class="row" >
    <div class="card h-70 p-4">  
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body d-flex justify-content-center">
      <img class="card-img-top" style= "width: 350px; height: 430px;" src="../assets/img/avatars/<?=$_SESSION['profile'];?>" alt="Card image cap" />
    <br>
    <div style = "position:absolute; bottom: 0px;">
    <i class='fa-solid fa-camera' style = "font-size: 25px; color: black;"  data-bs-toggle="modal" data-bs-target="#modalProfile" > </i>
    </div>
   
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="card " style = "margin-top: 130px;">
      <div class="card-body d-flex justify-content-center ">
      <h1 class="d-flex align-items-middle"><i class="fa-solid fa-quote-left fa-2xl"></i></h1>
           <figure class="p-3 mb-0">
           <blockquote class="blockquote d-flex justify-content-center"><br><br>
             <h4><?= $_SESSION['qoute']; ?></h4>
           </blockquote>
           <figcaption class="blockquote-footer mb-0 text-muted">
            <cite title="Source Title"><?=  $_SESSION['author']; ?></cite>
           </figcaption>
         </figure>
      </div>
    </div>
  </div>
</div>
  
    <!-- qoute    -->
    <div class="table-responsive ">
      <table class="table table-bordered border-secondary">
        <thead class="border-bottom">
        </thead>
        <tbody>
          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">OJT Id :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['ojt_id']; ?></p>
              </div>
            </th>
          </tr>


          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate   ">Firstname :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['first_name']; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate  ">Middlename :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['middle_name']; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Lastname :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['last_name']; ?></p>
              </div>
            </th>
          </tr>
          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Birthday :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $formatted_date; ?></p>
              </div>
              <i class='fa fa-edit align-items-center' style = "font-size: 18px;"  data-bs-toggle="modal" data-bs-target="#updateBirthday"></i>
            </th>
          </tr> 
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Age :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $age; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Sex :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['sex']; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Contact No. :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['contact_num']; ?></p>
            <i class='fa fa-edit align-items-center' style = "font-size: 18px;"  data-bs-toggle="modal" data-bs-target="#updateContacts"></i>

              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate">Course :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start "><?= $row ['degree']; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate">University :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['university']; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Hours to render :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['hours_to_render']; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Email:</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $row ['email']; ?></p>
              </div>
            </th>
          </tr>

          <tr>
            <th>
              <div class="d-flex justify-content-start align-items-right mt-lg-4">
                <div class="d-flex flex-column">
                  <p class="mb-1 text-truncate ">Date started :</p>
                </div>
              </div>
            </th>
            <th class="text-end">
              <div class="user-progress mt-lg-4">
                <p class="mb-1 text-start"><?= $formatted_date2;  ?></p>
              </div>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    </div>
  <!-- Modal edit birhtday -->
  <div class="modal fade" id="updateContacts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Contact Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="../Php/php-profile-update.php" method="POST">
        
         <label for="date "></label>
         <input type="number" class="form-control" id="inputZip"name = "Contact"  value = "<?php echo $contact_num?>" /> 
        <input type="text" value="<?= $user_id; ?>" name="user_id"  hidden />
        <input type="text" value="<?= $row ['user_type']; ?>" name="usertype" hidden />

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateContact" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Modal edit birhtday -->
<div class="modal fade" id="updateBirthday" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Birthday</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="../Php/php-profile-update.php" method="POST">

         <label for="date "></label>
 
        <input type="date" name="updatedob" class="form-control" id="date" value="<?php echo date('Y-m-d',strtotime($row['dob']) )?>" required />
        <input type="text" value="<?= $user_id ?>" name="user_id"  hidden />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateBirthday" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<!-- Modal Profile-->
<div class="modal fade" id="modalProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="modalCenterTitle">Upload Profile Picture</h2>

          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close">
          </button>
        </div>
          <div class="row">
                    <div class="col-xl">
                    <div class="card mb-4">
                    <div class="card-body">
              <form method="POST" enctype="multipart/form-data" action="../Php/php-upload.php ">
                <input type="file" name="image" class="form-control"/>
                <label for="qoute">Phrase</label>
             
                <input type="text" name="qoute" class="form-control" id= "qoute"/>
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" id="author"/>
                <br><br>
              <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
        </div>
      </div>
    </div>
   </div>
 </div>
 <?php
   }
  ?>
   
 <!-- toast -->

     <!-- /toast -->
 <?php include '../Layouts/footer.php'; ?>
