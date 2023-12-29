<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

//deny access to courses.php if user is not an admin
if ($_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}

$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$username = $_SESSION['username'];
$mail = $_SESSION['emailaddress'];

// Register Admin
if (isset($_POST['admin_reg_btn'])) {
  // receive all input values from the form
  $username=$_POST['admin_username'];
  $firstname=$_POST['admin_firstname'];
  $lastname=$_POST['admin_lastname'];
  $email=$_POST['admin_email'];
  $phone=$_POST['admin_phone'];
  $password=$_POST['admin_password'];
  $confirmPassword=$_POST['admin_confirm_password'];
  // form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
if (empty($username)) { array_push($errors, "Username is required"); }
if (empty($firstname)) { array_push($errors, "First Name is required"); }
if (empty($lastname)) { array_push($errors, "Last Name is required"); }
if (empty($email)) { array_push($errors, "Email is required"); }
if (empty($phone)) { array_push($errors, "Phone Number is required"); }
if (empty($password)) { array_push($errors, "Password is required"); }
if (empty($confirmPassword)) { array_push($errors, "Confirm Password is required"); }
if($password !== $confirmPassword){
  array_push($errors, "Passwords do not match.");
}
// first check the database to make sure
// a admin does not already exist with the same username
$admin_check_query = "SELECT * FROM `admin_details` WHERE admin_username='$username'  LIMIT 1";
$result = mysqli_query($db, $admin_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if admin exists
  if ($user['admin_username'] === $username) {
    array_push($errors, "Username already exists");
  }
}
// Finally, register admin if there are no errors in the form
if (count($errors) == 0) {
  $encrypted_pass = md5($password);
  $admin_register_query = "INSERT INTO `admin_details`(`admin_firstname`, `admin_lastname`, `admin_username`, `admin_email`, `admin_phone`, `admin_password`) 
  VALUES ('$firstname','$lastname','$username','$email','$phone','$encrypted_pass')";
  mysqli_query($db, $admin_register_query);


  header('location: admin.php');
  }else{
    header('location: add-admin.php');
  }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Add Admin | WKEO </title>
  <?php
include '../assets/components/header.php';
?>
  </head>

  <body>
         <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <?php
     include '../assets/components/topbar.php';
     ?>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->


      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <?php
     include '../assets/components/sidebar.php';
     ?>      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row pt-5">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Add a New Admin to WKEO System</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Add Admin
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" method="POST" action="">
                  <div class="card-body">
                    <h4 class="card-title">Personal Info</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Username</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="username"
                          name="admin_username"
                          placeholder="username"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >First Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          name="admin_firstname"
                          placeholder="Enter First Name "
                        />
                      </div>
                    </div>
                   
                     
                    
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Last Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          name="admin_lastname"
                          placeholder="Enter Last Name"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Email</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="email"
                          class="form-control"
                          id="lname"
                          name="admin_email"
                          placeholder="e.g user@wxy.com"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Phone</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="phone"
                          name="admin_phone"
                          placeholder="+254700000000"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="phone"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Password</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="password"
                          class="form-control"
                          id="email1"
                          name="admin_password"
                          placeholder="Password"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label
                        for="phone"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Confirm Password</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="password"
                          class="form-control"
                          id="email1"
                          name="admin_confirm_password"
                          placeholder="Password"
                        />
                      </div>
                    </div>
                    <div class="row">
             <div class="col-md-3"></div>
                  <div class="col-md-6">
                  <div class="border-top">
 <div class="card-body">
 <button type="submit" name="admin_reg_btn" class="btn btn-primary btn-lg">
                       Submit
                      </button>
 </div>
                    
          
                  </div>
                  </div>
                  <div class="col-md-3"></div>
             </div>
                  </div>
               

       
                </form>
              </div>
              
              <div class="col-md-2"></div>
           
              
   
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
 <?php
 include '../assets/components/footer.php';
 ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../dist/js/pages/mask/mask.init.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/libs/quill/dist/quill.min.js"></script>
    <script>
      //***********************************//
      // For select 2
      //***********************************//
      $(".select2").select2();

      /*colorpicker*/
      $(".demo").each(function () {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
          control: $(this).attr("data-control") || "hue",
          position: $(this).attr("data-position") || "bottom left",

          change: function (value, opacity) {
            if (!value) return;
            if (opacity) value += ", " + opacity;
            if (typeof console === "object") {
              console.log(value);
            }
          },
          theme: "bootstrap",
        });
      });
      /*datwpicker*/
      jQuery(".mydatepicker").datepicker();
      jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
      });
      var quill = new Quill("#editor", {
        theme: "snow",
      });
    </script>
  </body>
</html>
