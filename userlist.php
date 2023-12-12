<?php

//List all registered users

require("./connect.php");

    // Establish database connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Prepare SQL statement with ORDER BY clause for 'name'
    $sql = "SELECT firstname, lastname, password FROM users ORDER BY name ASC";
    $stmt = $connect->prepare($sql);

    if (!$stmt) {
        die("Error in SQL query: " . $connect->error);
    }

    // Execute the prepared statement
    $stmt->execute();
    
    // Get result set
    $result = $stmt->get_result();

    // Check for data and display in HTML table
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>NO</th><th>FIRST NAME</th><th>LAST NAME</th><th>ACTIONS</th></tr>";
        
        $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$count."</td>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td><button onclick='editRow(\"".$row['lastname']."\")'>Edit</button> <button onclick='deleteRow(\"".$row['lastname']."\")'>Delete</button></td>";
        echo "</tr>";
        $count++;
    }

        echo "</table>";
    } else {
        echo "No results found.";
    }

    // Close prepared statement and database connection
    $stmt->close();
    $connect->close();



?>



<script>
    function editRow(lastname) {
        // Implement edit action using regno (registration number)
        // Redirect to an edit page or perform AJAX to edit data
        alert("Editing user with Lastname: " + lastname);
    }

    function deleteRow(lastname) {
        if (confirm("Are you sure you want to delete this user with Lastname: " + lastname + "?")) {
            // AJAX request to delete the row from the database
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // event.preventDefault();
                    alert("User with Lastname: " + lastname + " deleted successfully.");
                    // Refresh the page after successful deletion
                    // location.reload(); // Reload the current page
                }
            };
            xhr.open("POST", "./retrievedata/delete_row.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("regno=" + username);
        }
    }
</script>
