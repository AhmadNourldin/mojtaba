<?php include './common/header.php' ?>
<?php require_once('./database/database.php') ?>
<?php include 'common/navbar.php' ?>
<?php session_start(); ?>

<?php

if (isset($_POST['submit'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // create query
    $query = "SELECT * from user where email = '$email' AND password = '$password';";

    // execute query
    $result = mysqli_query($conn, $query);
    $nb = mysqli_fetch_assoc($result);

    $_SESSION['id'] = $nb['id'];
    $_SESSION['role'] = $nb['role'];

    $query = "SELECT * from cart where user_id = ".$nb['id'].";";

    // execute query
    $result = mysqli_query($conn, $query);
    $nb = mysqli_fetch_assoc($result);

    $_SESSION['cart_id'] = $nb['id'];


    header("Location: Home.php", true);
}
?>


<div action="login.php " class="center">
    <h1>Login</h1>
    <form method="POST">
        <div class="txt_field">
            <input type="email" name="username" autocomplete="off" required>
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" autocomplete="off" required>
            <span></span>
            <label>Password</label>
        </div>
        <input class="account_button" name="submit" type="Submit" value="login">
        <div class="signup_link">
            Not a member ? <a href="Registration.php"> Register</a>
        </div>
    </form>
</div>