<?php
header ("Access-Control-Allow-Origin : localhost");
require_once("connexion.php");

function newLigue(){
    $table="Ligue";
    $nomLigue=$_POST['Nom_Ligue'];
    $idGestionnaire=$_POST['ID_Personne'];
    $req = "INSERT INTO $table VALUE (0, '$idGestionnaire', '$nomLigue')";

    createStatus(doQuery($req));
}

function newEquipe(){
    $table="Equipe";
    $nomEquipe=$_POST['Nom_Equipe'];
    $idLigue=$_POST['ID_Ligue'];
    $idSousLigue=$_POST['ID_SousLigue'];
    $req = "INSERT INTO $table VALUE (0, $idLigue, $idSousLigue, '$nomEquipe')";

    createStatus(doQuery($req));
}

function newPersonne(){

    $table="Personne";
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $dateDeNaissance=$_POST['Date_Naissance'];
    $telephone=$_POST['telephone'];
    $courriel=$_POST['courriel'];
    $adresse=$_POST['adresse'];
    if(($nom != "") && ($prenom != "") && ($dateDeNaissance != "")){
        $req = "INSERT INTO $table VALUE (0, '$nom', '$prenom', '$dateDeNaissance', '$telephone', '$courriel', '$adresse')";
        createStatus(doQuery($req));
    }
    else
        returnFail("Les champs nom, prenom, et date de naissance doivent être non-nul");
}


function newPartie(){
    $table="Partie";
    $lieu=$_POST['lieu'];
    $duree=$_POST['duree'];
    $date=$_POST['Date_Partie'];
    $equipe1=$_POST['equipe1'];
    $equipe2=$_POST['equipe2'];
    $pointage1=$_POST['pointage1'];
    $pointage2=$_POST['pointage2'];
    $req = "INSERT INTO $table VALUE (0, '$lieu', '$duree', '$date', $equipe1, $equipe2, $pointage1, $pointage2)";

    createStatus(doQuery($req));
}

function newAlignement(){
    $table="Alignement";
    $joueur=$_POST['ID_Joueur'];
    $equipe=$_POST['ID_Equipe'];
    $saison=$_POST['ID_Saison'];
    $position=$_POST['position'];
    $numeroChandail=$_POST['Numero_Chandail'];
    $temporaire=$_POST['temporaire'];
    if($temporaire == "")
        $temporaire="faux";
    $req = "INSERT INTO $table VALUE ($joueur, $equipe, $saison, '$position', $numeroChandail, '$temporaire')";

    createStatus(doQuery($req));
}


function newSaison(){
    $table="Saison";
    $idLigue=$_POST['ID_Ligue'];
    $dateDebut=$_POST['Date_Debut'];
    $dateFin=$_POST['Date_Fin'];
    $numeroSaison=$_POST['Numero_Saison'];
    $req = "INSERT INTO $table VALUE (0, $idLigue, '$dateDebut', '$dateFin', $numeroSaison)";

    createStatus(doQuery($req));
}


function logNewEvent(){
    $idBut = $_POST['idBut'];
    $idPasse = $_POST['idPasse'];
    $idPartie = $_POST['idPartie'];
    $idPenalite = $_POST['idPenalite'];
    $idLancer = $_POST['idLancer'];

    $req="INSERT INTO Evenement VALUES ($idBut, $idPasse, $idPartie, $idPenalite, $idLancer)";
    createStatus(doQuery($req));
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
}

mysqli_close($conn);
?>
