CREATE TABLE Admin(
   id_admin INT,
   pseudo_admin VARCHAR(50),
   mdp_admin VARCHAR(50),
   PRIMARY KEY(id_admin)
);

CREATE TABLE Adresse(
   id_adresse INT,
   pays VARCHAR(50),
   adresse VARCHAR(255),
   ville VARCHAR(50),
   code_postale VARCHAR(6),
   PRIMARY KEY(id_adresse)
);

CREATE TABLE Paiement(
   id_paiement INT,
   paiement_nom VARCHAR(100),
   paiement_code INT,
   PRIMARY KEY(id_paiement)
);

CREATE TABLE Categorie(
   id_categorie INT,
   type_produit VARCHAR(100),
   nom_categorie VARCHAR(50),
   PRIMARY KEY(id_categorie)
);

CREATE TABLE Client(
   id_client INT,
   nom_client VARCHAR(50),
   prenom_client VARCHAR(50),
   telephone_client VARCHAR(50),
   mail_client VARCHAR(50),
   mdp_client VARCHAR(255),
   id_adresse INT,
   PRIMARY KEY(id_client),
   FOREIGN KEY(id_adresse) REFERENCES Adresse(id_adresse)
);

CREATE TABLE Artisan(
   id_artisan INT,
   nom_artisan VARCHAR(50),
   prenom_artisan VARCHAR(50),
   nom_boutique VARCHAR(50),
   id_adresse INT,
   PRIMARY KEY(id_artisan),
   FOREIGN KEY(id_adresse) REFERENCES Adresse(id_adresse)
);

CREATE TABLE Produit(
   id_produit INT,
   nom_produit VARCHAR(50),
   desc_produit VARCHAR(50),
   prix_produit INT,
   stock_produit INT,
   id_categorie INT NOT NULL,
   id_artisan INT NOT NULL,
   PRIMARY KEY(id_produit),
   FOREIGN KEY(id_categorie) REFERENCES Categorie(id_categorie),
   FOREIGN KEY(id_artisan) REFERENCES Artisan(id_artisan)
);

CREATE TABLE Commande(
   id_commande INT,
   id_paiement INT NOT NULL,
   id_produit INT NOT NULL,
   id_client INT,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_paiement) REFERENCES Paiement(id_paiement),
   FOREIGN KEY(id_produit) REFERENCES Produit(id_produit),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);
