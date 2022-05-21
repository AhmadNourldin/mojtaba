<?php include './common/header.php' ?>
<?php require_once('./database/database.php') ?>
<?php include 'common/navbar.php' ?>
<?php session_start();?>

<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // create query
    $query = "INSERT INTO user VALUES(NULL,'$name', '$email', '$password',2)";

    // execute query
    $result = mysqli_query($conn, $query);

    if (!$result) die('Somthing went wrong');

    $query = "SELECT * from user where name = '$name' AND email = '$email' AND password = '$password';";

    // execute query
    $result = mysqli_query($conn, $query);
    $nb = mysqli_fetch_assoc($result);

    $_SESSION['id'] = $nb['id'];
    $_SESSION['role'] = $nb['role'];

    $query = "INSERT INTO cart 
    values(NULL, 0, '".$nb['id']."');";

    // execute query
    $result = mysqli_query($conn, $query);

    $query = "SELECT * from cart where user_id = ".$nb['id'].";";

    // execute query
    $result = mysqli_query($conn, $query);
    $nb = mysqli_fetch_assoc($result);

    $_SESSION['cart_id'] = $nb['id'];

    header('Location: Home.php', true);
}
?>

<div action="registration.php " class="center">
    <h1>Register</h1>
    <form method="POST">
        <div class="txt_field">
            <input type="text" name="name" required>
            <span></span>
            <label>Full Name</label>
        </div>
        <div class="txt_field">
            <input type="text" name="email" required>
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
            <input name="password" type="password" required>
            <span></span>
            <label>Password</label>
        </div>
        <input name="submit" class="account_button" type="Submit" value="register">
        <div class="signup_link">
            Not a member ? <a href="Login.php"> Login</a>
        </div>
    </form>
</div>