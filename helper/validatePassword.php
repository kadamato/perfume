<?php
function validatePassword($password) {
    // Regular expression for password validation
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

    // Use preg_match to perform the validation
    if (preg_match($pattern, $password)) {
        return true; // Password is valid
    } else {
        return false; // Password is not valid
    }
}
?>