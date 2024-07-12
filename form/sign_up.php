<?php
session_start();

$email_error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users_info";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $stmt_check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();

    if ($result_check_email->num_rows > 0) {
        $email_error_message = "The email you entered is already registered.";
    } else {
        $email = $conn->real_escape_string($email);
        $name = $conn->real_escape_string($name);
        $pass = password_hash($pass, PASSWORD_BCRYPT);

        $stmt_insert_user = $conn->prepare("INSERT INTO users (email, name, password) VALUES (?, ?, ?)");
        $stmt_insert_user->bind_param("sss", $email, $name, $pass);

        if ($stmt_insert_user->execute()) {
            $_SESSION['email_error_message'] = "";
            header("Location: http://localhost:63342/GroupProject/index.php");
            exit();
        } else {
            $email_error_message = "Failed to register user.";
        }
        $stmt_insert_user->close();
    }
    $stmt_check_email->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sign_up.css">
</head>
<body>
<form action="/sign_up.php" method="post">
    <div class="sigh_up_form_container">
        <h2 class="sign_up_form_heading">SignUp</h2>
        <div class="sign_up_form_inputs">
            <div class="sign_up_forms">
                <label for="sign-up-email" class="sign_up_forms_login_text">Email</label>
                <input type="email" id="sign-up-email" required="true" placeholder="Enter email" class="sign_up_forms_input" name="email">
            </div>
            <div class="sign_up_forms">
                <label for="sign-up-name" class="sign_up_forms_login_text">Name</label>
                <input type="text" id="sign-up-name" required="true" placeholder="Enter your name" class="sign_up_forms_input" name="name">
            </div>
            <div class="sign_up_forms">
                <div class="hide_password_container">
                    <label for="sign-up-password" class="sign_up_forms_login_text">Password</label>
                    <div class="hide_password_container_button">
                        <img src="/images/forms/eye_unchecked.png" alt="" class="hide_password_img" id="hide_pass_img">
                        <span class="sign_up_forms_login_text">Hide</span>
                    </div>
                </div>
                <input type="password" id="sign-up-password" required="true" placeholder="Enter your password" class="sign_up_forms_input" name="pass">
            </div>
            <span class="sign_up_forms_login_email_check">
                <?php echo $email_error_message; ?>
            </span>
        </div>
        <div class="sign_up_buttons">
            <button type="submit" class="sign_up_button sighbutton"><span class="sign_up_button_text">Create an account</span></button>
        </div>
        <span class="sign_up_forms_login_text center" id="sign_up_sign_in">Already have an account? SignIn</span>
    </div>
</form>
</body>
</html>
