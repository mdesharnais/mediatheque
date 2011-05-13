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

CREATE TABLE IF NOT EXISTS epoques (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS maisons_edition (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS instrumentations (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
  ID int(11),
  nom varchar(50) NOT NULL,
  type varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS nationalites (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS collections (
  ID int(11),
  nom varchar(50) NOT NULL,
  type varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS catalogues (
  ID int(11),
  code varchar(10) NOT NULL,
  description text,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tonalites (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS utilisateurs (
  ID int(11),
  matricule int(7) NOT NULL,
  nom varchar(50) NOT NULL,
  prenom varchar(50) NOT NULL,
  telephone varchar(10) NOT NULL,
  courriel varchar(320),
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS genres (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS artistes (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS formes (
  ID int(11),
  nom varchar(50) NOT NULL,
  inactif BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS medias (
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
  FOREIGN KEY (categorieID) REFERENCES categories(ID),
  FOREIGN KEY (maison_editionID) REFERENCES maisons_edition(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  sous_titre varchar(100),
  collectionID int(11),
  position_collection int(11),
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES medias(ID) ON DELETE CASCADE,
  FOREIGN KEY (collectionID) REFERENCES collections(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS details_imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  titre varchar(50) NOT NULL,
  position_media int(11) NOT NULL,
  catalogueID int(11),
  genreID int(11),
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES imprimes(ID) ON DELETE CASCADE,
  FOREIGN KEY (genreID) REFERENCES genres(ID),
  FOREIGN KEY (catalogueID) REFERENCES catalogues(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS arrangeurs_details_imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES details_imprimes(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS audios_videos (
  ID int(11),
  exID int(11) NOT NULL,
  collectionID int(11),
  position_collection int(11),
  CUP int(11) NOT NULL,
  realisateurs varchar(200),
  nationaliteID int(11),
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES medias(ID) ON DELETE CASCADE,
  FOREIGN KEY (collectionID) REFERENCES collections(ID),
  FOREIGN KEY (nationaliteID) REFERENCES nationalites(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS pieces (
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
  FOREIGN KEY (exID) REFERENCES audios_videos(ID) ON DELETE CASCADE,
  FOREIGN KEY (tonaliteID) REFERENCES tonalites(ID),
  FOREIGN KEY (formeID) REFERENCES formes(ID),
  FOREIGN KEY (epoqueID) REFERENCES epoques(ID),
  FOREIGN KEY (instrumentationID) REFERENCES instrumentations(ID),
  FOREIGN KEY (genreID) REFERENCES genres(ID),
  FOREIGN KEY (catalogueID) REFERENCES catalogues(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS arrangeurs_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS artistes_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS compositeurs_details_imprimes (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES details_imprimes(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS compositeurs_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS emprunts (
  ID int(11),
  utilisateurID int(11) NOT NULL,
  date_reservation date NOT NULL,
  date_voulue date NOT NULL,
  date_emprunt date,
  duree int(11) NOT NULL,
  date_retour date,
  mediaID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (utilisateurID) REFERENCES utilisateurs(ID),
  FOREIGN KEY (mediaID) REFERENCES medias(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS parolier_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS interpretes_pieces (
  ID int(11),
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  taches varchar(50) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orchestrateurs_pieces (
  ID int(11) NOT NULL,
  exID int(11) NOT NULL,
  artisteID int(11) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
  FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;
