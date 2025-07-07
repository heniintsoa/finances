CREATE DATABASE EF CHARACTER SET utf8mb4;

USE EF;


CREATE TABLE t_EF(
    id INT PRIMARY KEY AUTO_INCREMENT,
    fond FLOAT(10, 2) NOT NULL
);

CREATE TABLE t_typepret(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    taux-mois INT
);

CREATE TABLE t_renbourssement(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idpret INT,
    volanaverina FLOAT(10, 2) NOT NULL,
    date DATE NOT NULL,

    FOREIGN KEY (idpret) REFERENCES t_pret(id)
);

CREATE TABLE t_client(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    argentGlobal FLOAT(10, 2) NOT NULL
);

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

