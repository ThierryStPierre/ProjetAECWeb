create table Evenement (
    ID_Evenement int NOT NULL AUTO_INCREMENT,
    ID_PersonneBut int,
    ID_PersonnePasse1 int,  
    ID_PersonnePasse2 int,  
    ID_Partie int NOT NULL,
    ID_PersonnePenalite int,
    ID_PersonneTire int,
    UNIQUE(ID_Evenement),
    PRIMARY KEY (ID_Evenement),    
    FOREIGN KEY(ID_PersonneBut) REFERENCES Personne(ID_Personne),
    FOREIGN KEY(ID_PersonnePasse1) REFERENCES Personne(ID_Personne),
    FOREIGN KEY(ID_PersonnePasse1) REFERENCES Personne(ID_Personne),
    FOREIGN KEY(ID_PersonnePenalite) REFERENCES Personne(ID_Personne),
    FOREIGN KEY(ID_PersonneTire) REFERENCES Personne(ID_Personne),
    FOREIGN KEY(ID_Partie) REFERENCES Partie(ID_Partie)
);
