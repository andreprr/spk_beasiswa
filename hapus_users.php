<?php

$id=$_GET['id'];

$sql = "DELETE FROM users WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=users");
}
$conn->close();
?>