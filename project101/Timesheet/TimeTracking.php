<?php 
include '../Layouts/main-user1.php'; 
 include '../Php/db_connect.php';


?>
                       
                                                        <canvas id="myChart"></canvas>
                                                        <?php
                                                        $user_id = $_SESSION['user_id'];        
                                                        $sql_time = "SELECT SUM(total_hours) AS total_hours, tr.hours_to_render
                                                                    FROM timesheet ts
                                                                    INNER JOIN trainees tr ON tr.user_id = ts.user_id
                                                                    WHERE ts.user_id = '$user_id'";
                                                        
                                                        $result_time = mysqli_query($connect, $sql_time);
                                                  
                                                        
                                                        if ($result_time && mysqli_num_rows($result_time) > 0) {
                                                            // Fetch the result row
                                                            $row_time = mysqli_fetch_assoc($result_time);
                                                            
                                                     
                                                            $total_hours = $row_time['total_hours'];
                                                            $hours_to_render = $row_time['hours_to_render'];
                                                            $totalHours = intval($total_hours);
                                                              $hoursToRender = intval($hours_to_render);

                                                       
                                                          
                                                        }
                                                    ?>            

                                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                                    <script>

                                                        const totalHours = <?php echo json_encode($totalHours); ?>;
                                                        const hoursToRender = <?php echo json_encode($hoursToRender); ?>;
// console.log(totalHours, hoursToRender);
                                                        // Calculate the remaining progress
                                                        const remainingProgress = totalHours - hoursToRender;
console.log(remainingProgress); 
                                                        // Calculate the completed progress percentage
                                                        const completedProgressPercentage = (hoursToRender / totalHours)    *100;
console.log(completedProgressPercentage);
                                                        // Create the doughnut chart data
                                                        const chartData = {
                                                            labels: ['Hours Rendered', 'Hours to be Rendered'],
                                                            datasets: [{
                                                                label: 'Progress',
                                                                data: [completedProgressPercentage, 100 - completedProgressPercentage],
                                                                backgroundColor: [
                                                                    'rgba(75, 192, 192, 0.2)', // Completed Progress color
                                                                    'rgba(255, 99, 132, 0.2)', // Remaining Progress color
                                                                ],
                                                                borderColor: [
                                                                    'rgba(75, 192, 192, 1)',
                                                                    'rgba(255, 99, 132, 1)',
                                                                ],
                                                                borderWidth: 1
                                                            }]
                                                        };

                                                        const myChart = new Chart('myChart', {
                                                            type: 'doughnut',
                                                            data: chartData,
                                                            options: {
                                                                cutout: '80%', // Adjust the size of the hole in the middle
                                                                animation: true, // Disable animation for a progress bar effect
                                                                plugins: {
                                                                    legend: {
                                                                        display: true // Hide the legend
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    </script>

                                                                

