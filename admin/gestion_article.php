<?php require_once 'inc_admin/init.admin.php';

if (!adminConnect()) { //si admin n'est pas connexcté
    header('location:../connexion.php');
    exit;
}

//-------------------------------------------------------------------------------------------------------        

//SUPPRESSION des articles :
if( isset($_GET['action']) && $_GET['action'] == 'suppression' ){ //SI il existe 'action' dans l'URL - ET - que cette 'action' est égale à 'suppression' (c'est que l'on a cliqué sur le lien)

        //SUPPRESSION des photos (fichier physique)
        //Récupération de la colonne 'photo_produit' et 'photo_bois' en BDD AVANT le suppression en BDD car
        //sinon on ne pourrait pas récupérer les photos puisqu'elles seraient déjà supprimées.
        $r = $pdo->query("SELECT photo_produit, photo_bois FROM article WHERE id_article ='$_GET[id_article]' ");

        $photo_a_supprimer_bdd = $r->fetch( PDO::FETCH_ASSOC);
            // debug($photo_a_supprimer_bdd);

            $chemin_photo_produit_a_supprimer = str_replace('http://localhost', $_SERVER['DOCUMENT_ROOT'], $photo_a_supprimer_bdd['photo_produit']);
            $chemin_photo_bois_a_supprimer = str_replace('http://localhost', $_SERVER['DOCUMENT_ROOT'], $photo_a_supprimer_bdd['photo_bois']);
            // debug($chemin_photo_produit_a_supprimer);
            // debug($chemin_photo_bois_a_supprimer);
            //str_replace( arg1, arg2, arg3 ) : fonction php qui permet de remplacer une partie d'une chaine
		//arg1 : la chaine que l'on souhaite remplacer
		//arg2 : la chaine de remplacement
		//arg3 : la chaine sur laquelle je veux effectuer les changements

		//Ici : je remplace :	http://localhost
					//  par :	$_SERVER['DOCUMENT_ROOT'] <=> C:/xamp/htdocs
					// dans :	$photo_a_supprimer_bdd['photo'] <=> http://localhost/PHP/boutique/photo/nom_photo.jpg 
									//(l'adresse de la photo récupérée de la BDD)

    if (file_exists($chemin_photo_produit_a_supprimer)){// SI le fichier existe
                          
    // if (file_exists($chemin_photo_produit_a_supprimer)&&($chemin_photo_bois_a_supprimer)){// SI le fichier existe
        
        unlink(( $chemin_photo_produit_a_supprimer));
        
    //     unlink(url): permet de supprimer le fichier

    }
    if($chemin_photo_bois_a_supprimer){ 
        unlink(( $chemin_photo_bois_a_supprimer));

    }

    //Requête de suppression DELETE :
    $pdo->exec(" DELETE FROM article WHERE id_article = '$_GET[id_article]'");
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
	if( isset($_GET['action']) && $_GET['action'] == 'modification' ){ //SI on est dans le cadre d'une modification, on récupère le chemin en BDD de la photo actuelle grâce à l'input type='hidden' et je la stocke dans la variable $photo_bdd

		$photo_bdd_un = $_POST['photo_un'];
        $photo_bdd_deux = $_POST['photo_deux'];
       
	}
    
    if (!empty($_FILES['productPicture']['name'])) { //Si le nom des deux photos que l'on recupère dans $_FILES N'EST PAS VIDE, c'est que l'on peu uploader un fichier
       // debug($_SERVER);
        //Récupération du nom du fichier :
        $nom_photo_un = $_FILES['productPicture']['name'];
       //  debug($nom_photo_un);
        //chemin pour accéder à la photo (à insérer en BDD pour afficher dans une balise <img>)

        $photo_bdd_un = URL . 'photo/pstylos/' . $nom_photo_un;

        //Chemin où l'on souhaite enregistrer le fichier physique des photos
        $photo_un_dossier = $_SERVER['DOCUMENT_ROOT'] . "/photo/pstylos/" . $nom_photo_un;

           //debug($photo_bdd_un);
           
           //  debug($photo_un_dossier);


        //$_SERVER : supperglobale de PHP qui retourne un tableau avec des infos du serveur courant :
        //Ici, dans notre exemple :
        // $_SERVER['DOCUMENT_ROOT'] <=> c/:xampp/htdocs

        copy($_FILES['productPicture']['tmp_name'], $photo_un_dossier);
    }

    if (!empty($_FILES['woodPicture']['name'])){

    $nom_photo_deux = $_FILES['woodPicture']['name'];
    $photo_bdd_deux = URL . 'photo/pbois/' . $nom_photo_deux;
        $photo_deux_dossier = $_SERVER['DOCUMENT_ROOT'] . "/photo/pbois/" . $nom_photo_deux;

        copy($_FILES['woodPicture']['tmp_name'], $photo_deux_dossier);
        //copy( arg1, arg2 ); //copier un fichier
        //arg1 : chemin du fichier source
        //arg2 : chemin de destination

    } 

    else { //Sinon c'est qu'on a pas téléchargé les deux photos

        $error .= "<div class='alert alert-danger'>Vous n'avez pas uploader de photo</div>";
    }
//---------------------------------------------------------------------------------------------------------------    
            if (isset( $_GET['action']) && $_GET['action'] == 'modification'){//SI il existe 'actoin' dans 
                //l'URL et que cette 'action' est égale à 'modification', alors on effectue un UPDATE
                
                $pdo->exec("UPDATE article SET categorie = '$_POST[categorie]',
                                                nom_modele ='$_POST[modelName]',
                                                description_produit ='$_POST[productDescription]',
                                                photo_produit ='$photo_bdd_un',
                                                bois ='$_POST[wood]',
                                                photo_bois = '$photo_bdd_deux',
                                                prix ='$_POST[price]'
                         
                            WHERE id_article = '$_GET[id_article]'
                ");
       
       header('location:?action=affichage');

        }

          
            elseif (empty($error)) { //SI la variable $error est VIDE, le formulaire a bien été rempli. On fait donc insertion

        $pdo->exec(" INSERT INTO article( categorie, nom_modele, description_produit, photo_produit, bois, photo_bois, prix)

        VAlUES ( '$_POST[categorie]',
        '$_POST[modelName]',
        '$_POST[productDescription]',
        '$photo_bdd_un',
        '$_POST[wood]',
        '$photo_bdd_deux',
        '$_POST[price]'
        

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

        $r = $pdo->query(" SELECT * FROM article ");

        $content .="<h2>Listing des articles</h2>";
        $content .="<p>Nombre d'articles sur le site :  ". $r->rowCount() . "</p>";
        //rowCount() permet de retourner le nomde de ligne de résultat retournée par la requête ($r)
        
        $content .="<table class='table table-hover table-bordered' cellpadding='5'>";
        $content .="<tr >";
      
        $nombreColonnes = $r->columnCount();
        //columnCount() : retourne le nombre de colonnes issues du jeu de résultat ($r) retourné par la requête
                        //debug( $nombre_colonne ); //Ici, 8 colonnes
        //debug( $nombreColonnes );
        
            for( $i =0; $i < $nombreColonnes; $i++ ){
               
                $infoColonne = $r->getColumnMeta ( $i );
                
                
                //getColumnMeta( int ) : retourne des informations sur les colonnes issues du jeu de résultat ($r) retourné par la requête
                    
                //debug( $infoColonne );
        
        
                $content .="<th class=' bg-primary  text-center' style='text-transform: uppercase;' > ". str_replace("_", " ", $infoColonne["name"] ) ." </th>";
                        
            }
            
            $content .="<th class='bg-danger '> Suppression </th>";
            $content .="<th class='bg-warning '>Modification </th>";


        $content .="</tr>"; 
        
        
        while( $article = $r->fetch( PDO::FETCH_ASSOC ) ){
            //fetch() : retourne un tableau (ici, $ligne) avec les valeurs en BDD indéxés par les champs de la table 'article' grâce au paramètre PDO::FETCH_ASSOC
                    //Ici, $ligne va retourner UN tableau correspondant à UNE LIGNE de résultat issue du jeu de résultat de la requêtes ($r : object PDOStatement)
                    //Une ligne correspond à UN article !
                    //On utilise une boucle while pour afficher TOUTES les lignes TANT QU'il y en a à afficher car fetch() retourne la ligne suivante d'un jeu de résultat;
        
        //debug( $article );
        
            $content .= "<tr row>";
        
                foreach( $article as $indice =>$valeur ){ //Si l'indice ($indice) est égal à 'photoProduit' et à 'photoBois',
                    //alors on affiche la value correspondante ($valeur) dans l'attribut src d'une balise <img>
        
                    if( $indice =='photo_produit'  ){
        
                        $content .= "<td > 
                                <img src='$valeur' width='80'>
                        </td>";
        
                    }elseif( $indice =='photo_bois'  ){
        
                        $content .= "<td> 
                                <img src='$valeur' width='80'>
                        </td>";
        
                    }
                    else{// SINON, on affiche les valeurs dans des cellules simples
                    $content .= "<td> $valeur </td>";
                    }
                }
                //Ci-dessous: on fait passer des infos dans l'URL: une action de suppression ET l'id de l'article que l'on souhaite supprimer
				//On a ajouté du JS pour avoir la possibilité d'annuler la suppression car DELETE est irreversible
				$content.= '<td >
                <a href="?action=suppression&id_article='.$article['id_article'].'" onclick="return( confirm(\'Voulez vous supprimer le modèle: '. $article['nom_modele'] .' ?\') )" >
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>';

$content.= '<td>
                <a href="?action=modification&id_article='.$article['id_article'].'" >
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
<link href="assets/css/admin_style.css" rel="stylesheet">

<h1>GESTION DES ARTICLES</h1>
<!-- 2 liens pour gérer soit l'affichage soit le formulaire selon l'action passée dans l'URL -->
<a href="?action=ajout">Ajouter un nouvel article</a><br>
	<a href="?action=affichage">Affichage des articles</a><hr>
    <?php echo $error; ?>
    <?= $content; ?>

    <?php  if( isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification') ) : 
		//SI il existe 'action' dans l'URL - ET - que cette 'action' est égale à 'ajout'  (c'est que l'on a cliqué sur le lien et on affiche le <form>) ou à 'modification'(c'est que l'on a cliqué sur l'icone modifier) 

		if( isset( $_GET['id_article']) ){ //SI il existe 'id_article' dans l'URL, c'est que l'on est dans le cadre d'une modification !

			//Récupération des infos de l'article à modifier pour pré-remplir le formulaire
			$r = $pdo->query("SELECT * FROM article WHERE id_article = '$_GET[id_article]' ");

			$article_actuel = $r->fetch( PDO::FETCH_ASSOC );
				//debug( $article_actuel );
		}
        //-----------------------------------------------------------------------
        if (isset($article_actuel['categorie']) ){//SI $article_actuel['categorie'] existe, c'est que l'on est dans 
            // le cadre d'une modification, donc, on déclare une variable et on stocke la valeur correspondante récupérée en bdd que l'on affichera dans l'attribut value="" de l'input correspondant
            $categorie = $article_actuel['categorie'];
        }
            else{//SINON, c'est que l'on est dans le cadre d'un ajout on déclare cette même variable avec
                // "rien" à l'intérieur que l'on affichera dans l'attribut value="" de l'input correspondant
                $categorie ='';
            }
            //Version ternaire
            $nom_modele = ( isset($article_actuel['nom_modele'])) ? $article_actuel['nom_modele'] : '';
            $description_produit = ( isset($article_actuel['description_produit'])) ? $article_actuel['description_produit'] : '';
            $nom_du_bois = ( isset($article_actuel['bois'])) ? $article_actuel['bois'] : '';
            $prix_produit = ( isset($article_actuel['prix'])) ? $article_actuel['prix'] : '';
            
            //Gestion de la photo
            if (isset($article_actuel['photo_produit'])){
                $photoPdt = "<i>Vous pouvez télécharger une nouvelle image</i>";
                $photoPdt .= "<img src='$article_actuel[photo_produit]' width='80' >";
                $photoPdt .="<input type ='hidden' name='photo_un' value='$article_actuel[photo_produit]'>";

            }
            if (isset($article_actuel['photo_bois'])){
                $photoBois = "<i>Vous pouvez télécharger une nouvelle image</i>";
                $photoBois .= "<img src='$article_actuel[photo_bois]' width='80' >";
                $photoBois .="<input type ='hidden' name='photo_deux' value='$article_actuel[photo_bois]'>";

            }
           
            else{ // SINON, c'est que l'on est dans le cadre d'un 'ajout' et donc je n'affiche rien
                $photoPdt ='<br>';
                $photoBois ='<br>';

                
              
              
            
            }
        
	?>

    <form method='post' enctype="multipart/form-data" >
        <!-- enctype="multipart/form-data"> : aattribut obligatoire
     quand on veut uploader des fichier et les récupérer via $_FILES -->

        <label>Categorie</label><br>
        <input type="text" name="categorie" value="<?php echo $categorie ?>"><br><br>
        <label>Nom du modele</label><br>
        <input type="text" name="modelName"  value="<?= $nom_modele ?>"><br><br>
        <label>Description du produit</label><br>
        <textarea name="productDescription"> <?= $description_produit ?></textarea><br><br>
        <label>Photo du produit</label><br>
        <input type="file" name="productPicture"><br><br>
        <?= $photoPdt ?><br>
        <label>bois</label><br>
        <input type="text" name="wood" value="<?= $nom_du_bois ?>"><br><br>
        <label>photo du bois</label><br>
        <input type="file" name="woodPicture" ><br><br>
        <?= $photoBois ?><br>
        <label>prix</label><br>
        <input type="text" name="price" value="<?= $prix_produit ?>"><br><br>
        <input type="submit" class="btn btn-secondary">

    </form>

    <?php endif; ?>

<?php require_once 'inc_admin/footer.admin.php'; ?>