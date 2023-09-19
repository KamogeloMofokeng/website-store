<?php 

    require_once("connection.php");
    $query = " select * from sofas ";
    $result = mysqli_query($con,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="CSS/bootstrap.css"/>
    <title>View Records</title>
</head>
<body class="bg-dark">

        <div class="container">
            <div class="row">
                <div class="col m-auto">
                    <div class="card mt-5">
                        <table class="table table-bordered">
                            <tr>
                                <td> Product Id </td>
                                <td> Product name </td>
                                <td> Product price </td>
                                <td> Product cat </td>
                                <td> Product details </td>
                                <td> Edit  </td>
                                <td> Delete </td>
                            </tr>

                            <?php 
                                    
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        $ProductId = $row['product_id'];
                                        $ProductName = $row['product_name'];
                                        $ProductPrice = $row['product_price'];
                                        $ProductCat = $row['product_cat'];
                                        $ProductDetails = $row['product_details'];
                            ?>
                                    <tr>
                                        <td><?php echo $UserID ?></td>
                                        <td><?php echo $UserName ?></td>
                                        <td><?php echo $UserEmail ?></td>
                                        <td><?php echo $UserAge ?></td>
                                        <td><a href="edit.php?GetID=<?php echo $ProductId ?>">Edit</a></td>
                                        <td><a href="delete.php?Del=<?php echo $ProductId ?>">Delete</a></td>
                                    </tr>        
                            <?php 
                                    }  
                            ?>                                                                    
                                   

                        </table>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>
