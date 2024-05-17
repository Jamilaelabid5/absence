<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "absence");

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to select all teachers
$sql = "SELECT * FROM teachers";

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

h1 {
    font-size: 36px;
    color: #0F52BA;
    margin-bottom: 30px;
}

.table {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    margin-left:30%;
            margin-top:-50%;
    table-layout: auto;
    border-collapse: collapse;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;  /* Add borders to table cells */
}

.table th {
    background-color: #0F52BA;
    color: white;
   
    
    letter-spacing: 0.1em;
}

.table tr:hover {
    background-color: #f1f1f1;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table th, .table td {
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
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
<h1>Teachers List</h1>

<div class="content">

<div class="row">
<div class="table-container">
  <table class="table table-stripped table-hover">
    <thead>
      <tr>
        <th scope="col">Teacher ID</th>
        <th scope="col">Name</th>
        <th scope="col">Department</th>
        <th scope="col">Email</th>
        <th scope="col">Course</th>
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
              echo "<td>" . $row['tc_id'] . "</td>";
              echo "<td>" . $row['tc_name'] . "</td>";
              echo "<td>" . $row['tc_dept'] . "</td>";
              echo "<td>" . $row['tc_email'] . "</td>";
              echo "<td>" . $row['tc_course'] . "</td>";
              echo "</tr>";
          }
      } else {
          // Output a message if there are no rows in the result set
          echo "<tr><td colspan='5'>No teachers found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

    
    </div>
</div>

</center>

</body>
<!-- Body ended  -->

</html>
