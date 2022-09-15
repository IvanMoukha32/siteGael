<?php require_once 'inc/init.inc.php';

//restriction d'accès à la page SI L'UTILISATEUR EST CONNECTE :
if( userConnect() ){

	header('location:profil.php'); //redirection vers la page de profil
	exit;
}

//---------------------------------------------------------
if( isset( $_POST['valider'] ) ){ //SI on valide le formulaire donc c'est que l'on a cliqué sur l'input type "submit" (qui possède le name='valider')
	
	//debug( $_POST );

	//Controles sur les saisies de l'utilisateur (pour chaque input)

	//Controle sur la taille du pseudo (15 caractères max)
	if( strlen( $_POST['pseudo'] ) <= 3 || strlen( $_POST['pseudo'] ) > 15 ){
		//strlen( $arg ) : permet de retourner la taille de la chaine passée en paramètre (ici, $arg)

		$error .= "<div class='alert alert-danger'>Erreur taille pseudo (doit comprendre entre 4 et 15 caractères</div>";
	}

	//---------------------------------	
	//Tester l'existance d'un pseudo (car nous avons prévu dans la BDD que le champ pseudo soit UNIQUE)
	$pdostatement = $pdo->query(" SELECT pseudo FROM membre WHERE pseudo = '$_POST[pseudo]' ");
	//debug( $pdostatement ); //Object PDOStatement

	if( $pdostatement->rowCount() >= 1 ){ //SI il y a une correspondance dans la table 'membre', $pdostatement renverra 1 ligne de résultat et donc c'est que le pseudo existe en BDD

		$error .= "<div class='alert alert-danger'>Pseudo indisponible</div>";
	}

	//---------------------------------	
	//Boucle sur TOUTES les saisies afin de les passer dans les fonctions htmlentities() et addslashes() :
	foreach( $_POST as $indice => $valeur ){

		$_POST[ $indice ] = htmlentities( addslashes( $valeur ) );
		//htmlentities( $arg) : permet de convertir en entité HTML les caractères spéciaux
		//addslashes( $arg) : permet d'ajouter des antislashs devant certains caractères (apostrophes, guillemets nottament)
	}

	//---------------------------------	
	//Cryptage du mot de passe :
	$_POST['mdp'] = password_hash( $_POST['mdp'] , PASSWORD_DEFAULT );
	//password_hash() : permet de créer une clé de hashage
		//debug( $_POST['mdp'] );

	//INSERTION :
	if( empty( $error ) ){ //SI la varibale '$error' est vide (c'est que le formulaire à été rempli correctement)

		 $nombre = $pdo->exec(" 

		 	INSERT INTO membre( pseudo, mdp, nom, prenom, email, sexe, telephone ) 

						VALUES(
								'$_POST[pseudo]',
								'$_POST[mdp]',
								'$_POST[nom]',
							     '$_POST[prenom]',
		 						'$_POST[email]',
		 						'$_POST[sexe]',
								'$_POST[phone]'
		 					)
		 				");

		//---------------------------------------
		//$pdostatement = $pdo->prepare(" INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe ) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :sexe ) ");
		//debug( $pdostatement );

			//justification des marqueurs :
			//$pdostatement->bindValue( ':pseudo', $_POST['pseudo'], PDO::PARAM_STR );
			//$pdostatement->bindValue( ':mdp', $_POST['mdp'], PDO::PARAM_STR );
			//$pdostatement->bindValue( ':nom', $_POST['nom'], PDO::PARAM_STR );
			//$pdostatement->bindValue( ':prenom', $_POST['prenom'], PDO::PARAM_STR );
			//$pdostatement->bindValue( ':email', $_POST['email'], PDO::PARAM_STR );
			//$pdostatement->bindValue( ':sexe', $_POST['sexe'], PDO::PARAM_STR );
			

		$pdostatement->execute(); //exécution de la requête préparée

		//---------------------------------------

		$content .= "<div class='alert alert-success'> Inscription validée !!!

						<a href='". URL ."connexion.php'> Cliquez ici pour vous connecter </a>
					</div>";
	}
}

//-----------------------------------------------------
?>
<?php require_once 'inc/header.inc.php'; ?>

	<h1>INSCRIPTION</h1>

	<?php echo $error; //affichage des messages d'erreurs ?>

	<?= $content; //affichage du contenu ?>

	<form method="post">
		
		<label>Identifiant:</label><br>
		<input type="text" name="pseudo"><br><br>
		
		<label>Mot de passe:</label><br>
		<input type="password" name="mdp"><br><br>

		<label>Nom</label><br>
		<input type="text" name="nom"><br><br>

		<label>Prenom</label><br>
		<input type="text" name="prenom"><br><br>

		<label>Email</label><br>
		<input type="text" name="email"><br><br>
		
		<label>Telephone</label><br>
		<input type="text" name="phone"><br><br>
		
		

		<label>Civilite</label><br>
		<input type="radio" name="sexe" value="f" checked><span>Femme</span><br>
		<input type="radio" name="sexe" value="m"><span>Homme</span><br><br>

		<input type="submit" name="valider" value="Inscription" class='btn btn-secondary'>
	</form>

<?php require_once 'inc/footer.inc.php'; ?>