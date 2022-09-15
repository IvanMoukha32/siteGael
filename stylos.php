<?php require_once 'inc/init.inc.php'; //inclusion de l'init 

if (!isset($_SESSION['panier']))
$_SESSION['panier'] =array ();


$r = $pdo->query(" SELECT DISTINCT(categorie) FROM article");

$content .= '<div class="container">';
	$content .= '<div class="row ">';
		$content .= '<div class="">';  	

		while( $categorie = $r->fetch( PDO::FETCH_ASSOC ) ){
			//debug($categorie);

			$content .= "<a href='?categorie=$categorie[categorie]' class='bg-light text-center flex-item menuPen list-group-item'><i class='fa-sharp fa-solid fa-pen-fancy'></i> $categorie[categorie] </a>";
		} 

		$content .= '</div>';
	$content .= '</div>';
	$content .= '</div>';
	$content .= '<div class="col-md-8 col-md-offset-1">';
		$content .= '<div class="row">';

	if( isset($_GET['categorie']) ){ //SI il existe 'categorie' dans l'URL, c'est que l'on a cliqué sur une catégorie

		$content .= "<h2 class='mt-5 text-center'> $_GET[categorie] </h2>";
		$content .="<br>";
		
		$r = $pdo->query("SELECT * FROM article WHERE categorie = '$_GET[categorie]' ");

		while( $article = $r->fetch( PDO::FETCH_ASSOC ) ){
			//debug( $article );
           
			$content .= "<div class='my-4 col-4 text-center '>";
				$content .= "<div class='thumbnail' style='border:1px solid #eee'>";

                $content .= "<a style='text-decoration:none'; href='fiche_article.php?id_article=$article[id_article]'>";
               
						$content .= "<h3 style='text-transform: uppercase;'> $article[nom_modele] </h3>";
              
						$content .= "<img src='$article[photo_bois]' width='100'>";
              
						$content .= "<p style='color:black'; > $article[description_produit] </p>";
						$content .= "<p style='color:black'; > $article[prix]€</p>";
						$content .= "<a>";
					$content .= "</a>";
			

				$content .= '</div>';
			$content .= '</div>';
		} 
	}
	else{ //SINON, c'est que l'on a pas cliqué sur une catégorie (la première fois que l'on arrive sur la page)

		$content .= "<p>Ici vous pourrez retrouvez tous les stylos que je vends sur catalogue ainsi que des informations pratique sur l'entretien des vos stylos</p>";
	}

	//SELON la catégorie cliquée 
		//récupération des articles de la catégorie cliquée
			//puis les afficher


	$content .= '</div>';
	$content .= '</div>';
$content .= '</div>';


//------------------------------------------------------------------

?>
<?php require_once 'inc/header.inc.php'; //inclusion du header 
?>
<link href="assets/css/style.css" rel="stylesheet">

<h1 class="titlePen  text-center">LES STYLOS AU CATALOGUE</h1>
<br>


<?= $content;  //affichage du contenu 
?>

  <!-- Sidenav -->

  <!-- Navbar -->
 


<?php require_once 'inc/footer.inc.php'; ?>