


</div>
</div>
<div class="content-backdrop fade"></div> 
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- datatables JS -->
    <script src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.0.7/b-3.0.2/sl-2.0.2/datatables.min.js"></script>
    <script src="Editor-2.3.2/js/dataTables.editor.js"></script>
        <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../Assets/js/jquery.js"></script>
    <script src="../Assets/js/datatables.js"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>


    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<!-- toast -->
   
<?php
if(isset($_SESSION['success'])){
?>
    <div
    class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-success"
              role="alert"
              aria-live="assertive"
              aria-atomic="true">
              <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-medium">Success</div>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
               <?= $_SESSION['success'] ?>
              </div>
            </div>
<?php
    unset($_SESSION['success']);

}
?>
    <?php

    if(isset($_SESSION['error'])){


    ?>
        <div
        class="bs-toast toast fade show toast-placement-ex m-2 bottom-0 end-0 bg-danger"
                  role="alert"
                  aria-live="assertive"
                  aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-medium">Error</div>

                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                  <?= $_SESSION['error'] ?>
                  </div>
                </div>
    <?php
        unset($_SESSION['error']);


    }
    ?>
    <!-- /toast -->