<?php
header ("Access-Control-Allow-Origin : localhost");
require_once("connexion.php");

function doQuery($query){
	global $conn;
	$result = mysqli_query($conn, $query);

	return $result;
}

function createStatus($status){
	global $conn;
        echo "{\"Status\" : " ;
        if($status > 0)
        {
                echo "\"Success\"";
                echo ", \"Id\" : \"";
                echo  mysqli_insert_id($conn) ;
                echo "\"";
        }
        else
                echo "\"Fail\"";

        echo "}";
}

function newLigue(){
	$table="Ligue";
	$nomLigue=$_POST['nomLigue'];
	$idGestionnaire=$_POST['idGestionnaire'];
	$req = "INSERT INTO $table VALUE (0, '$idGestionnaire', '$nomLigue')";

	createStatus(doQuery($req));
}

function newEquipe(){
	$table="Equipe";
	$nomEquipe=$_POST['nomEquipe'];
	$idLigue=$_POST['idLigue'];
	$req = "INSERT INTO $table VALUE (0, $idLigue, '$nomEquipe')";

	createStatus(doQuery($req));
}

function newJoueur(){

	$table="Joueur";
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$dateDeNaissance=$_POST['dateDeNaissance'];
	$telephone=$_POST['telephone'];
	$courriel=$_POST['courriel'];
	$nomUsager=$_POST['nomUsager'];
	$motDePasse=$_POST['motDePasse'];
	$capitaine=$_POST['capitaine'];
	$pointeur=$_POST['pointeur'];
	$gestionnaire=$_POST['gestionnaire'];
	$req = "INSERT INTO $table VALUE (0, '$nom', '$prenom', '$dateDeNaissance', '$telephone', '$courriel', '$nomUsager', '$motDePasse', $capitaine, $pointeur, $gestionnaire)";

	createStatus(doQuery($req));
}


function newPartie(){
	$table="Partie";
	$lieu=$_POST['lieu'];
	$duree=$_POST['duree'];
	$date=$_POST['date'];
	$equipe1=$_POST['equipe1'];
	$equipe2=$_POST['equipe2'];
	$pointage1=$_POST['pointage1'];
	$pointage2=$_POST['pointage2'];
	$req = "INSERT INTO $table VALUE (0, '$lieu', '$duree', '$date', $equipe1, $equipe2, $pointage1, $pointage2)";

	createStatus(doQuery($req));
}

function newAlignement(){
	$table="Alignement";
	$joueur=$_POST['joueur'];
	$equipe=$_POST['equipe'];
	$saison=$_POST['saison'];
	$position=$_POST['position'];
	$numeroChandail=$_POST['numeroChandail'];
	$req = "INSERT INTO $table VALUE ($joueur, $equipe, $saison, '$position', $numeroChandail)";

	createStatus(doQuery($req));
}


function newSaison(){
	$table="Saison";
	$ligue=$_POST['ligue'];
	$dateDebut=$_POST['dateDebut'];
	$dateFin=$_POST['dateFin'];
	$numeroSaison=$_POST['numeroSaison'];
	$req = "INSERT INTO $table VALUE (0, $ligue, '$dateDebut', '$dateFin', $numeroSaison)";

	createStatus(doQuery($req));
}

function newPoint(){
	$table="Points";
	$equipe=$_POST['equipe'];
	$joueur=$_POST['joueur'];
	$saison=$_POST['saison'];
	$partie=$_POST['partie'];
	$typePoint=$_POST['typePoint'];
	$req = "INSERT INTO $table VALUE ($equipe, $joueur, $saison, $partie, '$typePoint')";

	createStatus(doQuery($req));
}

//Le controleur
$action=$_POST['action'];
switch ($action){
        case "newLigue" :
           newLigue();
        break;
        case "newJoueur" :
           newJoueur();
        break;
        case "newEquipe" :
           newEquipe();
        break;
        case "newPartie" :
           newPartie();
        break;
        case "newAlignement" :
           newAlignement();
        break;
        case "newSaison" :
           newSaison();
        break;
        case "newPoint" :
           newPoint();
        break;
}

mysqli_close($conn);
?>
