<?php

namespace backend;

use DateTime;

class ShoppingList
{

    /**
     * @param $note
     * @param $shoppingList
     * @return void
     *
     * Creates a full shopping list in the table shopping_lists
     *
     */
    public static function create($note, $shoppingList) {
        global $db;
        $timestamp = time();

        $query = "INSERT INTO shopping_lists (note, list, created_at) VALUES (?, ?, ?)";

        $statement = $db->prepare($query);
        $statement->bind_param("ssi", $note, $shoppingList, $timestamp);
        $statement->execute();

        exit();
    }


    /**
     * @param $id
     * @return void
     *
     * Deletes a shopping list in table shopping_lists
     *
     */
    public static function delete($id) {
        global $db;

        $query = "DELETE FROM shopping_lists WHERE id = ?";
        $statement = $db->prepare($query);
        $statement->bind_param("s", $id);
        $statement->execute();

        exit();
    }

}