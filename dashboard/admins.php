<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

//deny access to users.php if user is not an admin
if ($_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}
//Get Session data
$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

// Register New Admin Details
if (isset($_POST['add-user-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $username = $_POST['pf_number'];
  $title = $_POST['user_title'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $emailAddress = $_POST['mail'];
  $phoneNum= $_POST['phonenum'];
  $role_id= $_POST['user_roles'];
  $password= $_POST['user_password'];
  $confirmPassword= $_POST['user_confirm_password'];

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($title)) {
  	array_push($errors, "Title is required");
  }
  if (empty($fname)) {
  	array_push($errors, "First Name is required");
  }
  if (empty($lname)) {
  	array_push($errors, "Last Name is required");
  }
  if (empty($emailAddress)) {
  	array_push($errors, "Email is required");
  }
  if (empty($phoneNum)) {
  	array_push($errors, "Phone number is required");
  }
  if (empty($role_id)) {
  	array_push($errors, "role is required");
  }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (empty($confirmPassword)) { array_push($errors, "Please Confirm Password"); }

  if ($password != $confirmPassword) {
	array_push($errors, "The two passwords do not match");
  }

  if (count($errors) == 0) {
    $encrypted_password = md5($username).sha1($password);
  	$user_add_query = "INSERT INTO `user_details`(`pf_number`, `user_title`, `user_firstname`, `user_lastname`, `user_email`, `user_phone`, `user_password`) VALUES ('$username','$title','$fname','$lname','$emailAddress','$phoneNum','$encrypted_password ')";
  	$results = mysqli_query($db, $user_add_query);

    $user_role_query = "INSERT INTO `user_role_details`(`user_id`, `role_id`) VALUES ('$username','$role_id')";
  	$results = mysqli_query($db, $user_role_query);

  	  header('location: admins.php');
  	}else{
  		array_push($errors, "Unable to register admins");
      header('location: admins.php');
  	}
  }
}

// Update user details
if (isset($_POST['update-user-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $username = $_POST['pf_number'];
  $title = $_POST['user_title'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $emailAddress = $_POST['mail'];
  $phoneNum= $_POST['phonenum'];
  $role_id= $_POST['user_roles'];

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($title)) {
  	array_push($errors, "Title is required");
  }
  if (empty($fname)) {
  	array_push($errors, "First Name is required");
  }
  if (empty($lname)) {
  	array_push($errors, "Last Name is required");
  }
  if (empty($emailAddress)) {
  	array_push($errors, "Email is required");
  }
  if (empty($phoneNum)) {
  	array_push($errors, "Phone number is required");
  }
  if (empty($role_id)) {
  	array_push($errors, "role is required");
  }

  if (count($errors) == 0) {
  	$user_update_query = "UPDATE `user_details` SET `user_title`='$title',`user_firstname`='$fname',`user_lastname`='$lname',`user_email`='$emailAddress',`user_phone`='$phoneNum' WHERE `pf_number`='$username'";
  	$results = mysqli_query($db, $user_update_query);

    $user_role_query = "UPDATE `user_role_details` SET `role_id`='$role_id' WHERE `user_id`='$username',";
  	$results = mysqli_query($db, $user_role_query);

  	  header('location: admins.php');
  	}else{
  		array_push($errors, "Unable to push updates");
      header('location: admins.php');
  	}
  }
}

  // Delete user Details
  if (isset($_POST['delete-user-btn'])) {
    $userID = $_POST['user_id'];
    
    if (empty($userID)) {
      array_push($errors, "User ID is required");
    }
    if (count($errors) == 0) {
        $user_delete_query = "DELETE FROM `user_details` WHERE `pf_number`='$userID' ";
        $results = mysqli_query($db, $user_delete_query);

        header('location: admins.php');
      }else{
        array_push($errors, "Unable to delete user");
        header('location: admins.php');
        }
    }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Admins | EDUTIME </title>
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
     ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb pt-5">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Admin Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Admins
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">List of Administrators</h5>
                            <input type='button' value='Add an Admin' name='open-user-btn'
                                class='btn btn-primary float-end open-user-modal-btn m-2' />
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>PF Number</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
   if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `user_details` INNER JOIN user_role_details ON user_role_details.user_id =user_details.pf_number INNER JOIN role_details ON role_details.role_id = user_role_details.role_id WHERE role_name = 'Admin'";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $user_id = $row['pf_number'];
              $salutation = $row['user_title'];
              $fname = $row['user_firstname'];
              $lname = $row['user_lastname'];
              $user_email = $row['user_email'];
              $user_phone = $row['user_phone'];
              $role = $row['role_id'];
              $role_name = $row['role_name'];
              $date_created = $row['date_created'];

      echo "<tr> <td>" .$user_id.  "</td>";
      echo "<td>" .$salutation." ".$fname." ".$lname."</td>";
      echo "<td>" .$user_email."</td>";
      echo "<td>" .$user_phone."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='user_id' value='$user_id'>
      <input type='submit' data-id='$user_id' data-salutation='$salutation' data-fname='$fname' data-lname='$lname' data-mail='$user_email' data-phone='$user_phone' data-user_role='$role' value='Edit Details' name='edit-user-btn' class='btn btn-success edit-user-modal-btn m-2'>
      <input type='submit' data-id= '$user_id' value='Delete Admin'  class='btn btn-danger deleteUserBtn'>
      </form>
      </td> </tr>";
      }
      
      }else{
      echo "<td>"."No Requests Found"."</td>";
      }
      
      } else{
          echo "<td>"."No Data Found"."</td>";
      }

      ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>PF Number</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <!--Delete Lec-->
    <div class="modal" id='deleteUserModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:red">⚠ Warning!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" hidden class="form-control" id="userID" required readonly
                                    name='user_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No
                                    Cancel</button>
                                <button type="submit" name='delete-user-btn' class="btn btn-danger">Yes Delete!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Add a user-->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add an Admin</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">PF Number:</label>
                            <input type="text" name="pf_number" class="form-control" id="pf_number_id"
                                placeholder="e.g PF00012 " required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" name="user_title" class="form-control" id="user_title"
                                placeholder="e.g Dr, Mr " required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="e.g Benson "
                                required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="e.g Makau"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="email" name="mail" class="form-control" id="mail"
                                placeholder="e.g xyz@maseno.ac.ke" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Phone:</label>
                            <input type="number" name="phonenum" class="form-control" id="phonenum"
                                placeholder="e.g 0758413462" required>
                        </div>
                        <div class="form-group">
                            <label for="user_role_label_id">Select Role..</label>
                            <select class="form-control" id="user_role_id" name="user_roles">
                                <option value="">Select Role..</option>
                                <?php $sql=mysqli_query($db,"SELECT * from role_details WHERE role_name='Admin'");
                  while ($rw=mysqli_fetch_array($sql)) {
                    ?>
                                <option selected value="<?php echo htmlentities($rw['role_id']);?>">
                                    <?php echo htmlentities($rw['role_name']);?></option>
                                <?php
                  }
                  ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Password:</label>
                            <input type="password" name="user_password" class="form-control" id="user_password"
                                placeholder="Enter password" required>
                            <div id="message-length" style="color:red"></div>
                            <div id="message-uppercase" style="color:red"></div>
                            <div id="message-lowercase" style="color:red"></div>
                            <div id="message-number" style="color:red"></div>
                            <div id="message-special-char" style="color:red"></div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Confirm Password:</label>
                            <input type="password" name="user_confirm_password" class="form-control"
                                id="user_confirm_password" placeholder="Enter confirm password" required>
                            <div id="check-equal" style="color:red"></div>
                            <div id="msg-length" style="color:red"></div>
                            <div id="msg-uppercase" style="color:red"></div>
                            <div id="msg-lowercase" style="color:red"></div>
                            <div id="msg-number" style="color:red"></div>
                            <div id="msg-special-char" style="color:red"></div>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="checked" id="togglePasswordCheckBox">
                            <label class="form-check-label" for="showPass">
                                Show password
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" id="addLecBtnId"
                                name="add-user-details-btn">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--Update user details-->
    <div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel">Update Admin Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">PF Number:</label>
                            <input type="text" name="pf_number" class="form-control" id="pf_id"
                                placeholder="e.g PF00012 " readonly required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" name="user_title" class="form-control" id="usr_title"
                                placeholder="e.g Dr, Mr " required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" name="fname" class="form-control" id="first_name"
                                placeholder="e.g Benson " required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" name="lname" class="form-control" id="last_name" placeholder="e.g Makau"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="email" name="mail" class="form-control" id="usr_mail"
                                placeholder="e.g xyz@maseno.ac.ke" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Phone:</label>
                            <input type="number" name="phonenum" class="form-control" id="phone_number"
                                placeholder="e.g 0758413462" required>
                        </div>
                        <div class="form-group">
                            <label for="user_role_label_id">Select Role..</label>
                            <select class="form-control" id="usr_role_id" name="user_roles">
                                <option value="">Select Role..</option>
                                <?php $sql=mysqli_query($db,"select * from role_details");
                  while ($rw=mysqli_fetch_array($sql)) {
                    ?>
                                <option value="<?php echo htmlentities($rw['role_id']);?>">
                                    <?php echo htmlentities($rw['role_name']);?></option>
                                <?php
                  }
                  ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" id="updateUserBtnId"
                                name="update-user-details-btn">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

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
    <!-- this page js -->
    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

    //add admin details modal code
    function openAddAdminModal() {
        $("#addUserModal").modal("show");
    }

    let openAddUserModalBtn = document.querySelector(".open-user-modal-btn");
    openAddUserModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openAddAdminModal();
    });

    //Toggle Show/Hide Password
    const togglePassword = document.querySelector("#togglePasswordCheckBox");

    const password = document.querySelector("#user_password");
    const passwordConfirm = document.querySelector("#user_confirm_password");

    togglePassword.addEventListener("click", () => {
        // Toggle the type attribute using
        const type =
            password.getAttribute("type") === "password" ? "text" : "password";

        const confirm_type =
            passwordConfirm.getAttribute("type") === "password" ? "text" : "password";

        password.setAttribute("type", type);
        passwordConfirm.setAttribute("type", type);
    });

    //VALIDATE PASSWORD
    // Get the password input elements and the messages elements
    let passwordInput = document.getElementById("user_password");
    let passwordConfirmInput = document.getElementById("user_confirm_password");
    let submitBtn = document.getElementById("addLecBtnId")

    //pass divs
    var messageLength = document.getElementById("message-length");
    var messageUppercase = document.getElementById("message-uppercase");
    var messageLowercase = document.getElementById("message-lowercase");
    var messageNumber = document.getElementById("message-number");
    var messageSpecialChar = document.getElementById("message-special-char");

    //confirm pass divs
    var msgLength = document.getElementById("msg-length");
    var msgUppercase = document.getElementById("msg-uppercase");
    var msgLowercase = document.getElementById("msg-lowercase");
    var msgNumber = document.getElementById("msg-number");
    var msgSpecialChar = document.getElementById("msg-special-char");

    var checkEqual = document.getElementById("check-equal");

    // Add an input event listener to the password input element
    passwordInput.addEventListener("input", function() {
        // Get the current password value from the input field
        let password = passwordInput.value;

        // Validate the password and show validation messages for each requirement
        if (password.length < 8) {
            messageLength.textContent = "Password must be at least 8 characters long.";
            messageLength.style.color = "red";
        } else {
            messageLength.textContent = "";
        }

        if (!/[A-Z]/.test(password)) {
            messageUppercase.textContent = "Password must include an uppercase letter.";
            messageUppercase.style.color = "red";
        } else {
            messageUppercase.textContent = "";
        }

        if (!/[a-z]/.test(password)) {
            messageLowercase.textContent = "Password must include a lowercase letter.";
            messageLowercase.style.color = "red";
        } else {
            messageLowercase.textContent = "";
        }

        if (!/\d/.test(password)) {
            messageNumber.textContent = "Password must include a number.";
            messageNumber.style.color = "red";
        } else {
            messageNumber.textContent = "";
        }

        if (!/[\W_]/.test(password)) {
            messageSpecialChar.textContent =
                "Password must include a special character.";
            messageSpecialChar.style.color = "red";
        } else {
            messageSpecialChar.textContent = "";
        }

        //disable submit button untill confirm password field is filled with a value
        submitBtn.classList.add('disabled');
    });

    // Add an input event listener to the confirm password input element
    passwordConfirmInput.addEventListener("input", function() {
        // Get the current password value from the input field
        let confirmPassword = passwordConfirmInput.value;

        // Validate the password and show validation messages for each requirement
        if (confirmPassword.length < 8) {
            msgLength.textContent = "Password must be at least 8 characters long.";
            msgLength.style.color = "red";
        } else {
            msgLength.textContent = "";
        }

        if (!/[A-Z]/.test(confirmPassword)) {
            msgUppercase.textContent = "Password must include an uppercase letter.";
            msgUppercase.style.color = "red";
        } else {
            msgUppercase.textContent = "";
        }

        if (!/[a-z]/.test(confirmPassword)) {
            msgLowercase.textContent = "Password must include a lowercase letter.";
            msgLowercase.style.color = "red";
        } else {
            msgLowercase.textContent = "";
        }

        if (!/\d/.test(confirmPassword)) {
            msgNumber.textContent = "Password must include a number.";
            msgNumber.style.color = "red";
        } else {
            msgNumber.textContent = "";
        }

        if (!/[\W_]/.test(confirmPassword)) {
            msgSpecialChar.textContent =
                "Password must include a special character.";
            msgSpecialChar.style.color = "red";
        } else {
            msgSpecialChar.textContent = "";
        }

        //function to compare passwords
        comparePasswords();
    });


    //Function to Campare Passwords
    function comparePasswords() {
        const password = document.getElementById("user_password").value;
        const confirmPassword = document.getElementById("user_confirm_password").value;
        if (password !== confirmPassword) {
            checkEqual.textContent = "Passwords do not match!!";
            checkEqual.style.color = "red";
            submitBtn.classList.add('disabled');
        } else {
            checkEqual.textContent = "";
            submitBtn.classList.remove('disabled');
        }
        return true;
    }

    //edit update user modal details modal code
    function updateUserModal() {
        $("#updateUserModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-user-modal-btn");
    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let userid = editButton.dataset.id;
            let user_title = editButton.dataset.salutation;
            let user_fname = editButton.dataset.fname;
            let user_lname = editButton.dataset.lname;
            let user_mail = editButton.dataset.mail;
            let user_phone = editButton.dataset.phone;
            let user_role = editButton.dataset.user_role;

            document.getElementById("pf_id").value = userid;
            document.getElementById("usr_title").value = user_title;
            document.getElementById("first_name").value = user_fname;
            document.getElementById("last_name").value = user_lname;
            document.getElementById("usr_mail").value = user_mail;
            document.getElementById("phone_number").value = user_phone;

            document.getElementById("usr_role_id").value = user_role;
            // pre-select the option in the dropdown menu
            const role_select = document.querySelector('#usr_role_id');
            // console.log(select)
            role_select.value = user_role;

            updateUserModal();
        });
    });

    //   //delete user modal query
    function deleteUserModal() {
        $("#deleteUserModal").modal("show");
    }
    let deleteBtns = document.querySelectorAll(".deleteUserBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let user_id = deleteBtn.dataset.id;

            document.getElementById("userID").value = user_id;

            deleteUserModal()
        });
    });
    </script>

</body>

</html>