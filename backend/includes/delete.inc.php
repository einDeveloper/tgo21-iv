<?php

use backend\ShoppingList;

require "db.inc.php";
require "../ShoppingList.php";

if (isset($_POST['id'])) {
    ShoppingList::delete($_POST['id']);

} else {
    header("Location: ../../index.php");
}

exit();