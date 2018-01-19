
<?php
/*
 * **************************************************************
 * Fichier : DAO.php
 * Langage : PHP 5.1+
 * Auteur : Youn Cadoret
 *
 * **************************************************************
 */
class DAO
{


    /*
     * **************************************************************
     *	LISTE DES OEUVRES
     * **************************************************************
     */

    public function listeOeuvre()
    {   
        
        include('db.inc.php');
        $txt_req = "select cover_saison, nom_serie, serie.id_serie as id_serie from serie, saison where serie.id_serie = saison.id_serie and num_saison = 2 ;";
        $req = $db->prepare($txt_req);
        $req->execute();
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        $zIndex = 50;

        while ($uneLigne) {
            
            $nom = utf8_encode($uneLigne->nom_serie);
            $idSerie = $uneLigne->id_serie;
            $image = $uneLigne->cover_saison;
            $index = "z-index-".$zIndex;

                echo "<a href='serie-action.php?serie=".$idSerie."'>";
                echo "<div class='col-lg-3 col-sm-6 animatedParent animateOnce ".$index." '>";
                echo "<!-- Card -->";
                echo "<div class='animated fadeInUp'>";
                echo "<!-- Card header -->";
                echo "<div class='card-header'>";
                echo "<center><img style='width: 165px; height: 237px;' src='".$image."'></center></div>";
                echo "<!-- /card header -->";
                echo "<!-- Card content -->";
                echo "<div class='card-content'>";
                echo "<center><h3 style='font-weight:bold;'>".$nom."</h3></center>";
                echo "</div>";
                echo "<!-- /card content -->";							   
                echo "</div>";
                echo "<!-- /card --> ";
                echo "</div>";
                echo "</a>";
                
            $zIndex = $zIndex -1;
            $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        }
        $req->closeCursor();
    }


/*
 * **************************************************************
 *	Serie
 * **************************************************************
 */
public function getSerie($idSerie)
{
    include('db.inc.php');

    $txt_req = "SELECT nom_serie, num_saison, date_saison, resume_saison, background_saison, cover_saison, genre_saison, auteur_saison from saison, serie where serie.id_serie = saison.id_serie AND serie.id_serie = :idSerie order by num_saison ASC ;";
    $req = $db->prepare($txt_req);
    $req->bindValue("idSerie", $idSerie, PDO::PARAM_INT);
    $req->execute();
    $uneLigne = $req->fetch(PDO::FETCH_OBJ);

    $nom = utf8_encode($uneLigne->nom_serie);
    $date = utf8_encode($uneLigne->date_saison);
    $resume = utf8_encode($uneLigne->resume_saison);
    $imageBack = $uneLigne->background_saison;
    $genre = utf8_encode($uneLigne->genre_saison);
    $auteur = utf8_encode($uneLigne->auteur_saison);
    $imageCover = $uneLigne->cover_saison;

   echo "<!-- Main container --> ";
   echo "<div style='background:url(".$imageBack.") center; width:100%; height: 400px;'>";
   echo "<div style='position: relative; width:100%; height:100%;'>";
   echo "<div style='background-color: rgba(0, 0, 0, 0.4); position:aboslute; width: 99%;left:100px; height: 100%;'>";
   echo "<div style='width: 100%; height: 30%;'></div>";
   echo "<div style='width: 100%;'>";
   echo "<center>";
   echo "<table style='width:90%; color: white;'>";
   echo "<tr>";
   echo "<th rowspan='4' style='width: 230px;'><img style='border:0.6px solid white; width: 165px; height: 233px;'src='".$imageCover."'></th>";
   echo "<td><h1 style='font-weight:bold;'>".$nom."</h1></td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td><p>".$auteur."</p></td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td>".$date."</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td><p>".$resume."<p></td>";
   echo "</tr>";
   echo "</table>";
   echo "</center>";
   echo "</div>";
   echo "</div>";
   echo "</div>";
   echo "</div>";
   

    $req->closeCursor();
}



/*
 * **************************************************************
 *	getEpisode
 * **************************************************************
 */
public function getEpisode($idSerie){
    include('db.inc.php');

    $txt_req = "SELECT num_saison; count(id_episode) as nrbEpsiode from saison, serie, episode where serie.id_serie = saison.id_serie AND saison.id_saison = episode.id_saison AND serie.id_serie = :idSerie GROUP BY num_saison;";
    $req = $db->prepare($txt_req);
    $req->bindValue("idSerie", $idSerie, PDO::PARAM_INT);
    $req->execute();
    $uneLigne = $req->fetch(PDO::FETCH_OBJ);

        $txt_req1 = "SELECT cover_saison, num_saison, num_episode, lien_episode from saison, serie, episode where serie.id_serie = saison.id_serie AND saison.id_saison = episode.id_saison AND serie.id_serie = :idSerie order by num_episode ASC ;";
        $req1 = $db->prepare($txt_req1);
        $req1->bindValue("idSerie", $idSerie, PDO::PARAM_INT);
        $req1->execute();
        $uneLigne1 = $req1->fetch(PDO::FETCH_OBJ);

        $numero = 0;
        $zIndex = 50;

            while ($uneLigne1) {
                
                $num_saison = $uneLigne1->num_saison;
                $lien = $uneLigne1->lien_episode;
                $num_episode = $uneLigne1->num_episode;
                $imageCover = $uneLigne1->cover_saison;

                if($numero != $num_saison){
                        
                    $numero = $num_saison;
                        echo  "<div style='width:100%; height: 400px;'>";
                        echo  "<br>";
                        echo  "<div class='row'>";
                        echo  "<div class='col-lg-12 animatedParent animateOnce z-index-".$zIndex."'>";
                        echo  "<div class='panel panel-default animated fadeInUp'>";
                        echo  "<div class='panel-heading clearfix'>";
                        echo  "<h2 class='panel-title'>Saison ".$num_saison."</h2>";
                        echo  "<ul class='panel-tool-options'> ";
                        echo  "<li><a data-rel='collapse' href='#'><i class='icon-down-open'></i></a></li>";
                        echo  "</ul>";
                        echo  "</div>";
                        echo  "<div class='panel-body'>";
                }

                echo  "<!-- ========================== CARD episode ============================== -->";								
                echo  "<a class='lienVisite' href='https://uptostream.com/iframe/".$lien."'>";
                echo  "<div class='col-lg-3 col-sm-6 animatedParent animateOnce z-index-".$zIndex."'>";
                echo  "<!-- Card -->";
                echo  "<div class='animated fadeInUp'>";
                echo  "<!-- Card header -->";
                echo  "<div class='card-header'>";
                echo  "<center><img style='width: 92.5px; height: 128.5px;' src='".$imageCover."'></center>";
                echo  "</div>";
                echo  "<!-- /card header -->";
                echo  "<!-- Card content -->";
                echo  "<div class='card-content'>";
                echo  "<center><h2><strong>".$num_episode."</strong></h2></center>";
                echo  "</div>";
                echo  "<!-- /card content -->";					   
                echo  "</div>";
                echo  "<!-- /card --> ";
                echo  "</div>";
                echo  "</a>";
                echo  "<!-- ========================== /CARD episode ============================== -->";
                        
                $zIndex = $zIndex -1;
                $uneLigne1 = $req1->fetch(PDO::FETCH_OBJ);
        }
    $req1->closeCursor();
}


/*
 * **************************************************************
 *	COMPTE
 * **************************************************************
 */
    public function compte($leLogin, $leMdp)
    {
        include('db.inc.php');

        $txt_req = "SELECT login_utilisateur, count(*) as nbr from utilisateur where mdp_utilisateur LIKE :mdp AND login_utilisateur LIKE :login  ; ";
        $req = $db->prepare($txt_req);
        $req->bindValue("login", $leLogin, PDO::PARAM_STR);
        $req->bindValue("mdp", $leMdp, PDO::PARAM_STR);
        $req->execute();
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);

