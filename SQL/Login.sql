create table Login(
	ID_Personne int,
	Nom_Usager varchar(40) NOT NULL,
	Mot_De_Passe varchar(40) NOT NULL,
	FOREIGN KEY (ID_Personne) REFERENCES Personne (ID_Personne)
);
