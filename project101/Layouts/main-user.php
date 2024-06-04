
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <title><?php echo $title; ?></title>

    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/avlogo.png" />

   <!-- Font awersome -->
   <script src="https://kit.fontawesome.com/19fed37d60.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
  
    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    
<!-- jquerr -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

<!-- data tables -->
<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.2/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/sr-1.4.1/datatables.min.css" rel="stylesheet">

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
  
    <script src="../assets/js/config.js"></script>
  </head>
<style>
      #hover a:hover {
    background-color: var( --bs-link-hover-color);
    color: var(--bs-light);
}
</style>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
 <!-- Menu -->
 <aside id="layout-menu" class=" layout-menu menu-vertical menu table-responsive bg-menu-theme px-2 ">
          <div class=" bg-dark mt-2 " style = "height: 100%;">
          <div class="app-brand demoh-25 d-inline-block d-flex justify-content-center mt-2">
            <a href="https://www.avegabros.com/" class="app-brand-link">
              <span class="app-brand-logo demo d-flex justify-content-center fixed">
               <img width= '150' height= '120' src="../assets/img/favicon/av.jpg" alt="" xlink:href="https://www.avegabros.com/" >
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2 ">Avega</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>



          <div class="menu-inner-shadow"></div>
          <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard</span></li>
      <li class="menu-item">
        <ul class="menu-inner py-2 ">
          <ul class="menu-item ">
            <li class="menu-item  mb-3 mx-3" id="hover">
                  <a href="../Users/UserDashboard.php" class="menu-link ">
                    <div data-i18n="Analytics">Dashboard</div>
                  </a>
                </li>
                <li class="menu-item  mb-3 mx-3" id="hover">
                  <a href="../Users/UserProfile.php" class="menu-link">
                    <div data-i18n="Analytics">Profile</div>
                  </a>
                </li>
                <li class="menu-item mb-3 mx-3 " id="hover">
                  <a href="../Reports/DisplayReports.php" class="menu-link">
                    <div data-i18n="Analytics">Weekly Reports</div>
                  </a>
                </li>

                <li class="menu-item  mb-3 mx-3" id="hover">
                  <a href="../Timesheet/DisplayUser.php" class="menu-link">
                    <div data-i18n="Notifications">Attendance Record</div>
                  </a>
                </li>

                <li class="menu-item  mb-3 mx-3" id="hover">
                  <a href="pages-account-settings-notifications.html" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                  </a>
                </li>
           
              
            </li>

           <!-- Misc -->
           <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            </li>
                <li class="menu-item  mb-3 mx-3"id ="hover">
          
                  <a href="pages-account-settings-notifications.html" class="menu-link ">
                  <i class='fa-solid fa-gear' style='color: var(--bs-mute)'></i>
                    <div data-i18n="Notifications">About Us</div>
                  </a>
                </li> 
            </li>
            </li>
            </ul>
          </ul>
          </div>
        </aside>

   <!-- Layout container -->
   <div class="layout-page =-2">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                   <!-- time -->
                   <li class="nav-item lh-7 me-5">
                    
                                           
                                                      
                    <div class="display-date  ">
                      <span id="day">day</span>,
                      <span id="daynum" >00</span>
                      <span id="month" >month</span>
                      <span id="year" >0000</span>
                    <span  id ="currentTime">	</span>
              
                    </div>

                    <!-- Show current time -->
                    <script src="../Assets/js/dateTime.js"> </script>
                    <!-- Show current time -->
                    </li>

                <!-- <li class="nav-item lh-7 me-5">
                  <a
                  
                    class="text-muted"
                    href="../Users/UserDashboard.php"
                    
                    ><i class="fas fa-home text-muted" style="color: dark;"></i> Home
                    </a>
                   
                </li> -->

                <li class="nav-item lh-1 me-3">
                  <a
                    class="text-muted"
                    href="#"> <?= $_SESSION['usertype']. " " .$_SESSION['firstname'] ?> </a>

                </li>

                   <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                              <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                              <div class="avatar avatar-online">
                                <img src="../assets/img/avatars/<?= $_SESSION['profile']; ?>" alt class="w-px-40 h-px-40 rounded-circle" />
                              </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                              <li>
                                <a class="dropdown-item" href="#">
                                  <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                      <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/<?= $_SESSION['profile']; ?>" alt class="w-px-40 h-px-40 rounded-circle" />
                                      </div>
                                    </div>
                                    <div class="flex-grow-1">
                                      <span class="fw-medium d-block"><?= $_SESSION['email'];?></span>
                                      <small class="text-muted"><?= $_SESSION['usertype'];?></small>
                                    </div>
                                  </div>
                                </a>
                              </li>
                              <li>
                                <div class="dropdown-divider"></div>
                              </li>
                              <li>
                                <a class="dropdown-item" href="../Users/UserProfile.php">
                                  <i class="bx bx-user me-2"></i>
                                  <span class="align-middle">My Profile</span>
                                </a>
                              </li>
                              <li>
                                <div class="dropdown-divider"></div>
                              </li>
                              <li>
                                <a class="dropdown-item" href="../Functions/SettingsUser.php">
                                <i class='fa-solid fa-gear'></i>
                                  <span class="align-middle">Change Password</span>
                                </a>
                              </li>
                              <li>
                                <div class="dropdown-divider"></div>
                              </li>
                              <li>
                                <a class="dropdown-item" href="../Php/php-logout.php">
                                  <i class="bx bx-power-off me-2"></i>
                                  <span class="align-middle">Log Out</span>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <!--/ User -->  
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->


          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
<!-- content -->








<!-- content -->


        
