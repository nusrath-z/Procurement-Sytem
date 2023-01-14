<?php 
	include_once 'views/header.php';
	require_once 'includes/orders.inc.php';
	require_once 'includes/cart.inc.php';

	if(!isset($_SESSION['userRole']) || !($_SESSION['userRole'] == "client") ){
        header("location: ./index.php");
    }

	//print_r($_SESSION);

	$orders = $_SESSION['orders'];
	$cart = displayCart();
    
?>

<section>
    <div class="container-fluid" style="max-width: 800px">

        <h3><?php echo "Hello, " .  $_SESSION["userFName"] . "."; ?></h3>
		<?php 
        if(isset($_GET['status']) && $_GET['status'] == "success"){
            echo "<h5 style=\"color:MediumSeaGreen;\">Order Placed!</h5>";
        }elseif(isset($_GET['status']) && $_GET['status'] == "approval"){
            echo "<h5 style=\"color:DarkOrange;\">Order Pending for Aproval!</h5>";
        }
    	?>

		<form class="container-fluid mt-4 p-4 bg-white rounded-2 border" method="POST" action = "">
			<h4> Cart </h4>
            <?php if(empty($cart)): ?>
                <div class="card">
                    <div class="card-body bg-light text-black-50">Cart is empty</div>
                </div>
                <div class="card">
                    <a class="card-body bg-light" href="./market.php">Go to Market</a>
                </div>
                
            <?php endif; $index = 0; $total = 0; foreach($cart as $entry):?>

				<?php $itemID = $entry[0]["itemID"]; $quantity = count($entry);$item = findItem($conn,$itemID);$price = $quantity*$item[0]['itemPrice']?>
                
                <div class="card bg-light mb-2">
                    <h5 class="card-header"><?php echo $item[0]['itemName']; $index++?></h5>
					<div class="card-body">Quantity: <?php echo $quantity?></div>
                    <div class="card-body">Total: $<?php echo $price?></div>
                </div>
                
            <?php $total += $price;endforeach; setTotal($conn,$total);?>

			<h5> Cart Total: $<?php echo $total?></h5>
			<input type="hidden" id="passed" name="total" value="<?php echo $total?>">
			<button type="submit" name="submit" class="btn btn-primary">Place Order</button>


		</form>

       <!-- Display loop-->
	   <div class="container-fluid mt-4 p-4 bg-white rounded-2 border">
			<h4> Orders </h4>
            <?php if(count($orders) <= 1): ?>
                <div class="card">
                    <div class="card-body bg-light text-black-50">No Orders Yet...</div>
                </div>
                <div class="card">
                    <a class="card-body bg-light" href="./market.php">Go to Market</a>
                </div>
                
            <?php endif; $index = 0; foreach($orders as $entry): ?>

				<?php if($entry['status']==0){continue;}?>
                
                <div class="card bg-light mb-2">
                    <h5 class="card-header">Order: <?php echo $index+1; $index++?></h5>
                    <div class="card-body">Total: $<?php echo $entry['total'] ?></div>
					<div class="card-body">Status: <?php echo ($entry['status']==2)? "Order Placed":"Pending for Approval" ?></div>
					<div class="card-body">Approved: <?php echo ($entry['approval']==1)? "Yes":"No" ?></div>
                </div>
                
            <?php endforeach?>
        </div>


	</div>
</section>

<?php 
	include_once 'views/footer.php';
?>

