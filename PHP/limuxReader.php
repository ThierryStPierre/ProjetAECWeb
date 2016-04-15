<?php
header ("Access-Control-Allow-Origin : localhost");
require_once("connexion.php");

function doQuery($query){
global $conn;
	$result = mysqli_query($conn, $query);

	return $result;
}

function validateLogin(){
	$userName=$_POST["userName"];
	$passWord=$_POST["passWord"];

	if(($userName != "") && (passWord != "")){
		$req = "SELECT ID_Login, ID_Personne from Login WHERE username=$userName and password=$passWord";
		$result = doQuery($req);
		if($result == "")
			echo "Fail";
		else{
		}
	}
}

function getJoueurLigue(){
	$idLigue = $_POST['idLigue'];
	$req = "SELECT Joueur.ID_Joueur, Nom, Prenom, Numero_Chandail FROM Joueur, Alignement, Equipe WHERE Alignement.ID_Equipe=Equipe.ID_Equipe AND Equipe.ID_Ligue=$idLigue";

	$result = doQuery($req);

	$row = mysqli_num_rows($result);
	echo "{\"Status\" : " ;
	if($row > 0){
		echo "\"Success\",";
		echo "{\"Alignement\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Joueur\", \"prenom\" : \"$ligne->Prenom\", \"nom\" : \"$ligne->Nom\", \"numero\" : \"$ligne->Numero_Chandail\"}";
			if(--$row > 0) echo ",";
		}
		echo "]";
	}
	else
		echo "\"Fail\"";
	echo "}";
	mysql_free_result($result);
}

function getAlignement(){
	$whereStr = "";
	$idEquipe = $_POST['idEquipe'];
	$idSaison=$_POST['idSaison'];

	if(!(($idEquipe == "") || ($idSaison == "")))
		$whereStr = "WHERE Alignement.ID_Equipe=$idEquipe AND Alignement.ID_Saison=$idSaison";

	$req = "SELECT Joueur.ID_Joueur, Nom, Prenom, Numero_Chandail FROM Joueur, Alignement " . $whereStr;
	$result = doQuery($req);

	$row = mysqli_num_rows($result);
	echo "{\"Status\" : " ;
	if($row > 0){
		echo "\"Success\",";
		echo "\"Alignement\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Joueur\", \"prenom\" : \"$ligne->Prenom\", \"nom\" : \"$ligne->Nom\", \"numero\" : \"$ligne->Numero_Chandail\"}";
			if(--$row > 0) echo ",";
		}
		echo "]";
	}
	else
		echo "\"Fail\"";
	echo "}";
	mysql_free_result($result);
}

function getListEquipe(){
	$whereStr = "";
	$idLigue=$_POST['idLigue'];
	if($idLigue)
	 $whereStr = "WHERE ID_Ligue = $idLigue";

//	$req ="SELECT ID_Equipe, Nom_Equipe FROM Equipe INNER JOIN Ligue ON Equipe.ID_Ligue=Ligue.ID_Ligue WHERE Nom_Ligue LIKE '%$idLigue%'";
	$req ="SELECT ID_Equipe, Nom_Equipe FROM Equipe " . $whereStr ;

	$result = doQuery($req);

	$row = mysqli_num_rows($result);
	echo "{\"Status\" : " ;
	if($row > 0){
		echo "\"Success\",";
		echo "\"Equipes\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Equipe\", \"nom\" : \"$ligne->Nom_Equipe\"}";
			if(--$row > 0) echo ",";
		}
		echo "]";
	}
	else
		echo "\"Fail\"";
	echo "}";
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
	echo "{\"Status\" : " ;
	if($row > 0){
		echo "\"Success\",";
		echo "\"Ligues\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Ligue\", \"nom\" : \"$ligne->Nom_Ligue\"}";
			if(--$row > 0) echo ",";
		}
		echo "]";
	}
	else
		echo "\"Fail\"";
	echo "}";
	mysql_free_result($result);
}

function getListeLigueByMarqueur(){
	$idMarqueur=$_POST['idMarqueur'];
	if($idMarqueur){
		$req = "SELECT ID_Ligue, Nom_Ligue from Ligue ";
		$result = doQuery($req);

		$row = mysqli_num_rows($result);
		echo "{\"Status\" : " ;
		if($row > 0){
			echo "\"Success\",";
			echo "\"Ligues\" : [";
			while($ligne = mysqli_fetch_object($result)){
				echo "{\"id\" : \"$ligne->ID_Ligue\", \"nom\" : \"$ligne->Nom_Ligue\"}";
				if(--$row > 0) echo ",";
			}
			echo "]";
		}
		else
			echo "\"Fail\"";
		echo "}";
		mysql_free_result($result);

	}
	else
		echo "{\"Status\" : \"Fail\"}";
}


function getListeGestionnaire(){
	$req ="SELECT ID_Joueur, Prenom, Nom FROM Joueur WHERE Gestionnaire = true";
	$result = doQuery($req);

	$row = mysqli_num_rows($result);
	echo "{\"Status\" : " ;
	if($row > 0){
		echo "\"Success\",";
		echo "\"Gestionnaires\" : [";
		while($ligne = mysqli_fetch_object($result)){
			echo "{\"id\" : \"$ligne->ID_Joueur\", \"prenom\" : \"$ligne->Prenom\", \"nom\" : \"$ligne->Nom\"}";
			if(--$row > 0) echo ",";
		}
		echo "]";
	}
	else
		echo "\"Fail\"";
	echo "}";
	mysql_free_result($result);
}

//Le controleur
$action=$_POST['action'];
switch ($action){
        case "validateLogin" :
           validateLogin();
        break;
        case "listeEquipe" :
           getListEquipe();
        break;
        case "listeJoueur" :
           getAlignement();
        break;
        case "listeJoueurLigue" :
           getJoueurLigue();
        break;
        case "listeLigue" :
           getListeLigue();
        break;
		case "":
			getListeLigueByMarqueur();
		break;
        case "listeGestionnaires" :
           getListeGestionnaire();
        break;
}

mysqli_close($conn);
?>
