<!DOCTYPE html>
<html>
<head>
    <title>Encryption and Decryption</title>
</head>
<body>
    <h2>Encryption and Decryption</h2>
    <form method="post">
        <label for="plaintext">Enter plaintext:</label><br>
        <input type="text" id="plaintext" name="plaintext"><br><br>
        <input type="submit" value="Encrypt">
    </form>

    <br>

    <form method="post">
        <label for="encrypted">Enter encrypted text:</label><br>
        <input type="text" id="encrypted" name="encrypted"><br><br>
        <input type="submit" value="Decrypt">
    </form>

    <?php
    function encrypt($plaintext, $key) {
        $cipher_method = 'AES-256-CBC';
        $iv_length = openssl_cipher_iv_length($cipher_method);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $ciphertext = openssl_encrypt($plaintext, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
        $encrypted = base64_encode($iv . $ciphertext);
        return $encrypted;
    }

    function decrypt($encrypted, $key) {
        $cipher_method = 'AES-256-CBC';
        $iv_length = openssl_cipher_iv_length($cipher_method);
        $encrypted = base64_decode($encrypted);
        $iv = substr($encrypted, 0, $iv_length);
        $ciphertext = substr($encrypted, $iv_length);
        $plaintext = openssl_decrypt($ciphertext, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }

    $key = "YourSecretKey"; // Change this to your secret key

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['plaintext'])) {
            $plaintext = $_POST['plaintext'];
            $encrypted = encrypt($plaintext, $key);
            echo "Encrypted text: " . $encrypted . "<br>";
        } elseif (isset($_POST['encrypted'])) {
            $encrypted = $_POST['encrypted'];
            $decrypted = decrypt($encrypted, $key);
            echo "Decrypted text: " . $decrypted . "<br>";
        }
    }
    ?>
</body>
</html>
