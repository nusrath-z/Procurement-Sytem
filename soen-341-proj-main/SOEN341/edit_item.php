<?php 

    include_once 'views/header.php';
    require_once 'includes/inventory.inc.php';

    //Role Guard
    if(!isset($_SESSION['userRole']) || !($_SESSION['userRole'] == "supplier") ){
        header("location: ./index.php");
    }
    
    //setting current index
    $current = 0;
    $maxIndex = count($_SESSION['listings']);

    //index guard
    if(isset($_GET['index']) && (($_GET['index']) < $maxIndex) && ($_GET['index']) >= 0){
        $current = $_GET['index'];
    }

    //creating item
    $item = $_SESSION['listings'][$current];

    //prepare for update
    $itemID = $item['itemID'];

    
?>

<!-- FORM CREATION -->
<div class="container-fluid" style="max-width: 800px">

    <h3><?php echo "Currently viewing listing #".($current+1).": \"".$item["itemName"]."\""?></h3>
    <?php 
        if(isset($_GET['success']) && !(isset($hasErr))){
            echo "<h5 style=\"color:MediumSeaGreen;\">Listing Updated!</h5>";
        }
    ?>

    <form action="" class="rounded-4 border bg-white mt-2 px-4 py-2" method="POST">
        <div class="m-4 mt-6">
            <label for="prodname" class="form-label">Listing Title:</label>
            <input id ="prodname" class="form-control <?php if(isset($_POST['submit'])){echo !$titleErr ? 'is-valid': 'is-invalid';} ?>" type="text" placeholder="Enter the title of this listing" name="name" value="<?php echo !isset($_POST['name'])? $item['itemName']: $_POST['name']; ?>">
            <div class="invalid-feedback"><?php echo $titleErr?> </div>
         </div>
        <div class="m-4">
            <label for="proddesc" class="form-label">Descritption:</label>
             <textarea id ="proddesc" class="form-control <?php if(isset($_POST['submit'])){echo !$descErr ? 'is-valid': 'is-invalid';} ?>" rows="5" placeholder="Enter the description of the product" name="desc"><?php echo !isset($_POST['desc'])? $item['itemDesc'] : $_POST['desc'];?></textarea>
               <div class="invalid-feedback"><?php echo $descErr?> </div>
        </div>
        <div class="row mb-4">
            <div class="col-4 mx-4">
                <label for="prodprice" class="form-label">Price ($CAD):</label>
                <input id ="prodprice" class="form-control w-75 <?php if(isset($_POST['submit'])){echo !$priceErr ? 'is-valid': 'is-invalid';} ?>" type="text" placeholder="Enter Price" name="price" value="<?php echo !isset($_POST['price'])? $item['itemPrice'] : $_POST['price']; ?>">
                <div class="invalid-feedback"><?php echo $priceErr?> </div>
            </div>
            <div class="col-4">
                <label for="prodquantity" class="form-label">Quantity Avaliable:</label>
                <input id ="prodquantity" class="form-control w-50 <?php if(isset($_POST['submit'])){echo !$quantErr ? 'is-valid': 'is-invalid';} ?>" type="text" placeholder="#" name="quantity" value="<?php echo !isset($_POST['quantity'])? $item['itemQuantity'] : $_POST['quantity']; ?>">
                <div class="invalid-feedback"><?php echo $quantErr?> </div>
            </div>
        </div>
        <input type="hidden" id="passed" name="itemID" value="<?php echo $itemID; ?>">
        <div class="m-4 mb-6">
            <button type="submit" name="submit" class="btn btn-success">Update</button>
            <a name="delete"  href="edit_item.php?delete=1&index=<?php echo $current;?>" class="btn btn-danger">Delete</a>
        </div>
    </form>

    <!-- INDEX NAVIGATION -->
    <div class="container-fluid">
        <div class="row mt-2 g-2">
            <div class="col-2"><a href="edit_item.php?index=<?php echo $current-1;?>" type="button" class="btn w-75 <?php echo ($current == 0)?"disabled":"";?> btn-primary btn-sm">previous</a></div>
            <div class="col-8"></div>
            <div class="col-2"><a href="edit_item.php?index=<?php echo $current+1;?>" type="button" class="btn w-75 <?php echo ($current >= $maxIndex-1)?"disabled":"";?> btn-primary btn-sm">next</a></div>
        </div>
    </div>

</div>


<?php 
	include_once 'views/footer.php';
?>




