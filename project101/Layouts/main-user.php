
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

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
 <!-- Menu -->
 <aside id="layout-menu" class=" layout-menu menu-vertical menu bg-menu-theme px-2 ">
          <div class=" bg-dark mt-2 ">
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
            <li class="menu-item active mb-3">
                  <a href="../Users/UserDashboard.php" class="menu-link ">
                    <div data-i18n="Analytics">Dashboard</div>
                  </a>
                </li>
                <li class="menu-item active mb-3">
                  <a href="../Users/UserProfile.php" class="menu-link">
                    <div data-i18n="Analytics">Profile</div>
                  </a>
                </li>
                <li class="menu-item mb-3 active">
                  <a href="../Biweekly/DisplayReports.php" class="menu-link">
                    <div data-i18n="Analytics">Weekly Reports</div>
                  </a>
                </li>

                <li class="menu-item active mb-3">
                  <a href="../Timesheet/DisplayUser.php" class="menu-link">
                    <div data-i18n="Notifications">Attendance Record</div>
                  </a>
                </li>

                <li class="menu-item active mb-3">
                  <a href="pages-account-settings-notifications.html" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                  </a>
                </li>
                <li class="menu-item active mb-3">
                  <a href="pages-account-settings-connections.html" class="menu-link">
                    <div data-i18n="Connections">Connections</div>
                  </a>
                </li>
                
              
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item active mb-3">
              <a
                href="../Functions/Settings.php"
                target="_blank"
                class="menu-link ">
                <i class='fa-solid fa-gear' style='color:#6f6e67'></i>
                <div data-i18n="Support">Settings</div>
              </a>
            </li>
            <li class="menu-item active mb-3">
              <a
                href=""
                target="_blank"
                class="menu-link ">
                <i class='fa-solid fa-gear' style='color:#6f6e67'></i>
                <div data-i18n="Support">About Us</div>
              </a>
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


                <li class="nav-item lh-7 me-5">
                  <a
                  
                    class="text-muted"
                    href="../Users/UserDashboard.php"
                    
                    ><i class="fas fa-home text-muted" style="color: dark;"></i> Home
                    </a>
                   
                </li>

                <li class="nav-item lh-1 me-3">
                  <a
                    class="text-muted"
                    href="#"

                    > <?= $_SESSION['email']; ?></a
                  >
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
                                      <span class="fw-medium d-block"><?= $_SESSION['firstname'];?></span>
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


        
