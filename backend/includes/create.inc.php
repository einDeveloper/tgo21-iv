<?php

use backend\ShoppingList;

require "db.inc.php";
require "../ShoppingList.php";

if (isset($_POST['note']) && isset($_POST['list'])) {
    $note = $_POST['note'];
    $list = $_POST['list'];

    ShoppingList::create($note, $list);

    header("Refresh: 0; ../../index.php");
    exit();
} else {
    header("Location: ../../index.php");
    exit();
}