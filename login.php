<?php


require('./connect.php');

// Function to sanitize user inputs
function sanitize_input($input) {
    // Implement your sanitization logic here
    // For example, you can use mysqli_real_escape_string() or other methods
    return htmlspecialchars(trim($input));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? sanitize_input($_POST['username']) : '';
    $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';

    if ($username && $password) {
        // Add your database connection logic here if it's not already included
        require "./connect.php";

        // Prepare the SQL statement using a prepared statement to prevent SQL injection
        $stmt = $connect->prepare("SELECT password FROM users WHERE username = ?");

        // Bind parameter and execute the query
        $stmt->bind_param('s', $username);
        $stmt->execute();

        // Store the result from the query
        $stmt->store_result();

        // If a row with the given lastname exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Passwords match - authentication successful
                header("Location: dashboard.php");
                exit();
            } else {
                // Passwords do not match
                echo "<div class='tlogerbx'><p>Incorrect password</p></div>";
            }
        } else {
            // No user found with the provided lastname
            echo "<div class='tlogerbx'><p>User not found</p></div>";
        }

        // Close the statement and connection
        $stmt->close();
        $connect->close();
    } else {
        echo 'All fields are required';
    }
}




/* CONFIRMPASSWORD INPUT IS NOT STORED IN DATABASE - WHY? 

To clarify, the confirmation password ('confirmpass') field shouldn't be stored in the database, as it's generally used to verify the entered password.

The 'confirmpass' field's purpose is to ensure that the user has correctly entered the desired password. In the PHP script, it's used to verify that the password and confirmation password match before hashing and storing the password in the database.

Here's a quick recap of the process:

    User enters data in the form (including 'password' and 'confirmpass' fields).
    PHP script checks if all necessary fields are filled.
    PHP script compares 'password' and 'confirmpass' fields to ensure they match.
    If passwords match, the script hashes the 'password' field and stores it in the database.

The 'confirmpass' field itself is not stored in the database. It's only used for validation purposes to ensure the accuracy of the entered password. */

//===================================================================================



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN: TEACHER SYSTEM</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <form id="teacherLoginForm" class="stdmainbx hbox" method="post" action="#" onsubmit="return validateForm()">
        <p class="studentRegTitle stdmaintitle">Login Staff</p>
        <hr>
        <div class="studentRegIn stdmainin">
            <p class="studentInTitle stdmainintitle">Login Staff</p>
            <div class="studentDetails stdgdatabx">
                <aside class="stda stdaside">
                    <!-- User should use lastname and password to login -->
                    <div class="financeIdbx sflex">
                        <label for="financeIdinput" class="studentNamenm">User Name:</label>
                        <input type="text" id="financeIdinput" name="username" class="sflexinp" placeholder="" required>
                    </div>

                    <div class="tsurnamebx sflex">
                        <label for="tsurNameinput" class="studentNamenm">Password:</label>
                        <input type="password" id="tsurNameinput" name="password" class="sflexinp" placeholder="" required>
                    </div>
                </aside>
                <aside class="stdb stdaside">
                    <div class="studentProfile">
                        <img src="./../../abst1_slash.jpg" class="stdImg" width="50" alt="Student Profile">
                        <button id="changeProfile" onclick="changeProfile()">Change Profile</button>
                    </div>
                </aside>
            </div>
            <p class="notif" id="regNotif"></p>
            <hr color="lightgray">
            <div class="stdActbtns">
                <div class="stdActbtnsIn">
                    <button id="loginButton" type="submit" class="stdinfobtn">Login</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function validateForm() {
            // Basic validation, you can enhance this further
            var lastName = document.getElementById('financeIdinput').value;
            var password = document.getElementById('tsurNameinput').value;

            if (lastName.trim() === '' || password.trim() === '') {
                alert('Please fill in all fields.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