        $nbr = $uneLigne->nbr;
        $login = $uneLigne->login_utilisateur;

        if ($nbr == 1) {
            echo "Ma Bibliothèque";
        } else {
            echo "Se connecter";
        }
        $req->closeCursor();

    }


    /*
* **************************************************************
*	Les films Le TOP INDEX
* **************************************************************
*/
    public function AccueilFilm()
    {
        include('db.inc.php');


        $txt_req = "SELECT id_oeuvre, image_oeuvre, nom_auteur, nom_oeuvre from oeuvre, auteur where oeuvre.auteur_oeuvre = auteur.id_auteur AND type_oeuvre LIKE 'film' order by lecture_oeuvre DESC;";
        $req = $db->prepare($txt_req);
        $req->execute();
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);

        $id = utf8_encode($uneLigne->id_oeuvre);
        $nom = utf8_encode($uneLigne->nom_oeuvre);
        $image = $uneLigne->image_oeuvre;
        $auteur = $uneLigne->nom_auteur;

        $i = 0;

        echo "<table style='width: 300px'>";
        while ($uneLigne and $i < 4) {

            $i = $i + 1;


            $id = utf8_encode($uneLigne->id_oeuvre);
            $nom = utf8_encode($uneLigne->nom_oeuvre);
            $image = $uneLigne->image_oeuvre;
            $auteur = $uneLigne->nom_auteur;
            $fichier = $uneLigne->fichier_oeuvre;


            if ($i == 3) {


                echo "<tr><td style='width: 100px;'><img style='width: 100%;' src='" . $image . "'></td>";
                echo "<td style='background:black ;'><ol<a href='#' style='text-decoration: none; color: yellow; left: 0px; font-size: 16px; font-weight: bold;'><h1>&nbsp" . $nom . "</h1></br<h2>&nbsp" . $auteur . "</h2></a></ol></td></tr>";


            } else {

                echo "<tr><td style='width: 100px;'><img style='width: 100%;' src='" . $image . "'></td>";
                echo "<td style='background:yellow ;'><ol<a href='#' style='text-decoration: none; color: black; left: 0px; font-size: 16px; font-weight: bold;'><h1>&nbsp" . $nom . "</h1></br<h2>&nbsp" . $auteur . "</h2></a></ol></td></tr>";


            }

            $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        }
        echo "</table>";


        $req->closeCursor();

    }



    /*
* **************************************************************
*	Les films Le TOP INDEX
* **************************************************************
*/
    public function AccueilLivre()
    {
        include('db.inc.php');


        $txt_req = "SELECT id_oeuvre, image_oeuvre, nom_auteur, nom_oeuvre from oeuvre, auteur where oeuvre.auteur_oeuvre = auteur.id_auteur AND type_oeuvre LIKE 'livre' order by lecture_oeuvre DESC;";
        $req = $db->prepare($txt_req);
        $req->execute();
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);

        $id = utf8_encode($uneLigne->id_oeuvre);
        $nom = utf8_encode($uneLigne->nom_oeuvre);
        $image = $uneLigne->image_oeuvre;
        $auteur = $uneLigne->nom_auteur;

        $i = 0;

        echo "<table style='width: 300px'>";
        while ($uneLigne and $i < 4) {

            $i = $i + 1;


            $id = utf8_encode($uneLigne->id_oeuvre);
            $nom = utf8_encode($uneLigne->nom_oeuvre);
            $image = $uneLigne->image_oeuvre;
            $auteur = $uneLigne->nom_auteur;
            $fichier = $uneLigne->fichier_oeuvre;


            if ($i == 3) {


                echo "<tr><td style='width: 100px;'><img style='width: 100%;' src='" . $image . "'></td>";
                echo "<td style='background:black ;'><ol<a href='#' style='text-decoration: none; color: yellow; left: 0px; font-size: 16px; font-weight: bold;'><h1>&nbsp" . $nom . "</h1></br<h2>&nbsp" . $auteur . "</h2></a></ol></td></tr>";


            } else {

                echo "<tr><td style='width: 100px;'><img style='width: 100%;' src='" . $image . "'></td>";
                echo "<td style='background:yellow ;'><ol<a href='#' style='text-decoration: none; color: black; left: 0px; font-size: 16px; font-weight: bold;'><h1>&nbsp" . $nom . "</h1></br<h2>&nbsp" . $auteur . "</h2></a></ol></td></tr>";


            }

            $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        }
        echo "</table>";


        $req->closeCursor();

    }



    /*
* **************************************************************
*	Les musiques Le TOP INDEX
* **************************************************************
*/
    public function AccueilMusic()
    {
        include('db.inc.php');


        $txt_req = "SELECT id_oeuvre, image_oeuvre, nom_auteur, nom_oeuvre from oeuvre, auteur where oeuvre.auteur_oeuvre = auteur.id_auteur AND type_oeuvre LIKE 'music' order by lecture_oeuvre DESC;";
        $req = $db->prepare($txt_req);
        $req->execute();
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);

        $id = utf8_encode($uneLigne->id_oeuvre);
        $nom = utf8_encode($uneLigne->nom_oeuvre);
        $image = $uneLigne->image_oeuvre;
        $auteur = $uneLigne->nom_auteur;

        $i = 0;

        echo "<table style='width: 300px'>";
        while ($uneLigne and $i < 5) {

            $i = $i + 1;


            $id = utf8_encode($uneLigne->id_oeuvre);
            $nom = utf8_encode($uneLigne->nom_oeuvre);
            $image = $uneLigne->image_oeuvre;
            $auteur = $uneLigne->nom_auteur;
            $fichier = $uneLigne->fichier_oeuvre;


            if ($i == 3) {

                echo "<tr><td style='width: 100px;'><img style='width: 100%;' src='" . $image . "'></td>";
                echo "<td style='background:yellow ;'><ol<a href='#' style='text-decoration: none; color: black; left: 0px; font-size: 16px; font-weight: bold;'><h2>&nbsp" . $nom . "</h2></br<h3>&nbsp" . $auteur . "</h2></a></ol></td></tr>";


            } else {
                echo "<tr><td style='width: 100px;'><img style='width: 100%;' src='" . $image . "'></td>";
                echo "<td style='background:black ;'><ol<a href='#' style='text-decoration: none; color: yellow; left: 0px; font-size: 16px; font-weight: bold;'><h2>&nbsp" . $nom . "</h2></br<h3>&nbsp" . $auteur . "</h2></a></ol></td></tr>";

            }

            $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        }
        echo "</table>";


        $req->closeCursor();

    }


    /*
* **************************************************************
*	ACCUEIL FILM
* **************************************************************
*/
    public function film()
    {
        include('db.inc.php');

        $txt_req = "SELECT id_oeuvre, image_oeuvre, fichier_oeuvre, nom_oeuvre from oeuvre where type_oeuvre LIKE 'film' order by lecture_oeuvre DESC;";
        $req = $db->prepare($txt_req);
        $req->execute();
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);

        $id = utf8_encode($uneLigne->id_oeuvre);
        $nom1 = utf8_encode($uneLigne->nom_oeuvre);
        $image = $uneLigne->image_oeuvre;
        $type = $uneLigne->type_oeuvre;
        $fichier1 = $uneLigne->fichier_oeuvre;


        $playlist = "?playlist=";
        $i = 0;
        $liste = "";

        while ($uneLigne and $i < 12) {

            $i = $i + 1;


            $id = utf8_encode($uneLigne->id_oeuvre);
            $nom = utf8_encode($uneLigne->nom_oeuvre);
            $image = $uneLigne->image_oeuvre;
            $type = $uneLigne->type_oeuvre;
            $fichier = $uneLigne->fichier_oeuvre;


            if ($fichier == $fichier1) {

            } else {

                $playlist = $playlist . "," . $fichier;

            }

            $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        }


        $iframe = "<div style='padding-top:56.25%; position:relative; width:100%;'><iframe style='height:100%; left:0px; position:absolute; top:0px; width:100%;'";
        $iframe = $iframe . "src='https://www.youtube.com/embed/" . $fichier1 . $playlist . "&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&fs=0&controls=2'";
        $iframe = $iframe . "frameborder='0' allowfullscreen></iframe></div>";
        echo $iframe;

        $req->closeCursor();

    }


    /*
 * **************************************************************
 *	ACCUEIL MUSIC
 * **************************************************************
 */
    public function music()
    {
        include('db.inc.php');

        $txt_req = "SELECT id_oeuvre, image_oeuvre, fichier_oeuvre, nom_oeuvre from oeuvre where type_oeuvre LIKE 'music' order by lecture_oeuvre DESC;";
        $req = $db->prepare($txt_req);
        $req->execute();
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);

        $id = utf8_encode($uneLigne->id_oeuvre);
        $nom1 = utf8_encode($uneLigne->nom_oeuvre);
        $image = $uneLigne->image_oeuvre;
        $type = $uneLigne->type_oeuvre;
        $fichier1 = $uneLigne->fichier_oeuvre;


        $playlist = "?playlist=";
        $i = 0;
        $liste = "";

        while ($uneLigne and $i < 12) {

            $i = $i + 1;


            $id = utf8_encode($uneLigne->id_oeuvre);
            $nom = utf8_encode($uneLigne->nom_oeuvre);
            $image = $uneLigne->image_oeuvre;
            $type = $uneLigne->type_oeuvre;
            $fichier = $uneLigne->fichier_oeuvre;


            if ($fichier == $fichier1) {

            } else {

                $playlist = $playlist . "," . $fichier;
            }
            $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        }


        $iframe = "<div style='padding-top:56.25%; position:relative; width:100%;'><iframe style='height:100%; left:0px; position:absolute; top:0px; width:100%;'";
        $iframe = $iframe . "src='https://www.youtube.com/embed/" . $fichier1 . $playlist . "&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&fs=0&controls=2'";
        $iframe = $iframe . "frameborder='0' allowfullscreen></iframe></div>";
        echo $iframe;


        $req->closeCursor();


    }
}

?>