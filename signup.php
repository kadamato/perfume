<?php
    require ("helper/validateUser.php");
    require ("helper/validateEmail.php");
    require ("helper/validatePassword.php");
    $db = require("connectDB.php");

    $error = "";
    $success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rePassword = $_POST["rePassword"];

        if(empty($username) ||  empty($email) || empty($password) || empty($rePassword))  {
            $error = "Fields cannot to blank";
        }
        else if(!validateUsername($username)) {
            $error = "Username is not valid";
        }
        else if (!validateEmail($email)) {
            $error = "Email is not valid";
        }
        else if(!validatePassword($password)) {
            $error = "Password must contain least  8 letters , numberic , alpha , 1 uppercase letter , 1 lowercase letter and 1 special character";
        }
       else if (!$password ==  $rePassword) {
            $error = "Password and re-password must same";
       }
       else {
           $sql = 'SELECT * FROM users WHERE  users.username = :username';
           $statement = $db->prepare($sql);
           $statement->bindParam(':username', $username, PDO::PARAM_INT);
           $statement->execute();
           $users = $statement->fetch(PDO::FETCH_ASSOC);
           if($users) {
               $error = "Account already exist";
           }
           else {
               $stmt = $db->prepare("INSERT INTO users  (username, email, password) VALUES (:username,:email,:password)");
               $stmt->bindParam(':username', $username);
               $stmt->bindParam(':email', $email);
               $stmt->bindParam(':password', $password);

               try {
                   $stmt->execute();
                   $success = true;
                   header("Location: http://localhost/perfume/login.php");
                   die();
               }
               catch (Exception $e) {
                   $error = "Sign up failed, try again!";
               }
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

    <style>
        .signUp__error {
            color: #e73d3d;
            font-size: 15px;
        }
    </style>
</head>
<body>
<div class="signIn">
    <div class="signIn__left">
        <div class="signIn__left__title">Welcome </div>
        <p class="signIn__left__subTitle">Signup to receive more incentives when buying perfume</p>

        <form class="signInForm" method="post" action="./signup.php">
            <div class="signInForm__field">
                <label class="signInForm__field__title">Username</label>
                <input type="text" placeholder="Enter your username" class="signInForm__field__input" name="username" />
            </div>
            <div class="signInForm__field">
                <label class="signInForm__field__title">Email</label>
                <input type="email" placeholder="Example@gmail.com" class="signInForm__field__input"  name="email"/>
            </div>
            <div class="signInForm__field">
                <label class="signInForm__field__title">Password</label>
                <input type="password" placeholder="At least 8 characters" class="signInForm__field__input" name="password"/>
            </div>
            <div class="signInForm__field">
                <label class="signInForm__field__title">Re-password</label>
                <input type="password" placeholder="At least 8 characters" class="signInForm__field__input" name="rePassword"/>
            </div>
            <div class="signUp__error">
            <?php
                echo $error;
            ?>
            </div>
            <button class="signInForm__btn"> Sign Up </button>
            <p class="signInForm__signUp">Do you have an account? <a href="./login.php" class="signInForm__signUp__link">Sign In</a></p>
            <div class="signInForm__reserved">© 2024 ALL RIGHTS RESERVED</div>
        </form>
    </div>
    <div class="signIn__right">
        <img src="images/signUp-cover.svg" alt="signIn-cover" class="signIn__right__coverImg"/>
    </div>
</div>
</body>
</html>