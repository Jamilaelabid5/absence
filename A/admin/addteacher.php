<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tcr"])) {
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "absence");

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $tc_id = mysqli_real_escape_string($conn, $_POST["tc_id"]);
    $tc_name = mysqli_real_escape_string($conn, $_POST["tc_name"]);
    $tc_dept = mysqli_real_escape_string($conn, $_POST["tc_dept"]);
    $tc_course = mysqli_real_escape_string($conn, $_POST["tc_course"]);
    $tc_email = mysqli_real_escape_string($conn, $_POST["tc_email"]);

    // SQL query to insert teacher information into the database
    $sql = "INSERT INTO teachers (tc_id, tc_name, tc_dept, tc_course, tc_email) VALUES ('$tc_id', '$tc_name', '$tc_dept', '$tc_course', '$tc_email')";

      // Execute SQL query
      if (!mysqli_query($conn, $sql)) {
        // Check if the error is due to duplicate entry
        if (mysqli_errno($conn) == 1062) {
            echo '<p style="color: red;  ">Duplicate entry. Please choose a different ID.</p>';
        } else {
            // Error occurred during query execution
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
       // After successfully inserting the student's information into the students table
// Insert data into the users table
// Function to generate a random password
function generateRandomPassword($length = 8) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $password = '';
  for ($i = 0; $i < $length; $i++) {
      $password .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $password;
}

// Generate a random password

$user_id = $tc_id; // Set user_id as st_id
$userType = "ClassTeacher";
$username = $tc_name; // Set username as st_name
// Generate a random password
$password = generateRandomPassword();

// Store the plaintext password before hashing it
$plaintext_password = $password;

// Hash the password using MD5 or SHA-256
$simple_hashed_password = md5($plaintext_password); // Or sha256($plaintext_password)


// SQL query to insert data into the users table
$insert_user_sql = "INSERT INTO users (user_id, userType, username, password) VALUES ('$user_id', '$userType', '$username', '$simple_hashed_password')";


// Execute the insertion query
if (!mysqli_query($conn, $insert_user_sql)) {
    // Error occurred during query execution
    echo "Error: " . $insert_user_sql . "<br>" . mysqli_error($conn);
} else {
    // If insertion successful, clear any previous error message
    echo "<script>document.getElementById('error_message').innerHTML = '';</script>";
    // Provide feedback to the user
    echo "<p style='color: green;'>Teacher information added successfully.</p>";
}

    }

    // Close database connection
    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<!-- head started -->
<head>
<title>Attendance Management System</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
 
   
  <link rel="stylesheet" href="admin/style.css" >

  <style type="text/css">
 body {
    color: #333;
    background-color: #FFFFFF;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding-top: 70px;
}

.navbar {
    font-size: 18px;
    overflow: hidden;
    background-color: #0F52BA;
    width: 100%;
    margin-top: -70px;
}

.navbar a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}

.navbar a:hover {
    color: #36454F;
    background-color: inherit;
}
.content {
  display: flex;
  justify-content: center;
  padding: 50px 20px;
}

.form-horizontal {
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.25);

  width: 130%; /* Make the form wider */
    max-width: 800px;
    margin-left:-60px;
}

.form-horizontal h4 {
  text-align: center;
  margin-bottom: 20px;
  color: #007bff;
}

.form-group label {
  color: #495057;
}

.form-group input {
  border-radius: 4px;
  border: 1px solid #ced4da;
  padding:10px;
  width:60%;
}

.form-group input:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
}

.btn-primary {
            background-color: #6082B6;
          
            font-size: 16px; /* Make the button text larger */
            padding: 5px 80px; /* Increase the padding */
            display: flex; /* Make the button a block element */
            justify-content: center; /* Center horizontally */
            align-items: center;
            margin-left: 250px; /* Align the button to the left */
            text-align: center; /* Center the text within the button */
            color: white; /* Ensure the text color is set */
            cursor: pointer; /* Make sure the button looks clickable */
        }

      


.message {
  margin: 20px 0;
  margin-top: 50px;
  text-align: center;
}

</style>
</head>
<!-- head ended -->

<!-- body started -->
<body>

    <!-- Menus started-->
    <header>

      
      <div class="navbar">
      
      <a href="v-students.php" style="text-decoration:none;">Students</a>
      <a href="v-teachers.php" style="text-decoration:none;">Teachers</a>
      <a href="admin.php" style="text-decoration:none;">Add Student</a>
        <a href="addteacher.php" style="text-decoration:none;">Add Teacher</a>
        
      <a href="../login.php" style="text-decoration:none;">Logout</a>

    </div>

    </header>
    <!-- Menus ended -->

<center>


<!-- Content, Tables, Forms, Texts, Images started -->
<div class="content">

  <div class="rowtwo" id="teacher">
  

       <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
        <h4>Add Teacher's Information</h4>
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Teacher ID</label>
          <div class="col-sm-7">
            <input type="text" name="tc_id"  class="form-control" id="input1" placeholder="teacher's id" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-7">
            <input type="text" name="tc_name"  class="form-control" id="input1" placeholder="teacher full name" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Department</label>
          <div class="col-sm-7">
            <input type="text" name="tc_dept"  class="form-control" id="input1" placeholder="department ex. CSE" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="tc_email"  class="form-control" id="input1" placeholder="valid email" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Subject Name</label>
          <div class="col-sm-7">
            <input type="text" name="tc_course"  class="form-control" id="input1" placeholder="subject ex. Software Engineering" />
          </div>
      </div>

      <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Add Teacher" name="tcr" style="margin-top: 10px;" />
    </form>
    
  </div>


</div><br>
<!-- Contents, Tables, Forms, Images ended -->

</center>
<!-- Error or Success Message printint started -->
<div class="message">
        <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
</div>
<!-- Error or Success Message printint ended -->
</body>
<!-- Body ended  -->
</html>
