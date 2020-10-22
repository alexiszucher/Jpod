CREATE TABLE users
(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email varchar(200) NOT NULL,
    mdp varchar(200) NOT NULL
);

CREATE TABLE applications
(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle varchar(200) NOT NULL,
    url varchar(200) NOT NULL,
    img varchar(200) DEFAULT NULL,
    leads int DEFAULT NULL
);

CREATE TABLE droits_applications
(
    id_user int NOT NULL,
    id_application int NOT NULL,
    CONSTRAINT pk_user_application PRIMARY KEY (id_user,id_application),
    CONSTRAINT fk_droit_user FOREIGN KEY(id_user) REFERENCES users(id),
    CONSTRAINT fk_droit_application FOREIGN KEY(id_application) REFERENCES applications(id)
);

CREATE TABLE budget_applications
(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_application int NOT NULL,
    budget float NOT NULL,
    CONSTRAINT fk_buget_application FOREIGN KEY(id_application) REFERENCES applications(id)
);

CREATE TABLE transactions
(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_application int NOT NULL,
    montant float NOT NULL,
    gains int NOT NULL,
    CONSTRAINT fk_transactions_application FOREIGN KEY(id_application) REFERENCES applications(id)
);

CREATE TABLE sujets
(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_application int NOT NULL,
    libelle varchar(200) NOT NULL,
    visible int DEFAULT NULL,
    CONSTRAINT fk_sujets_application FOREIGN KEY(id_application) REFERENCES applications(id)
);

CREATE TABLE taches
(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_sujet int NOT NULL,
    libelle varchar(200) NOT NULL,
    ischeck int NOT NULL,
    CONSTRAINT fk_taches_sujets FOREIGN KEY(id_sujets) REFERENCES sujets(id)
);

INSERT INTO users(email,mdp) VALUES('alexiszucher@gmail.com',MD5('Alexis7957'));
INSERT INTO applications(libelle,url,img,leads) VALUES("Affiliation Tremplin","at.php","at.png",90);