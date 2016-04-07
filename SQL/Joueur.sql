create table Joueur(
	ID_Joueur int NOT NULL AUTO_INCREMENT,
--	ID_Equipe int NOT NULL,
	Nom varchar(40) NOT NULL,
	Prenom varchar(40) NOT NULL,
	Date_Naissance date NOT NULL,/*a confirmer si date ou varchar(40)*/
	Telephone varchar(13),
	Courriel varchar(40) NOT NULL,
	Nom_Usager varchar(40) NOT NULL,
	Mot_De_Passe varchar(40) NOT NULL,
	Capitaine boolean,
	Pointeur boolean,
	Gestionnaire boolean,
	UNIQUE (ID_Joueur),
	PRIMARY KEY(ID_Joueur)
-- , FOREIGN KEY(ID_Equipe) REFERENCES Equipe(ID_Equipe)
);
