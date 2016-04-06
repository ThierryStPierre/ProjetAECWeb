create table Ligue(
	ID_Ligue int NOT NULL AUTO_INCREMENT, 
	ID_Gestionnaire int NOT NULL,
	Nom_Ligue varchar(40) NOT NULL,
	UNIQUE (ID_Ligue),
	PRIMARY KEY(ID_Ligue),
	FOREIGN KEY (ID_Gestionnaire) REFERENCES Joueur (ID_Joueur)
);
