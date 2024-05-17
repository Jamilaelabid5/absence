<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["std"])) {
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "absence");

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $st_id = mysqli_real_escape_string($conn, $_POST["st_id"]);
    $st_name = mysqli_real_escape_string($conn, $_POST["st_name"]);
    $st_dept = mysqli_real_escape_string($conn, $_POST["st_dept"]);
    $st_major = mysqli_real_escape_string($conn, $_POST["st_major"]);
    $st_sem = mysqli_real_escape_string($conn, $_POST["st_sem"]);
    $st_email = mysqli_real_escape_string($conn, $_POST["st_email"]);

    // SQL query to insert student information into the students table
    $sql = "INSERT INTO students (st_id, st_name, st_dept, st_major, st_sem, st_email) VALUES ('$st_id', '$st_name', '$st_dept', '$st_major', '$st_sem', '$st_email')";

    // Execute SQL query
    if (!mysqli_query($conn, $sql)) {
        // Check if the error is due to duplicate entry
        if (mysqli_errno($conn) == 1062) {
            echo "<p style='color: red;'>Duplicate entry. Please choose a different ID.</p>";
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

$user_id = $st_id; // Set user_id as st_id
$userType = "Student";
$username = $st_name; // Set username as st_name
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
    echo "<p style='color: green;'>Student information added successfully.</p>";
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

  
  <!-- Latest compiled and minified CSS -->

   
  <link rel="stylesheet" href="admin/style.css" >
 
  <style>
   

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

  width: 200%; /* Make the form wider */
  
    margin-left:-40px;
}

.form-horizontal h4 {
  text-align: center;
  margin-bottom: 20px;
  color: #007bff;
}

.form-group label {
  color: #495057;

  margin-top:60px;
}

.form-group input {
  border-radius: 4px;
  border: 1px solid #ced4da;
  width: 90%;
  padding:10px;
}

.form-group input:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
}

.btn-primary {
            background-color: #6082B6;
          width:10px;
            font-size: 16px; /* Make the button text larger */
            padding: 5px 80px; /* Increase the padding */
            display: flex; /* Make the button a block element */
            justify-content: center; /* Center horizontally */
            align-items: center;
            margin-left: 20px; /* Align the button to the left */
            text-align: center; /* Center the text within the button */
            color: white; /* Ensure the text color is set */
            cursor: pointer; /* Make sure the button looks clickable */
        }

 
  


.message {
  margin: 20px 0;
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
<!-- Error or Success Message printint started -->
<div class="message">
        <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
</div>
<!-- Error or Success Message printint ended -->

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="content">

 

  <div class="row" id="student">

       <div class="container">

      <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
      <h4>Add Student's Information</h4>
     
      <div class="form-group">
    <label for="input1" class="col-sm-3 control-label">Id</label>
    <div class="col-sm-7">
        <input type="text" name="st_id" class="form-control" id="input1" placeholder="student Id. no." />
    </div>
</div>


      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-7">
            <input type="text" name="st_name"  class="form-control" id="input1" placeholder="student full name" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Department</label>
          <div class="col-sm-7">
            <input type="text" name="st_dept"  class="form-control" id="input1" placeholder="department ex. IT" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Major</label>
          <div class="col-sm-7">
            <input type="text" name="st_major"  class="form-control" id="input1" placeholder="student major" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Semester</label>
          <div class="col-sm-7">
            <input type="text" name="st_sem"  class="form-control" id="input1" placeholder="semester ex. S1" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="st_email"  class="form-control" id="input1" placeholder="valid email" />
          </div>
      </div>


      <input type="submit" class=" btn-primary col-md-2 col-md-offset-8" value="Add Student" name="std"style="margin-top: 10px;" />
    </form>

  </div>
  </div>

<!-- Contents, Tables, Forms, Images ended -->

</center>
</body>
<!-- Body ended  -->
</html>


