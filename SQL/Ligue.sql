create table Ligue(
	ID_Ligue int NOT NULL AUTO_INCREMENT, 
	ID_Personne int NOT NULL,
	Nom_Ligue varchar(40) NOT NULL,
	UNIQUE (ID_Ligue),
	PRIMARY KEY(ID_Ligue),
	FOREIGN KEY (ID_Personne) REFERENCES Personne (ID_Personne)
);
