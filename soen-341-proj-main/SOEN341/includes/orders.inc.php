<?php

    require_once 'dbh.inc.php';

    if(isset($_SESSION['userID'])){
       updateSession($conn);
    }

    //when session is set
    if(isset($_SESSION['orderID'])){
        $orderID = $_SESSION['orderID'];
        $_SESSION['cart'] = getOrder($conn,$orderID);
    }

    if(isset($_POST['submit'])){

        //validate item ID
        if(!empty($_POST['itemID'])){
            $id = $_POST['itemID'];
            addItem($conn,$id);
        }

        if(!empty($_POST['total']) && $_POST['total'] > 0){
            $orderID = $_SESSION['orderID'];
            processOrder($conn,$orderID);
        }

    }

    function processOrder($conn,$orderID){

        $order = getOrderInfo($conn,$orderID);

        $status = $order[0]["status"];
        $total = $order[0]["total"];
        $result = "";

        if($total < 5000){
            $status = 2;
            $approval = 1;
            $result = "success";
        }elseif($total >= 5000){
            $status = 1;
            $approval = 0;
            $result = "approval";
        }

        setStatuses($conn,$orderID,$status,$approval);
        createOrder($conn);
        updateSession($conn);

        header("location: ./client.php?status=".$result);

    }

    function setStatuses($conn,$orderID,$status,$approval){

        $sql = "UPDATE orders SET approval = '$approval' WHERE orderID = '$orderID'";
        mysqli_query($conn, $sql);

        $sql = "UPDATE orders SET status = '$status' WHERE orderID = '$orderID'";
        mysqli_query($conn, $sql);
        
        updateSession($conn);
    }

    function getOrderInfo($conn,$orderID){

        $sql = "SELECT * FROM orders WHERE orderID = '$orderID'";

        $result = mysqli_query($conn, $sql);
        $order = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $order;
    }

    function addItem($conn,$itemID){
        //fetch user ID
        $orderID = $_SESSION['orderID'];
        $sql = "INSERT INTO orderlist (itemID, itemQuantity, orderID) VALUES ('$itemID','1','$orderID')";

        //make sql query
        if(mysqli_query($conn, $sql)){
            header("location: ./view_item.php?success=true&index=".$_GET['index']);
        } else {
            echo 'Error ' . mysqli_error($conn);
        }
    }

    function createOrder($conn){
        //fetch user ID
        $userID = $_SESSION['userID'];
        $sql = "INSERT INTO orders (orderPlacerID, total) VALUES ('$userID', '0')";

        //make sql query
        mysqli_query($conn, $sql);

        updateSession($conn);
    }

    function updateSession($conn){
        //fetch user ID
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM orders WHERE orderPlacerID = '$userID'";

        //retrieve order
        $result = mysqli_query($conn, $sql);
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        if($orders == null){

            createOrder($conn);

        }else{

            $_SESSION['orders'] = $orders;

            //count amount of orders
            $orderAmt = count($_SESSION['orders']);

            //fetch most recent order ID
            $orderID = $orders[$orderAmt-1]["orderID"];

            $_SESSION['orderID'] = $orderID;
        }
    }

    function getOrder($conn,$orderID){
        $sql = "SELECT * FROM orderlist WHERE orderID = '$orderID'";

        //retrieve array of lists
        $result = mysqli_query($conn, $sql);
        $order = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $order;
    }

    function setTotal($conn,$total){
        //fetch user ID
        $orderID = $_SESSION['orderID'];
        $sql = "UPDATE orders SET total = '$total' WHERE orderID = '$orderID'";

        //make sql query
        mysqli_query($conn, $sql);

        updateSession($conn);
    }

    function deleteOrder($conn,$orderID){

        $sql = "DELETE FROM orderlist WHERE orderID = '$orderID'";
        mysqli_query($conn, $sql);

        $sql = "DELETE FROM orders WHERE orderID = '$orderID'";
        mysqli_query($conn, $sql);

        updateSession($conn);
    
    }
?>