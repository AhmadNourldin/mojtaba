<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=>, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/Home.css">
    <link rel="stylesheet" href="./styles/Books.css">
    <link rel="stylesheet" href="./styles/Account.css">
    <link rel="stylesheet" href="./styles/Cart.css">
    <link rel="stylesheet" href="./styles/Registration.css">
    <link rel="stylesheet" href="./styles/About.css">

    <title>Home</title>
</head>

<body class="BodyBg">
<?php require_once('./database/database.php') ?>
<?php include 'common/navbar.php' ?>
<?php
    session_start();
?>


<article>
    <?php
    // create query
    $query = "SELECT * from book INNER JOIN cartitem
on book.id = cartitem.book_id
WHERE cartitem.cart_id = ".$_SESSION["cart_id"].";";
    // execute query
    $result = mysqli_query($conn, $query);

    while ($book = mysqli_fetch_assoc($result)) {
        echo "<div class='article__container'>";
        echo "<h2> Name : " . $book['title'] . " </h2>";
        echo "<h4> Descriptions : " . $book['description'] . " </h4>";
        echo "<p> Made BY : " . $book['author'] . "|" . $book['price'] . "$</p>";
        echo "<form method='post'>
            <input type='hidden' name='del' value='".$book['book_id']."'>
            <button class='delete_btn' name='del_submit' type='submit'>Delete</button>
        </form>";
        echo "</div>";
    }
    ?>

    </article>
    <form method='post' class="cash_out">
        <button type='submit' name="check_out" id="check_out">CHECK OUT</button>
    </form>
    <?php 
    if(isset($_POST['check_out'])){
        $sql = "DELETE FROM cartitem WHERE cart_id = ".$_SESSION['cart_id'].";";
        $result = mysqli_query($conn, $sql);
        header("Location: Cart.php");
    }
    ?>
<?php
    if(isset($_POST['del_submit'])){
        $sql = "DELETE FROM cartitem where book_id = ".$_POST['del']." AND cart_id = ".$_SESSION['cart_id'].";";
        $result = mysqli_query($conn, $sql);
        header("Location: Cart.php");
    }
?>
<script>
    document.getElementById('check_out').addEventListener("click", () => {
        alert("Thanks For Buying From Our Store");})
</script>
<?php include './common/footer.php' ?>
