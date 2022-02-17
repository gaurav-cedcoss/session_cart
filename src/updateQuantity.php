<?php 
    if(isset($_POST["submit"])){
        //print_r($_POST);
        $id=$_POST["Prodid"];
        $qty=$_POST["qty-".$id];
        //echo $id." + ".$qty;
        header("Location:addToCart.php?id=$id&qty=$qty&action=update");
    }
?>