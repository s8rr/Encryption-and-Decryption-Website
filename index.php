<?php
function encrypt($plaintext, $key) {
    $cipher_method = 'AES-256-CBC';
    $iv_length = openssl_cipher_iv_length($cipher_method);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $ciphertext = openssl_encrypt($plaintext, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
    $encrypted = base64_encode($iv . $ciphertext);
    return $encrypted;
}
// github.com/s8rr // discord : theigl
function decrypt($encrypted, $key) {
    $cipher_method = 'AES-256-CBC';
    $iv_length = openssl_cipher_iv_length($cipher_method);
    $encrypted = base64_decode($encrypted);
    $iv = substr($encrypted, 0, $iv_length);
    $ciphertext = substr($encrypted, $iv_length);
    $plaintext = openssl_decrypt($ciphertext, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
    return $plaintext;
}

// Example usage:
$key = "YourSecretKey"; // Change this to your secret key

$plaintext = "Hello, world!";
$encrypted = encrypt($plaintext, $key);
echo "Encrypted: " . $encrypted . "\n";

$decrypted = decrypt($encrypted, $key);
echo "Decrypted: " . $decrypted . "\n";
?>
