<?php 

    include_once 'views/header.php';
    require_once 'includes/orders.inc.php';
    
    //setting current index
    $current = 0;
    $maxIndex = count($_SESSION['market']);

    //index guard
    if(isset($_GET['index']) && (($_GET['index']) < $maxIndex) && ($_GET['index']) >= 0){
        $current = $_GET['index'];
    }

    //creating item
    $item = $_SESSION['market'][$current];

    //print_r($_SESSION)
?>

<!-- FORM CREATION -->

<body style="background-image: url('./img/sb.jpg'); 
  background-repeat: no-repeat; background-size: 100% 100%; background-attachment: fixed;">
       
	   <div style="padding:10%">

    <h3><?php echo "Currently viewing listing #".($current+1).": \"".$item["itemName"]."\""?></h3>
    <?php 
        if(isset($_GET['success']) && !(isset($hasErr))){
            echo "<h5 style=\"color:MediumSeaGreen;\">Added to Cart!</h5>";
        }
    ?>

    <form action="" class="rounded-4 border bg-white mt-2 px-4 py-2" method="POST">
        <div class="m-4 mt-6">
            <label for="prodname" class="form-label">Listing Title:</label>
            <input readonly id ="prodname" class="form-control" type="text" placeholder="Enter the title of this listing" name="name" value="<?php echo $item['itemName'];?>">
            <div class="invalid-feedback"><?php echo $titleErr?> </div>
         </div>
        <div class="m-4">
            <label for="proddesc" class="form-label">Descritption:</label>
             <textarea readonly id ="proddesc" class="form-control" rows="5" placeholder="Enter the description of the product" name="desc"><?php echo $item['itemDesc'];?></textarea>
               <div class="invalid-feedback"><?php echo $descErr?> </div>
        </div>
        <div class="row mb-4">
            <div class="col-4 mx-4">
                <label for="prodprice" class="form-label">Price ($CAD):</label>
                <input readonly id ="prodprice" class="form-control w-75" type="text" placeholder="Enter Price" name="price" value="<?php echo $item['itemPrice'];?>">
                <div class="invalid-feedback"><?php echo $priceErr?> </div>
            </div>
            <div class="col-4">
                <label for="prodquantity" class="form-label">Quantity Avaliable:</label>
                <input readonly id ="prodquantity" class="form-control w-50" type="text" placeholder="#" name="quantity" value="<?php echo ($item['itemQuantity']>0)? $item['itemQuantity'] : "Out of Stock"; ?>">
                <div class="invalid-feedback"><?php echo $quantErr?> </div>
            </div>
        </div>
        <input type="hidden" id="passed" name="itemID" value="<?php echo $item['itemID']; ?>">
        <div class="m-4 mb-6">
            <?php if(isset($_SESSION["userRole"]) && ($_SESSION["userRole"]=="client") && ($item['itemQuantity']>0)):?>
                <button type="submit" name="submit" class="btn btn-warning">Add to Cart</button>
            <?php endif;?>
        </div>
    </form>

    <!-- INDEX NAVIGATION -->
    <div class="container-fluid">
        <div class="row mt-2 g-2">
            <div class="col-2"><a href="view_item.php?index=<?php echo $current-1;?>" type="button" class="btn w-75 <?php echo ($current == 0)?"disabled":"";?> btn-primary btn-sm">previous</a></div>
            <div class="col-8"></div>
            <div class="col-2"><a href="view_item.php?index=<?php echo $current+1;?>" type="button" class="btn w-75 <?php echo ($current >= $maxIndex-1)?"disabled":"";?> btn-primary btn-sm">next</a></div>
        </div>
    </div>


</div>

<?php 
	include_once 'views/footer.php';
?>



    </div>
	
</body>

