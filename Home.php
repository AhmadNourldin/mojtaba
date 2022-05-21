<?php include './common/header.php' ?>
<?php require_once('./database/database.php') ?>
<?php
    session_start();
?>

<?php
if (isset($_POST['submit'])) {
    $category = $_POST['category'];

    // create query
    $query = "INSERT INTO category (title) VALUES('$category')";

    // execute query
    $result = mysqli_query($conn, $query);

    if (!$result) die('Somthing went wrong');
}
?>

<?php
if(isset($_SESSION['cart_id'])){
    $sql = "SELECT COUNT(cart_id) FROM cartitem WHERE cart_id = ".$_SESSION['cart_id'].";";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_assoc($result);
    $count =  $arr['COUNT(cart_id)'];
    if((isset($_SESSION['role']) && $_SESSION["role"] == 1) OR (isset($_SESSION['role']) && $_SESSION["role"] == 2)){
        $serverSet = $_SERVER["PHP_SELF"];
        echo '<a href="Cart.php" class="cart__icons">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve">
<path d="M7,12V4c0-0.553-0.448-1-1-1H1C0.448,3,0,3.447,0,4s0.448,1,1,1h4v7v1v24v1v9c0,0.553,0.448,1,1,1h7.031
	C11.806,48.912,11,50.359,11,52c0,2.757,2.243,5,5,5s5-2.243,5-5c0-1.641-0.806-3.088-2.031-4h21.062C38.806,48.912,38,50.359,38,52
	c0,2.757,2.243,5,5,5s5-2.243,5-5c0-1.641-0.806-3.088-2.031-4H52c0.552,0,1-0.447,1-1s-0.448-1-1-1H7v-8h53V12H7z M16,55
	c-1.654,0-3-1.346-3-3s1.346-3,3-3s3,1.346,3,3S17.654,55,16,55z M43,55c-1.654,0-3-1.346-3-3s1.346-3,3-3s3,1.346,3,3
	S44.654,55,43,55z M7,22h51v6H7V22z M58,20H7v-6h51V20z M7,36v-6h51v6H7z"/>
<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
        '.$count.'</a>';
    }else{
        echo '<a href="Cart.php" class="cart__icons">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve">
<path d="M7,12V4c0-0.553-0.448-1-1-1H1C0.448,3,0,3.447,0,4s0.448,1,1,1h4v7v1v24v1v9c0,0.553,0.448,1,1,1h7.031
	C11.806,48.912,11,50.359,11,52c0,2.757,2.243,5,5,5s5-2.243,5-5c0-1.641-0.806-3.088-2.031-4h21.062C38.806,48.912,38,50.359,38,52
	c0,2.757,2.243,5,5,5s5-2.243,5-5c0-1.641-0.806-3.088-2.031-4H52c0.552,0,1-0.447,1-1s-0.448-1-1-1H7v-8h53V12H7z M16,55
	c-1.654,0-3-1.346-3-3s1.346-3,3-3s3,1.346,3,3S17.654,55,16,55z M43,55c-1.654,0-3-1.346-3-3s1.346-3,3-3s3,1.346,3,3
	S44.654,55,43,55z M7,22h51v6H7V22z M58,20H7v-6h51V20z M7,36v-6h51v6H7z"/>
<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
        0</a>';
    }
}
?>

<?php include 'common/navbar.php' ?>
<h1 class="container_title">Choose a category</h1>
<div class="cards_container">
    <?php
    // create query
    $query = "SELECT * FROM category";

    // execute query
    $result = mysqli_query($conn, $query);

    while ($record = mysqli_fetch_assoc($result)) {
        $category_id = $record['id'];
        $category = $record['title'];

        echo "<div class='card'>
                    <h4><a class=\"category_title\" href=\"Book.php?id=$category_id&title=$category\">$category</a></h4>
                </div>";
    }
    ?>
</div>




<article class="main__article">
    <div class="article_container">
       <h2>LIBRARY:</h2>
        <p>
            "As gateways to knowledge and culture, libraries play a fundamental role in society. The resources and services they offer create opportunities for learning, support literacy and education, and help shape the new ideas and perspectives that are central to a creative and innovative society"
        </p>
    </div>
    <div class="article_container">
        <h2>Book:</h2>
        <p>
            Books play a quintessential role in every student's life by introducing them to a world of imagination, providing knowledge of the outside world, improving their reading, writing and speaking skills as well as boosting memory and intelligence
        </p>
    </div>
    <div class="article_container">
        <h2>IMPORTANT OF READING BOOKS:</h2>
        <p>
            Reading is good for you because it improves your focus, memory, empathy, and communication skills. It can reduce stress, improve your mental health, and help you live longer. Reading also allows you to learn new things to help you succeed in your work and relationships
        </p>
    </div>
</article>
<?php
    if(isset($_SESSION['role']) && $_SESSION["role"] == 1){
        $serverSet = $_SERVER["PHP_SELF"];
        echo '<form action="'.$serverSet.'" style="display:flex; justify-content:center;align-items:center" method="POST">
    <input class="input_container" name="category" type="text" placeholder="category" required />
    <input class="input_submit" type="submit" name="submit" />
</form>';
    }else{
        echo "";
    }
?>


<?php include './common/footer.php' ?>