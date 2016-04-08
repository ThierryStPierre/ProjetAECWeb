<?php
require_once("connexion.php");

function doQuery($query){
	global $conn;
	$result = mysqli_query($conn, $query);

	return $result;
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
	$equipe = $_POST['equipe'];
	$saison=$_POST['saison'];
	$req = "SELECT Joueur.ID_Joueur, Nom, Prenom, Numero_Chandail FROM Joueur, Alignement where Alignement.ID_Equipe=$idEquipe AND Alignement.ID_Saison=$idSaison";

	$result = doQuery($req);
	$row = mysqli_num_rows($result);
	if($row > 0){
		echo "{\"Alignement :\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Joueur\", \"prenom\" : \"$ligne->Prenom\",  \"nom\" : \"$ligne->Nom\" \"numero\" : \"$ligne->Numero_Chandail\"}";
			if(--$row > 0) echo ",";
		}
		echo "];}";
	}
	else
		echo "No result found!";
	mysql_free_result($result);
}

function getListEquipe(){
	$idLigue=$_POST['idLigue'];
	$req ="SELECT ID_Equipe, Nom_Equipe FROM Equipe INNER JOIN Ligue ON Equipe.ID_Ligue=Ligue.ID_Ligue WHERE ID_Ligue = $idLigue";

	$result = doQuery($req);
	$row = mysqli_num_rows($result);
	if($row > 0){
		echo "{\"Equipes\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Equipe\", \"nom\" : \"$ligne->Nom_Equipe\"}";
			if(--$row > 0) echo ",";
		}
		echo "];}";
	}
	else
		echo "No result found!";
	mysql_free_result($result);
}

function getListeLigue(){
	$idGestionnaire=$_POST['idGestionnaire'];
	if($idGestionnaire)
		$req ="SELECT ID_Ligue, Nom_Ligue FROM Ligue WHERE ID_Gestionnaire = $idGestionnaire";
	else
		$req ="SELECT ID_Ligue, Nom_Ligue FROM Ligue";

	$result = doQuery($req);

	$row = mysqli_num_rows($result);
	if($row > 0){
		echo "{\"Ligues\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Ligue\", \"nom\" : \"$ligne->Nom_Ligue\"}";
			if(--$row > 0) echo ",";
		}
		echo "];}";
	}
	else
		echo "No result found!";
	mysql_free_result($result);
}

function getListeGestionnaire(){
	$req ="SELECT ID_Joueur, Prenom, Nom FROM Joueur WHERE Gestionnaire = true";
	$result = doQuery($req);

	$row = mysqli_num_rows($result);
	if($row > 0){
		echo "{\"Gestionnaires\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Joueur\", \"prenom\" : \"$ligne->Prenom\", \"nom\" : \"$ligne->Nom\"}";
			if(--$row > 0) echo ",";
		}
		echo "];}";
	}
	else
		echo "No result found!";
	mysql_free_result($result);
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
        case "listeLigue" :
		getListeLigue();
        break;
        case "listeGestionaires" :
		getListeGestionnaire();
        break;
}

mysqli_close($con);
?>
