

<?php

 error_reporting (0);
        $query = "SELECT * FROM trainees ORDER BY id DESC LIMIT 1";
        $result= mysqli_query($connect,$query);
        $row = mysqli_fetch_array($result);
        $last_id = $row['id'];
        if ($last_id == "")
        {
            $ojt_ID = "AVOJT0001";
        }
        else
        {
            $ojt_ID = substr($last_id, 7);
            $ojt_ID = intval($ojt_ID);
            $ojt_ID = "AVOJT00" . ($last_id + 1);
        }
    ?>
                        <!-- Button trigger modal -->
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#modalCenter">
                          Launch modal
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Create account for trainee.       </h5>
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
                                                        <form class="row g-3" method= 'Post' action="../Php/php-add.php";>
                                                                <div class="col-md-6">
                                                                        <label for="inputEmail4" class="form-label">Firstname</label>
                                                                        <input type="text" class="form-control" id="inputEmail4" name = "Firstname">
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <label for="inputMiddlename" class="form-label">Middlename</label>
                                                                        <input type="text" class="form-control" id="inputMiddlename"name = "Middlename">
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <label for="inputLastname" class="form-label">Lastname</label>
                                                                        <input type="text" class="form-control" id="inputLastname"name = "Lastname">
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <label for="inputLastname" class="form-label">OJT-ID</label>
                                                                        <input type="text" class="form-control" id="inputLastname"name = "Ojtid" value="<?= $ojt_ID; ?>" readonly>
                                                                </div>

                                                                <div class="col-md-6">
                                                                        <label for="inputZip" class="form-label">Contact no.</label>
                                                                        <input type="number" class="form-control" id="inputZip"name = "Contact">
                                                                </div>

                                                                <div class="col-md-2">
                                                                        <label for="inputZip" class="form-label">Age</label>
                                                                        <input type="number" class="form-control" id="inputZip"name = "Age">
                                                                </div>

                                                                
                                                                <div class="col-md-4">    
                                                                        <label for="sex" class="form-label">Sex</label>
                                                                        <select name="Sex" id="sex" class="form-select">
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                        </select>
                                                                </div>
                                                                <div class="col-md-6">    
                                                                        <label for="usertype" class="form-label">Usertype</label>
                                                                        <select name="Usertype" id="usertype" class="form-select">
                                                                                <option value="Admin">Admin</option>
                                                                                <option value="Trainee">Trainee</option>
                                                                        </select>
                                                                </div>

                                                                <div class="col-12">
                                                                        <label for="inputCourse" class="form-label">Course/Degree</label>
                                                                        <input type="text" class="form-control" id="inputCourse" name = "Course">
                                                                </div>
                                                                <div class="col-12">
                                                                        <label for="inputAddress2" class="form-label">University</label>
                                                                        <input type="text" class="form-control" id="inputAddress2"name = "University">
                                                                </div>
                                                                <div class="col-md-4">
                                                                        <label for="inputCity" class="form-label">Hours to render</label>
                                                                        <input type="number" class="form-control" id="inputCity"name = "Hours">
                                                                </div>
                                                                <div class="col-md-4">
                                                                        <label for="inputCity" class="form-label">Date started</label>
                                                                        <input type="date" class="form-control" id="inputCity"name = "Dos">
                                                                </div>
                                                                <div class="col-md-4">
                                                                        <label for="Office" class="form-label">Office Assigned</label>
                                                                        <select name="Office" id="office" class="form-select">
                                                                                <option value="Tayud">Tayud Office</option>
                                                                                <option value="Makati">Makati Office</option>
                                                                                <option value="NRA">NRA</option>
                                                                        </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                        <label for="inputZip" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="inputZip"name = "Email">
                                                                </div>
                                                                <div class="col-md-12">
                                                                        <label for="inputZip" class="form-label">Password</label>
                                                                        <input type="password" class="form-control" id="inputZip"name = "Password">
                                                                </div>  
                                                                <div class="col-md-12">
                                                                        <label for="inputZip" class="form-label">Confirm Password</label>
                                                                        <input type="password" class="form-control" id="inputZip"name = "Confirm">
                                                                </div>
                                                                <!-- <div class="col-md-12">
                                                                        <label for="inputGroupFile04" class="form-label"> Profile</label>
                                                                        <input type="file" class="form-control" id="inputGroupFile04"  aria-label="Upload" name='Profile'>
                                                                </div> -->
                                                                <div class=" d-grid gap-2 col-6 mx-auto">
                                                                        <button id="register-btn" type="submit" name = "submit"class="btn btn-dark">Register</button>
                                                                </div>
                                                </form>
                                             </div>
                                        </div>
                                     </div>
                                </div>  

                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

