<?php 
    include "../Layouts/maintemp.php";
    include "../Php/db_connect.php";
?>

<div class="container-nav">
<a href="Add.php" class="add-button"><button type="button" class=" btn btn-dark " >Add Trainee</button></a>
     <div class="ojt-table shadow p-3 mb-5 bg-body rounded">
     
           
          
        <table class=" table table-responsive">
            <thead class="table-dark">
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">OJT Id</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Sex</th>
                <th scope="col">Course</th>
                <th scope="col">University</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Status</th>
                <th scope="col">Operation</th>
                </tr>
            </thead>
              <tbody>
<?php 
     
     $sql= "SELECT * FROM trainees";
     $query =mysqli_query($connect, $sql);
    if($query) {
        $row=mysqli_fetch_assoc($query);
    }
     while ($row=mysqli_fetch_assoc($query)) {

                        $id = $row ['id'];
                       $ojtid = $row ['ojt_id'];
                       $firstname = $row ['first_name'];
                       $middlename = $row ['middle_name'];
                       $lastname = $row ['last_name'];
                       $age = $row ['age'];
                       $sex = $row ['sex'];
                       $course = $row ['degree'];
                       $university = $row ['university'];
                       $hours_to_render = $row ['hours_to_render'];
                       $dos = $row ['dos'];
                       $office = $row ['office_assigned'];
                       $email = $row ['email'];
                       $user_type =  $row ['user_type'];

                            echo '
                                 <tr>
                                

                                        <td>'.$id.'</td>
                                        <td>'.$ojtid.'</td>
                                        <td>'.$firstname.'</td>
                                        <td>'.$middlename.'</td>
                                         <td>'.$lastname.'</td>
                                        <td>'.$age.'</td>
                                        <td>'.$sex.'</td>
                                        <td>'.$course.'</td>
                                        <td>'.$university.'</td>
                                        <td>'.$hours_to_render.'</td>
                                        <td>'.$dos.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$password.'</td>
                                        <td>'.$user_type.'</td>
                                        <td>
                                                 <a href=""><button>Update</button></a>  
                                                 <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Status
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <li> <a href=""><button class="dropdown-item" type="button">Action</button></a> <button class="dropdown-item" type="button">Action</button></li>
                                                        <li> <a href=""><button class="dropdown-item" type="button">Action</button></a> <button class="dropdown-item" type="button">Action</button></li>                                                        <li><button class="dropdown-item" type="button">Something else here</button></li>
                                                    </ul>
                                                    </div>
                                        </td>
                                                                
                                 </tr>
                            ';
                      
     }
     ?>
            </tbody>
        </table>
     </div>