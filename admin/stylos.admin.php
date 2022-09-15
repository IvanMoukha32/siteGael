<?php require_once 'inc_admin/init.admin.php'; 

//debug($_GET);
 	

$r = $pdo->query(" SELECT DISTINCT(categorie) FROM article");

$content .= '<div class="row">';
	$content .= '<div class="col-md-3">';
		$content .= '<div class="list-group">';  	

		while( $categorie = $r->fetch( PDO::FETCH_ASSOC ) ){
			//debug($categorie);

			$content .= "<a href='?categorie=$categorie[categorie]' class='list-group-item'> $categorie[categorie] </a>";
		}

		$content .= '</div>';
	$content .= '</div>';
	$content .= '<div class="col-md-8 col-md-offset-1">';
		$content .= '<div class="row">';

	if( isset($_GET['categorie']) ){ //SI il existe 'categorie' dans l'URL, c'est que l'on a cliqué sur une catégorie

		$content .= "<h2>Vous êtes dans la catégorie : $_GET[categorie] </h2>";

		$r = $pdo->query("SELECT * FROM article WHERE categorie = '$_GET[categorie]' ");

		while( $article = $r->fetch( PDO::FETCH_ASSOC ) ){
			//debug( $article );
           
			$content .= "<div class='col-4 text-center '>";
				$content .= "<div class='thumbnail' style='border:1px solid #eee'>";

                $content .= "<a href='fiche_article.php?id_article=$article[id_article]'>";
               
						$content .= "<h3> $article[nom_modele] </h3>";
              
						$content .= "<img src='$article[photo_bois]' width='100'>";
              
						$content .= "<p> $article[description_produit] </p>";
					$content .= "</a>";

				$content .= '</div>';
			$content .= '</div>';
		} 
	}
	else{ //SINON, c'est que l'on a pas cliqué sur une catégorie (la première fois que l'on arrive sur la page)

		$content .= "<h2>On afficherait ce que l'on veut la première fois qu'on arrive sur la page d'accueil</h2>";
	}

	//SELON la catégorie cliquée 
		//récupération des articles de la catégorie cliquée
			//puis les afficher


	$content .= '</div>';
	$content .= '</div>';
$content .= '</div>';


//------------------------------------------------------------------

?>
<?php require_once 'inc_admin/header.admin.php';  ?>
<link href="assets/css/admin_style.css" rel="stylesheet">

<h1>LES STYLOS</h1>


<?= $content;  //affichage du contenu 
?>




<?php require_once 'inc_admin/footer.admin.php';  ?>
