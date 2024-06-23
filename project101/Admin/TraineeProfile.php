<?php 
session_start();
$usertype = 'Admin';
include '../Php/authenticate.php';
checkLoggedIn();
// checkUserType();
$title=$_SESSION['firstname']." ". "Profile";
include '../Layouts/main-admin.php'; 
 include '../Php/db_connect.php';
  ?>

<?php 

if (isset($_GET['trainee_profile'])){
    $trainee_profile_id = $_GET['trainee_profile'];
    $res = mysqli_query($connect, "SELECT us.*,
                                  tr.qoute,
                                  tr.author,
                                  tr.ojt_id,
                                  tr.university,
                                  tr.dos,
                                  tr.degree,
                                  tr.contact_num,
                                  tr.hours_to_render
                                FROM users us, trainees tr
                                WHERE us.id=tr.user_id
                                AND us.id='$trainee_profile_id';
                              ");

   if($row=mysqli_fetch_assoc($res)) {
      $ojtid=$row['ojt_id'];
      $qoute=$row['qoute'];
      $author=$row['author'];
      $university=$row['university'];
      $dos=$row['dos'];
      $degree=$row['degree'];
      $contact_num=$row['contact_num'];
      $hours_to_render=$row['hours_to_render'];
      $user_id=$row['id'];
      $firstname=$row['first_name'];
      $middlename=$row['middle_name'];
      $lastname=$row['last_name'];
      $email=$row['email'];
      $dob=$row['dob'];
      $sex=$row['sex'];
      $profile=$row['profile'];
      date_default_timezone_set('Asia/Manila');// local timezone
      $dateOfBirth =   date($row['dob']);
      $dateOfStart =   date($row['dos']);
      $start = new DateTime($dateOfStart);
      // Calculate age
      $today = new DateTime();
      $birthdate = new DateTime($dateOfBirth);
   
      $age = $birthdate->diff($today)->y;

       $formatted_date=$birthdate->format('F j, Y'); 
       $formatted_date2=$start->format('F j, Y');
   }
  } 
?>
  <div class="row" >
    <div class="card h-70 p-4">  
<div class="row">

                            <a href="../Admin/Trainees.php" class="d-flex justify-content-end">
                               <button
                                 type="button"
                                class="btn btn-dark d-flex"
                                 data-bs-dismiss="modal"
                                 aria-label="Close">
                                    Back
                               </button>
                               </a>


  <div class="col-sm-6">
    <div class="card">
      <div class="card-body d-flex justify-content-center">
      <img class="card-img-top" style= "width: 350px; height: 430px;" src="../assets/img/avatars/<?= $profile?>" alt="Card image cap" />
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
             <h4><?=  $qoute ?></h4>
           </blockquote>
           <figcaption class="blockquote-footer mb-0 text-muted">
            <cite title="Source Title"><?=  $author; ?></cite>
           </figcaption>
         </figure>
      </div>
    </div>
  </div>
</div>                               
 <div class="table-responsive ">
 <h5 class="card-header"><?= $firstname.' '. $middlename .' '. $lastname .' '. 'Information'?></h5>
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
           <p class="mb-1 text-start"><?=$ojtid; ?></p>
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
         <div class="user-progress mt-lg-4" >
           <p class="mb-1 text-start"><?= $firstname; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateFname"></i>
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
           <p class="mb-1 text-start"><?= $middlename; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateMname"></i>
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
           <p class="mb-1 text-start"><?=$lastname; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateLname"></i>
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
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateBirthday"></i>

       </th>
     </tr> <tr>
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
           <p class="mb-1 text-start"><?= $sex; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateSex"></i>
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
           <p class="mb-1 text-start"><?= $contact_num; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateContact"></i>
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
           <p class="mb-1 text-start "><?= $degree; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateDegree"></i>
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
           <p class="mb-1 text-start"><?= $university; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateUniversity"></i> 
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
           <p class="mb-1 text-start"><?= $hours_to_render; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateHtr"></i>
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
           <p class="mb-1 text-start"><?= $email; ?></p>
         </div>
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateEmail"></i>
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
         <i class='fa fa-edit align-items-center' style = " font-size: 20px;"  data-bs-toggle="modal" data-bs-target="#updateDos"></i>
       </th>
     </tr>
   </tbody>
 </table>
     </div>

      </div>
    </div>
  </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="updateFname" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Firstname</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../Php/php-profile-update.php" method = "POST">
          <label for="fname "></label>
          <input type="text" name="Firstname" class="form-control" id="fname" value="<?=  $firstname; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
        
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateFirstname" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="updateMname" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Middlename</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">

          <label for="fname "></label>
          <input type="text" name="Middlename" class="form-control" id="fname" value="<?=  $middlename; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateMiddlename" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="updateLname" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Lastname</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php"  method = "POST">

          <label for="fname "></label>
          <input type="text" name="Lastname" class="form-control" id="fname" value="<?=  $lastname; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateLastname" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

   <!-- Modal -->
<div class="modal fade" id="updateBirthday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Date of Birth</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">

          <label for="fname "></label>
          <input type="date" name="updatedob" class="form-control" id="dob" value="<?php echo date('Y-m-d',strtotime($dob) )?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
          <input type="text" value="<?= $_SESSION['usertype'];  ?>" name="user_type"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateBirthday" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

   <!-- Modal -->
<div class="modal fade" id="updateSex" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Sex</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">

          <label for="sex "></label>
          <select name="Sex" id="sex" class="form-control" >
            <option value="Male" <?php if($sex === 'Male'){ echo 'selected';} ?> >Male</option>
            <option value="Female" <?php if($sex === 'Female'){echo 'selected';} ?> >Female</option>
          </select>
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateSex" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

    <!-- Modal -->
<div class="modal fade" id="updateContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Contact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">

          <label for="fname "></label>
          <input type="number" name="Contact" class="form-control" id="fname" value="<?=  $contact_num; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateContact" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="updateDegree" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">
          <label for="fname "></label>
          <input type="text" name="Degree" class="form-control" id="fname" value="<?=  $degree; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateDegree" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

   <!-- Modal -->
<div class="modal fade" id="updateUniversity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update University</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">

          <label for="fname "></label>
          <input type="text" name="University" class="form-control" id="fname" value="<?=  $university; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateUniversity" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

    <!-- Modal -->
<div class="modal fade" id="updateHtr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Hours to render</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">

          <label for="fname "></label>
          <input type="text" name="Hours" class="form-control" id="fname" value="<?=  $hours_to_render; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateHours" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

   <!-- Modal -->
<div class="modal fade" id="updateEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Email</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../Php/php-profile-update.php" method = "POST">

          <label for="fname "></label>
          <input type="email" name="Email" class="form-control" id="fname" value="<?=  $email; ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateEmail" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="updateDos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Date of start </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../Php/php-profile-update.php" method = "POST">
          <label for="fname "></label>
          <input type="date" name="dateStart" class="form-control" id="fname" value="<?= date('Y-m-d',strtotime($dos) ) ?>" required />
          <input type="text" value="<?= $trainee_profile_id;  ?>" name="user_id"  hidden />
        </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updateDos" >Update</button>
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
                <input type="text" value = "<?=$trainee_profile_id?>" name = "user_id" hidden/>
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
  <?php include '../Layouts/realfooter.php'; ?>
 <?php
include '../Layouts/footer.php'; 
 ?>
