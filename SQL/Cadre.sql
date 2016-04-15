create table Cadre(
	ID_Cadre int, /* Est-ce Utile?*/
	ID_Ligue int NOT NULL,
	ID_Personne int NOT NULL, 
	ID_Saison int NOT NULL
	,UNIQUE (ID_Cadre),
	PRIMARY KEY(ID_Cadre)
);
