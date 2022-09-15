<?php require_once 'inc/init.inc.php';

if   (isset($_POST['message'])) {
    $entete  = 'MIME-Version: 1.0' . "\r\n";
    $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $entete .= 'From: webmaster@monsite.fr' . "\r\n";
    $entete .= 'Reply-to: ' . $_POST['email'];

    $message = '<h1>Ce message a été envoyé depuis la page conctact du site duboisalaplume.com</h1>
    <p><b>Email : </b>' . $_POST['email'] . '<br>
    <b>Message : </b>' . htmlspecialchars($_POST['message']) . '</p>';

    $retour = mail('gaeldelmas@duboisalaplume.com', 'Envoi depuis page Contact', $message, $entete);
    if($retour){
        echo '<p>Votre message a bien été envoyé.</p>';
}}
?>



<?php require_once 'inc/header.inc.php'; 


?>

<link href="assets/CSS/style.css" rel="stylesheet">



<h1>Contactez-moi</h1>
    <form class="formContact"method="post">
        <label class="labelContact">Votre nom*:</label>
        <input class= "inputContact" type="text" name="famillyNameContact" placeholder="indiquez votre nom" required>
        <label class="labelContact">Votre prénom*:</label>
        <input class= "inputContact" type="text" name="firstNameContact" placeholder="indiquez votre prénom" required>
        <label class="labelContact">Votre email*:</label>
        <input class= "inputContact" type="email" name="email" placeholder="indiquez votre email" required>
        <label class="labelContact"> Votre numéro de téléphone:</label>
        <input class= "inputContact" type="email" name="email" placeholder="indiquez votre email" required>
        <label class="labelContact">Message*:</label>
        <textarea class="textAreaContact" name="message"  placeholder="tapez votre message ici" required></textarea>
        <input class= "inputContact" class="bg-primary" type="submit">
    </form>
    <?php

?>


<?php require_once 'inc/footer.inc.php'; ?>