CREATE DATABASE IF NOT EXISTS TheaterD;
USE TheaterD;

-- 1. Gebruiker
CREATE TABLE gebruiker (
    Id INT NOT NULL AUTO_INCREMENT,
    Voornaam VARCHAR(50) NOT NULL,
    Tussenvoegsel VARCHAR(10),
    Achternaam VARCHAR(50) NOT NULL,
    Gebruikersnaam VARCHAR(100) NOT NULL,
    Wachtwoord VARCHAR(255) NOT NULL,
    IsIngelogd BIT NOT NULL,
    Ingelogd DATETIME(6),
    Uitgelogd DATETIME(6),
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- 2. Rol
CREATE TABLE rol (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Naam VARCHAR(100) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 3. Contact
CREATE TABLE contact (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Mobiel VARCHAR(20) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 4. Medewerker
CREATE TABLE medewerker (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Nummer MEDIUMINT NOT NULL UNIQUE,
    Medewerkersoort VARCHAR(20) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 5. Bezoeker
CREATE TABLE bezoeker (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Relatienummer MEDIUMINT NOT NULL UNIQUE,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 6. Prijs
CREATE TABLE prijs (
    Id INT NOT NULL AUTO_INCREMENT,
    Tarief DECIMAL(5,2) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- 7. Voorstelling
CREATE TABLE voorstelling (
    Id INT NOT NULL AUTO_INCREMENT,
    MedewerkerId INT NOT NULL,
    Naam VARCHAR(100) NOT NULL,
    Beschrijving TEXT,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    MaxAantalTickets INT NOT NULL,
    Beschikbaarheid VARCHAR(50) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (MedewerkerId) REFERENCES Medewerker(Id)
) ENGINE=InnoDB;

-- 8. Ticket
CREATE TABLE ticket (
    Id INT NOT NULL AUTO_INCREMENT,
    BezoekerId INT NOT NULL,
    VoorstellingId INT NOT NULL,
    PrijsId INT NOT NULL,
    Nummer MEDIUMINT NOT NULL UNIQUE,
    Barcode VARCHAR(20) NOT NULL UNIQUE,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    Status VARCHAR(20) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (BezoekerId) REFERENCES Bezoeker(Id),
    FOREIGN KEY (VoorstellingId) REFERENCES Voorstelling(Id),
    FOREIGN KEY (PrijsId) REFERENCES Prijs(Id)
) ENGINE=InnoDB;

-- 9. Melding
CREATE TABLE melding (
    Id INT NOT NULL AUTO_INCREMENT,
    BezoekerId INT,
    GebruikerId INT NOT NULL,
    Nummer MEDIUMINT NOT NULL UNIQUE,
    Type VARCHAR(20) NOT NULL,
    Bericht VARCHAR(250) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id),
    FOREIGN KEY (BezoekerId) REFERENCES Bezoeker(Id)
) ENGINE=InnoDB;

CREATE TABLE feedback (
    Id INT NOT NULL AUTO_INCREMENT,
    MeldingId INT NOT NULL,
    Nummer MEDIUMINT NOT NULL UNIQUE,
    Bericht VARCHAR(250) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (MeldingId) REFERENCES melding(Id)
) ENGINE=InnoDB;

-- 2. Rol
INSERT INTO rol (GebruikerId, Naam, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 'Bezoeker', 1, NULL, NOW(), NOW()),
(2, 'Medewerker', 1, NULL, NOW(), NOW()),
(3, 'Admin', 1, NULL, NOW(), NOW());

-- 3. Contact
INSERT INTO contact (GebruikerId, Email, Mobiel, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 'emma.jansen@mail.com', '0612345678', 1, NULL, NOW(), NOW()),
(2, 'tom.dijk@mail.com', '0623456789', 1, NULL, NOW(), NOW()),
(3, 'lars.vries@mail.com', '0634567890', 1, NULL, NOW(), NOW());

-- 4. Medewerker
INSERT INTO medewerker (GebruikerId, Nummer, Medewerkersoort, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 1001, 'Beheerder', 1, NULL, NOW(), NOW()),
(2, 1002, 'Kaartverkoop', 1, NULL, NOW(), NOW());

-- 5. Bezoeker
INSERT INTO bezoeker (GebruikerId, Relatienummer, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 2001, 1, NULL, NOW(), NOW());

-- 6. Prijs
INSERT INTO prijs (Tarief, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(12.50, 1, 'Normaal tarief', NOW(), NOW()),
(8.00, 1, 'Studententarief', NOW(), NOW());

-- 7. Voorstelling
INSERT INTO voorstelling (MedewerkerId, Naam, Beschrijving, Datum, Tijd, MaxAantalTickets, Beschikbaarheid, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 'Hamlet', 'Een klassiek toneelstuk van Shakespeare', '2025-06-15', '20:00:00', 100, 'Beschikbaar', 1, NULL, NOW(), NOW()),
(2, 'De Kleine Prins', 'Een voorstelling voor kinderen', '2025-06-20', '15:00:00', 50, 'Beschikbaar', 1, NULL, NOW(), NOW());

-- 8. Ticket
INSERT INTO ticket (BezoekerId, VoorstellingId, PrijsId, Nummer, Barcode, Datum, Tijd, Status, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 1, 1, 3001, 'ABC123DEF456', '2025-06-15', '20:00:00', 'Geboekt', 1, NULL, NOW(), NOW()),
(1, 2, 2, 3002, 'XYZ789GHI123', '2025-06-20', '15:00:00', 'Geboekt', 1, NULL, NOW(), NOW());

-- 9. Melding
INSERT INTO melding (BezoekerId, MedewerkerId, Nummer, Type, Bericht, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, NULL, 4001, 'Vraag', 'Tot hoe laat duurt de voorstelling Hamlet?', 1, NULL, NOW(), NOW()),
(2, NULL, 2, 4002, 'Technisch', 'Geluid valt uit tijdens scène 3.', 1, NULL, NOW(), NOW());

Hallo Jim Pecker wij gaan voor jou het zo snel mogelijk uitvogelen

