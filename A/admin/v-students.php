
<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "absence");

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to select all students
$sql = "SELECT * FROM students";

// Execute SQL query
$result = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Attendance Management System</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="admin/style.css">
  <!-- Latest compiled and minified CSS -->

   
  <link rel="stylesheet" href="style.css" >
   
  <!-- Latest compiled and minified JavaScript -->

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

h1 {
    font-size: 36px;
    color: #0F52BA;
    margin-bottom: 30px;
}

table {
    width: 100%; /* Ensure table takes full width */
    max-width: none; /* Remove max-width restriction */
    margin: 0 auto; /* Center the table */
    margin-left: 30%; /* Custom margin-left */
    margin-top: -40%; /* Custom margin-top */
    border-collapse: collapse;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd; /* Add border to table */
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd; /* Added border to create vertical lines */
}

th {
    background-color: #0F52BA;
    color: white;
}

tr:hover {
    background-color: #f1f1f1;
}

.message {
    margin: 20px 0;
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
    color: black;
    background-color: #f8d7da;
    border: 1px solid #f5c2c7;
    border-radius: 5px;
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
<h1>Students List</h1>

<div class="content">

  <div class="row">
   
    <table class="table table-striped table-hover">
      
        <thead>
        <tr>
          <th scope="col">Student Id</th>
          <th scope="col">Name</th>
          <th scope="col">Department</th>
          <th scope="col">Major</th>
          <th scope="col">Semester</th>
          <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
  <?php
  // Check if there are any rows in the result set
  if (mysqli_num_rows($result) > 0) {
      // Loop through each row
      while ($row = mysqli_fetch_assoc($result)) {
          // Output data for each row
          echo "<tr>";
          echo "<td>" . $row['st_id'] . "</td>";
          echo "<td>" . $row['st_name'] . "</td>";
          echo "<td>" . $row['st_dept'] . "</td>";
          echo "<td>" . $row['st_major'] . "</td>";
          echo "<td>" . $row['st_sem'] . "</td>";
          echo "<td>" . $row['st_email'] . "</td>";
          echo "</tr>";
      }
  } else {
      // Output a message if there are no rows in the result set
      echo "<tr><td colspan='6'>No students found</td></tr>";
  }
  ?>
</tbody>

    
  
      </table>
    
  </div>
    

</div>

</center>

</body>
<!-- Body ended  -->

</html>
