create table Equipe(
    ID_Equipe int NOT NULL AUTO_INCREMENT,
    ID_Ligue int NOT NULL,
    ID_SousLigue int,
    Nom_Equipe varchar(40) NOT NULL,
    UNIQUE(ID_Equipe),
    PRIMARY KEY(ID_Equipe),
    FOREIGN KEY(ID_Ligue) REFERENCES Ligue(ID_Ligue),
    FOREIGN KEY(ID_SousLigue) REFERENCES SousLigue(ID_SousLigue)
);
