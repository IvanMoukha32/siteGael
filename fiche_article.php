<?php require_once 'inc/init.inc.php';


//debug($_GET);

if( isset($_GET['id_article']) ){ //SI il y a 'id_article' dans l'URL, c'est que l'on a choisi délibérément d'afficher la fiche d'un article en particulier

	//On récupère les infos en BDD :
	$r = $pdo->query("SELECT * FROM article WHERE id_article = '$_GET[id_article]' ");

	$article = $r->fetch( PDO::FETCH_ASSOC );
		//debug( $article );
}
else{ //SINON, c'est que l'on force l'accès à la page et on le redirige vers la apge d'accueil

	header('location:panier.php');
	exit;
}
//-----------------------------------------
//Créer 2 liens (fil d'ariane) 
//L'un sera pour retourner sur la page d'accueil
$content .= "<a href='index.php'> Accueil </a> / "; 
//l'aute pour retourner à la catégorie précédente
$content .= "<a href='stylos.php?categorie=$article[categorie]'> ". ucfirst( $article['categorie'] ) ."</a> <hr> "; 
//ucfirst( string ) : permet de passer la première lettre en MAJUSCULE

//Affichage des infos de l'article :

foreach( $article as $indice => $valeur ){
	
	
	$content .="<section class='container  '>";
	$content .=" <div class='row' >";
	
	
	if( $indice == 'description_produit' ){
		$content .= "<p class=' col-12 col-lg-6 col-md-6'><u><b>DESCRIPTION DU PRODUIT:</b></u>&nbsp;  $valeur</p>";
	}
	if( $indice == 'photo_produit' ){ //SI l'indice est égale à 'photo', on affiche la valeur correspondante dans l'attribut src de la balige <img>
		
		$content .= " <img class='img-fluid img-thumbnail  col-6 col-md-6 col-lg-6 'style='width:300px'; src= $valeur width='150'>";
		$content .='<br>';
	}
	if( $indice == 'categorie' ){
		$content .='<br>';
		
		$content .= "<p class='text-uppercase  text-center' style='font-size:30px'><b>$valeur</b></p><br><br>";
	}
	

	if( $indice == 'bois' ){
		$content .= "<p ><u><b>ESSENCE DE BOIS DE:</b></u> $valeur</p><br>";
	}	$content .='<br>';
	if( $indice == 'photo_bois' ){ //SI l'indice est égale à 'photo', on affiche la valeur correspondante dans l'attribut src de la balige <img>
		
		$content .= "<img class='img-fluid img-thumbnail  col-6 col-md-6 col-lg-6 'style='width:300px'; src= $valeur width='150'><br>";

	}
	if( $indice == 'prix' ){
		$content .= "<p class='col-6 col-lg-6 col-md-6' ><u><b>PRIX:</b></u> $valeur €</p><br>";
	}
	$content .=" </div>";

	
	$content .=" </div>";
	
	$content .=" </section >";
}
$content .= "<a href='ajout_panier.php?id_article=$article[id_article]'class='btn btn-primary'>Ajouter au panier</a><br>";


//----------------------------------------------------------------
?>
<?php require_once 'inc/header.inc.php'; //inclusion du header ?> 

	<h1>Fiche article</h1>

	<?php echo $content; //Affichage du contenu ?>

	<?php require_once 'inc/footer.inc.php'; //inclusion du footer?>