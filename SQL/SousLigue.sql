create table SousLigue(
	ID_SousLigue int NOT NULL AUTO_INCREMENT, 
	ID_Ligue int NOT NULL, 
	Nom_SousLigue varchar(40) NOT NULL,
	Categorie varchar(40),
	UNIQUE (ID_SousLigue),
	PRIMARY KEY(ID_SousLigue),
	FOREIGN KEY (ID_Ligue) REFERENCES Ligue (ID_Ligue)
);
