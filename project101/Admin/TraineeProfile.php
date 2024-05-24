<?php 
session_start();
$title=$_SESSION['firstname']." ". "Profile";
include '../Php/authenticate.php';
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
  <div class="col-2 col-xl-12 col-md-6" >
    <div class="card h-70 p-4">  

                                              <a href="../Admin/Trainees.php" class="d-flex justify-content-end">
                                                  <button class="btn btn-dark">
                                                    Back
                                                  </button>
                                              </a>
                            <div class="card-group mb-5">
                              <div class="card">
                                <img class="card-img-top" src="../assets/img/avatars/<?=$profile;?>" alt="Card image cap" />
                              
                                <div class="card-footer">
                                </div>
                              </div>
                              
                              <div class="card">
                                <!-- <img class="card-img-top" src="../assets/img/elements/5.jpg" alt="Card image cap" /> -->
                                <div class="card-body d-flex justify-content-center   align-items-center ">
                                  <h1 class="card-title"><i class="fa-solid fa-quote-left fa-2xl"></i></h1>
                                        <figure class="p-3 mb-0">
                                        <blockquote class="blockquote">
                                          <h4><?=$qoute ?></h4>
                                        </blockquote>
                                        <figcaption class="blockquote-footer mb-0 text-muted">
                                         <cite title="Source Title"><?= $author ?></cite>
                                        </figcaption>
                                      </figure>
                                  <h1 class="card-title"><i class="fa-solid fa-quote-right fa-2xl"></i></i></h>

                                </div>
                                <div class="card-footer">
                                  <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                                </div>
                              </div>
                            </div>

                              <h5 class="card-header"><?= $firstname.' '. $middlename .' '. $lastname .' '. 'Information'?></h5>
                                    
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
                                                                  <div class="user-progress mt-lg-4">
                                                                    <p class="mb-1 text-start"><?= $firstname; ?></p>

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
                                                                    <p class="mb-1 text-start"><?= $middlename; ?></p>
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
                                                                    <p class="mb-1 text-start"><?=$lastname; ?></p>
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
              </div>
              </div>
            </div>


 <?php

include '../Layouts/footer.php'; 

 ?>
