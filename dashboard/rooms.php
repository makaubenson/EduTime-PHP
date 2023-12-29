<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}


//deny access to schools.php if user is not an admin
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

//Add Room
//generate room id function
function generate_room_id($room_name) {
    // Slugify the room name
    $slugified_name = strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $room_name)));
    // Add the prefix "RM_" to the slugified name
    $room_id = "RM-" . $slugified_name;

    return $room_id;
}

if (isset($_POST['add-room-btn'])) {
  $room_name = $_POST['room_name'];
  $room_id = generate_room_id($room_name);
  $room_type = $_POST['room_type_id'];
  $room_capacity = $_POST['room_capacity'];
 
  if (empty($room_name)) {
    array_push($errors, "Room Name is required");
  }
  if (empty($room_type)) {
    array_push($errors, "Room Type is required");
  }
  if (empty($room_capacity)) {
    array_push($errors, "Room Capacity is required");
  }

  if (count($errors) == 0) {
    $add_room_query = "INSERT INTO `room_details`(`room_id`, `room_name`, `room_type_id`, `room_capacity`) VALUES ('$room_id','$room_name','$room_type','$room_capacity')";
    $results = mysqli_query($db, $add_room_query );

      header('location: ./rooms.php');
    }else{
      array_push($errors, "Unable to add room");
      header('location: ./rooms.php');
    }
  }

