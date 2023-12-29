<?php
ob_start();
session_start();

// connect to the database
try {
  $db = mysqli_connect('localhost', 'benson', 'benson', 'timetable');
  if (!$db) {
    die('Could not connect: ' . mysqli_connect_error());
}
} catch(Exception $e) {
  echo 'Database Connection Failed.';
}

$errors = array();

// Redirect to HTTPS if not already on HTTPS
// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
//   header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//   exit();
// }

// LOGIN STAFF
if (isset($_POST['login_btn'])) {
  $username = trim($_POST['pf_number']);
  $password = $_POST['staff_password'];

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $encrypted_password = md5($username).sha1($password);

    $login_query = "SELECT * FROM user_details INNER JOIN user_role_details ON user_details.pf_number = user_role_details.user_id INNER JOIN role_details ON user_role_details.role_id = role_details.role_id WHERE `pf_number`='$username' AND `user_password`='$encrypted_password'";
    $results = mysqli_query($db, $login_query);

    if (mysqli_num_rows($results) == 1) {
      $row = mysqli_fetch_assoc($results);
      //sessions
      $_SESSION['pfno'] = $row['pf_number'];
      $_SESSION['salutation'] = $row['user_title'];
      $_SESSION['fname'] = $row['user_firstname'];
      $_SESSION['lname'] = $row['user_lastname'];
      $_SESSION['email'] = $row['user_email'];
      $_SESSION['tel'] = $row['user_phone'];
      $_SESSION['role_id']=$row['role_id'];
      $_SESSION['role_name']=$row['role_name'];
      $_SESSION['success'] = "You are now logged in";

   // set session cookie parameters
   session_set_cookie_params(0, '/', '', true, true);

  //  Set session.cookie_secure = 1 to ensure that the session cookie is only sent over HTTPS.
   ini_set('session.cookie_secure', 1);
  //  Set session.cookie_httponly = 1 to ensure that the session cookie is not accessible through client-side scripts.
   ini_set('session.cookie_httponly', 1);
  //  Set session.use_only_cookies = 1 to ensure that the session ID is only transmitted via cookies.
   ini_set('session.use_only_cookies', 1);
  //  Set session.cookie_lifetime = 0 to ensure that the session cookie expires when the browser is closed.
   ini_set('session.cookie_lifetime', 0);

  //  Use session_regenerate_id() to generate a new session ID on every page load.
   session_regenerate_id();

      header('location: ./dashboard/');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: index.php');
    }
  }
}

ob_end_flush();
?>