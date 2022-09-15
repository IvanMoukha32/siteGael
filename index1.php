<?php require_once 'inc/init.inc.php';

if (!isset($_SESSION['panier']))
$_SESSION['panier'] =[];



//debug( $test );

?>




<?php require_once 'inc/header.inc.php'; //inclusion du header ?> 
<link href="assets/css/style.css" rel="stylesheet">
<!-- CARROUSEL-->


<section>
<div class="row-fluid">
<div  id="carouselExampleCaptions" class=" row-fluid carousel carousel-dark slide mt-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class=" carousel-item active">

            <img src="assets/img/photocaroussel1.jpg" class="  d-block w-100 img-fluid px-0" alt="..."><br><br>
            <div class="carousel-caption d-none d-md-block">
                <h5 class="text-white">Stylo bille AmericanWild</h5>
                <p class="text-white">Stylos bille en bois de chene.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/photocaroussel2.jpg" class="d-block w-100 img-fluid px-0" alt="..."><br><br>
            <div class="carousel-caption d-none d-md-block">
            <h5 class="text-white">Second slide label</h5>
                <p class="text-white">Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/photocarousel3.jpg" class="d-block w-100  px-0" alt="..."><br><br>
            <div class="carousel-caption d-none d-md-block">
                <h5 class="text-white">Third slide label</h5>
                <p class="text-white">Some representative placeholder content for the third slide.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>
</section>
<!-- CARTS-DIRECTION-PAGES_PRINCIPALES-->

<h1 class="bigTitleIndex">
 
    <span class="letters">Découvrez mon univers</span>
    <span class="line"></span>
 
</h1>
<hr class="hrCarts col-md-4">

<section>

<div class="containerAnimated d-flex align-items-center justify-content-center position-relative flex-wrap">
        <div class="card d-flex position-relative flex-column">
            <div class='imgContainer'>
            <img src="assets/img/stylo_card.png" alt="">            </div>
            <div class="content">
                <h2>Votre artisan</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget velit tristique, sollicitudin leo viverra, suscipit neque. Aliquam ut facilisis urna, in pretium nibh.  Morbi in leo in eros commodo volutpat ac sed dolor.</p>
            </div>
        </div>
        <div class="card d-flex position-relative flex-column">
            <div class='imgContainer'>
            <img src="assets/img/stylo_card.png" >           </div>
            <div class="content">
                <h2>Mon atelier</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget velit tristique, sollicitudin leo viverra, suscipit neque. Aliquam ut facilisis urna, in pretium nibh.  Morbi in leo in eros commodo volutpat ac sed dolor.</p>
            </div>
        </div>
        <div class="card d-flex position-relative flex-column">
            <div class='imgContainer'>
   <img src="assets/img/stylo_card.png" alt=""   >         </div>
            <div class="content">
                <h2>La boutique</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget velit tristique, sollicitudin leo viverra, suscipit neque. Aliquam ut facilisis urna, in pretium nibh.  Morbi in leo in eros commodo volutpat ac sed dolor.</p>
            </div>
        </div>
    </div>

    </section>





<!-- VIDEOS ETAPES FABRICATION D'UN STYLO -->
<br>
<h1 class="mt-4 bigTitleIndex">
 
    <span class="letters ">Les étapes de fabrication d'un stylo</span>
    <span class="line"></span>
 
</h1>
<hr class="hrCarts col-md-4">

<section class="row  rounded gap-1 justify-content-center ">
<div class="  col-md-3 rounded  embed-responsive embed-responsive-16by9">
<video width="320" height="240" controls>
      <source src="assets/video/presentation_tournage_stylo.mp4"  type="video/mp4">
    </video>
    <p class="text-center">Polissage</p>

</div>
<div class="  col-md-3  embed-responsive embed-responsive-16by9">
<video width="320" height="240" controls>
      <source src="assets/video/presentation_tournage_stylo.mp4"  type="video/mp4">
    </video>
    <p class="text-center">fraisage</p>

</div>
<div class="  col-md-3 rounded embed-responsive embed-responsive-16by9">
<video width="320" height="240" controls>
      <source src="assets/video/presentation_tournage_stylo.mp4"  type="video/mp4">
    </video>
    <p class='text-center textBeau '   >Polissage</p>

</div>
    
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

<script src="assets/js/script.js"></script> 

<?php require_once 'inc/footer.inc.php'; //inclusion du footer?>