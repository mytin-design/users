<?php


// require('./connect.php');

// // Function to sanitize user inputs
// function sanitize_input($input) {
//     // Implement your sanitization logic here
//     // For example, you can use mysqli_real_escape_string() or other methods
//     return htmlspecialchars(trim($input));
// }

// // Check if form is submitted
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $firstname = isset($_POST['firstname']) ? sanitize_input($_POST['firstname']) : '';
//     $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';
//     $confirmpass = isset($_POST['confirmpass']) ? sanitize_input($_POST['confirmpass']) : '';

//     if ($firstname && $lastname && $password && $confirmpass) {
//         // Add your database connection logic here if it's not already included
//         require "./connect.php";

//         // Prepare the SQL statement using a prepared statement to prevent SQL injection
//         $stmt = $connect->prepare("INSERT INTO users (firstname, lastname, password)  
//                                 VALUES (?, ?, ?)");

//         // Check if the passwords match before inserting
//         if ($password === $confirmpass) {
//             // Hash the password for secure storage
//             $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
//             // Bind parameters and execute the query
//             $stmt->bind_param('sss', $firstname, $lastname, $hashed_password);
//             $stmt->execute();

//             // Check if the query was successful
//             if ($stmt->affected_rows > 0) {
//                 header("Location: login.php");
//                 //echo "<div><p>Your data is stored successfully</p></div>";
//             } else {
//                 echo "<div><p>Kindly try again</p></div>";
//             }
//         } else {
//             echo "<div><p>Passwords do not match</p></div>";
//         }

//         // Close the statement and connection
//         $stmt->close();
//         $connect->close();
//     } else {
//         echo 'All fields are required';
//     }
// }

//--------------------------------------------------------------------------------------

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

// USERNAME UPDATE


// require('./connect.php');

// // Function to sanitize user inputs
// function sanitize_input($input) {
//     // Implement your sanitization logic here
//     // For example, you can use mysqli_real_escape_string() or other methods
//     return htmlspecialchars(trim($input));
// }

// // Check if form is submitted
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $firstname = isset($_POST['firstname']) ? sanitize_input($_POST['firstname']) : '';
//     $lastname = isset($_POST['lastname']) ? sanitize_input($_POST['lastname']) : '';
//     $username = isset($_POST['username']) ? sanitize_input($_POST['username']) : '';
//     $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';
//     $confirmpass = isset($_POST['confirmpass']) ? sanitize_input($_POST['confirmpass']) : '';

//     if ($firstname && $lastname && $username && $password && $confirmpass) {
//         // Add your database connection logic here if it's not already included
//         require "./connect.php";

//         // Prepare the SQL statement using a prepared statement to prevent SQL injection
//         $stmt = $connect->prepare("INSERT INTO users (firstname, lastname, username, password)  
//                                 VALUES (?, ?, ?, ?)");

//         // Check if the passwords match before inserting
//         if ($password === $confirmpass) {
//             // Hash the password for secure storage
//             $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
//             // Bind parameters and execute the query
//             $stmt->bind_param('ssss', $firstname, $lastname, $username, $hashed_password);
//             $stmt->execute();

//             // Check if the query was successful
//             if ($stmt->affected_rows > 0) {
//                 header("Location: login.php");
//                 //echo "<div><p>Your data is stored successfully</p></div>";
//             } else {
//                 echo "<div><p>Kindly try again</p></div>";
//             }
//         } else {
//             echo "<div><p>Passwords do not match</p></div>";
//         }

//         // Close the statement and connection
//         $stmt->close();
//         $connect->close();
//     } else {
//         echo 'All fields are required';
//     }
// }


//-----------------------------------------------------------------------------------------------------

//CHECKS IF USERNAME EXISTS BEFORE PROCEEDING WITH REGISTRATION


// require('./connect.php');

// // Function to sanitize user inputs
// function sanitize_input($input) {
//     // Implement your sanitization logic here
//     // For example, you can use mysqli_real_escape_string() or other methods
//     return htmlspecialchars(trim($input));
// }

// // Check if form is submitted
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $firstname = isset($_POST['firstname']) ? sanitize_input($_POST['firstname']) : '';
//     $lastname = isset($_POST['lastname']) ? sanitize_input($_POST['lastname']) : '';
//     $username = isset($_POST['username']) ? sanitize_input($_POST['username']) : '';
//     $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';
//     $confirmpass = isset($_POST['confirmpass']) ? sanitize_input($_POST['confirmpass']) : '';

//     if ($firstname && $lastname && $username && $password && $confirmpass) {
//         // Add your database connection logic here if it's not already included
//         require "./connect.php";

//         // Check if the username already exists in the database
//         $check_query = "SELECT * FROM users WHERE username=?";
//         $check_stmt = $connect->prepare($check_query);
//         $check_stmt->bind_param('s', $username);
//         $check_stmt->execute();
//         $result = $check_stmt->get_result();

//         if ($result->num_rows > 0) {
//             echo "<div><p>Username already exists. Please choose a different username.</p></div>";
//         } else {
//             // Prepare the SQL statement using a prepared statement to prevent SQL injection
//             $insert_stmt = $connect->prepare("INSERT INTO users (firstname, lastname, username, password)  
//                                             VALUES (?, ?, ?, ?)");

