SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: mediatheque
--
drop database if exists mediatheque;

create database mediatheque default character set utf8 collate utf8_general_ci;
-- Sélectionne la base de données
use mediatheque;
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS Epoques (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Maisons_edition (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Instrumentations (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Categories (
  ID int(11),
  nom varchar(50) NOT NULL,
  type varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Nationalites (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Collections (
  ID int(11),
  nom varchar(50) NOT NULL,
  type varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Catalogues (
  ID int(11),
  code varchar(10) NOT NULL,
  description text,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Tonalites (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Utilisateurs (
  ID int(11),
  matricule int(7) NOT NULL,
  nom varchar(50) NOT NULL,
  prenom varchar(50) NOT NULL,
  telephone varchar(10) NOT NULL,
  courriel varchar(320),
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Genres (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Artistes (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Formes (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Medias (
  ID int(11),
  titre varchar(50) NOT NULL,
  annee_publication int(11),
  image varchar(100),
  quantite int(11),
  reference varchar(50) NOT NULL,
  notes varchar(150),
  maison_editionID int(11),
  categorieID int(11) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID),
  FOREIGN KEY (categorieID) REFERENCES Categories(ID),
  FOREIGN KEY (maison_editionID) REFERENCES Maisons_edition(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  sous_titre varchar(100),
  collectionID int(11),
  position_collection int(11),
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Medias(ID) ON DELETE CASCADE,
  FOREIGN KEY (collectionID) REFERENCES Collections(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS Details_imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  titre varchar(50) NOT NULL,
  position_media int(11) NOT NULL,
  catalogueID int(11),
  genreID int(11),
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Imprimes(ID) ON DELETE CASCADE,
  FOREIGN KEY (genreID) REFERENCES Genres(ID),
  FOREIGN KEY (catalogueID) REFERENCES Catalogues(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS Arrangeurs_details_imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Details_imprimes(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS Audios_videos (
  ID int(11),
  exID int(11) NOT NULL,
  collectionID int(11),
  position_collection int(11),
  CUP int(11) NOT NULL,
  realisateurs varchar(200),
  nationaliteID int(11),
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Medias(ID) ON DELETE CASCADE,
  FOREIGN KEY (collectionID) REFERENCES Collections(ID),
  FOREIGN KEY (nationaliteID) REFERENCES Nationalites(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS Pieces (
  ID int(11),
  exID int(11) NOT NULL,
  titre varchar(50) NOT NULL,
  position_media int(11),
  annee_enregistrement int(11),
  duree decimal(4,2),
  catalogueID int(11),
  epoqueID int(11),
  formeID int(11),
  genreID int(11),
  instrumentationID int(11),
  tonaliteID int(11),
  notes varchar(150),
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Audios_videos(ID) ON DELETE CASCADE,
  FOREIGN KEY (tonaliteID) REFERENCES Tonalites(ID),
  FOREIGN KEY (formeID) REFERENCES Formes(ID),
  FOREIGN KEY (epoqueID) REFERENCES Epoques(ID),
  FOREIGN KEY (instrumentationID) REFERENCES Instrumentations(ID),
  FOREIGN KEY (genreID) REFERENCES Genres(ID),
  FOREIGN KEY (catalogueID) REFERENCES Catalogues(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Arrangeurs_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Artistes_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Compositeurs_details_imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Details_imprimes(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Compositeurs_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Emprunts (
  ID int(11),
  utilisateurID int(11) NOT NULL,
  date_reservation date NOT NULL,
  date_voulue date NOT NULL,
  date_emprunt date,
  duree int(11) NOT NULL,
  date_retour date,
  mediaID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (utilisateurID) REFERENCES Utilisateurs(ID),
  FOREIGN KEY (mediaID) REFERENCES Medias(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Parolier_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Interpretes_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  taches varchar(50) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Orchestrateurs_pieces (
  ID int(11) NOT NULL,
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES Pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES Artistes(ID)
) ENGINE=InnoDB;
