create table Stats_Equipe(
	ID_Saison int NOT NULL,
	ID_Equipe int NOT NULL,
	Nombre_Partie int NOT NULL,
	Victoire int NOT NULL,
	Defaite int NOT NULL,
	But_Pour int NOT NULL,
	But_Contre int NOT NULL,
	Penalite int NOT NULl,
	FOREIGN KEY (ID_Saison) REFERENCES Saison (ID_Saison),
	FOREIGN KEY (ID_Equipe) REFERENCES Equipe (ID_Equipe)
);