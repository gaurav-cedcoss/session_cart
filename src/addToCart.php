<?php 
session_start();
    require("config.php");
    if(isset($_GET["id"]) && isset($_GET["action"])){
        $id=$_GET["id"];
        $act=$_GET["action"];
        switch($act){
            case "add":
                addTocart($id);
                break;
            case "update":
                update($id, $_GET["qty"]);
                header("Location:products.php");
                break;
            case "remove":
                removeProd($id);
                break;
            case "empty":
                $_SESSION["cart"]=array();
                header("Location:products.php");
                break;
        }
    }


    function checkProdinCart($id){
        foreach($_SESSION["cart"] as $key=> $val){
            if($_SESSION["cart"][$key]["id"] == $id){
                return 1;
            }
        }
        return 0;
    }


    function addTocart($id){
        $product=array("id"=>$id, "quantity"=>"1");
        if(checkProdinCart($id)){
            update($id, 1);
        }
        else{
        array_push($_SESSION["cart"],$product);
        }
        header("Location:products.php");
    }


    function update($id, $v){
        foreach($_SESSION["cart"] as $key=> $val){
            if($_SESSION["cart"][$key]["id"] == $id){
                $_SESSION["cart"][$key]["quantity"] += $v;
                break;
            }
        }        
    }


    function removeProd($id){
        foreach($_SESSION["cart"] as $key=> $val){
            if($_SESSION["cart"][$key]["id"] == $id){
                array_splice($_SESSION["cart"],$key,1);
                break;
            }
        }
        header("Location:products.php");
    }
