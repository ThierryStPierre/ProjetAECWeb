create table Stats_Joueur(
	ID_Saison int NOT NULL,
	ID_Joueur int NOT NULL,
	But int NOT NULL,
	Passe int NOT NULL,
	Penalite int NOT NULL,
	But_Tir_Barrage int NOT NULL,
	FOREIGN KEY (ID_Saison) REFERENCES Saison (ID_Saison),
	FOREIGN KEY (ID_Joueur) REFERENCES Joueur (ID_Joueur)
);