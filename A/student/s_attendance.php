<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Management System</title>
    <meta charset="UTF-8">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.navbar {
    font-size: 18px;
    overflow: hidden;
    background-color: #0F52BA;
    color: white;
    padding: 10px;
}

.navbar a {
    text-decoration: none;
    color: white;
    margin-right: 60px;
}

#numberForm {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
}

#numberForm label {
    font-size: 18px;
    margin-bottom: 10px;
}

#numberInput {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#submitButton {
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    background-color: #0F52BA;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

#submitButton:hover {
    background-color: #09418a;
}
#resultContainer {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        #resultContainer p {
            font-size: 18px;
            background-color: #f8d7da; /* Pink background color */
            color: #721c24; /* Dark red text color */
            padding: 10px;
            border: 1px solid #f5c2c7;
            border-radius: 5px;
            margin: 0; /* Remove default margin */
        }

    </style>
</head>
<body>
    <!-- Menus started-->
    <header>
        <div class="navbar">
        <div class="navbar">
       
       <a href="s_attendance.php" style="text-decoration:none;">Attendance</a>
       
       <a href="../login.php" style="text-decoration:none;">Logout</a>
 
       </div>
    </header>
    <!-- Menus ended -->
    <form id="numberForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="numberInput">Enter Code</label>
        <input type="number" id="numberInput" name="number" required>
        <button type="submit" name="submit" id="submitButton">Send</button>
    </form>

    <!-- Display the result -->
    <div id="resultContainer" style="display:none; ">
        <p id="resultMessage"  ></p>
    </div>
    
    <?php
    // Check if the form is submitted
    if (isset($_POST["submit"])) {
        $n_number = $_POST["number"];

        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'absence';

        // Establish database connection
        $conn = mysqli_connect($host, $user, $pass, $dbname);

        // Check if connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // SQL query to check if the number exists in the database
        $sql = "SELECT * FROM numbers WHERE number = '$n_number'";

        // Execute SQL query
        $result = mysqli_query($conn, $sql);

        // Check if any row is returned
        if (mysqli_num_rows($result) > 0) {
            // Number exists in the database, update the attendance status for the student
        $student_id = 23; // Assuming the student ID is 1, you need to replace it with the actual student ID
        $attendance_status = 'Present';

        // SQL query to update the attendance status
        $update_sql = "UPDATE students SET attendance_status = '$attendance_status' WHERE st_id = $student_id";
       
        // Execute the update query
        if (mysqli_query($conn, $update_sql)) {
            echo '<p style="color: white; font-size: 20px; background-color: #00A36C; padding: 10px; border-radius: 5px; margin: 10px; width: 5%; margin-left:47%;">You are Present.</p>'; // Change text color to red and add additional styling
        } else {
            echo "Error updating attendance status: " . mysqli_error($conn);
        }
        
    } else {
        echo '<p style="color: white; font-size: 20px; background-color: red; padding: 10px; border-radius: 5px; margin: 10px; width: 5%; margin-left:47%;">You are Absent.</p>'; // Change text color to red and add additional styling
    }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
 