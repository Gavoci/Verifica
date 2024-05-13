-- Creazione delle tabelle
CREATE DATABASE IF NOT EXISTS  verifica;
USE verifica;

CREATE TABLE assicuratori (
    codice INT PRIMARY KEY,
    nominativo VARCHAR(100)
);

CREATE TABLE assicurati (
    codice_anagrafica INT PRIMARY KEY,
    nome VARCHAR(100)
);

CREATE TABLE tipo_di_polizza (
    codice INT PRIMARY KEY,
    descrizione VARCHAR(255),
    premio_annuale DECIMAL(10, 2)
);

CREATE TABLE contratti_di_assicurazione (
    codice_contratto INT PRIMARY KEY,
    codice_anagrafica INT,
    codice_assicuratore INT,
    codice_tipo_polizza INT,
    anno_inizio INT,
    anno_fine INT,
    FOREIGN KEY (codice_anagrafica) REFERENCES assicurati(codice_anagrafica),
    FOREIGN KEY (codice_assicuratore) REFERENCES assicuratori(codice),
    FOREIGN KEY (codice_tipo_polizza) REFERENCES tipo_di_polizza(codice)
);

CREATE TABLE premi_annuali_pagati (
    codice_contratto INT,
    anno INT,
    importo DECIMAL(10, 2),
    PRIMARY KEY (codice_contratto, anno),
    FOREIGN KEY (codice_contratto) REFERENCES contratti_di_assicurazione(codice_contratto)
);

-- Popolamento delle tabelle
INSERT INTO assicuratori (codice, nominativo) VALUES
(1, 'ina'),
(2, 'sara'),
(3, 'allianz'),
(4, 'unipol');

INSERT INTO assicurati (codice_anagrafica, nome) VALUES
(1, 'tizio'),
(2, 'caio'),
(3, 'sempronio'),
(4, 'calpurnio');

INSERT INTO tipo_di_polizza (codice, descrizione, premio_annuale) VALUES
(1, 'assicurazione responsabilità civile automezzo', 300.00),
(2, 'assicurazione danneggiamento da grandine dell’automezzo', 120.00),
(3, 'assicurazione responsabilità civile motociclo', 140.00),
(4, 'assicurazione a copertura danni verso terzi, abitazioni', 220.00),
(5, 'assicurazione a copertura danni abitazioni, esempio: eventi atmosferici', 290.00);

INSERT INTO contratti_di_assicurazione (codice_contratto, codice_anagrafica, codice_assicuratore, codice_tipo_polizza, anno_inizio, anno_fine) VALUES
(1, 1, 2, 1, 2020, 2023),
(2, 1, 4, 3, 2021, 2024),
(3, 1, 3, 3, 2018, 2022),
(4, 2, 3, 1, 2016, 2022),
(5, 3, 4, 2, 2023, NULL),
(6, 3, 2, 3, 2015, 2020),
(7, 3, 2, 5, 2018, 2020);

INSERT INTO premi_annuali_pagati (codice_contratto, anno, importo) VALUES
(1, 2020, 300.00),
(1, 2021, 300.00),
(1, 2022, 300.00),
(2, 2021, 140.00),
(2, 2022, 140.00),
(2, 2023, 140.00),
(2, 2024, 140.00),
(3, 2018, 140.00),
(3, 2019, 140.00),
(3, 2020, 140.00),
(3, 2021, 140.00),
(3, 2022, 140.00),
(4, 2016, 300.00),
(4, 2017, 300.00),
(4, 2018, 300.00),
(4, 2019, 300.00),
(4, 2020, 300.00),
(4, 2021, 300.00),
(4, 2022, 300.00),
(5, 2023, 120.00),
(6, 2015, 220.00),
(6, 2016, 220.00),
(6, 2017, 220.00),
(6, 2018, 220.00),
(6, 2019, 220.00),
(6, 2020, 220.00),
(7, 2018, 290.00),
(7, 2019, 290.00),
(7, 2020, 290.00);
