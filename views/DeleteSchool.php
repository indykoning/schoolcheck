<?php
require_once "includes/database.php";

if(isset($_POST['delete'])) {

    $sql = "DELETE FROM schools WHERE id = '" . $_POST[''] . "'";
    $result = $mysqli->query($sql);

    $sql = "DELETE FROM schools_level WHERE schoolid = '" . $_POST[''] . "'";
    $result = $mysqli->query($sql);
}

echo "ezz";
?>