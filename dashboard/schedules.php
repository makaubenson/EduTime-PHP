<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

//deny access to courses.php if user is not an admin
if ($_SESSION['role_name'] !== 'Dean' && $_SESSION['role_name'] !== 'Lecturer' &&  $_SESSION['role_name'] !== 'Chairperson') {
    // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
    header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
    exit;
  }
  

  //sessions  

  $pfno = $_SESSION['pfno'];
  $salutation= $_SESSION['salutation'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $name = $_SESSION['fname'] . " ".$_SESSION['lname'];
  $mail = $_SESSION['email'];
  
//Download Personal TT
if (isset($_POST['download-personal-tt-btn'])) {

    $lec = $_POST['lec_pf'];
    $lec_name = $_POST['lec_name'];
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    
    // Set the file name
    $filename = strtolower($lname) . '-personal-timetable.pdf';
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    // Create a new PDF document
    $pdf = new FPDF('L', 'mm', 'A4'); // 'L' for landscape orientation
    $pdf->AddPage();

    // Add the logo to the document
    $pdf->Image('images/logo.png', $pdf->GetPageWidth()/2 - 15, 10, 30, 0, 'PNG');
    
    //get department details
    $sql_dpt = "SELECT * FROM department_details 
    INNER JOIN lecturer_department_details ON lecturer_department_details.department_id = department_details.department_id
    INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
    INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
     WHERE lecturer_department_details.lecturer_id = '$lec'";
    $dpt_result = mysqli_query($db, $sql_dpt);

    //get unit details
    $sql_unit = "SELECT * FROM unit_details
    INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id = unit_details.unit_code
    WHERE lecturer_unit_details.lecturer_id = '$lec'";
    $unit_result = mysqli_query($db, $sql_unit);

    // Query to get the timetable details
    $sql = "SELECT *
    FROM unit_room_time_day_allocation_details urtd1
    INNER JOIN lecturer_unit_details lud ON urtd1.unit_id = lud.unit_id
    INNER JOIN user_details ud ON lud.lecturer_id = ud.pf_number
    INNER JOIN unit_room_time_day_allocation_details urtd2 ON urtd1.unit_id = urtd2.unit_id
    WHERE urtd2.lecturer_id = '$lec'";
    $result = mysqli_query($db, $sql);

    // Write the title of the document
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->Cell(0, 30, '', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Maseno University', 0, 1, 'C');
    while ($row = mysqli_fetch_assoc($dpt_result)) {
        // Do something with each row, for example:
        $department_id = $row['department_id'];
        $department_name = $row['department_name'];
        $school_name = $row['school_name'];
        $pdf->SetFont('Arial', 'B', 18); // set font to Arial, bold, size 18
        $pdf->Cell(0, 10,"Faculty of ".$school_name, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 15); // set font to Arial, bold, size 18
        $pdf->Cell(0, 10,"Department of ".$department_name, 0, 1, 'C');
    }
    $pdf->SetFont('Arial', 'B', 14); // set font to Arial, bold, size 18
    $pdf->Cell(0, 10,$salutation." ".$lname."'s"." Personal Timetable", 0, 1, 'C');

    // Set the font and font size for the table headers
    $pdf->SetFont('Arial', 'B', 12);

// create table header
$pdf->Cell(40,10,'Day/Time',1);
$pdf->Cell(40,10,'07:00-09:00',1);
$pdf->Cell(40,10,'09:00-11:00',1);
$pdf->Cell(40,10,'11:00-13:00',1);
$pdf->Cell(40,10,'13:00-15:00',1);
$pdf->Cell(40,10,'15:00-17:00',1);
$pdf->Cell(40,10,'17:00-19:00',1);
// set font for table content
$pdf->SetFont('Arial','',12);

// populate table with data
$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
$times = array('07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00', '17:00-19:00');
foreach($days as $day) {
    $pdf->Ln();
    $pdf->Cell(40,10,$day,1);

    foreach($times as $time) {
        $unit_id = '';
        mysqli_data_seek($result, 0); // reset the result set pointer
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['weekday'] === $day && $row['time_slot_id'] === $time) {
                $unit_id = $row['unit_id']." ".$row['room_id'];
                break;
            }
        }
        $pdf->Cell(40,10,$unit_id,1);
    }
}


// Close the database connection and output the PDF
mysqli_close($db);
$pdf->Output('D', $filename);
}

