create table Equipe(
	ID_Equipe int NOT NULL AUTO_INCREMENT,
	ID_Ligue int NOT NULL,
	Nom_Equipe varchar(40) NOT NULL,
	UNIQUE(ID_Equipe),
	PRIMARY KEY(ID_Equipe),
	FOREIGN KEY(ID_Ligue) REFERENCES Ligue(ID_Ligue)
);