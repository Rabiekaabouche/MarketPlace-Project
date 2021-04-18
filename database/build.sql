
DROP TABLE IF EXISTS Paniers;
DROP TABLE IF EXISTS ContenuCommandes;
DROP TABLE IF EXISTS Produits;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS Commandes;
DROP TABLE IF EXISTS Clients;
DROP TABLE IF EXISTS Vendeurs;
DROP TABLE IF EXISTS CodePostal;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Utilisateurs;

CREATE TABLE Utilisateurs (
    Id INTEGER PRIMARY KEY AUTOINCREMENT,
    Email VARCHAR(128) NOT NULL,
    Password_hash VARCHAR(128) NOT NULL,
    Droit_acces INTEGER NOT NULL DEFAULT 0,
    UNIQUE(Email)
);

CREATE TABLE Categories(
    IdCat INTEGER PRIMARY KEY AUTOINCREMENT,
    NomCat VARCHAR(50)
);
CREATE TABLE images(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    NomProd VARCHAR(50) NOT NULL,
    prod_image BLOB NOT NULL
);

CREATE TABLE CodePostal(
    Cp VARCHAR(5) PRIMARY KEY,
    Ville VARCHAR(50)
);

CREATE TABLE Vendeurs(
    IdVend INTEGER PRIMARY KEY,
    PrenomVend VARCHAR(50),
    NomVend VARCHAR(50) NOT NULL,
    NomEntreprise VARCHAR(50) NOT NULL,
    DescripEntreprise VARCHAR(200) NOT NULL,
    MailVend VARCHAR(50) NOT NULL,
    TelVend VARCHAR(15) NOT NULL,
    Adresse VARCHAR(50) NOT NULL,
    Ville VARCHAR(100) NOT NULL,
    Cp VARCHAR(10) NOT NULL,
    SiretVend VARCHAR(20) NOT NULL,
    RibVend VARCHAR(50) NOT NULL,
    Validation INTEGER DEFAULT 0,
    FOREIGN KEY(IdVend) REFERENCES Utilisateurs(Id),
    UNIQUE(SiretVend)
);


CREATE TABLE Clients(
    IdClient INTEGER PRIMARY KEY,
    PrenomClient VARCHAR(50),
    NomClient VARCHAR(50) NOT NULL,
    MailClient VARCHAR(50) NOT NULL,
    TelClient VARCHAR(15) NOT NULL,
    Adresse VARCHAR(100) NOT NULL,
    Cp VARCHAR(5) NOT NULL,
    Ville VARCHAR(50) NOT NULL,
    FOREIGN KEY(IdClient) REFERENCES Utilisateurs(Id)

);

CREATE TABLE Produits (
    IdProd INTEGER PRIMARY KEY AUTOINCREMENT,
    NomProd VARCHAR(50) NOT NULL,
    DescriptionProd VARCHAR(250) NOT NULL,
    EtatProd VARCHAR(50),
    /*Couleur VARCHAR(50) NOT NULL,*/
    QuantiteStock INTEGER NOT NULL,
    PrixUnite Decimal(5,2) NOT NULL,
    DateAjout DATETIME,
    imageId INTEGER NOT NULL,
    IdVend INTEGER NOT NULL,
    IdCat INTEGER NOT NULL,
    FOREIGN KEY(imageId) REFERENCES images(id),
    FOREIGN KEY(IdVend) REFERENCES Utilisateurs(Id),
    FOREIGN KEY(IdVend) REFERENCES Vendeurs(IdVend),
    FOREIGN KEY(IdCat) REFERENCES Categories(IdCat)
);

CREATE TABLE Paniers (
    Id INTEGER PRIMARY KEY AUTOINCREMENT,
    IdClient INTEGER NOT NULL,
    Quantite INTEGER NOT NULL DEFAULT 1,
    IdProd INTEGER NOT NULL,
    FOREIGN KEY(IdClient) REFERENCES Clients(IdClient),
    FOREIGN KEY(IdProd) REFERENCES Produits(IdProd)
    );

CREATE TABLE Commandes (
    IdCommande INTEGER PRIMARY KEY AUTOINCREMENT,
    DateCommande DATETIME,
    /*ModeLivraison Enum('En boutique', 'A domicile'),    Ca marche pas le enum en sqlite    */
    DateExpedition DATETIME,
    TotalPrix DECIMAL(5,2) NOT NULL,
    IdClient INTEGER NOT NULL,
    FOREIGN KEY(IdClient) REFERENCES Clients(IdClient)
);

CREATE TABLE ContenuCommandes (
    IdCommande INTEGER NOT NULL,
    IdProd INTEGER NOT NULL,
    Quant INTEGER NOT NULL,
    PRIMARY KEY(IdCommande,IdProd),
    FOREIGN KEY(IdCommande) REFERENCES Commandes(IdCommande),
    FOREIGN KEY(IdProd) REFERENCES Produits(IdProd),
    CHECK(Quant>=0)
);
