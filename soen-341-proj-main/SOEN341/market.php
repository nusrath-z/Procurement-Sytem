<?php 
	include_once 'views/header.php';
    require_once 'includes/inventory.inc.php';

    $sql = "SELECT * FROM inventory ";

    //retrieve array of lists
    $result = mysqli_query($conn, $sql);
    $listings = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $_SESSION['market'] = $listings;

?>

<body style="background-image: url('./img/sb.jpg'); 
  background-repeat: no-repeat; background-size: 100% 100%; background-attachment: fixed;">
       
	   <div style="padding:10%">



        <h2>Welcome to the Market</h2>

        <!-- Display loop-->
        <div class="container-fluid mt-4 p-4 bg-white rounded-2 border" >
            <h4>All listed products:</h4>
            <?php if(empty($listings)): ?>
                <div class="card">
                    <div class="card-body bg-light text-black-50">No Listings Yet...</div>
                </div>
                
            <?php endif;?>

            <div class="row">

 <div class="container mt-3">
               

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

              <tr>
                  <td><?php echo $entry['itemName'] ?></td>
                  <td><?php echo $entry['itemDesc'] ?></td>
                  <td><?php echo "$" . $entry['itemPrice'] ?></td>
                  <td><?php echo $entry['itemQuantity'] ?></td>
                  <td><a class="card-footer text-end" href="view_item.php?index=<?php echo $index; $index++?>">View</a></td>
             </tr>

  
            <?php endforeach?>
     
          </tbody>
  </table>
             
                           
                
            </div>
        </div>



<?php 
	include_once 'views/footer.php';
?>

    </div>
	
</body>


