<?php 

        require_once("connection.php ");

        if(isset($_GET['Del']))
        {
            $product_id = $_GET['Del'];
            $query = " delete from records where product_id = '".$product_id."'";
            $result = mysqli_query($con,$query);

            if($result)
            {
                header("location:view.php");
            }
            else
            {
                echo ' Please Check Your Query ';
            }
        }
        else
        {
            header("location:view.php");
        }

?>


