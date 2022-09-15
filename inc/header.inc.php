<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SCRIPT BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    



    <!-- CSS PERSO -->
    <link href="assets/css/style.css" rel="stylesheet">
    <title>Page accueil</title>
</head>

<body>

    <!--------- HEADER ------------->
    <!-- MENU PRINCIPAL -->
    
      
    <main>
        <header>
            <nav class="navbar bg-light  navbar-expand-sm navbar-light bgnav fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href=""></a>
                    <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">Menu
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mynavbar">
                        <img src="assets/img/logogael.jpg" width="80" height="60" class="rounded-circle d-inline-block align-top" alt="logo">
                        <ul class="navbar-nav me-auto ">
                            <li class="p-2 nav-item">

                                <a class="nav-link active" aria-current="page" href="<?= URL ?>index1.php"> <i class="fa-solid fa-house"></i>
                                    Accueil</a>

                            </li>

                            <?php if (adminConnect()) : //SI l'ADMIN est connecté, on affiche le menu du BackOffice 
                            ?>
                                <a class="nav-link p-3"  href="<?= URL ?>admin/profil.admin.php"> <i class="fa-solid fa-sitemap"></i>
                                    Back-Office</a>


                            <?php endif; ?>

                            <?php if (userConnect()) : //SI l'utilisateur EST CONNECTE, on affiche les liens 'profil' et 'deconnexion' 
                            ?>

                                <li class=" nav-item ">
                                    <a class="p-3  nav-link" href="<?php echo URL ?>stylos.php">
                                        <i class="fa-solid fa-pen-fancy"></i> La boutique</a>
                                    
                                </li>
                                <li class=" p-2 nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle " id="dropMeDecouvrir" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-pen-ruler"></i>
                                        Mon univers
                                    </a>
                                    <ul class="dropdown-menu " aria-labelledby="dropMeDecouvrir">
                                        <li><a class="dropdown-item" href="<?php echo URL ?>votre_artisan.php">Votre Artisan</a></li>
                                        <li><a class="dropdown-item" href="<?php echo URL ?>son_atelier.php">Son atelier</a></li>
                                    </ul>
                                </li>

                                <from class="d-flex">
                                    <a href="<?php echo URL ?>panier.php" class="btn btn-light  rounded m-2"><i class="fa-solid  fa-cart-arrow-down"></i></a>
                                    <a href="<?php echo URL ?>contact.php" class="btn btn-primary rounded m-2"><i class="fa-solid fa-envelope-open-text"></i></a>

                                    <div class="nav-item ">
                                        <a class="nav-link btn btn-warning text-dark m-2 " href="<?php echo URL ?>profil.php">Profil</a>
                                    </div>
                                    <div class="nav-item">
                                    <a class="nav-link text-dark btn btn-danger  m-2" href="<?php echo URL ?>connexion.php?action=deconnexion">Deconnexion</a>

                                    </div>



                                <?php else : //SINON, c'est que l'utilisateur n'est pas connecté et affichera les liens 'inscription' et 'connexion' 
                                ?>

                                    <li class=" p-2 nav-item dropdown ">
                                        <a class="nav-link dropdown-toggle " id="dropMeDecouvrir" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-pen-ruler"></i>
                                            Mon univers
                                        </a>
                                        <ul class="dropdown-menu " aria-labelledby="dropMeDecouvrir">
                                            <li><a class="dropdown-item" href="<?php echo URL ?>votre_artisan.php">Votre Artisan</a></li>
                                            <li><a class="dropdown-item" href="<?php echo URL ?>son_atelier.php">Son atelier</a></li>
                                        </ul>
                                    </li>

                                    <li class="   nav-item dropdown">
                                        <a class="  p-3 nav-link dropdown-toggle" id="dropStylos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-pen-fancy"></i> La boutique</a>
                                        <ul class="dropdown-menu " aria-labelledby="dropStylos">
                                            <li><a class="dropdown-item" href="<?php echo URL ?>stylos.php">Stylos billes</a></li>
                                        </ul>
                                    </li>
                        </ul>
                        <from class="d-flex">
                            <a href="<?php echo URL ?>panier.php" class="btn btn-light rounded m-2"><i class="fa-solid fa-cart-arrow-down"></i></a>
                            <a href="<?php echo URL ?>contact.php" class="btn btn-primary rounded m-2"><i class="fa-solid fa-envelope-open-text"></i></a>
                            <a href="<?php echo URL ?>inscription.php" class="btn btn-light m-2">Inscription</a>
                            <a href="<?php echo URL ?>connexion.php" class="btn btn-secondary m-2">Connexion</a>
                        </from>
                    <?php endif; ?>




                    </div>
                </div>
            </nav>
        </header>
       
        
        <!------------------- CONTENU PRINCIPAL ------------------------>
        <!-- CARROUSSEL PHOTO STYLOS BESTS SELLERS -->
        <main class="container rounded colorMain ">
        <br>