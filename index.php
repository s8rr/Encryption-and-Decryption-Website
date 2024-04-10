<!DOCTYPE html>
<html>
<head>
    <title>Encryption and Decryption</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }
        input[type="text"], input[type="submit"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"], button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #45a049;
        }
        .logo {
            margin-bottom: 20px;
            max-width: 150px;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #dff0d8; /* Green background color */
            color: #3c763d; /* White text color */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Encryption and Decryption</h2>
        <form method="post">
            <label for="plaintext">Enter plaintext:</label>
            <input type="text" id="plaintext" name="plaintext">
            <input type="submit" value="Encrypt">
        </form>

        <br>

        <form method="post">
            <label for="encrypted">Enter encrypted text:</label>
            <input type="text" id="encrypted" name="encrypted">
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
                echo "<div class='result'><p><strong>Encrypted text:</strong> " . $encrypted . "</p><button onclick='copyText(\"$encrypted\")'>Copy</button></div>";
            } elseif (isset($_POST['encrypted'])) {
                $encrypted = $_POST['encrypted'];
                $decrypted = decrypt($encrypted, $key);
                echo "<div class='result'><p><strong>Decrypted text:</strong> " . $decrypted . "</p><button onclick='copyText(\"$decrypted\")'>Copy</button></div>";
            }
        }
        ?>

        <script>
            function copyText(text) {
                const input = document.createElement('textarea');
                input.value = text;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                document.body.removeChild(input);
                alert('Copied to clipboard');
            }
        </script>
    </div>
</body>
</html>
