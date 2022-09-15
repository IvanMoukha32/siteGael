<?php require_once 'inc_admin/init.admin.php';


//debug($_GET);

if( isset($_GET['id_article']) ){ //SI il y a 'id_article' dans l'URL, c'est que l'on a choisi délibérément d'afficher la fiche d'un article en particulier

	//On récupère les infos en BDD :
	$r = $pdo->query("SELECT * FROM article WHERE id_article = '$_GET[id_article]' ");

	$article = $r->fetch( PDO::FETCH_ASSOC );
		//debug( $article );
}
else{ //SINON, c'est que l'on force l'accès à la page et on le redirige vers la apge d'accueil

	header('location:index1.php');
	exit;
}
//-----------------------------------------
//Créer 2 liens (fil d'ariane) 
//L'un sera pour retourner sur la page d'accueil
$content .= "<a href='index1.php'> Accueil </a> / "; 
//l'aute pour retourner à la catégorie précédente
$content .= "<a href='stylos.php?categorie=$article[categorie]'> ". ucfirst( $article['categorie'] ) ."</a> <hr> "; 
//ucfirst( string ) : permet de passer la première lettre en MAJUSCULE

//Affichage des infos de l'article :
foreach( $article as $indice => $valeur ){

	if( $indice == 'photo_produit' ){ //SI l'indice est égale à 'photo', on affiche la valeur correspondante dans l'attribut src de la balige <img>

		$content .= "<p> <img src='$valeur' width='300'></p>";

	}
	elseif( $indice == 'photo_bois' ){ //SI l'indice est égale à 'photo', on affiche la valeur correspondante dans l'attribut src de la balige <img>

		$content .= "<p> <img src='$valeur' width='300'></p>";

	}
	elseif( $indice != 'id_article' ){ //SINON SI l'indice est différent de 'id_article' et bien on l'affiche la valeur correspondante dans un <p>

		$content .= "<p> $valeur </p>";
	}
}



//----------------------------------------------------------------
?>
<?php require_once 'inc_admin/header.admin.php'; //inclusion du header ?>
<link href="assets/css/admin_style.css" rel="stylesheet">

	<h1>Fiche article</h1>

	<?php echo $content; //Affichage du contenu ?>

	<?php require_once 'inc_admin/footer.admin.php'; ?>