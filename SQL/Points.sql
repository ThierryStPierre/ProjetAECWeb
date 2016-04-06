create table Points(
	ID_Equipe int NOT NULL,
	ID_Joueur int NOT NULL,
	ID_Saison int NOT NULL,
	ID_Partie int NOT NULL,
	Type_Point varchar(30),
	FOREIGN KEY (ID_Equipe) REFERENCES Equipe (ID_Equipe),
	FOREIGN KEY (ID_Joueur) REFERENCES Joueur (ID_Joueur),
	FOREIGN KEY (ID_Saison) REFERENCES Saison (ID_Saison),
	FOREIGN KEY (ID_Partie) REFERENCES Partie (ID_Partie)
);