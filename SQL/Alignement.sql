create table Alignement(
	ID_Joueur int NOT NULL,
	ID_Equipe int NOT NULL,
	ID_Saison int NOt NULL,
	Position varchar(40) NOT NULL,
	Numero_Chandail int NOT NULL,
	Temporaire boolean NOT NULL,
	FOREIGN KEY (ID_Joueur) REFERENCES Joueur (ID_Joueur),
	FOREIGN KEY (ID_Equipe) REFERENCES Equipe (ID_Equipe),
	FOREIGN KEY (ID_Saison) REFERENCES Saison (ID_Saison)
);
