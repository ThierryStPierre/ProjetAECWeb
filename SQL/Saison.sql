create table Saison( 
	ID_Saison int NOT NULL AUTO_INCREMENT,
	ID_Ligue int NOT NULL,
	Date_Debut date NOT NULL,
	Date_Fin date NOT NULL,
	Numero_Saison int NOT NULL,
	UNIQUE(ID_Saison),
	PRIMARY KEY (ID_Saison),
	FOREIGN KEY (ID_Ligue) REFERENCES Ligue(ID_Ligue)
);