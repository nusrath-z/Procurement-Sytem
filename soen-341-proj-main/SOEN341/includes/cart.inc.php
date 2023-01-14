<?php

    require_once 'dbh.inc.php';

    function displayCart(){

        $cart = $_SESSION['cart'];
        $cleanedCart= array();

        foreach ($cart as $entry) {
            $cleanedCart[$entry['itemID']][] = $entry;
        }

        return $cleanedCart;
    }

    function findItem($conn, $itemID){

        $sql = "SELECT * FROM inventory WHERE itemID = '$itemID'";

        //retrieve item
        $result = mysqli_query($conn, $sql);
        $item = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $item;

    }

?>