//Download Group TT
if (isset($_POST['download-course-group-tt-btn'])) {

    $lec = $_POST['lec_id'];
    $crs_id = $_POST['course_identifier'];
    $grp_year = $_POST['group_year'];
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    
    // Set the file name
    $filename = strtolower($crs_id) . 'timetable.pdf';
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    // Create a new PDF document
    $pdf = new FPDF('L', 'mm', 'A4'); // 'L' for landscape orientation
    $pdf->AddPage();

    // Add the logo to the document
    $pdf->Image('images/logo.png', $pdf->GetPageWidth()/2 - 15, 10, 30, 0, 'PNG');
    
    //get department details
    $sql_dpt = "SELECT * FROM department_details 
    INNER JOIN lecturer_department_details ON lecturer_department_details.department_id = department_details.department_id
    INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
    INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
     WHERE lecturer_department_details.lecturer_id = '$lec'";
    $dpt_result = mysqli_query($db, $sql_dpt);

    //get unit details
    $sql_unit = "SELECT * FROM unit_details
    INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id = unit_details.unit_code
    INNER JOIN unit_course_details ON unit_course_details.unit_id = lecturer_unit_details.unit_id
    INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = lecturer_unit_details.lecturer_id
    INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id
    INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id
    INNER JOIN academic_year ON academic_year.academic_year_id = lecturer_unit_details.academic_year_id
    WHERE unit_course_details.course_id = '$crs_id'";
    $unit_result = mysqli_query($db, $sql_unit);

    // Query to get the timetable details
    $sql = "SELECT * FROM unit_room_time_day_allocation_details urtd1 
    INNER JOIN lecturer_unit_details lud ON urtd1.unit_id = lud.unit_id 
    INNER JOIN user_details ud ON lud.lecturer_id = ud.pf_number 
    INNER JOIN unit_room_time_day_allocation_details urtd2 ON urtd1.unit_id = urtd2.unit_id 
    INNER JOIN unit_course_details ucd ON ucd.unit_id = lud.unit_id 
    INNER JOIN course_details cd ON cd.course_id = ucd.course_id
    INNER JOIN lecturer_department_details ldd ON ldd.lecturer_id = lud.lecturer_id
    INNER JOIN department_details dd ON dd.department_id = ldd.department_id
    INNER JOIN academic_year on academic_year.academic_year_id = lud.academic_year_id
    WHERE ucd.course_id = '$crs_id' AND lud.academic_year_id='$grp_year'";
    $result = mysqli_query($db, $sql);

    // Write the title of the document
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->Cell(0, 30, '', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Maseno University', 0, 1, 'C');
    while ($row = mysqli_fetch_assoc($dpt_result)) {
        // Do something with each row, for example:
        $department_id = $row['department_id'];
        $department_name = $row['department_name'];
        $school_name = $row['school_name'];
        $pdf->SetFont('Arial', 'B', 18); // set font to Arial, bold, size 18
        $pdf->Cell(0, 10,"Faculty of ".$school_name, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 15); // set font to Arial, bold, size 18
        $pdf->Cell(0, 10,"Department of ".$department_name, 0, 1, 'C');
    }

    $pdf->SetFont('Arial', 'B', 14); // set font to Arial, bold, size 18
    if ($row = mysqli_fetch_assoc($unit_result)) {
        $crs_name = $row['course_name'];
        $year = $row['Year'];

        $pdf->Cell(0, 10, $crs_name, 0, 1, 'C');
        $pdf->Cell(0, 10, $year, 0, 1, 'C');
    }
    
    // Set the font and font size for the table headers
    $pdf->SetFont('Arial', 'B', 12);

// create table header
$pdf->Cell(40,10,'Day/Time',1);
$pdf->Cell(40,10,'07:00-09:00',1);
$pdf->Cell(40,10,'09:00-11:00',1);
$pdf->Cell(40,10,'11:00-13:00',1);
$pdf->Cell(40,10,'13:00-15:00',1);
$pdf->Cell(40,10,'15:00-17:00',1);
$pdf->Cell(40,10,'17:00-19:00',1);
// set font for table content
$pdf->SetFont('Arial','',12);

// populate table with data
$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
$times = array('07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00', '17:00-19:00');
foreach($days as $day) {
    $pdf->Ln();
    $pdf->Cell(40,10,$day,1);

    foreach($times as $time) {
        $unit_id = '';
        mysqli_data_seek($result, 0); // reset the result set pointer
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['weekday'] === $day && $row['time_slot_id'] === $time) {
                $unit_id = $row['unit_id']." ".$row['room_id'];
                break;
            }
        }
        $pdf->Cell(40,10,$unit_id,1);
    }
}


