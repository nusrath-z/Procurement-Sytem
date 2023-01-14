<?php

    require_once 'includes/orders.inc.php';

    if(isset($_POST['submit'])){

        if(!empty($_POST['orderID'])){
            $orderID = $_POST['orderID'];
            setStatuses($conn,$orderID,2,1);
            header("location: ./inbox.php?status=approved");
        }

    }

    if(isset($_GET['delete'])){

        $index = $_GET["request"];
        $requests = $_SESSION['requests'];

        $orderID = $requests[$index]["orderID"];

        deleteOrder($conn,$orderID);

        header("location: ./inbox.php?status=denied");
    }

    function findEmployee($conn){

        $userID = $_SESSION['userID'];

        $sql = "SELECT * FROM relationship WHERE superID = '$userID'";

        $result = mysqli_query($conn, $sql);
        $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $employees;

    }

    function getRequests($conn, $employees){

        $idArray = array();

        foreach($employees as $entry){
            $idArray[] = $entry['employeeID'];
        }

        $orderArray = array();

        foreach($idArray as $entry){

            $sql = "SELECT * FROM orders WHERE orderPlacerID = '$entry'";
            $result = mysqli_query($conn, $sql);
            
            $orderArray[] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        }

        $requests = array();

        foreach($orderArray as $entry){
            foreach($entry as $i){
                if($i['status'] == 1){
                    $requests[] = $i;
                }
            }
        }
        
        return $requests;

    }

    function findUser($conn, $userID){

        $sql = "SELECT * FROM user WHERE userID = '$userID'";

        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $user;
    }

?>