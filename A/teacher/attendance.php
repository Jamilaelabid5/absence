<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Management System</title>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" type="text/css" href="admin/style.css">
 
    
   
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

h1.student-heading {
    font-size: 36px;
    color: #0F52BA;
    margin-top: 50px; /* Adjust the margin to place it below the navbar */
    margin-bottom: 30px;
    margin-left:95px;
}

table {
    width: 100%; /* Ensure table takes full width */
    max-width: 1200px; /* Set a maximum width */
    margin: 0 auto; /* Center the table horizontally */
    border-collapse: collapse; /* Collapse borders */
    font-size: 16px;
     margin-top: -20%; 
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add shadow for a slight 3D effect */
    background-color: white;
}

th, td {
    padding: 12px; /* Add padding to cells */
    text-align: left; /* Align text to the left */
    border: 1px solid #ddd; /* Add border to create vertical lines */
    font-size: 14px; /* Adjust font size */
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

/* Style for labels */
form#numberForm label {
    font-size: 18px;
    margin-bottom: 10px; /* Add some space between label and input */
    
    margin-right:-2%; 
    margin-top: 40px; /* Add some space between label and input */
    display: block; /* Ensure the label takes full width */
}

/* Style for inputs */
form#numberForm input {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ddd;
    width: 70px;
    border-radius: 4px;
   
    margin-bottom: 10px; /* Add some space between input fields */
    margin-top: 0; /* Adjust as needed */
    margin-right:-1%;
}

/* Style for button */
form#numberForm button {
    padding: 10px 20px;
    width: 90px;
    font-size: 16px;
    color: white;
    background-color: #0F52BA;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right:50%;
    margin-left: calc(50% - 45px); /* Adjust according to your layout */
}

/* Button hover effect */
form#numberForm button:hover {
    background-color: #09418a;
}


</style>
</head>
<body>
    <!-- Menus started-->
    <header>
    <div class="navbar">
       
       <a href="attendance.php" style="text-decoration:none;">Attendance</a>
       
       <a href="../login.php" style="text-decoration:none;">Logout</a>
 
       </div>
    </header>
    <!-- Menus ended -->

    <center>
        <!-- Form section -->
        <form id="numberForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="numberInput" id="enter">Enter Number:</label>
            <input type="number" id="numberInput" name="number" required>
            <button type="submit" name="submit" id="submitButton">Send</button>
          
        </form>
    <h1 class="student-heading">All Students</h1>
        
        <div class="content">
     
            <div class="row">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Student Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Attendance Status</th> <!-- New column -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    // Establish database connection
                    $conn = mysqli_connect("localhost", "root", "", "absence");
                    
                    // Check if connection was successful
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    
                    // Check if the form is submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["number"])) {
                        $n_number = $_POST["number"];
                    
                        // SQL query to insert the submitted number into the numbers table
                        $sql = "INSERT INTO numbers (number) VALUES ('$n_number')";
                    
                        // Execute SQL query
                        if (mysqli_query($conn, $sql)) {
                            echo '<p style="color: green; margin-left:110%;"></p>';
                        } else {
                            echo "Error storing number in the database: " . mysqli_error($conn);
                        }
                    }
                    
                    // SQL query to select all students
                    $sql = "SELECT * FROM students";
                    
                    // Execute SQL query
                    $result = mysqli_query($conn, $sql);
                    
                    if ($result) {
                        // Check if there are any rows in the result set
                        if (mysqli_num_rows($result) > 0) {
                            // Loop through each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Output data for each row
                                echo "<tr>";
                                echo "<td>" . $row['st_id'] . "</td>";
                                echo "<td>" . $row['st_name'] . "</td>";
                                echo "<td>" . $row['st_email'] . "</td>";
                                echo "<td>" . $row['attendance_status'] . "</td>"; // Display attendance status
                                echo "</tr>";
                            }
                        } else {
                            // Output a message if there are no rows in the result set
                            echo "<tr><td colspan='4'>No students found</td></tr>";
                        }
                    } else {
                        // Output an error message if there's an issue with the SQL query
                        echo "<tr><td colspan='4'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</td></tr>";
                    }
                    
                    // Close database connection
                    mysqli_close($conn);
                    ?>
                    
                    
                    </tbody>
                </table>
            </div>
        </div>
    </center>

</body>
</html>
