-- CREATE TABLES
CREATE TABLE IF NOT EXISTS studiengang
(
    id INT NOT NULL AUTO_INCREMENT,
    studiengang VARCHAR(255) NOT NULL,

    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS klausur
(
    id INT NOT NULL AUTO_INCREMENT,
    klausur VARCHAR(255) NOT NULL,

    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS student
(
    matrikelnummer INT NOT NULL,
    vorname VARCHAR(255) NOT NULL,
    nachname VARCHAR(255) NOT NULL,
    telefonnummer VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    geburtsdatum Date NOT NULL,
    studiengang INT NOT NULL,
    anmerkung VARCHAR(255),

    PRIMARY KEY(matrikelnummer),
    FOREIGN KEY(studiengang) REFERENCES studiengang (id)
);

CREATE TABLE IF NOT EXISTS einschreibung
(
    student INT NOT NULL,
    klausur INT NOT NULL,

    PRIMARY KEY(student, klausur),
    FOREIGN KEY(student) REFERENCES student (matrikelnummer),
    FOREIGN KEY(klausur) REFERENCES klausur (id)
);


-- INSERT TABLES
INSERT INTO studiengang
VALUES
    (1, "Wirtschaftsinformatik"),
    (2, "Wirtschaftswissenschaften");

INSERT INTO klausur
VALUES
    (1, "Web-Programming"),
    (2, "E-Wiinf"),
    (3, "Logistik 1");

INSERT INTO student
    (matrikelnummer, vorname, nachname, telefonnummer, email, geburtsdatum, studiengang)
VALUES
    (5303660, "Erwin", "Hohlbein", "+49 931 12345", "e.hohl@aol.com", "1993-06-05", 1),
    (6211542, "Anne-Ursula", "Schlaug", "+49 89 24331", "auschlau@web.de", "1994-01-23", 2),
    (5563802, "Kerstin", "Inel", "+49 9322 4356", "keine@yahoo.com", "1993-11-17", 1),
    (6037991, "Stefan", "Weber", "+49 931 909090", "stewe@yahoo.de", "1992-08-11", 2),
    (5702050, "Klaus-Dieter", "Trischler", "+49 931 70100", "klaud@t-online.de", "1990-10-31", 1);

INSERT INTO einschreibung
VALUES
    (5303660, 2),
    (5303660, 3),
    (6211542, 3),
    (5563802, 1),
    (5563802, 2),
    (6037991, 2),
    (6037991, 3),
    (5702050, 1),
    (5702050, 2),
    (5702050, 3);


-- SELECT TABLES
-- Liste mit den Matrikelnummern aller Studenten, aufsteigend sortiert
SELECT matrikelnummer
FROM student
ORDER BY matrikelnummer ASC;
-- Die Anzahl der Studenten, die vor 1994 geboren sind
SELECT COUNT(matrikelnummer)
FROM student
WHERE geburtsdatum <= "1994-01-01";
-- Liste mit den Vor- und Nachnamen sowie der Matrikelnummer der Studenten, die die Klausur „Web-Programming“ schreiben, aufsteigend sortiert nach Nachname und Vorname
SELECT matrikelnummer, vorname, nachname
FROM student
    JOIN einschreibung
    ON student.matrikelnummer = einschreibung.student
    JOIN klausur
    on einschreibung.klausur = klausur.id
WHERE klausur.klausur = "Web-Programming"
ORDER BY nachname ASC, vorname ASC

-- SELECT TABLES
-- Liste aller Studenten, die eine Würzburger Telefonvorwahl haben
SELECT *
FROM student
WHERE telefonnummer LIKE "+49 931%";
-- Liste mit der Anzahl der Teilnehmer je Klausur
SELECT klausur.klausur, COUNT(einschreibung.student) AS Anzahl_Teilnehmer
FROM einschreibung
    JOIN klausur
    ON einschreibung.klausur = klausur.id
GROUP BY klausur.klausur;
-- Liste mit der Anzahl der Studenten je First-Level-Domain des E-Mail-Providers (.de, .com)
WITH Email AS
    (
        SELECT CASE 
            WHEN student.email LIKE '%.de' THEN '.de' 
            WHEN student.email LIKE '%.com' THEN '.com'
        END AS TopLevelDomain
        FROM student
    )
SELECT TopLevelDomain, COUNT(*) AS Anzahl_Emails
FROM Email
GROUP BY TopLevelDomain;

SELECT CASE
    WHEN email LIKE "%.de" THEN ".de"
    WHEN email LIKE "%.com" THEN ".com"
END AS TopLevelDomain, COUNT(*) AS Anzahl_Emails
FROM student
GROUP BY TopLevelDomain;

-- Fehleranalyse
CREATE TABLE IF NOT EXISTS movies
(
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    release_date Date NOT NULL,

    PRIMARY KEY(id)
);

INSERT INTO movies
VALUES
    (1, "James Bundy", "1970"),
    (2, "ETF Bond", "2000");