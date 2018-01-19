<?php
/* ***************************************************************
  Fichier    : db.inc.php
  Langage    : PHP 5.x
  Auteur     : Youn Cadoret
  Extensions : Aucune
  Paramètres : Aucun
*************************************************************** */

  $server = "mysql";
  $host   = "localhost";
  $base   = "waf";
  $user   = "root";
  $passwd = "";
  
  try {
    $db = new PDO ( "$server:host=$host;dbname=$base", $user, $passwd );
  } catch ( PDOException $e ) {
  	// Connexion impossible... impossible donc d'aller plus loin !
  	die ( "Impossible de se connecter a la source de donnees..." );
  }
  
?>





