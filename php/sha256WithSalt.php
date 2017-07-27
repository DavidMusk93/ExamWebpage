<?php
/**
 * Created by PhpStorm.
 * User: davidmusk
 * Date: 5/30/2017
 * Time: 10:08 PM
 */
function sha256WithSalt($plaintext, $salt=null) {
    if (!$salt) {
        $salt = bin2hex(openssl_random_pseudo_bytes(32));
        var_dump($salt);
    }
    // $mix = $pwd + $salt;  // automatic transform type by context
    $mix = $plaintext . $salt;
    return hash('sha256', $mix);
}
// var_dump(sha256WithSalt('sun'));
$salt = "834a3085cb5a158a3ce3ab89fc122c8c00376869cdaa76a7ddd7c397746a84c2";
$ciphertext = "261a28c2319d3e17dc362ff9e0f557ddcd3b968b5e84dd831abffe868e90e5c4";

function validatePassword($plaintext, $salt, $ciphertext) {
    $toBeVarified = sha256WithSalt($plaintext, $salt);
    if ($toBeVarified === $ciphertext) {
        return true;
    } else {
        return false;
    }
}
// var_dump(validatePassword('sun', $salt, $ciphertext));