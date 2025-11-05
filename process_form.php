<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Submission Status</title>

    <style>

        body { font-family: sans-serif; background-color: #f4f4f4; margin: 40px; text-align: center; }

        .message { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }

        .success { color: #4CAF50; }

        .error { color: #f44336; }

        a { color: #007BFF; text-decoration: none; }

    </style>

</head>

<body>

    <div class="message">

        <?php

header("Access-Control-Allow-Origin: *");

        

        // Add these two lines for debugging during development

        // They will show you any errors instead of a blank page.

        ini_set('display_errors', 1);

        error_reporting(E_ALL);

        // --- Check if the form was submitted ---

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // --- Database Connection Details ---

            $servername = "127.0.0.1";

            $username = "webapp_user";

            $password = "Ubuntu@1235";

            $dbname = "webapp_db";

            // --- 1. Create Connection ---

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection

            if ($conn->connect_error) {

                die("<h2 class='error'>Connection Failed: " . $conn->connect_error . "</h2>");

            }

            // --- 2. Retrieve Data from Form ---

            $name = $_POST['user_name'];

            $email = $_POST['user_email'];

            // --- 3. Create a table if it doesn't exist ---

            $table_sql = "CREATE TABLE IF NOT EXISTS users (

                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

                name VARCHAR(50) NOT NULL,

                email VARCHAR(50),

                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

            )";

            $conn->query($table_sql);

            // --- 4. Prepare and Execute SQL INSERT Statement (SECURE METHOD) ---

            $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");

            $stmt->bind_param("ss", $name, $email);

            if ($stmt->execute()) {

                echo "<h2 class='success'>New record created successfully!</h2>";

                echo "<p>Thank you, " . htmlspecialchars($name) . ", your data has been submitted.</p>";

            } else {

                echo "<h2 class='error'>Error: " . $stmt->error . "</h2>";

            }

            $stmt->close();

            $conn->close();

        } else {

            // This message will show if someone tries to access the PHP file directly

            echo "<h2 class='error'>Error: Form not submitted.</h2>";

            echo "<p>Please fill out the form first.</p>";

            echo '<p><a href="index.html">Go to form</a></p>';

        }

        ?>

    </div>

</body>

</html>
