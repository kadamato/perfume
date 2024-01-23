<?php
function validateUsername($username) {
    // Allow only alphanumeric characters, underscores, and hyphens
    $pattern = "/^[a-zA-Z0-9]+$/";

    if (preg_match($pattern, $username)) {
        return true; // Valid username
    } else {
        return false; // Invalid username
    }
}
?>