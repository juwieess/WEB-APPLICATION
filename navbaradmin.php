<html>
<head>
<title>Glihttr's</title>
<link rel="stylesheet" type="text/css" href="homepage2.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            text-align: center;
        }

        header {
            color: pink;
            text-align: center; 
        }
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: white;
    font-family: 'Poppins', sans-serif;
}

.dropdownmenu ul, .dropdownmenu li {
    list-style: none;
    margin: 0;
    padding: 0;
}

.dropdownmenu ul {
    background: lightpink;
    width: 100%;
    position: relative;
    display: flex;
    justify-content: space-around;
}

.dropdownmenu li {
    position: relative;
    width: auto;
}

.dropdownmenu a {
    background: lightpink;
    color: white;
    display: block;
    font-weight: bold;
    font-size: 20px;
    text-align: center;
    text-decoration: none;
    padding: 30px 40px;
    transition: all 0.25s ease;
}

.dropdownmenu li:hover a {
    background: #F8C8DC;
}

#submenu, #submenu-login {
    position: absolute;
    top: 100%;
    left: 0;
    visibility: hidden;
    opacity: 0;
    z-index: 1;
    width: 100%;
    display: flex;
    flex-direction: column;
}

li:hover #submenu, li:hover #submenu-login {
    visibility: visible;
    opacity: 1;
    top: 100%;
}

#submenu li, #submenu-login li {
    float: none;
    width: 100%;
}

#submenu a, #submenu-login a {
    background-color: #FFC0CB;
}

#submenu a:hover, #submenu-login a:hover {
    background: #F88379;
</style>
</head>

<body>
<nav class="dropdownmenu">
        <ul>
            <li><a href="loginPage.php">Home</a></li>
            <li><a href="uploadpage.php">Insert Recipes</a></li>
            <li><a href="update.php">Update Recipes</a>
            <li><a href="delete.php">Delete Recipes</a></li>
            </ul>
            </li>
        </ul>
</nav>