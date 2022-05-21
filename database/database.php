<?php
$conn = mysqli_connect("localhost", "root", "", "library");
if ($error = mysqli_connect_errno()) {
    die("Connection failed: " . $error);
}
