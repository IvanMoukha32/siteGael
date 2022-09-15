CREATE DATABASE hvrb6018_bddgael;

USE hvrb6018_bddgael;


CREATE TABLE article(
   id_article INT(50)AUTO_INCREMENT,
   categorie VARCHAR(50),
   nom_modele VARCHAR(150 ),
   description_produit VARCHAR(150 ),
   photo_produit VARCHAR(550 ),
   bois VARCHAR(50),
   photo_bois VARCHAR(550),
   prix INT(50),
   PRIMARY KEY(id_article)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE payements(
   id_payement INT(50)AUTO_INCREMENT,
   code_payement VARCHAR(50),
   nom_payement VARCHAR(50),
   PRIMARY KEY(id_payement)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE membre(
   id_membre INT(50)AUTO_INCREMENT,
   pseudo VARCHAR(150),
   mdp VARCHAR(150),
   nom VARCHAR(150),
   prenom VARCHAR(150),
   email VARCHAR(150),
   sexe enum('m','f') NOT NULL,
   statut int(1) NOT NULL DEFAULT 0,
   telephone VARCHAR(150),
   ville VARCHAR(150),
   pays VARCHAR(150),
   cp VARCHAR(50),
   PRIMARY KEY(id_membre)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE commandes(
   id_commande INT(50)AUTO_INCREMENT,
   prix_commande_ht INT(150),
   prix_commande_ttc INT(150),
   date_commande datetime(6),
   id_payement INT(150)NOT NULL,
   id_membre INT(150)NOT NULL,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_payement) REFERENCES payements(id_payement),
   FOREIGN KEY(id_membre) REFERENCES membre(id_membre)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


CREATE TABLE detail_commande(
   id_detail_commande INT(50)AUTO_INCREMENT,
   id_article INT(150) NOT NULL,
   id_commande INT(150) NOT NULL,
   quantite VARCHAR(150) NOT NULL,
   prix INT(150) NOT NULL,
   PRIMARY KEY(id_detail_commande),
   FOREIGN KEY(id_article) REFERENCES article(id_article),
   FOREIGN KEY(id_commande) REFERENCES commandes(id_commande)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