// Update Room Details
if (isset($_POST['update-room-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $room_id = $_POST['room_id'];
  $room_name = $_POST['rm_name'];
  $room_type = $_POST['room_type'];
  $room_capacity = $_POST['room_capacity'];

//Data Validation
  if (empty($room_id)) {
  	array_push($errors, "Room ID is required");
  }
  if (empty($room_name)) {
  	array_push($errors, "Room Name is required");
  }
  if (empty($room_type)) {
  	array_push($errors, "Room Type is required");
  }
  if (empty($room_capacity)) {
  	array_push($errors, "Room Capacity is required");
  }

if (count($errors) == 0) {
  $room_data_update_query = "UPDATE `room_details` SET `room_name`='$room_name',`room_type_id`='$room_type',`room_capacity`='$room_capacity' WHERE `room_id`='$room_id'";
  $results = mysqli_query($db, $room_data_update_query);

  header('location: rooms.php');
  }else{
  array_push($errors, "Unable to push room updates");
  header('location: rooms.php');
  }
}
}

  // Delete room Details
if (isset($_POST['room-delete-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $roomID = $_POST['room_id'];
  
  if (empty($roomID)) {
    array_push($errors, "Room ID is required");
  }

  if (count($errors) == 0) {
      $room_data_delete_query = "DELETE FROM `room_details` WHERE `room_id`='$roomID' ";
      $results = mysqli_query($db, $room_data_delete_query);

        header('location: rooms.php');
      }else{
        array_push($errors, "Unable to delete this room");
        header('location: rooms.php');
      }
  }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Rooms | EDUTIME</title>
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
                    <h4 class="page-title">Room Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Rooms
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
                            <h5 class="card-title">List of Rooms</h5>
                            <input type='button' value='Add a Room' name='open-room-modal-btn'
                                class='btn btn-primary float-end open-room-modal-btn m-2'>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Room ID</th>
                                        <th>Room Name</th>
                                        <th>Room Type</th>
                                        <th>Room Capacity</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `room_details` INNER JOIN room_type_details ON room_type_details.room_type_id = room_details.room_type_id";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $room_id = $row['room_id'];
              $room_name = $row['room_name'];
              $room_type = $row['room_type'];
              $room_type_id = $row['room_type_id'];
              $room_capacity = $row['room_capacity'];
              $date_created = $row['date_added'];

      echo "<tr> <td>" .$room_id.  "</td>";
      echo "<td>" .$room_name."</td>";
      echo "<td>" .$room_type."</td>";
      echo "<td>" .$room_capacity."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='room_id' value='$room_id'>
      <input type='submit' data-room_id='$room_id' data-room_name='$room_name' data-room_type='$room_type' data-room_type_id='$room_type_id' data-room_capacity='$room_capacity' value='Edit Details' name='edit-room-btn' class='btn btn-success edit-room-modal-btn m-2'>
      <input type='submit' data-id= '$room_id' value='Delete Room'  class='btn btn-danger deleteRoomBtn'>
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
                                        <th>Room ID</th>
                                        <th>Room Name</th>
                                        <th>Room Type</th>
                                        <th>Room Capacity</th>
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

    <!-- add new Room-->
    <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="addRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel">Add a Room</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Room Name:</label>
                            <input type="text" name="room_name" class="form-control" id="room_name_id" required
                                placeholder="e.g TB 1">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Room Type</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="room_type_id">
                                <option value="">Select Room Type</option>
                                <?php $sql=mysqli_query($db,"select * from room_type_details");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
                                <option value="<?php echo htmlentities($rw['room_type_id']);?>">
                                    <?php echo htmlentities($rw['room_type']);?></option>
                                <?php
}
?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Room Capacity:</label>
                            <input type="number" name="room_capacity" class="form-control" id="room_capacity_id"
                                required placeholder="e.g 60">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" name="add-room-btn">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--edit Room details-->
    <div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="editRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomModalLabel">Edit Room Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <input type="text" name="room_id" readonly hidden class="form-control" id="room_id" required>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Room Name:</label>
                            <input type="text" name="rm_name" class="form-control" id="rm_name_id" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Room Type</label>
                            <select class="form-control" name="room_type" value="" id="rm_type">
                                <option value="">Select Room Type</option>
                                <?php $sql=mysqli_query($db,"select * from room_type_details");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
                                <option value="<?php echo htmlentities($rw['room_type_id']);?>">
                                    <?php echo htmlentities($rw['room_type']);?></option>
                                <?php
}
?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Room Capacity:</label>
                            <input type="number" name="room_capacity" class="form-control" id="rm_capacity_id" required
                                placeholder="e.g 60">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" name="update-room-details-btn">Update
                                Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Room model-->
    <div class="modal" id='deleteRoomModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
                        <p>Are you sure you want to delete this Room?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="roomID" required readonly hidden
                                    name='room_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='room-delete-btn' class="btn btn-danger">Yes,Delete!</button>
                            </div>
                        </form>
                    </div>
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

    //add Room details modal code
    function openAddRoomModal() {
        $("#addRoomModal").modal("show");
    }
    let openAddRoomModalBtn = document.querySelector(".open-room-modal-btn");

    openAddRoomModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openAddRoomModal();
    });

    //edit Room details modal code
    function editRoomModal() {
        $("#editRoomModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-room-modal-btn");

    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let room_id = editButton.dataset.room_id;
            let room_name = editButton.dataset.room_name;
            let room_type = editButton.dataset.room_type;
            let room_type_id = editButton.dataset.room_type_id;
            let room_capacity = editButton.dataset.room_capacity;

            document.getElementById("room_id").value = room_id;
            document.getElementById("rm_name_id").value = room_name;
            document.getElementById("rm_capacity_id").value = room_capacity;

            document.getElementById("rm_type").value = room_type_id;
            // pre-select the option in the dropdown menu
            const selectedRoom = document.querySelector('#rm_type');
            // console.log(selectedRoom,"ERRORRRRR")
            selectedRoom.value = room_type_id;


            editRoomModal();
        });
    });

    //   //delete Room modal query
    function deleteRoomModal() {
        $("#deleteRoomModal").modal("show");
    }

    let deleteBtns = document.querySelectorAll(".deleteRoomBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let room_id = deleteBtn.dataset.id;

            document.getElementById("roomID").value = room_id;

            deleteRoomModal();
        });
    });
    </script>

</body>

</html>