// Close the database connection and output the PDF
mysqli_close($db);
$pdf->Output('D', $filename);
}


//generate department TT
if (isset($_POST['download-department-tt-btn'])) {
    $lec = $_POST['lec_pf_num'];

    // Retrieve the department ID of the lecturer
    $sql_dept = "SELECT lecturer_department_details.department_id FROM lecturer_department_details 
    INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id
    WHERE lecturer_id = '$lec' LIMIT 0, 25";
    $result_dept = mysqli_query($db, $sql_dept);
    $row_dept = mysqli_fetch_assoc($result_dept);
    $dept_id = $row_dept['department_id'];

    // Retrieve information from the database
    $sql = "SELECT * FROM unit_room_time_day_allocation_details 
    INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id = unit_room_time_day_allocation_details.unit_id
    INNER JOIN user_details ON user_details.pf_number = lecturer_unit_details.lecturer_id
    INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = lecturer_unit_details.lecturer_id
    INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id
    INNER JOIN room_details ON room_details.room_name = unit_room_time_day_allocation_details.room_id
    WHERE department_details.department_id = '$dept_id'";
    $result = mysqli_query($db, $sql);

    // Shuffle the results
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    shuffle($rows);

    // Create a new PDF document
    require('fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Add the logo to the document
    $pdf->Image('images/logo.png', $pdf->GetPageWidth()/2 - 15, 10, 30, 0, 'PNG');

            // Write the title of the document
    $pdf->SetFont('Arial', 'B', 30);
    $pdf->Cell(0, 30, '', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Maseno University', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 22);

    //get department details
    $sql_dpt = "SELECT * FROM department_details 
    INNER JOIN lecturer_department_details ON lecturer_department_details.department_id = department_details.department_id
    INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
    INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
     WHERE lecturer_department_details.lecturer_id = '$lec'";
    $dpt_result = mysqli_query($db, $sql_dpt);

    while ($row = mysqli_fetch_assoc($dpt_result)) {
        // Do something with each row, for example:
        $department_id = $row['department_id'];
        $department_name = $row['department_name'];
        $school_name = $row['school_name'];
        $pdf->SetFont('Arial', 'B', 18); // set font to Arial, bold, size 18
        $pdf->Cell(0, 10,"Faculty of ".$school_name, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 15); // set font to Arial, bold, size 18
        $pdf->Cell(0, 10,"Department of ".$department_name, 0, 1, 'C');
        $pdf->Cell(0, 10,"Department Timetable", 0, 1, 'C');
    }
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Unit', 1);
    $pdf->Cell(50, 10, 'Lecturer', 1);
    $pdf->Cell(30, 10, 'Time', 1);
    $pdf->Cell(30, 10, 'Day', 1);
    $pdf->Cell(40, 10, 'Room', 1);
    $pdf->Ln();

    // Loop through the shuffled rows and add the data to the PDF
    foreach ($rows as $row) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 10, $row['unit_id'], 1);
        $pdf->Cell(50, 10, $row['user_firstname']." ".$row['user_lastname'], 1);
        $pdf->Cell(30, 10, $row['time_slot_id'], 1);
        $pdf->Cell(30, 10, $row['weekday'], 1);
        $pdf->Cell(40, 10, $row['room_name'], 1);
        $pdf->Ln();
    }


    function slugify($text) {
        // Replace spaces with hyphens
        $text = str_replace(' ', '-', $text);
      
        // Remove special characters except hyphens
        $text = preg_replace('/[^A-Za-z0-9\-]/', '', $text);
      
        // Convert to lowercase
        $text = strtolower($text);
      
        return $text;
      }
      
      // Usage:
      $department_slug = slugify($department_name);

    // Output the PDF document
    $pdf->Output($department_slug."_timetable".".pdf", 'D');
    exit();

    mysqli_close($db);

}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Reports | EDUTIME</title>
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
                    <h4 class="page-title">Reports</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Reports
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
                <?php
    if ($_SESSION['role_name'] === 'Admin'){
    // display the HTML code if the session variable 'role_name' is set to 'Admin'
    ?>
                <div class="col-md-3">
                    <a href="#" name="faculty-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Faculty Details</h6>
                                    <input type="submit" name="download-school-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="department-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf "></i>
                                    </h1>
                                    <h6 class="text-light">Department Details</h6>
                                    <input type="submit" name="download-department-btn" class="btn btn-success"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="course-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Course Details</h6>
                                    <input type="submit" name="download-course-btn" class="btn btn-cyan"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="unit-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Unit Details</h6>
                                    <input type="submit" name="download-unit-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="unit-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-secondary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Lecturer Details</h6>

                                    <input type="submit" name="download-lecturer-btn" class="btn btn-success"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="lecturer-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Room Details</h6>
                                    <input type="submit" name="download-room-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="timetable.csv" download>
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-excel"></i>
                                    </h1>
                                    <h6 class="text-light">Timetable</h6>
                                    <a href="timetable.csv" class="btn btn-success" download>Download</a>
                                </div>
                            </div>
                        </form>
                    </a>
                </div>
                <?php
    }
    ?>


                <!-- personal TT -->
                <?php
