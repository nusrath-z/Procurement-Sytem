<?php

	include_once 'views/header.php';
    require_once 'includes/messages.inc.php';

    $employees = findEmployee($conn);
    $requests = getRequests($conn, $employees);

    $_SESSION["requests"] = $requests

?>

<section>
    <div class="container-fluid" style="max-width: 800px">

        <div class="container-fluid mt-4 p-4 bg-white rounded-2 border">
                <h4> Inbox </h4>
                <?php
                if(isset($_GET['status']) && $_GET['status'] == "approved"){
                    echo "<h5 style=\"color:MediumSeaGreen;\">Order Approved!</h5>";
                } elseif(isset($_GET['status']) && $_GET['status'] == "denied"){
                    echo "<h5 style=\"color:FireBrick;\">Order Denied!</h5>";
                }
                
                if(empty($requests)): ?>

                    <div class="card">
                        <div class="card-body bg-light text-black-50">No notifications</div>
                    </div>

                <?php endif;$index = 0;foreach($requests as $entry):?>

                    <?php $user = findUser($conn,$entry["orderPlacerID"]);//print_r($entry)?>
                        
                    <form class="card bg-light mb-2" method="POST">

                        <h5 class="card-header">Request From: <?php echo $user[0]['fName']." ".$user[0]['lName'];?></h5>

                        <div class="card-body ">Quantity: <?php //echo $quantity?></div>
                        <div class="card-body">Total: $<?php echo $entry["total"]?></div>
                        <input type="hidden" id="passed" name="orderID" value="<?php echo $entry['orderID']; ?>">

                        <div class="m-4 mb-6">
                            <button type="submit" name="submit" class="btn btn-success">Aprove</button>
                            <a name="delete"  href="inbox.php?delete=1&request=<?php echo $index;$index++?>" class="btn btn-danger">Deny</a>
                        </div>

                    </form>
                        
                    <?php endforeach?>                

            </div>

    </div>
</section>


<?php

	include_once 'views/footer.php';

?>