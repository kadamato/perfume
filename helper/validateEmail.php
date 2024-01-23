<?php
function validateEmail($email) {
    // Define the regular expression pattern for a valid email address
    $pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    // Use preg_match to perform the validation
    if (preg_match($pattern, $email)) {
        return true; // Valid email address
    } else {
        return false; // Invalid email address
    }
}

?>