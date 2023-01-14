<?php 
	include_once 'views/header.php';
    require_once 'includes/inventory.inc.php';

    //Role Guard
    if(!isset($_SESSION['userRole']) || !($_SESSION['userRole'] == "supplier") ){
        header("location: ./index.php");
    }

    $listings = $_SESSION['listings'];

?>


  


<body style="background-image: url('./img/sb.jpg'); background-repeat: no-repeat; background-size: 100% 100%; background-attachment: fixed;">
       
	<div style="padding:10%">
           
	    <h3><?php echo "Hello, " .  $_SESSION["userFName"] . "."; ?></h3>
        <!-- List of listed products-->Here is a list of your listed products:<br>
        <?php 
            if(isset($_GET['success']) && !(isset($hasErr))){
                echo "<h5 style=\"color:MediumSeaGreen;\">New item succefuly added!</h5>";
            }
        ?>

        <!-- Display loop-->
        
        <?php if(empty($listings)): ?>
            <div class="card">
                <div class="card-body bg-light text-black-50">No Listings Yet...</div>
            </div>
            <div class="card">
            <a class="card-body bg-light" data-bs-toggle="collapse" href="#openForm">+ Add A Listing</a>
               
                
        <?php endif;?>


        <?php if(!empty($listings)): ?>

            <div class="container mt-3 p-2">
                <table class="table table-hover">
            
                    <thead>
                        <tr>
                        
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    
                        </tr>

                    </thead>

                    <tbody>
                        
                            <?php $index = 0; foreach($listings as $entry): ?>

                            <tr class="p-2">
                                <td><?php echo $entry['itemName'] ?></td>
                                <td><?php echo $entry['itemDesc'] ?></td>
                                <td><?php echo "$" . $entry['itemPrice'] ?></td>
                                <td><?php echo $entry['itemQuantity'] ?></td>
                                <td><a class="text-secondary fw-bold  " href="edit_item.php?index=<?php echo $index; $index++?>">Edit</a><td>
                            </tr>

                            <?php endforeach?>
                
                    </tbody>
                </table>

            </div>

        <?php endif;?>

        <!-- New Product Form-->

       <a class="my-2 mx-4 btn btn-outline-primary " data-bs-toggle="collapse" href="#openForm">Create New Listing</a>
            <div id="openForm" class="container-fluid collapse">
                <form action="" class="rounded-4 border bg-white mt-2 px-4 py-2" method="POST">
                    <div class="m-4 mt-6">
                        <label for="prodname" class="form-label">Listing Title:</label>
                        <input id ="prodname" class="form-control <?php if(isset($_POST['submit'])){echo !$titleErr ? 'is-valid': 'is-invalid';} ?>" type="text" placeholder="Enter the title of this listing" name="name" value="<?php echo !isset($_POST['name'])? "": $_POST['name']; ?>">
                        <div class="invalid-feedback"><?php echo $titleErr?> </div>
                    </div>
                    <div class="m-4">
                        <label for="proddesc" class="form-label">Descritption:</label>
                        <textarea id ="proddesc" class="form-control <?php if(isset($_POST['submit'])){echo !$descErr ? 'is-valid': 'is-invalid';} ?>" rows="5" placeholder="Enter the description of the product" name="desc"><?php echo !isset($_POST['desc'])? null : $_POST['desc']; ?></textarea>
                        <div class="invalid-feedback"><?php echo $descErr?> </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-4 mx-4">
                            <label for="prodprice" class="form-label">Price ($CAD):</label>
                            <input id ="prodprice" class="form-control w-75 <?php if(isset($_POST['submit'])){echo !$priceErr ? 'is-valid': 'is-invalid';} ?>" type="text" placeholder="Enter Price" name="price" value="<?php echo !isset($_POST['price'])? "": $_POST['price']; ?>">
                            <div class="invalid-feedback"><?php echo $priceErr?> </div>
                        </div>
                        <div class="col-4">
                            <label for="prodquantity" class="form-label">Quantity Avaliable:</label>
                            <input id ="prodquantity" class="form-control w-50 <?php if(isset($_POST['submit'])){echo !$quantErr ? 'is-valid': 'is-invalid';} ?>" type="text" placeholder="#" name="quantity" value="<?php echo !isset($_POST['quantity'])? "": $_POST['quantity']; ?>">
                            <div class="invalid-feedback"><?php echo $quantErr?> </div>
                        </div>
                    </div>
                    <div class="m-4 mb-6">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
		</div>
    </div>
</body>

<?php 
	include_once 'views/footer.php';
?>

	