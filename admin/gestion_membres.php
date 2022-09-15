<?php require_once 'inc_admin/init.admin.php';

if (!adminConnect()) { //si admin n'est pas connexcté
    header('location:../connexion.php');
    exit;
}

//-------------------------------------------------------------------------------------------------------        

//SUPPRESSION des articles :
if( isset($_GET['action']) && $_GET['action'] == 'suppression' ){ //SI il existe 'action' dans l'URL - ET - que cette 'action' est égale à 'suppression' (c'est que l'on a cliqué sur le lien)

        
    //Requête de suppression DELETE :
    $pdo->exec(" DELETE FROM membre WHERE id_membre = '$_GET[id_membre]'");
    //SUPRESSION dans la table 'article' a CONDITION que dans la colonne 'id_article' ce soit égale à l'id récupéré dans URL
  
    header('location:?action=affichage');
 
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


WHERE id_membre = '$_GET[id_membre]'
");

       
       header('location:?action=affichage');

        }

          
            elseif (empty($error)) { //SI la variable $error est VIDE, le formulaire a bien été rempli. On fait donc insertion

                $pdo->exec(" INSERT INTO membre( pseudo, nom, prenom, email, telephone, ville, pays, cp, adresse ) 

                VALUES ( '$_POST[pseudoMembre]',
                        '$_POST[nomMembre]',
                         '$_POST[prenomMembre]',
                         '$_POST[emailMembre]',
                        '$_POST[telephoneMembre]',
                        '$_POST[villeMembre]',
                        '$_POST[paysMembre]',
                        '$_POST[cpMembre]',
                        '$_POST[adresseMembre]'

                        
                     )
                     ");
     header('location:?action=affichage');
}
    }

//-------------------------------------------------------------------------------------------    
        //AFFICHAGE DES ARTICLES :

       // debug($_GET);
        if( isset($_GET['action']) && $_GET['action'] == 'affichage' ){ //SI il existe 'action' dans l'URL - ET - que cette 'action' est égale à 'affichage' (c'est que l'on a cliqué sur le lien)
        
            //récupération des infos en bdd( select )

            $r = $pdo->query(" SELECT  id_membre, pseudo, nom, prenom, email, statut, telephone, ville, pays, cp, adresse FROM membre ");

        $content .="<h2>Listing des membres</h2>";
        $content .="<p>Nombre de membres sur le site :  ". $r->rowCount() . "</p>";
        //rowCount() permet de retourner le nomde de ligne de résultat retournée par la requête ($r)
        
        $content .="<table class='table table-bordered' cellpadding='5'>";
        $content .="<tr>";
      
        $nombreColonnes = $r->columnCount();
        //columnCount() : retourne le nombre de colonnes issues du jeu de résultat ($r) retourné par la requête
                        //debug( $nombre_colonne ); //Ici, 8 colonnes
        //debug( $nombreColonnes );
        
            for( $i =0; $i < $nombreColonnes; $i++ ){
               
                $infoColonne = $r->getColumnMeta ( $i );
                
                
                //getColumnMeta( int ) : retourne des informations sur les colonnes issues du jeu de résultat ($r) retourné par la requête
                    
                //debug( $infoColonne );
        
        
                $content .="<th class=' bg-secondary text-center' style='text-transform: uppercase;' > ". str_replace("_", " ", $infoColonne["name"] ) ." </th>";
                        
            }
            
            $content .="<th class='bg-danger'> Suppression </th>";
            $content .="<th class='bg-warning'>Modification </th>";


        $content .="</tr>"; 
        
        
        while( $membre = $r->fetch( PDO::FETCH_ASSOC ) ){
            //fetch() : retourne un tableau (ici, $ligne) avec les valeurs en BDD indéxés par les champs de la table 'article' grâce au paramètre PDO::FETCH_ASSOC
                    //Ici, $ligne va retourner UN tableau correspondant à UNE LIGNE de résultat issue du jeu de résultat de la requêtes ($r : object PDOStatement)
                    //Une ligne correspond à UN article !
                    //On utilise une boucle while pour afficher TOUTES les lignes TANT QU'il y en a à afficher car fetch() retourne la ligne suivante d'un jeu de résultat;
        
        //debug( $article );
        
            $content .= "<tr>";
        
            foreach( $membre as $indice =>$valeur ){ //Si l'indice ($indice) est égal à 'photoProduit' et à 'photoBois',
                //alors on affiche la value correspondante ($valeur) dans l'attribut src d'une balise <img>
        
                    
                    $content .= "<td> $valeur </td>";
                    }
                
                //Ci-dessous: on fait passer des infos dans l'URL: une action de suppression ET l'id de l'article que l'on souhaite supprimer
				//On a ajouté du JS pour avoir la possibilité d'annuler la suppression car DELETE est irreversible
				$content.= '<td>
                <a href="?action=suppression&id_membre='.$membre['id_membre'].'" onclick="return( confirm(\'Voulez vous supprimer : '. $membre['pseudo'] .' ?\') )" >
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>';

$content.= '<td>
                <a href="?action=modification&id_membre='.$membre['id_membre'].'" >
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </td>';
        
            $content .= "</tr>";
        }
        $content .="</table>";
        
        }
        
    ?>

<?php require_once 'inc_admin/header.admin.php'; //inclusion du header 
?>

<h1>GESTION DES MEMBRES</h1>
<!-- 2 liens pour gérer soit l'affichage soit le formulaire selon l'action passée dans l'URL -->

	<a href="?action=affichage">Affichage des membres</a><br>
    <a href="?action=ajout">Ajouter un nouveau membre</a><br><hr>
    <?php echo $error; ?>
    <?= $content; ?>

    <?php  if( isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification') ) : 
		//SI il existe 'action' dans l'URL - ET - que cette 'action' est égale à 'ajout'  (c'est que l'on a cliqué sur le lien et on affiche le <form>) ou à 'modification'(c'est que l'on a cliqué sur l'icone modifier) 

		if( isset( $_GET['id_membre']) ){ //SI il existe 'id_article' dans l'URL, c'est que l'on est dans le cadre d'une modification !

			//Récupération des infos de l'article à modifier pour pré-remplir le formulaire
			$r = $pdo->query("SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]' ");

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

<?php require_once 'inc_admin/footer.admin.php'; ?>