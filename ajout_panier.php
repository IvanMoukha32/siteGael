<?php require_once 'inc/init.inc.php';

if(!isset($_SESSION)){
    //si non demarer la session
    session_start();
 }
 //creer la session
 if(!isset($_SESSION['panier'])){
    //s'il nexiste pas une session on créer une et on mets un tableau a l'intérieur 
    $_SESSION['panier'] = array();
 }
 //récupération de l'id dans le lien
  if(isset($_GET['id_article'])){//si un id a été envoyé alors :
    $id = $_GET['id_article'] ;
    //verifier grace a l'id si le produit existe dans la base de  données
    $r = $pdo->query("SELECT * FROM article WHERE id_article = id_article =$id");

    //$produit = mysqli_query($con ,"SELECT * FROM products WHERE id = $id") ;
    if(empty($r)){
        //si ce produit n'existe pas
        die("Ce produit n'existe pas");
    }
    //ajouter le produit dans le panier ( Le tableau)

    if(isset($_SESSION['panier'][$id])){// si le produit est déjà dans le panier
        $_SESSION['panier'][$id]++; //Représente la quantité 
    }else {
        //si non on ajoute le produit
        $_SESSION['panier'][$id]= 1 ;
    }

   //redirection vers la page index.php
   header("Location:fiche_article.php");


  }?> 
