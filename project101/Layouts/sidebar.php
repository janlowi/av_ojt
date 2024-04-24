       <?php include 'main.php';
       ?>
       
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="https://www.avegabros.com/" class="app-brand-link">
              <span class="app-brand-logo demo">
               <img width="80" height= "55"src="../assets/img/favicon/avlogo.png" alt="" xlink:href="https://www.avegabros.com/" >
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-4">Avega</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>



          <div class="menu-inner-shadow"></div>
          <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard</span></li>
            <li class="menu-item">
          <ul class="menu-inner py-1 ">
          <ul class="menu-item ">
            <li class="menu-item mb-3">
                  <a href="../Admin/Users.php" class="menu-link ">
                    <div data-i18n="Connections">Dashboard</div>
                  </a>
                </li>
                <li class="menu-item mb-3">
                  <a href="../Biweekly/weekly.php? user_id=<?php echo $_SESSION['id'];?> " class="menu-link">
                    <div data-i18n="Analytics">Weekly Reports</div>
                  </a>
                </li>
            
                <li class="menu-item active mb-3">
                  <a href="../Admin/Trainees.php" class="menu-link">
                    <div data-i18n="Analytics">Trainees</div>
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
            <li class="menu-item">
              <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons  bx bx-support" ></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            </ul>
          </ul>
        </aside>
        <!-- / Menu -->