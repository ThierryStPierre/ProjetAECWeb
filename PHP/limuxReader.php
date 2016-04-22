<?php
header ("Access-Control-Allow-Origin : localhost");
require_once("connexion.php");

function doQuery($query){
	global $conn;
    $result = mysqli_query($conn, $query);

    return $result;
}

function returnFail(){
    echo "{\"Status\" : \"Fail\"}";
}

function validateLogin(){
    $userName=$_POST["userName"];
    $passWord=$_POST["passWord"];

    if(($userName != "") && (passWord != "")){
        $req = "SELECT Nom, Prenom, Personne.ID_Personne FROM Personne INNER ".
               "JOIN Login ON Personne.ID_Personne=Login.ID_Personne ".
                "WHERE Login.Nom_Usager='$userName' AND Mot_De_Passe='$passWord'";

        $result = doQuery($req);

        echo "{\"Status\" : " ;
        if($result == "")
            echo "Fail";
        else{
            $row = mysqli_num_rows($result);

            if($row > 0){
                $rowCount=0;
                echo "\"Success\", ";
                if($ligne = mysqli_fetch_object($result)){
                    echo " \"personne\" : {\"id\" : \"$ligne->ID_Personne\",";
                    echo " \"nom\" : \"$ligne->Nom\", \"prenom\" : \"$ligne->Prenom\"}";
                    $req2 = "SELECT * FROM Competence WHERE ID_Personne=" . $ligne->ID_Personne;

                    $result2= doQuery($req2);
                    if($result2 != ""){
                        $row2 = mysqli_num_rows($result2);

                        if($row2 > 0){
                            echo ", \"competence\" : [";
                            while($ligne2=mysqli_fetch_object($result2)){
                                echo "{\"id\" : \"$ligne2->ID_Personne\", \"competenceValue\"".
                                     " : \"$ligne2->Competence\", \"ligue\" : \"$ligne2->ID_Ligue\",".
                                     " \"sous-ligue\" : \"$ligne2->ID_SousLigue\", \"equipe\" : \"$ligne2->ID_Equipe\"}";
                                if(--$row2 > 0 ) echo ",";
                            }
                            echo "]";
                        }
                    }
                    mysql_free_result($result2);
                }

            }
        }
        mysql_free_result($result);
        echo "}";
    }
	else
		returnFail();
}

function getJoueurLigue(){
    $idLigue = $_POST['idLigue'];
	if(!is_numeric($idLigue)){
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
	else returnFail();
}

function getAlignement(){
    $whereStr = "";
    $idEquipe = $_POST['idEquipe'];

	if(is_numeric($idEquipe)){
        $req = "SELECT Personne.ID_Personne, Personne.Nom, Personne.Prenom,".
		" Alignement.ID_Saison, Alignement.Numero_Chandail from Personne,".
		" Alignement inner join Saison on Saison.ID_Saison = Alignement.ID_Saison".
		" where Saison.Date_Fin > now() and Alignement.ID_Joueur=".
		"Personne.ID_Personne and ID_Equipe=$idEquipe";

		$result = doQuery($req);

		$row = mysqli_num_rows($result);
		echo "{\"Status\" : " ;
		if($row > 0){
			echo "\"Success\",";
			echo "\"Alignement\" : [";
			while($ligne = mysqli_fetch_object($result)){
			    echo "{\"id\" : \"$ligne->ID_Personne\", \"prenom\" : \"$ligne->Prenom\", \"nom\" : \"$ligne->Nom\", \"numeroChandail\" : \"$ligne->Numero_Chandail\"}";
			    if(--$row > 0) echo ",";
			}
			echo "]";
			mysql_free_result($result);
		}
		else
			echo "\"Fail\"";
		echo "}";
	}
	else returnFail();
}
function getListEquipe(){
    $whereStr = "";
    $idLigue=$_POST['idLigue'];
    if($idLigue)
     $whereStr = "WHERE ID_Ligue = $idLigue";

//    $req ="SELECT ID_Equipe, Nom_Equipe FROM Equipe INNER JOIN Ligue ON Equipe.ID_Ligue=Ligue.ID_Ligue WHERE Nom_Ligue LIKE '%$idLigue%'";
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
        $req ="SELECT ID_Ligue, Nom_Ligue FROM Ligue WHERE ID_Personne = $idGestionnaire";
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
    $req = "SELECT Ligue.ID_Ligue, Nom_Ligue FROM Ligue INNER JOIN Competence ON Competence.ID_Ligue = Ligue.ID_Ligue WHERE Competence.ID_Personne = $idMarqueur";
//        $req = "SELECT Ligue.ID_Ligue, Nom_Ligue from Saison, Ligue inner join Cadre on Cadre.ID_Ligue=Ligue.ID_Ligue WHERE  Cadre.ID_Saison=Saison.ID_Saison AND Saison.Date_Fin > now()";

//echo "req = $req<br/>";
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
    $req ="SELECT DISTINCT Personne.ID_Personne, Prenom, Nom FROM Personne INNER JOIN Ligue ON Ligue.ID_Personne=Personne.ID_Personne ";
    $result = doQuery($req);

    $row = mysqli_num_rows($result);
    echo "{\"Status\" : " ;
    if($row > 0){
        echo "\"Success\",";
        echo "\"Gestionnaires\" : [";
        while($ligne = mysqli_fetch_object($result)){
            echo "{\"id\" : \"$ligne->ID_Personne\", \"prenom\" : \"$ligne->Prenom\", \"nom\" : \"$ligne->Nom\"}";
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
        case "listeLigueParMarqueur":
            getListeLigueByMarqueur();
        break;
        case "listeGestionnaires" :
           getListeGestionnaire();
        break;
}

mysqli_close($conn);
?>

