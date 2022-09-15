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

        <nav class=" bg-light navbar navbar-expand-sm navbar-light fixed-top">
                <div class=" bg-white container-fluid">
                    <a class="navbar-brand" href=""></a>
                    <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">Menu
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mynavbar">
                        <img src="assets/img/logogael.jpg" width="80" height="60" class="rounded-circle d-inline-block align-top" alt="logo">
                        <ul class="navbar-nav me-auto ">
                            <li class="p-2 nav-item">

                                <a class="nav-link active" aria-current="page" href="<?= URL ?>index.php"> <i class="fa-solid fa-house"></i>
                                    Visualiser mon site</a>

                            </li>


                            <li>
                                <a class="nav-link p-3" aria-current="page" href="<?= URL ?>admin/gestion_article.php"> <i class="fa-solid fa-list"></i>Gestion des articles</a>
                            </li>
                            <a class="nav-link p-3" aria-current="page" href="<?= URL ?>admin/gestion_membres.php"><i class="fa-solid fa-person-circle-plus"></i>
                                Gestion des membres</a>
                        
                            <from class="d-flex">

                                <a href="" class="btn btn-primary rounded m-2"><i class="fa-solid fa-envelope-open-text"></i></a>

                                <div class="nav-item ">
                                    <a class="nav-link btn btn-warning text-dark m-2 " href="<?php echo URL ?>admin/profil.admin.php">Profil</a>
                                </div>
                                <div class="nav-item">
                                    <a class="nav-link text-dark btn btn-danger  m-2" href="<?php echo URL ?>connexion.php?action=deconnexion">Deconnexion</a>

                                </div>



                                <li class=" p-2 nav-item dropdown ">

                                    <ul class="dropdown-menu " aria-labelledby="dropMeDecouvrir">
                                        <li><a class="dropdown-item" href="<?php echo URL ?>admin/votreArtisan.php">Votre Artisan</a></li>
                                        <li><a class="dropdown-item" href="<?php echo URL ?>admin/sonAtelier.php">Son atelier</a></li>
                                    </ul>
                                </li>

                                <li class="   nav-item dropdown">

                                    <ul class="dropdown-menu " aria-labelledby="dropStylos">
                                        <li><a class="dropdown-item" href="<?php echo URL ?>stylos.php">Stylos billes</a></li>
                                        <li><a class="dropdown-item" href="<?php echo URL ?>admin/stylosPlumeEtRoller.php">Stylos plumes & roller</a></li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo URL ?>admin/coffretCadeaux.php">coffrets cadeaux</a>
                                    </ul>
                                </li>
                        </ul>



                    </div>
                </div>
            </nav>
        </header>
        <!------------------- CONTENU PRINCIPAL ------------------------>
        <!-- CARROUSSEL PHOTO STYLOS BESTS SELLERS -->
        <main class="containerAnimated colorMain">
            <br>
            <br>
            <br>