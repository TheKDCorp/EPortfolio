       
<!-- The Delete Modal -->
<div id="deletemodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentdelete">
    <span class="closedelete">&times;</span>
    <p>Are you Sure you want to Delete ?</p>
    <hr>
    <div>
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel</a>
        <a onclick="performdelete();" class="btn btn-danger" style="color:white;">Delete</a>
    </div>
  </div>
</div>

<!-- The Delete Modal -->
<div id="addmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentadd">
    <span class="closeadd">&times;</span>
    <p id="addmodaltext">Record Added Successfully!!!</p>
    <hr>
    <div>
        <a onclick="performcancelok();" class="btn btn-info" style="color:white;">Ok</a>
    </div>
  </div>
</div>

<!-- The Delete Modal -->
<div id="deletesuccessmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentdeletesuccess">
    <span class="closedeletesuccess">&times;</span>
    <p id="deletesuccessmodaltext">Record Deleted Successfully!!!</p>
    <hr>
    <div>
        <a onclick="performcancelok();" class="btn btn-info" style="color:white;">Ok</a>
    </div>
  </div>
</div>

<!-- The Delete Modal -->
<div id="blankmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentblank">
    <span class="closeblank">&times;</span>
    <p id="blankmodaltext">Blank Record Cannot Be Added!!!</p>
    <hr>
    <div>
        <a onclick="performcancelok();" class="btn btn-danger" style="color:white;">Cancel</a>
    </div>
  </div>
</div>

<!-- The Edit Modal -->
<div id="editmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentedit">
    <span class="closeedit">&times;</span>
    <p>Update Class Name...</p>
    <hr>
    <input type="text" class="form-control" value="" id="updateclassbox">
    <br>
    <div>
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel</a>
        <a onclick="performupdate();" class="btn btn-primary" style="color:white;">Update</a>
    </div>
  </div>
</div>

<!-- The Delete Modal -->
<div id="editsuccessmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contenteditsuccess">
    <span class="closeeditsuccess">&times;</span>
    <p>Record Updated Successfully!!!</p>
    <hr>
    <div>
        <a onclick="performcancelok();" class="btn btn-info" style="color:white;">Ok</a>
    </div>
  </div>
</div>

        </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2018  &copy; Copyright <a class="text-bold-800 grey darken-2" href="#">Made by Jatin Gangwani.</a></span>
            <!-- <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
                <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/" target="_blank"> More themes</a></li>
                <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/support" target="_blank"> Support</a></li>
                <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/products/chameleon-admin-modern-bootstrap-webapp-dashboard-html-template-ui-kit/" target="_blank"> Purchase</a></li>
            </ul> -->
        </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="../assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="../assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="../assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->