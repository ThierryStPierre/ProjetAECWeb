create table Partie(
	ID_Partie int NOT NULL AUTO_INCREMENT,
	Lieu varchar(40) NOT NULL,
	Duree time ,
	Date_Partie date NOT NULL,
	Equipe1 int NOT NULL,
	Equipe2 int NOT NULL,
	Pointage1 int ,
	Pointage2 int ,
	UNIQUE(ID_Partie),
	PRIMARY KEY (ID_Partie),
	FOREIGN KEY (Equipe1) REFERENCES Equipe (ID_Equipe),
	FOREIGN KEY (Equipe2) REFERENCES Equipe (ID_Equipe)
);	
