<?php
header ("Access-Control-Allow-Origin : localhost");
require_once("connexion.php");

function newLigue(){
    $table="Ligue";
    $nomLigue=$_POST['Nom_Ligue'];
    $idGestionnaire=$_POST['ID_Personne'];

    if(($idGestionnaire != "") && ($nomLigue != "")){
	if(is_numeric($idGestionnaire){
            $req = "INSERT INTO $table VALUE (0, '$idGestionnaire', '$nomLigue')";
            if(createStatus(doQuery($req)) == true){
		$idLigue = mysqli_insert_id($conn);
                $newReq = "INSERT INTO Competence VALUES ($idGestionnaire, $idLigue, -1, -1, -1, 'Gestionnaire')";
                doQuery($newReq);
            }
        }
        else
            returnFail("ID_Personne doit être numérique");
    }
    else
        returnFail("Les champs doivent être non-nul");
}

function newEquipe(){
    $table="Equipe";
    $nomEquipe=$_POST['Nom_Equipe'];
    $idLigue=$_POST['ID_Ligue'];
    $idSousLigue=$_POST['ID_SousLigue'];
    if(($nomEquipe != "") && ($idLigue != "")){
        if(is_numeric($idLigue) ){
            if(($idSousLigue != "") && !is_numeric($idSousLigue))
                returnFail("ID_SousLigue doit être numérique ou null (\"\")");
            else{
                $req = "INSERT INTO $table VALUE (0, $idLigue, $idSousLigue, '$nomEquipe')";
                createStatus(doQuery($req));
            }
        }
    else
        returnFail("ID_Ligue doit être numérique");
    }
    else
        returnFail("Les champs ID_Ligue et Nom_Equipe doivent être non-nul");
}

function newPersonne(){
    $valid = true;
    $table="Personne";
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $dateDeNaissance=$_POST['Date_Naissance'];
    $telephone=$_POST['telephone'];
    $courriel=$_POST['courriel'];
    $adresse=$_POST['adresse'];
    if(($nom != "") && ($prenom != "") && ($dateDeNaissance != "")){
	$dateDeNaissance = str_replace("/", "-", $dateDeNaissance);
        $dateSplit = explode('-', $dateDeNaissance);
        if(!checkdate($dateSplit[1], $dateSplit[2], $dateSplit[0])){
            returnFail("Format de Date_Naissance non valide");
            $valid = false;
        }
        if($courriel != ""){
            if(!filter_var($courriel, FILTER_VALIDATE_EMAIL)){
                returnFail("Format de courriel non valide");
                $valid = false;
            }
        }
	if($telephone != ""){
            if(!filter_var(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $telephone)){
                returnFail("Format de téléphone non valide");
                $valid = false;
            }
        }

        if($valid){
            $req = "INSERT INTO $table VALUE (0, '$nom', '$prenom', ".
                   "'$dateDeNaissance', '$telephone', '$courriel', '$adresse')";
            createStatus(doQuery($req));
        }
    }
    else
        returnFail("Les champs nom, prénom, et date de naissance doivent être non-nul");
}


function newPartie(){
    $valid = true;
    $table="Partie";
    $lieu=$_POST['lieu'];
    $duree=$_POST['duree'];
    $date=$_POST['Date_Partie'];
    $equipe1=$_POST['ID_Equipe1'];
    $equipe2=$_POST['ID_Equipe2'];
    $pointage1=$_POST['pointage1'];
    $pointage2=$_POST['pointage2'];

    if(($lieu != "") && ($date != "") && ($equipe1 != "") && ($equipe2 != "")){
	$date = str_replace("/", "-", $date);
        $dateSplit = explode('-', $date);
        if(!checkdate($dateSplit[1], $dateSplit[2], $dateSplit[0])){
            returnFail("Format de Date_Partie non valide");
            $valid = false;
        }
	if(!is_numeric($equipe1) || !is_numeric($equipe2)){
            returnFail("ID_Equipe 1 et 2 doivent être numérique");
            $valid = false;
	}

        if($valid){
            $req = "INSERT INTO $table VALUE (0, '$lieu', '$duree', '$date', $equipe1, $equipe2, $pointage1, $pointage2)";
            createStatus(doQuery($req));
        }
    }
    else
        returnFail("Les champs lieu, Date_Partie, ID_Equip1 et ID_Equipe2 doivent être non-nul");
}

function newAlignement(){
    $table="Alignement";
    $joueur=$_POST['ID_Personne'];
    $equipe=$_POST['ID_Equipe'];
    $saison=$_POST['ID_Saison'];
    $position=$_POST['position'];
    $numeroChandail=$_POST['Numero_Chandail'];
    $temporaire=$_POST['temporaire'];
    if($temporaire == "")
        $temporaire="faux";
    if(($joueur != "") && ($equipe != "") && ($saison != "") && ($position != "") && ($numeroChandail != ""){
        if(!is_numeric($joueur) || !is_numeric($equipe) || !is_numeric($saison) || !is_numeric($numeroChandail))
            returnFail("Les champs ID_Personne, ID_Equipe, ID_Saison et Numero_Chandail doivent être numérique");
        else{
            $req = "INSERT INTO $table VALUE ($joueur, $equipe, $saison, '$position', $numeroChandail, '$temporaire')";
            createStatus(doQuery($req));
        }
    }
    else
        returnFail("Tout les champs doivent être non-nul");
}


function newSaison(){
    $table="Saison";
    $valid = true;
    $idLigue=$_POST['ID_Ligue'];
    $dateDebut=$_POST['Date_Debut'];
    $dateFin=$_POST['Date_Fin'];
    $numeroSaison=$_POST['Numero_Saison'];
    if(($idLigue != "") && ($dateDebut != "") && ($dateFin != "") && ($numeroSaison != "")){
	if(!is_numeric($idLigue) || !is_numeric($numeroSaison)){
            $valid = false;
            returnFail("Les champs ID_Ligue et Numero_Saison doivent être numérique");
	}
        $dateDebut = str_replace("/", "-", $dateDebut);
        $dateSplit = explode('-', $dateDebut);
        if(!checkdate($dateSplit[1], $dateSplit[2], $dateSplit[0])){
            returnFail("Format de Date_Debut non valide");
            $valid = false;
        }
        $dateFin = str_replace("/", "-", $dateFin);
        $dateSplit = explode('-', $dateFin);
        if(!checkdate($dateSplit[1], $dateSplit[2], $dateSplit[0])){
            returnFail("Format de Date_Fin non valide");
            $valid = false;
        }

        if($valid){
            $req = "INSERT INTO $table VALUE (0, $idLigue, '$dateDebut', '$dateFin', $numeroSaison)";
            createStatus(doQuery($req));
        }
    }
    else
        returnFail("Tout les champs doivent être non-nul");
}


function logNewEvent(){
    $valid = true;
    $idBut = $_POST['idBut'];
    $idPasse1 = $_POST['idPasse1'];
    $idPasse2 = $_POST['idPasse2'];
    $idPartie = $_POST['idPartie'];
    $idPenalite = $_POST['idPenalite'];
    $idLancer = $_POST['idLancer'];

    if(idPartie != ""){
	if(($idBut == "") && ($idPenalite == "") && ($idLancer ==""))
            returnFail("Au moins une autre champ parmi idBut, idPenalite et idLancer doit être présent.");
        else{
            if(($idBut != "") && !is_numeric($idBut)){
                $valid = false;
                returnFail("Le champs idBut doit être numérique");
            }
            if(($idPasse2 != "") && !is_numeric($idPasse2)){
                $valid = false;
                returnFail("Le champs idPasse2 doit être numérique");
            }
            if(($idPasse1 != "") && !is_numeric($idPasse1)){
                $valid = false;
                returnFail("Le champs idPasse1 doit être numérique");
            }
            if(($idPartie != "") && !is_numeric($idPartie)){
                $valid = false;
                returnFail("Le champs idPartie doit être numérique");
            }
            if(($idPenalite != "") && !is_numeric($idPenalite)){
                $valid = false;
                returnFail("Le champs idPenalite doit être numérique");
            }
            if(($idLancer != "") && !is_numeric($idLancer)){
                $valid = false;
                returnFail("Le champs idLancer doit être numérique");
            }

            if($valid){
                $req="INSERT INTO Evenement VALUES ($idBut, $idPasse1, $idPasse2, $idPartie, $idPenalite, $idLancer)";
                createStatus(doQuery($req));
            }
        }
    }
    else
        returnFail("Un idPartie doit être présent pour que l'évènement soit valide");
}

//Le controleur
$action=$_POST['action'];
    switch ($action){
    case "newLigue" :
       newLigue();
    break;
    case "newPersonne" :
       newPersonne();
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
    case "newEvent":
        logNewEvent();
    break;
    default :
        returnFail("Commande inconnue : $action");
    break;
}

mysqli_close($conn);
?>
