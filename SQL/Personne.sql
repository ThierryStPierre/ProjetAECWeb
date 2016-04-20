create table Personne(
	ID_Personne int NOT NULL AUTO_INCREMENT,
	Nom varchar(40) NOT NULL,
	Prenom varchar(40) NOT NULL,
	Date_Naissance date,/*a confirmer si date ou varchar(40)*/
	Telephone varchar(13),
	Courriel varchar(40),
	Adresse varchar(40),
	UNIQUE (ID_Personne),
	PRIMARY KEY(ID_Personne)
);
