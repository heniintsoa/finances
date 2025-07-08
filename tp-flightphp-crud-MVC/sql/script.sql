CREATE DATABASE EF CHARACTER SET utf8mb4;

USE EF;


CREATE TABLE t_EF(
    id INT PRIMARY KEY AUTO_INCREMENT,
    fond FLOAT(10, 2) NOT NULL
);

CREATE TABLE t_typepret(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    taux_mois INT
);

CREATE TABLE t_renbourssement(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idpret INT,
    volanaverina FLOAT(10, 2) NOT NULL,
    date DATE NOT NULL,

    FOREIGN KEY (idpret) REFERENCES t_typepret(id)
);

CREATE TABLE t_client(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    argentGlobal FLOAT(10, 2) NOT NULL
);

INSERT INTO t_client (nom, argentGlobal) VALUES
("Client 1", 1000.00),
("Client 2", 2000.00),
("Client 3", 3000.00);

CREATE TABLE t_pret(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idclient INT,
    idtypepret INT,
    mois_debut INT NOT NULL,
    mois_fin INT NOT NULL,
    montant_par_mois FLOAT(10, 2) NOT NULL,

    FOREIGN KEY (idclient) REFERENCES t_client(id),
    FOREIGN KEY (idtypepret) REFERENCES t_typepret(id)
);

CREATE TABLE fonds(
    id INT PRIMARY KEY AUTO_INCREMENT,
    montant FLOAT(10, 2) NOT NULL,
    type_operation ENUM('entree', 'sortie') NOT NULL DEFAULT 'entree',
    date_operation DATE,
    descri VARCHAR(100),
    id_pret INT,

    FOREIGN KEY (id_pret) REFERENCES t_pret(id)
);

CREATE VIEW vue_fonds_details AS
SELECT 
    f.id AS id_fonds,
    f.montant,
    f.type_operation,
    f.date_operation,
    f.descri AS description,
    
    p.id AS id_pret,
    p.mois_debut,
    p.mois_fin,
    p.montant_par_mois,

    c.id AS id_client,
    c.nom AS nom_client,
    c.argentGlobal,

    t.id AS id_typepret,
    t.nom AS type_pret,
    t.taux_mois

FROM fonds f
LEFT JOIN t_pret p ON f.id_pret = p.id
LEFT JOIN t_client c ON p.idclient = c.id
LEFT JOIN t_typepret t ON p.idtypepret = t.id;

INSERT INTO t_typepret (nom , taux_mois) VALUES
("Pret immobilier" , 10);