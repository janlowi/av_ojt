<?php 

include 'main-user.php';
include '../Php/db_connect.php';
include '../Php/authenticate.php';





?>

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
        </div>