if ($_SESSION['role_name'] === 'Chairperson' || $_SESSION['role_name'] === 'Lecturer' || $_SESSION['role_name'] === 'Dean'){
// display the HTML code if the session variable 'role_name' is set to 'Admin'
?>
                <div class="col-md-4">
                    <a href="#" name="lecturer-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Personal Timetable</h6>
                                    <input type='text' readonly hidden value='<?php echo $pfno; ?>' name='lec_pf'>
                                    <input type='text' readonly hidden value='<?php echo $name; ?>' name='lec_name'>
                                    <input type="submit" name="download-personal-tt-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="#" name="lecturer-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Department Timetable</h6>
                                    <input type='text' readonly hidden value='<?php echo $pfno; ?>' name='lec_pf_num'>
                                    <input type="submit" name="download-department-tt-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-4"></div>
                <?php
}
?>


            </div>
            <!--close row-->
            <?php
if ($_SESSION['role_name'] === 'Chairperson' || $_SESSION['role_name'] === 'Lecturer' || $_SESSION['role_name'] === 'Dean'){
// display the HTML code if the session variable 'role_name' is set to 'Admin'
?>
            <div class="row mt-4 mb-4">
                <form method="POST" action="">
                    <input type='text' readonly hidden value='<?php echo $pfno; ?>' name='lec_id'>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword1" style="font-size:16px">Select Course:</label>
                            <select class="form-control form-control-lg" id="course_id" name="course_identifier"
                                required>
                                <option value="">Select course..</option>
                                <?php 
    // Retrieve the semesters from the database
    $sql=mysqli_query($db,"select * from course_details INNER JOIN department_course_details ON department_course_details.course_id = course_details.course_id INNER JOIN lecturer_department_details ON lecturer_department_details.department_id = department_course_details.department_id INNER JOIN user_details ON user_details.pf_number = lecturer_department_details.lecturer_id WHERE lecturer_department_details.lecturer_id= '$pfno'");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['course_id']);?>">
                                    <?php echo htmlentities($rw['course_name']);?>
                                    (<?php echo htmlentities($rw['course_shortform']);?>)
                                </option>
                                <?php
    }
    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword1" style="font-size:16px">Select Group:</label>
                            <select class="form-control form-control-lg" id="academic_year_id" name="group_year"
                                required>
                                <option value="">Select group..</option>
                                <?php 
    // Retrieve the semesters from the database
    $sql=mysqli_query($db,"select * FROM  academic_year WHERE year_status='Active' ORDER BY Year ASC");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['academic_year_id']);?>">
                                    <?php echo htmlentities($rw['Year']);?></option>
                                <?php
    }
    ?>
                            </select>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword1" style="font-size:16px">*Submit to download
                                Timetable</label></br>
                            <input type="submit" name="download-course-group-tt-btn"
                                class="btn btn-outline-success form-control-lg btn-block" value="Download Timetable"
                                style="font-size:16px; font-weight:bold;"></input>
                        </div>
                    </div>
                </form>
            </div>
            <?php
}
?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Personal Timetable</h5>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm personal-tt"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            Time / Weekday
                                        </th>
                                        <th>
                                            07:00AM-09:00AM
                                        </th>
                                        <th>
                                            09:00AM-11:00AM
                                        </th>
                                        <th>
                                            11:00AM-13:00PM
                                        </th>
                                        <th>
                                            13:00AM-15:00PM
                                        </th>

                                        <th>
                                            15:00AM-17:00PM
                                        </th>
                                        <th>
                                            17:00AM-19:00PM
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- monday -->
                                    <tr>
                                        <td width="110" align="center"><span style="color:white;">1</span>MONDAY
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '07:00-09:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Monday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                  
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '09:00-11:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Monday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '11:00-13:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Monday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                   
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '13:00-15:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Monday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                     
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '15:00-17:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Monday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '17:00-19:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Monday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                    </tr>
                                    <!-- tuesday -->
                                    <tr>
                                        <td width="110" align="center"><span style="color:white;">2</span>TUESDAY
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '07:00-09:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Tuesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '09:00-11:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Tuesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '11:00-13:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Tuesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '13:00-15:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Tuesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '15:00-17:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Tuesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '17:00-19:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Tuesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                    </tr>

                                    <!-- Wednesday -->
                                    <tr>
                                        <td width="110" align="center"><span style="color:white;">3</span>WEDNESDAY
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '07:00-09:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Wednesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '09:00-11:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Wednesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '11:00-13:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Wednesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '13:00-15:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Wednesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '15:00-17:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Wednesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '17:00-19:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Wednesday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                    </tr>
                                    <!-- thursday -->
                                    <tr>
                                        <td width="110" align="center"><span style="color:white;">4</span>THURSDAY
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '07:00-09:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Thursday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '09:00-11:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Thursday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '11:00-13:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Thursday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '13:00-15:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Thursday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '15:00-17:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Thursday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '17:00-19:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Thursday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                    </tr>

                                    <!-- Friday -->
                                    <tr>
                                        <td width="110" align="center"><span style="color:white;">5</span>FRIDAY
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '07:00-09:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Friday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '09:00-11:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Friday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '11:00-13:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Friday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '13:00-15:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Friday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>
                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '15:00-17:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Friday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                        <td width="120" style="background-color:white;">
                                            <font size="4">
                                                <?php 
                                        $query = "SELECT * FROM unit_room_time_day_allocation_details 
                                        INNER JOIN user_details ON user_details.pf_number = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN lecturer_department_details ON lecturer_department_details.lecturer_id = unit_room_time_day_allocation_details.lecturer_id 
                                        INNER JOIN department_course_details ON department_course_details.department_id = lecturer_department_details.department_id
                                        INNER JOIN course_details ON course_details.course_id = department_course_details.course_id
                                        INNER JOIN department_details ON department_details.department_id = lecturer_department_details.department_id 
                                        INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
                                        INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
                                        WHERE time_slot_id = '17:00-19:00' AND unit_room_time_day_allocation_details.lecturer_id ='$pfno' AND weekday='Friday' LIMIT 1 ";

                                        $result = mysqli_query($db, $query);
                                        $row = mysqli_fetch_array($result);
                                        if($row > 0){
                                        echo $row['unit_id'];
                                      
                                        echo '<br>';	 
                                        echo $row['room_id'];
                                        }
                                        ?>
                                            </font>
                                        </td>

                                    </tr>
                                </tbody>
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
    </script>

</body>

</html>