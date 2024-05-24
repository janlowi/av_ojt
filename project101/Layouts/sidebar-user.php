       <?php
       ob_start();
  
       include 'main.php';?>
       
       
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
        <!-- / Menu -->