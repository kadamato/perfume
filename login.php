<?php
$db = require("connectDB.php");
require ("helper/validateUser.php");
require ("helper/validatePassword.php");

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(empty($username) || empty($password))  {
        $error = "Fields cannot to blank";
    }
    else if(!validateUsername($username)) {
        $error = "Username is not valid";
    }
    else if(!validatePassword($password)) {
        $error = "Password must contain least  8 letters , numeric , alpha , 1 uppercase letter , 1 lowercase letter and 1 special character";
    }
    else {
        $sql = 'SELECT * FROM users WHERE  users.username = :username AND users.password = :password';
        $statement = $db->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_INT);
        $statement->bindParam(':password', $password, PDO::PARAM_INT);
        try {
            $statement->execute();
        }
        catch (Exception $e) {
            echo $e;
        }
        $users = $statement->fetch(PDO::FETCH_ASSOC);
        if($users) {
            header("Location: http://localhost/perfume/home.php");
            die();
        }
        else {
            $error = "username or password is wrong";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/styles.css"/>
    <link rel="stylesheet" href="./styles/login.css"/>
</head>
<body>
<div class="signIn">
    <div class="signIn__left">
        <div class="signIn__left__title">Welcome you back 🎇 </div>
        <p class="signIn__left__subTitle">Today is a new day. It's your day. You shape it. Sign in to start managing your projects</p>

        <form class="signInForm" method="post" action="./login.php">
            <div class="signInForm__field">
                <label class="signInForm__field__title">Username</label>
                <input type="text" placeholder="Example@gmail.com" class="signInForm__field__input" name="username" />
            </div>
            <div class="signInForm__field">
                <label class="signInForm__field__title">Password</label>
                <input type="password" placeholder="At least 8 characters" class="signInForm__field__input" name="password"/>
            </div>
            <div>
                <?php
                    echo $error;
                ?>
            </div>
            <div class="signInForm__forgotPassword">Forgot Password?</div>
            <button class="signInForm__btn"> Sign In </button>
            <p class="signInForm__signUp">Don't you have an account? <a href="./signup.php" class="signInForm__signUp__link">Sign Up</a></p>
            <div class="signInForm__reserved">© 2024 ALL RIGHTS RESERVED</div>
        </form>
    </div>
    <div class="signIn__right">
        <img src="images/signIn-cover.svg" alt="signIn-cover" class="signIn__right__coverImg"/>
    </div>
</div>
</body>
</html>