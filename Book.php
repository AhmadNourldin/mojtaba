<?php include './common/header.php' ?>
<?php require_once('./database/database.php') ?>
<?php session_start(); ?>


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


<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    // create query
    $query = "INSERT INTO book (title, description, author, price, category_id) VALUES('$title', '$description', '$author', $price, $category_id)";
    // execute query
    $result = mysqli_query($conn, $query);

    if (!$result) die('Somthing went wrong');
}

if (isset($_POST['addToCart'])) {
    $book_id = $_POST['book_id'];
    if(isset($_SESSION['role']) && $_SESSION['role'] == 2){
        $query = "INSERT INTO cartitem 
        values(".$book_id.", ".$_SESSION['cart_id'].");";
        $result = mysqli_query($conn, $query);
    }else{
        header("Location: Registration.php");
    }
}

?>



<div class="header">
    <h1><?php echo $_GET['title'] ?></h1>
    <div class="search_icon">
        <form method="GET">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
            <input type="hidden" name="title" value="<?php echo $_GET['title'] ?>" />
            <input class="searchBar" type="text" name="text" value="<?php if (isset($_GET['text'])) echo $_GET['text'] ?>" class="input_container" placeholder="search...">
            <input type="submit" name="search" class="cart__button">
        </form>
    </div>
</div>

<a href="Home.php" class="Return__Home"><img src="icons_return.png">Home Page</a>

<div>
    <article>
        <?php
        // create query
        $query = "SELECT * FROM book WHERE category_id = " . $_GET['id'];
        if (isset($_GET['text'])) {
            $text = $_GET['text'];
            $query = $query . " AND title LIKE '%" . $text . "%'";
        }
        // execute query
        $result = mysqli_query($conn, $query);

        while ($book = mysqli_fetch_assoc($result)) {
            echo "<div class='article__container'>";
            echo "<h2> Name : " . $book['title'] . " </h2>";
            echo "<h4>Descriptions : " . $book['description'] . " </h4>";
            echo "<p> Made BY : " . $book['author'] . "|" . $book['price'] . "$</p>";
            echo '<form method="POST">
                <input type="hidden" name="book_id" value=' . $book['id'] . '>
                <button type="submit" name="addToCart" class="cart__button" >Add To cart</button>
            </form>';
            echo "</div>";
        }
        ?>

    </article>

<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == 1){
        echo '    <form method="POST" class="book_form_container">
        <input type="hidden" name="category_id" value="'.$_GET['id'].'" />
        <input required class="input_container" type="text" name="title" placeholder="title" />
        <textarea required class="input_container" type="text" name="description" placeholder="description"></textarea>
        <input required class="input_container" type="text" name="author" placeholder="author" />
        <input required class="input_container" type="number" name="price" placeholder="price" />
        <input required class="input_submit" type="submit" name="submit" />
    </form>';
    }else{
        echo "";
    }
?>

</div>

<?php include './common/footer.php' ?>