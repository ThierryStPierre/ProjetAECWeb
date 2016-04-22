create table Competence(
	ID_Personne int NOT NULL, 
	ID_Ligue int NOT NULL,
	ID_SousLigue int,
	ID_Equipe int,
	ID_Saison int NOT NULL,
	Competence enum ('', 'Gestionnaire', 'Capitaine', 'Marqueur'),
	FOREIGN KEY(ID_Personne) REFERENCES Personne(ID_Personne),
	FOREIGN KEY(ID_Ligue) REFERENCES Ligue(ID_Ligue),
	FOREIGN KEY(ID_SousLigue) REFERENCES SousLigue(ID_SousLigue),
	FOREIGN KEY(ID_Saison) REFERENCES Saison(ID_Saison)
);
