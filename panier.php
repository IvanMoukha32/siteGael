<?php require_once 'inc/init.inc.php';

   //supprimer les produits
   //si la variable del existe
   if(isset($_GET['del'])){
    $id_del = $_GET['del'] ;
    //suppression
    unset($_SESSION['panier'][$id_del]);
   }

 

?>
<?php require_once 'inc/header.inc.php'; //inclusion du header ?> 


<section class="mt-5">
    <div>
    <div><a href="stylos.php" class="link">Boutique</a></div>

        <table class=table>
            <tr>
                <th></th>
                <th>Nom  :&ensp;</th>
                <th>Prix :&ensp;</th>
                <th>Quantité &ensp;</th>
                <th>ajouter/supprimer &ensp;</th>
                
                <th>Action :&ensp;</th>
            </tr>
            <?php 
            debug( $_SESSION );
              $total = 0 ;
              // liste des produits
              //récupérer les clés du tableau session
              $ids = array_keys($_SESSION['panier']);
              //s'il n'y a aucune clé dans le tableau
              if(empty($ids)){
                echo "Votre panier est vide";
              }else {
                //si oui 
                $product = $pdo->query("SELECT * FROM article WHERE id_article IN (".implode(',', $ids).")");

                //lise des produit avec une boucle foreach
                foreach($product as $product):
                    //calculer le total ( prix unitaire * quantité) 
                    //et aditionner chaque résutats a chaque tour de boucle
                    $total = $total + $product['prix'] * $_SESSION['panier'][$product['id_article']] ;
                ?>
                <tr>
                <td><img src="pbois/<?=$product['photo_bois']?>"></td>

                    <td><?=$product['categorie']?></td>
                    <td><?=$product['prix']?>€</td>
                    <td><?=$_SESSION['panier'][$product['id_article']] // Quantité?></td>

                <td><a href="panier.php?del=<?=$product['id_article']?>"><i class="text-danger fa-solid fa-trash-can"></i></a></td>

            

                

                </tr>

            <?php endforeach ;} ?>

            <tr class="total">
                <th>Total : <?=$total?>€</th>
            </tr>
        </table>
                </div>
              
</section>

<?php require_once 'inc/footer.inc.php'; ?>