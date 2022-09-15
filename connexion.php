<?php require_once "inc/init.inc.php";

//DECONNEXION : Les scripts de déconnexion se postionnent TOUJOURS AVANT les redirections sinon elle ne serait pas interprétée par l'interpréteur php à cause du exit; qui suit la redirection.
//debug( $_GET );

if( isset( $_GET['action'] ) && $_GET['action'] == "deconnexion" ){ //SI il EXISTE 'action' dans l'URL - ET - que cette 'action' est égale à "deconnexion"

	session_destroy();
	//session_destroy : permet de détruire le fichier de session et elle sera interprétée après la lecture complète du script

	//unset( $_SESSION['membre'] );
	//unset() : fonction pour détruire une variable
		//Ici, supprimera la session/membre et entrainera donc la deconnexion
}

//--------------------------------------------------
//restriction d'accès à la page SI L'UTILISATEUR EST CONNECTE :
if( userConnect() ){

	header('location:profil.php'); //redirection vers la page profil.php
	exit;
}

//--------------------------------------------------
if( $_POST ){ //SI validation du formulaire

	//debug( $_POST );

	//1 - Verifier si le pseudo existe, si c'est le cas, on récupèrera (SELECT) les infos du membre en bdd pour comparer ensuite son mdp

	//Comparaison du pseudo posté et celui de la BDD (pour savoir si il existe) :
	$r = $pdo->query(" SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]' ");
		//debug( $r ); //Object PDOStatement

	if( $r->rowCount() >= 1 ){ //SI il y a une correspondance dans la table 'membre', $r renverra 1 ligne de résultat et donc c'est que le pseudo existe en BDD

		//Ici, je récupère les données sous forme d'un Array pour les exploiter :
		$membre = $r->fetch( PDO::FETCH_ASSOC );
			//La méthode fetch() : s'exécute sur un objet PDOStatement, et retourne un tableau avec les données de la requête
				//Le paramètre PDO::FETHC_ASSOC permet de faire d'indéxer le tableau (retournée par le fetch()) avec les champs de la table
			//debug( $membre );

		if( password_verify( $_POST['mdp'] , $membre['mdp'] ) ){
			//password_verify( arg1, arg2 ) : retourne true ou false et permet de comparer une chaine à une chaine cryptée
				//arg1 : le mot de passe (ici posté par l'utilisateur)
				//arg2 : le mot de passe crypté par la fonction password_hash() (ici, le mdp en BDD correspondant au pseudo posté)

			//Insertion des infos ($membre) de la personne qui se connecte dans le fichier de session
			$_SESSION['membre'] = $membre;
				//debug( $_SESSION );

			//redirection vers la page profil :
			header('location:profil.php');
			//header() : permet de faire une redirection vers un autre fichier
				// ATTENTION : la fonction header() doit etre appeler avant tout affichage (html) 
			
			//exit; : permet de quitter A CET ENDRIT PRECIS le script courant et donc de ne pas interpréter le code qui suit cette instruction.
		}

		

		else{ //SINON, c'est que le mdp n'est pas bon

			$error .= "<div class='alert alert-danger'>Mot de passe incorrect ! </div>";
		}
	}
	else{ //SINON, c'est que le pseudo n'existe pas en bdd

		$error .= "<div class='alert alert-danger'>Pseudo incorrect ! </div>";
	}
}

//----------------------------------------------------------------------
?>
<?php require_once "inc/header.inc.php"; ?>

	<h1>CONNEXION</h1>

	<?php echo $error; //affichage des messages d'erreurs ?>

	<form method="post">
		
		<label>Pseudo</label><br>
		<input type="text" name="pseudo" placeholder="Votre pseudo"><br><br>
		
		<label>Mot de passe</label><br>
		<input type="password" name="mdp" placeholder="Votre mot de passe"><br><br>

		<input type="submit" value="se connecter" class="btn btn-secondary">
	</form>

<?php require_once "inc/footer.inc.php"; ?>