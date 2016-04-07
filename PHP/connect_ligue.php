<?php
require_once("connexion.php");

function doQuery($query){
	global $conn;
	$result = mysqli_query($conn, $query);

	if($result == TRUE)
		return $result;
/*	else if( mysqli_connect_errno())
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	else {
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	}*/
}

function newLigue(){
	$table="Ligue";
	$nomLigue=$_POST['nomLigue'];
	$idGestionnaire=$_POST['idGestionnaire'];
	$req = "INSERT INTO $table VALUE (0, '$idGestionnaire', '$nomLigue')";

	doQuery($req);
}

function newEquipe(){
	$table="Equipe";
	$nomEquipe=$_POST['nomEquipe'];
	$idLigue=$_POST['idLigue'];
	$req = "INSERT INTO $table VALUE (0, $idLigue, '$nomEquipe')";
	doQuery($req);
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
	doQuery($req);
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

	doQuery($req);
}

function newAlignement(){
	$table="Alignement";
	$joueur=$_POST['joueur'];
	$equipe=$_POST['equipe'];
	$saison=$_POST['saison'];
	$position=$_POST['position'];
	$numeroChandail=$_POST['numeroChandail'];
	$req = "INSERT INTO $table VALUE ($joueur, $equipe, $saison, '$position', $numeroChandail)";

	doQuery($req);
}


function newSaison(){
	$table="Saison";
	$ligue=$_POST['ligue'];
	$dateDebut=$_POST['dateDebut'];
	$dateFin=$_POST['dateFin'];
	$numeroSaison=$_POST['numeroSaison'];
	$req = "INSERT INTO $table VALUE (0, $ligue, '$dateDebut', '$dateFin', $numeroSaison)";

	doQuery($req);
}

function newPoint(){
	$table="Points";
	$equipe=$_POST['equipe'];
	$joueur=$_POST['joueur'];
	$saison=$_POST['saison'];
	$partie=$_POST['partie'];
	$typePoint=$_POST['typePoint'];
	$req = "INSERT INTO $table VALUE ($equipe, $joueur, $saison, $partie, '$typePoint')";

	doQuery($req);
}

function getAlignement(){
	$table="Alignement";
	$equipe = $_POST['equipe'];
	$saison=$_POST['saison'];
	$req = "SELECT Joueur.ID_Joueur FROM  WHERE ";

	doQuery($req);
}

function getListEquipe(){
	$table = "Equipe";
	$idLigue=$_POST['idLigue'];
	$req ="SELECT ID_Equipe, Nom_Equipe FROM Equipe INNER JOIN Ligue ON Equipe.ID_Ligue=Ligue.ID_Ligue WHERE Nom_Ligue LIKE '%$idLigue%'";

	doQuery($req);
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

mysqli_close($con);
?>
