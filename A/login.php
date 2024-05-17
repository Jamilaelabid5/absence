<?php
// Initialize a flag to indicate login failure
$loginError = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "absence");

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $userType = mysqli_real_escape_string($conn, $_POST["userType"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // SQL query to retrieve user information based on username, password, and userType
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND userType = '$userType'";

    // Execute SQL query
    $result = mysqli_query($conn, $sql);
// Check if a row with matching credentials exists
if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
  $userType = $row['userType']; // Assuming userType is a field in your database
  
  // Redirect based on user type
  switch ($userType) {
      case "Administrator":
          header("Location: admin/admin.php");
          exit();
          break;
      case "ClassTeacher":
          header("Location: teacher/attendance.php");
          exit();
          break;
      case "Student":
          header("Location: student/s_attendance.php");
          exit();
          break;
      default:
          // Handle default case
          break;
  }
} else {
  // Login failed, set login error variable to true
  $loginError = true;
}

    
    // Close database connection
    mysqli_close($conn);}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="logo/attnlg.jpg" rel="icon">
  <title>SAS - Login</title>

  
<style>
     body {
            background-image: url('img/logo/loral1.jpe00g');
            background-size: cover;
            background-position: center;
            background-color: #FFFFFF;
            font-family: "Lucida Console", "Courier New", monospace;
        }
        
        .container-login {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Adjust as needed */
            margin-top: -10px;
            margin-left:-280px;
            
           
        }
        
        .card {
            width: 100%;
            max-width: 400px; /* Adjust as needed */
        }
        .login-form{

            
    background-color:#FFFFFF; 
    border-radius: 10px; /* Rounded corners */
    padding: 20px; /* Add some padding */
    box-shadow:  0 8px 16px rgba(0,0,0,0.2); /* Add shadow */
    
     width: 95%;
    margin: -40px; /* Center the container */
    text-align: center;
    margin-left:100px;
    font-family: "Lucida Console", "Courier New", monospace;
    

}
.login-form .form-group {
    margin-bottom: 15px; /* Add space between form elements */
}
.login-form input[type="text"],
.login-form input[type="password"] {
   
    width: 80%; /* Make input fields 100% width */
    padding: 10px; /* Add padding to input fields */
    font-size: 16px; /* Adjust font size */
    font-family: Arial;
    border: 1px solid #ccc
}
.login-form select {
    width: 85%; /* Make select dropdown 100% width */
    padding: 10px; /* Add padding to select dropdown */
    font-size: 16px; /* Adjust font size */
    font-family: Arial;
    border: 1px solid #ccc
}

.login-form input[type="submit"] {
    width: 85%; /* Make login button 100% width */
    padding: 10px; /* Add padding to login button */
    font-size: 16px; /* Adjust font size */
    font-family: Arial;
    background-color:#4B9CD3;
    
    box-shadow:  0 8px 16px rgba(0,0,0,0.2);


}
.btn-success {
        /* Your button styles */
        background-color: #4B9CD3;
        color: #fff;
        padding: 10px;
        border: none;
        cursor: pointer;
        transition: box-shadow 0.3s ease; /* Transition effect for smooth shadow */
    }

    .btn-success:hover {
        /* Shadow effect on hover */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Adjust the shadow properties as needed */
    }
        
</style>
</head>

<body class="bg-gradient-login" style="background-image: url('img/logo/loral1.jpe00g');">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                <h5 align="center" style="font-family: Arial ;font-size: 20px;font-weight: 300;" >STUDENT ATTENDANCE SYSTEM</h5>
                  <div class="text-center">
                    <img src="logo/attnlg.jpg" style="width:120px;height:120px">
                    <br><br>
                    <h1 class="h4 text-gray-900 mb-4" style="margin-top: -10px; font-size: 30px;font-family: Arial;font-weight: 300;">Login </h1>
                  </div>
                  <form class="user" method="Post" action="login.php">
                  <div class="form-group">
                  <select required name="userType" class="form-control mb-3">
                          <option value="">--Select User Roles--</option>
                          <option value="Administrator">Administrator</option>
                          <option value="ClassTeacher">ClassTeacher</option>
                          <option value="Student">Student</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" required name="username" id="exampleInputusername" placeholder="Enter Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input type="password" name = "password" required class="form-control" id="exampleInputPassword" placeholder="Enter Password">
                    </div>


                    
                    <div class="form-group">
                        <input type="submit"  class="btn btn-success btn-block" value="Login" name="login" autocomplete="off" style=" border: none; margin-top: 10px; 
    outline: none; " />
                    </div>
                     </form>

                    
                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->

                
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  


</body>

</html>
