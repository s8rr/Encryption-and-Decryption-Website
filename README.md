# Encryption and Decryption Web Application

This is a simple web application that allows users to encrypt and decrypt text using AES-256-CBC encryption. It's built with PHP and can be deployed on an Nginx web server.

## Setup Guide

Follow these steps to set up the Encryption and Decryption web application on your Nginx server:

### Prerequisites

- PHP installed on your server. You can install PHP using your package manager. For example, on Ubuntu, you can run:

```sudo apt-get update```   
```sudo apt-get install php```

- Nginx web server installed and configured. If Nginx is not installed, you can install it using your package manager.

### Installation

1. Clone this repository to your server using Git:
git clone https://github.com/s8rr/encryption-decryption-website.git


3. Place your logo image file in the directory and name it `logo.png`. Ensure it's a suitable size for the layout.

### Configuration

1. Open the `index.php` file in a text editor.

2. Replace `"YourSecretKey"` with your desired secret key. This key will be used for encryption and decryption. Make sure it's a strong and secure key.

### Nginx Configuration

1. Create a new server block configuration file for your domain in the Nginx `sites-available` directory. For example:

```sudo nano /etc/nginx/sites-available/yourdomain.com```
Replace `yourdomain.com` with your actual domain name.

2. Add the following configuration to the file, replacing `yourdomain.com` with your actual domain name and the path to the directory where the web application is located:
`server {
listen 80;
server_name yourdomain.com;`


   root /path/to/encryption-decryption-web;
   index index.php;

   location / {
       try_files $uri $uri/ /index.php?$args;
   }

   location ~ \.php$ {
       include snippets/fastcgi-php.conf;
       fastcgi_pass unix:/run/php/php7.4-fpm.sock; # Adjust PHP version if necessary
   }


4. Save and close the file.

5. Create a symbolic link to enable the server block:

``sudo ln -s /etc/nginx/sites-available/yourdomain.com /etc/nginx/sites-enabled/``

5. Test the Nginx configuration for syntax errors:

6. If the test is successful, reload Nginx to apply the changes:

``sudo systemctl reload nginx``

### Accessing the Web Application

You can now access the Encryption and Decryption web application by navigating to your domain in a web browser.

## Usage

1. Enter the text you want to encrypt or decrypt in the respective text fields.

2. Click the "Encrypt" button to encrypt text or the "Decrypt" button to decrypt text.

3. The result will be displayed below the form. You can click the "Copy" button to copy the encrypted or decrypted text to the clipboard.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
