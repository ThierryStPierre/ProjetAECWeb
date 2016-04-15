create table Joueur(
	ID_Login int NOT NULL AUTO_INCREMENT,
	ID_Personne int,
	Nom_Usager varchar(40) NOT NULL,
	Mot_De_Passe varchar(40) NOT NULL,
	UNIQUE (ID_Login),
	PRIMARY KEY(ID_Login)
);
