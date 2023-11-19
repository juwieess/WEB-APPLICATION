<!DOCTYPE html>
<html>
<head>
    <title>Delete Recipe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #808080;
            margin: 0;
            padding: 0;
        }
        .page-header {
            background-color: lightblue;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .container {
            align-items: center;
            max-width: 420px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 400px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: blue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: lightblue;
        }
        .pop-up {
            border: 1px solid green;
            padding: 10px;
            margin-top: 10px;
            background-color: lightgreen;
        }
        .messages {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header class="page-header">
        <h1>Delete Page</h1>
    </header>
    
    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "recipe";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if product_id is set and not empty
            if (isset($_POST['recipeName']) && !empty($_POST['recipeName'])) {
                // Sanitize input to prevent SQL injection
                $recipeName = $conn->real_escape_string($_POST['recipeName']);

                // SQL query to delete a record
                $sql = "DELETE FROM upload WHERE recipeName = '$recipeName'";

                if ($conn->query($sql) === TRUE) {
                    // Check if any rows were affected by the DELETE operation
                    if ($conn->affected_rows > 0) {
                        echo '<div class="pop-up">Record deleted successfully</div>';
                    } else {
                        echo "No record found with the provided recipeName.";
                    }
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Invalid recipeName. Please provide a valid recipeName.";
            }
        }

        // Close the database connection
        $conn->close();
        ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="recipeName">Delete Record:</label>
            <input type="text" name="recipeName" id="recipeName" autocomplete="off">
            <input type="submit" value="Delete">
        </form>
        <div class="messages">
            <p><a href="loginPage.php">Back to Main Menu</a></p>
        </div>
    </div>
</body>
</html>