<?php
include("connect.php");

if (isset($_POST["submit"])) {
    $recipeName = $_POST["repName"];
    $recipeIng = $_POST["repIng"];
    $recipeSteps = $_POST["repSteps"];

    // For uploads photos
    $upload_dir = "uploads/";
    $recipeImage = $upload_dir . $_FILES["imageUpload"]["name"];
    $upload_file = $upload_dir . basename($_FILES["imageUpload"]["name"]);
    $imageType = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
    $check = $_FILES["imageUpload"]["size"];
    $upload_ok = 1; // Initialize to 1

    if (file_exists($upload_file)) {
        echo "<script>alert('The file already exists')</script>";
        $upload_ok = 0; // Set to 0 to indicate an issue
    } else {
        if ($check === 0) {
            echo '<script>alert("The photo size is 0 or the file is empty. Please select a valid photo.")</script>';
            $upload_ok = 0;
        } else {
            if (!in_array($imageType, ['jpg', 'jpeg', 'png', 'gif'])) {
                echo '<script>alert("Please change the image format to jpg, jpeg, png, or gif.")</script>';
                $upload_ok = 0;
            }
        }
    }

    if ($upload_ok === 1) { // Check for a successful check
        if ($recipeName !== "") {
            move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $upload_file);

            // Use prepared statement to prevent SQL injection
            $sql = "INSERT INTO upload (recipeName, recipeIng, recipeSteps, recipeImage) VALUES (?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $recipeName, $recipeIng, $recipeSteps, $recipeImage);

            if ($stmt->execute()) {
                echo "<script>alert('Your recipe was uploaded successfully')</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "')</script>";
            }

            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .page-header {
        background-color: lightblue;
        color: white;
        text-align: center;
        padding: 20px;
        margin-bottom: 20px;
    }

    .container {
        max-width: 800px; 
        margin: 0 auto;
        padding: 40px 40px; 
        background-color: #fff;
        border-radius: 5px;
        text-align: center;
    }

    #upload_container form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #upload_container form input,
    #upload_container form select {
        margin: 15px 0;
        padding: 15px;
        outline: none;
        background: white;
        border: 1px solid cyan;
        width: 100%; 
        box-sizing: border-box; 
    }

    #upload_container form button {
        padding: 15px; 
        background-color: lightblue;
        color: white;
        border: none;
        cursor: pointer;
    }

    #upload_container form button:hover {
        background-color: blue;
    }

    .messages {
        text-align: center;
        font-size: 15px;
        margin-top: 10px;
    }

    .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
    }
</style>
</head>

<body>

    <header class="page-header">
        <h1>Insert Recipe</h1>
    </header>

    <div class="container">
        <section id="upload_container">
            <form action="uploadpage.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="repName" id="repName" placeholder="Recipe Name" required>
                <input type="text" name="repIng" id="repIng" placeholder="Recipe Ingredients" required>
                <input type="text" name="repSteps" id="repSteps" placeholder="Recipe Steps" required>
                <select name="category" id="category" required>
                    <option value="cake">Cakes</option>
                    <option value="cookies">Cookies</option>
                </select>
                <input type="file" name="imageUpload" id="imageUpload" style="display: none;">
                <button id="choose" onclick="upload();">Choose Image</button>

                <input type="submit" value="Upload" name="submit">
            </form>
            <div class="messages">
                <p class="back-link"><a href="loginPage.php">Back to Main Menu</a></p>
            </div>
        </section>

        <script>
            var repName = document.getElementById("repName");
            var repIng = document.getElementById("repIng");
            var repSteps = document.getElementById("repSteps");
            var choose = document.getElementById("choose");
            var uploadImage = document.getElementById("imageUpload");

function upload() {
            uploadImage.click();
        }

        uploadImage.addEventListener("change", function () {
            var file = this.files[0];
            if (repName.value === "") {
                repName.value = file.name;
            }
            choose.innerHTML = "You can change (" + file.name + ") picture";});

        </script>
    </div>
</body>

</html>