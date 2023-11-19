<!DOCTYPE html>
<html>
<head>
    <title>Update Recipe</title>
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
            background-color: lightblue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: blue;
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
        <h1>Update Page</h1>
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
            // Check if recipeName is set and not empty
            if (isset($_POST['recipeName']) && !empty($_POST['recipeName'])) {
                // Sanitize input to prevent SQL injection
                $recipeName = $conn->real_escape_string($_POST['recipeName']);

                // Check if recipeIng and recipeSteps are set and not empty
                if (isset($_POST['recipeIng']) && !empty($_POST['recipeIng']) &&
                    isset($_POST['recipeSteps']) && !empty($_POST['recipeSteps'])) {
                    $recipeIng = $conn->real_escape_string($_POST['recipeIng']);
                    $recipeSteps = $conn->real_escape_string($_POST['recipeSteps']);

                    // SQL query to update a record
                    $sql = "UPDATE upload SET recipeIng = '$recipeIng', recipeSteps = '$recipeSteps' WHERE recipeName = '$recipeName'";

                    if ($conn->query($sql) === TRUE) {
                        // Check if any rows were affected by the UPDATE operation
                        if ($conn->affected_rows > 0) {
                            echo '<div class="pop-up">Record updated successfully</div>';
                        } else {
                            echo "No record found with the provided product_id.";
                        }
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    echo "Invalid product_name or price. Please provide valid values.";
                }
            } else {
                echo "Invalid product_id. Please provide a valid product_id.";
            }
        }

        // Close the database connection
        $conn->close();
        ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="recipeName">Recipe Name:</label>
            <input type="text" name="recipeName" id="recipeName" autocomplete="off">
            <label for="recipeIng">Recipe Ingredients:</label>
            <input type="text" name="recipeIng" id="recipeIng" autocomplete="off">
            <label for="price">Recipe Steps:</label>
            <input type="text" name="recipeSteps" id="recipeSteps" autocomplete="off">
            <input type="submit" value="Update">
        </form>
        <div class="messages">
            <p><a href="loginPage.php">Back to Main Menu</a></p>
        </div>
    </div>
</body>
</html>