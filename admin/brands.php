<?php 
require_once '../init.php';


$sql = "SELECT * FROM brand ORDER BY brand";
$results = $db->query($sql);
$errors = array();

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $sql2 = "SELECT * FROM brand WHERE id = '$edit_id'";
    $edit_result = $db->query($sql2);
    $eBrand = mysqli_fetch_assoc($edit_result);
    }

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "DELETE FROM brand WHERE id = '$delete_id'";
    $db->query($sql);
    header('Location: brands.php');
}

if (isset($_POST['add_submit'])) {
    $brand = sanitize($_POST['brand']);
    if ($_POST['brand'] ==''){
        $errors[] .='You must enter a brand';
    }

    $sql = "SELECT * FROM brand WHERE brand ='$brand'";
    if (isset($_GET['edit'])) {
        $sql = "SELECT * FROM brand WHERE brand = '$brand' AND id != '$edit_id'";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $errors[] .= $brand. ' already exists. Please choose another brand.';
    }

    if (!empty($errors)) {
        echo display_errors($errors);
    }else{
        $sql ="INSERT INTO brand (brand) VALUES ('$brand')";
        if (isset($_GET['edit'])) {
            $sql = "UPDATE brand SET ='$brand' WHERE id = '$edit_id'";
        }
        $db->query($sql);
        header('Location: brands.php');

    }
}
?>
<!doctype html>
<html>
    <head>
    <title>Simplistic Threads</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link href="../style.css" rel="stylesheet">
        <script src="../ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="../bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
        </head>
        <body>

            <div class="menu">

                <li><a  class="active"href="brands.php">Brands</a></li>
                <li><a href="categories.php">Categories</a></li>
                </div>
             

            <div class="contant">
            
                <h1>Brands</h1>
            </div>
           
           <center>
            <div>
                <form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
                    <div class="form-group">

                        
                        <?php
                        $brand_value = ''; 
                        if (isset($_GET['edit'])){
                            $brand_value = $eBrand['brand'];
                        }else{
                            if (isset($_POST['brand'])) {
                                $brand_value = sanitize($_POST['brand']);
                            }
                        } ?>

                        <label for="brand"><?=((isset($_GET['edit']))?'Edit':'Add a');?> brand: </label>
                        <input type="text" name="brand" class="form-control" id="brand" placeholder="Add a brand" value="<?=((isset($_POST['brand']))?$_POST['brand']:''); ?>">
                        <?php if(isset($_GET['edit'])): ?>
                            <a href="brands.php" class="btn btn-default">Cancel</a>
                    <?php endif; ?>
                    </div>
                    <br>
                    <input type="submit" name="add_submit" value="<?=((isset($_GET))?'Edit':'Add'); ?>" class="btn btn-default">
                </form>
            </div>
            <table>
                
                <thead>
                    <th></th><th>Brand</th><th></th>
                </thead>
                <tbody>
                    <?php while($brand = mysqli_fetch_assoc($results)): ?>
                    <tr>
                        <td><a href="brands.php?edit=<?=$brand['id']; ?>" class="btn btn-xs btn-default"><button class="btn">Edit</button></a></td>
                        <td><?=$brand['brand']; ?></td>
                        <td><a href="brands.php?delete=<?=$brand['id']; ?>" class="btn btn-xs btn-default" ><button class="btn">remove</button></a></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            </center>
        	  <center>
            <div class="container">
                <div id="links">
                   <h3>Quick links...</h3>
				</div>
				<div id="info">
					<h3>Who we are...</h3>
					<p>Simplistic Threads
					is founded by</p>
					
					<p>South African young student
					Kamogelo Mofokeng.</p>
				</div>
                 <div id="letter">
				<h3>Newsletter</h3>
					 <p>Subscribe to our news letter </p>
						 
					 <p> via email to recieve the latest news</p>
					 
						 <p>about our brand and some of our exlusive contant.</p>
				</div>
				<hr width="100%" height="25px" color="grey"  align="center">
                <div class="socials">
                   
                <center>
                    <img src="../pictures/instagram__social__media_-512.png" height="50px" width="50px">
                    <img src="../pictures/facebook__social__media_social__media-128.png" height="50px" width="50px">
                 <img src="../pictures/twitter__social__media__icons-128.png" height="50px" width="50px">
                    </center>
                    
                 </div>
                   
				
					<div class="footer">
					<p>© 2020 Simplistic Threads </p>
            </div>
				</div>
                </center>
        </body>
        </html>
