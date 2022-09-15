<?php require_once 'inc/init.inc.php';

if (!userConnect()) { //si admin n'est pas connexcté
    header('location:../connexion.php');
    exit;
}

//-------------------------------------------------------------------------------------------------------        
$id = $_SESSION['membre']['id_membre'];

//SUPPRESSION des articles :
if( isset($_GET['action']) && $_GET['action'] == 'suppression' ){ //SI il existe 'action' dans l'URL - ET - que cette 'action' est égale à 'suppression' (c'est que l'on a cliqué sur le lien)

        
    //Requête de suppression DELETE :
    $pdo->exec(" DELETE FROM membre WHERE id_membre = '$id'
    ");
    //SUPRESSION dans la table 'article' a CONDITION que dans la colonne 'id_article' ce soit égale à l'id récupéré dans URL
  
 
}

//-------------------------------------------------------------------------------------------------------        

//INSERTION des articles :

    if ( !empty( $_POST ) ){ //SI formulaire est validé et qu'il n'est pas vide
       //  debug($_POST);
        //EXOS : controle sur les saisies de l'utilisateur (empty(), strlen() etc )
    
        //on passe toutes les infos postés par l'ADMIN dans les fonctions addslashes() et htmlentities()
    
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlentities(addslashes( $valeur ) );
        }

    //---------------------------------------------------------------------------------------------------------------    
    //GESTION DE LA PHOTO
     //debug($_FILES);

    //Cette portion de code DOIT IMPERATIVEMENT se situer AVANT la gestion de l'upload d'une nouvelle photo

    
//---------------------------------------------------------------------------------------------------------------    
          
if (isset( $_GET['action']) && $_GET['action'] == 'modification'){//SI il existe 'actoin' dans 
                //l'URL et que cette 'action' est égale à 'modification', alors on effectue un UPDATE
                
                $pdo->exec("UPDATE membre SET  pseudo = '$_POST[pseudoMembre]',
                nom ='$_POST[nomMembre]',
                prenom ='$_POST[prenomMembre]',
                email ='$_POST[emailMembre]',
                telephone ='$_POST[telephoneMembre]',
                ville ='$_POST[villeMembre]',
                pays ='$_POST[paysMembre]',
                cp ='$_POST[cpMembre]',
                adresse ='$_POST[adresseMembre]'


WHERE id_membre = '$id'
");

       
       header('location:?action=affichage');

       
    }
    }
//-------------------------------------------------------------------------------------------    
        //AFFICHAGE DES ARTICLES :

       // debug($_GET);
        
    

    $pseudo = $_SESSION['membre']['pseudo'] ;
    $prenom = $_SESSION['membre']['prenom'] ;
    $telephone = $_SESSION['membre']['telephone'] ;
    $nom = $_SESSION['membre']['nom'] ;
    $email = $_SESSION['membre']['email'] ;


   
?>

<?php require_once 'inc/header.inc.php'; ?>

<link href="assets/css/style.css" rel="stylesheet">

<h1>GESTION DES MEMBRES</h1>
<!-- 2 liens pour gérer soit l'affichage soit le formulaire selon l'action passée dans l'URL -->


<div class="containerProfil">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="cardProfil p-0">
                    <div class="card-imageProfil">
                    <h1 class="text-center"><?php echo $prenom; ?></h1><img class='imgProfil' src="https://images.pexels.com/photos/2746187/pexels-photo-2746187.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                            alt="">
                    </div>
                    <div class="card-contentProfil d-flex flex-column align-items-center">
                        <h4 class="pt-2"><?php echo $pseudo; ?></h4>
                       
                        <h5><?php echo $nom ?></h5>
                        <p class=""><?php echo $telephone; ?></p>
                        <p class=""><?php echo $email; ?></p>
                        <a href="?action=modification&id_membre='.$membre[$id].'" >
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>              <br>

                                              
                
            </div>
            </div>
            </div>
            </div>
</div>
    <?php echo $error; ?>

    <?php  if( isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification') ) : 
		//SI il existe 'action' dans l'URL - ET - que cette 'action' est égale à 'ajout'  (c'est que l'on a cliqué sur le lien et on affiche le <form>) ou à 'modification'(c'est que l'on a cliqué sur l'icone modifier) 

		if( isset( $_GET['id_membre']) ){ //SI il existe 'id_article' dans l'URL, c'est que l'on est dans le cadre d'une modification !

			//Récupération des infos de l'article à modifier pour pré-remplir le formulaire
			$r = $pdo->query("SELECT * FROM membre WHERE id_membre = '$id' ");

			$membre_actuel = $r->fetch( PDO::FETCH_ASSOC );
				//debug( $article_actuel );
		}
        //-----------------------------------------------------------------------
        
            //Version ternaire
            $pseudoMembre = ( isset($membre_actuel['pseudo'])) ? $membre_actuel['pseudo'] : '';
            $famillyName = ( isset($membre_actuel['nom'])) ? $membre_actuel['nom'] : '';
            $firstName = ( isset($membre_actuel['prenom'])) ? $membre_actuel['prenom'] : '';
            $emailMember = ( isset($membre_actuel['email'])) ? $membre_actuel['email'] : '';
            $telephone = ( isset($membre_actuel['telephone'])) ? $membre_actuel['telephone'] : '';
            $ville = ( isset($membre_actuel['ville'])) ? $membre_actuel['ville'] : '';
            $pays = ( isset($membre_actuel['pays'])) ? $membre_actuel['pays'] : '';
            $cp = ( isset($membre_actuel['cp'])) ? $membre_actuel['cp'] : '';
            $adresse = ( isset($membre_actuel['adresse'])) ? $membre_actuel['adresse'] : '';
         
                
              
              
            
            
        
	?>

    
	<form method="post"  >
		
		<label>Identifiant:</label><br>
		<input type="text" name="pseudoMembre"  value="<?php echo $pseudoMembre  ?>"><br><br>
	

		<label>Nom</label><br>
		<input type="text" name="nomMembre" value="<?php echo  $famillyName ?>"><br><br>

		<label>Prenom</label><br>
		<input type="text" name="prenomMembre" value="<?php echo $firstName ?>"><br><br>

		<label>Email</label><br>
		<input type="text" name="emailMembre" value="<?php echo $emailMember ?>"><br><br>
		
		<label>Telephone</label><br>
		<input type="text" name="telephoneMembre" value="<?php echo  $telephone ?>"><br><br>
		<label>ville</label><br>
		<input type="text" name="villeMembre" value="<?php echo  $ville ?>"><br><br>
		<label>Pays</label><br>
		<input type="text" name="paysMembre" value="<?php echo $pays ?>"><br><br>
		<label>Code postale</label><br>
		<input type="text" name="cpMembre" value="<?php echo  $cp ?>"><br><br>
		<label>Adresse</label><br>
		<input type="text" name="adresseMembre" value="<?php echo  $adresse ?>"><br><br>
		
		
        <input type="submit" class="btn btn-secondary">
	</form>

    <?php endif; ?>


	<?php require_once 'inc/footer.inc.php'; ?>