//             // Check if the passwords match before inserting
//             if ($password === $confirmpass) {
//                 // Hash the password for secure storage
//                 $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//                 // Bind parameters and execute the query
//                 $insert_stmt->bind_param('ssss', $firstname, $lastname, $username, $hashed_password);
//                 $insert_stmt->execute();

//                 // Check if the query was successful
//                 if ($insert_stmt->affected_rows > 0) {
//                     header("Location: login.php");
//                     //echo "<div><p>Your data is stored successfully</p></div>";
//                 } else {
//                     echo "<div><p>Kindly try again</p></div>";
//                 }
//             } else {
//                 echo "<div><p>Passwords do not match</p></div>";
//             }

//             // Close the statement for insertion
//             $insert_stmt->close();
//         }

//         // Close the connection and statement for checking username
//         $check_stmt->close();
//         $connect->close();
//     } else {
//         echo 'All fields are required';
//     }
// }



//======================================================================================|||||||||||||||||

//INCLUDES WELL DESIGNED ALERT BOXES


require('./connect.php');

// Function to sanitize user inputs
function sanitize_input($input) {
    // Implement your sanitization logic here
    // For example, you can use mysqli_real_escape_string() or other methods
    return htmlspecialchars(trim($input));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = isset($_POST['firstname']) ? sanitize_input($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? sanitize_input($_POST['lastname']) : '';
    $username = isset($_POST['username']) ? sanitize_input($_POST['username']) : '';
    $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';
    $confirmpass = isset($_POST['confirmpass']) ? sanitize_input($_POST['confirmpass']) : '';

    if ($firstname && $lastname && $username && $password && $confirmpass) {
        // Add your database connection logic here if it's not already included
        require "./connect.php";

        // Check if the username already exists in the database
        $check_query = "SELECT * FROM users WHERE username=?";
        $check_stmt = $connect->prepare($check_query);
        $check_stmt->bind_param('s', $username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                    alert('Username already exists. Please choose a different username.');
                  </script>";
        } else {
            // Prepare the SQL statement using a prepared statement to prevent SQL injection
            $insert_stmt = $connect->prepare("INSERT INTO users (firstname, lastname, username, password)  
                                            VALUES (?, ?, ?, ?)");

            // Check if the passwords match before inserting
            if ($password === $confirmpass) {
                // Hash the password for secure storage
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Bind parameters and execute the query
                $insert_stmt->bind_param('ssss', $firstname, $lastname, $username, $hashed_password);
                $insert_stmt->execute();

                // Check if the query was successful
                if ($insert_stmt->affected_rows > 0) {
                    echo "<script>
                            alert('Registration Successful. Welcome!');
                            window.location = 'login.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Kindly try again');
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Passwords do not match');
                      </script>";
            }

            // Close the statement for insertion
            $insert_stmt->close();
        }

        // Close the connection and statement for checking username
        $check_stmt->close();
        $connect->close();
    } else {
        echo "<script>
                alert('All fields are required');
              </script>";
    }
}




?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER: TEACHER SYSTEM</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <form id="studentRegbox" class="stdmainbx hbox" method="post" action="#" >
        <p class="studentRegTitle stdmaintitle">Register Staff</p>
        <hr>
        <div class="studentRegIn stdmainin">
            <p class="studentInTitle stdmainintitle">New Staff</p>
            <div class="studentDetails stdgdatabx">
                <aside class="stda stdaside">
                    <div class="teacherIdbx sflex">
                        <p class="studentNamenm">First Name:</p>
                        <input type="text" id="teacherIdinput" name="firstname" class="sflexinp" placeholder="">
                    </div>
                    <div class="financeIdbx sflex">
                        <p class="studentNamenm">Last Name:</p>
                        <input type="text" id="financeIdinput" name="lastname" class="sflexinp" placeholder="">
                    </div>

                    <div class="financeIdbx sflex">
                        <p class="studentNamenm">UserName:</p>
                        <input type="text" id="financeIdinput" name="username" class="sflexinp" placeholder="">
                    </div>

                    <div class="tsurnamebx sflex">
                        <p class="studentNamenm">Password:</p>
                        <input type="text" id="tsurNameinput" name="password" class="sflexinp" placeholder="">
                    </div>
                    <div class="firsttnamebx sflex">
                        <p class="studentNamenm">Confirm Password:</p>
                        <input type="text" id="firsttnameinput" name="confirmpass" class="sflexinp" placeholder="">
                    </div>
                    
                </aside>
                <aside class="stdb stdaside">
                    <div class="studentProfile">
                        <img src=" ./../../abst1_slash.jpg" class="stdImg" width="50" alt="Student Profile">
                        <button id="changeProfile" onclick="changeProfile()">Change Profile</button>
                    </div>
                  
            </div>
                <p class="notif" id="regNotif"></p>

            <hr color="lightgray">
            <div class="stdActbtns">
                <div class="stdActbtnsIn">
                    <button id="saveStudent" type="submit" class="stdinfobtn">Register</button>
                </div>                
            </div>
        </div>
    </form>
</body>
</html>