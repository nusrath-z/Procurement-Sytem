<?php

require_once 'dbh.inc.php';

//when session is set
if(isset($_SESSION['userID'])){
    updateListing($conn);
}

//when posted
if(isset($_POST['submit'])){

    //product listing form template
    $titleErr = $descErr = $priceErr = $quantErr = "";
    $title = $description = $price = $quantity = "";

    //Error handling of passed values
    //Validate title
    if(empty($_POST['name'])){
        $titleErr = "You must give this listing a title";
    } else {
        $title = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    //Validate description
    if(empty($_POST['desc'])){
        $descErr = "You must give this item a proper description";
    } else {
        $description = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    //validate price
    if(empty($_POST['price'])){
        $priceErr = "You must enter the price of this item";
    } elseif(!is_numeric($_POST['price'])){
        $priceErr = "You must enter a number for the price";
    } else {
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
    }

    //Validate quantity
    if(empty($_POST['quantity'])){
        $quantErr = "You must enter current quantity of this item";
    } elseif(!is_numeric($_POST['quantity'])){
        $quantErr = "You must enter a number for the quantity";
    } else {
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    }

    //validate item ID
    if(!empty($_POST['itemID'])){
        $id = $_POST['itemID'];
    }

    //defining userID
    $userID = $_SESSION["userID"];

    //if all passes run functions
    if(empty($titleErr) && empty($descErr) && empty($priceErr) && empty($quantErr)){

        //test to see which sql function to create
        if(!isset($id)){
            $sql = "INSERT INTO inventory (itemName, itemDesc, itemPrice, itemQuantity, itemOwnerID) VALUES ('$title', '$description', '$price', '$quantity', '$userID')";
            $path = "supplier.php?success=true";
        } elseif(isset($id)){
            $sql = "UPDATE inventory SET itemName='$title', itemDesc='$description', itemPrice='$price', itemQuantity='$quantity' WHERE itemID=$id";
            $path = "edit_item.php?success=true&index=".$_GET['index'];
        }

        manageInventory($conn, $sql,$path);
        updateListing($conn);
    
    } else{
        $hasErr = true;
    }
}

//managing inventory
function manageInventory($conn, $sql,$path){

    if(mysqli_query($conn, $sql)){
        header("location: ./".$path);
    } else {
        echo 'Error ' . mysqli_error($conn); 
    }
}

//set the listing array to the session
function updateListing($conn){

    $value = $_SESSION['userID'];
    $sql = "SELECT * FROM inventory WHERE itemOwnerID = '$value'";

    //retrieve array of lists
    $result = mysqli_query($conn, $sql);
    $listings = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $_SESSION['listings'] = $listings;
}

function deleteListing($conn,$itemID){
    $sql = "DELETE FROM 'inventory' WHERE 'inventory'.'itemID' = $itemID";

    //retrieve array of lists
    mysqli_query($conn, $sql);
    updateListing($conn);

}

?>