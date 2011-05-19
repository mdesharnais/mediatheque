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
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS maisons_edition (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS instrumentations (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	type varchar(50) NOT NULL COMMENT 'Type de média',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS nationalites (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS collections (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	type varchar(50) NOT NULL COMMENT 'Type de média',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS catalogues (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	code varchar(10) NOT NULL COMMENT 'Code',
	description text COMMENT 'Description',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tonalites (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS utilisateurs (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	matricule int(8) NOT NULL COMMENT 'Matricule',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	prenom varchar(50) NOT NULL COMMENT 'Prénom',
	telephone varchar(10) NOT NULL COMMENT 'Téléphone',
	courriel varchar(320) COMMENT 'Addresse de courriel',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS genres (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS artistes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS formes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS medias (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	titre varchar(50) NOT NULL COMMENT 'Titre',
	annee_publication int(11) COMMENT 'Année de publication',
	image varchar(100) COMMENT 'Image',
	quantite int(11) COMMENT 'Quantité',
	reference varchar(50) NOT NULL COMMENT 'Numéro de référence',
	notes varchar(150) COMMENT 'Notes',
	maison_editionID int(11) COMMENT 'Maison d''édition',
	categorieID int(11) NOT NULL COMMENT 'Catégorie',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif',
	FOREIGN KEY(maison_editionID) REFERENCES maisons_edition(ID),
	FOREIGN KEY(categorieID) REFERENCES categories(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS imprimes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	sous_titre varchar(100) COMMENT 'Sous-titre',
	collectionID int(11) COMMENT 'Collection',
	position_collection int(11) COMMENT 'Position dans la collection',
	FOREIGN KEY(exID) REFERENCES medias(ID) ON DELETE CASCADE,
	FOREIGN KEY(collectionID) REFERENCES collections(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS details_imprimes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	titre varchar(50) NOT NULL COMMENT 'Titre',
	position_media int(11) NOT NULL COMMENT 'Position dans le média',
	catalogueID int(11) COMMENT 'Catalogue',
	genreID int(11) COMMENT 'Genre',
	FOREIGN KEY(exID) REFERENCES imprimes(ID) ON DELETE CASCADE,
	FOREIGN KEY(catalogueID) REFERENCES catalogues(ID),
	FOREIGN KEY(genreID) REFERENCES genres(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS arrangeurs_details_imprimes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Arrangeur',
	FOREIGN KEY(artisteID) REFERENCES artistes(ID),
	FOREIGN KEY(exID) REFERENCES details_imprimes(ID) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS audios_videos (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	collectionID int(11) COMMENT 'Collection',
	position_collection int(11) COMMENT 'Position dans la collection',
	CUP int(11) NOT NULL COMMENT 'CUP',
	realisateurs varchar(200) COMMENT 'Réalisateur',
	nationaliteID int(11) COMMENT 'Nationalité',
	FOREIGN KEY (exID) REFERENCES medias(ID) ON DELETE CASCADE,
	FOREIGN KEY (collectionID) REFERENCES collections(ID),
	FOREIGN KEY (nationaliteID) REFERENCES nationalites(ID)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	titre varchar(50) NOT NULL COMMENT 'Titre',
	position_media int(11) COMMENT 'Position dans le média',
	annee_enregistrement int(11) COMMENT 'Année d''enregistrement',
	duree decimal(4,2) COMMENT 'Durée',
	catalogueID int(11) COMMENT 'Catalogue',
	epoqueID int(11) COMMENT 'Époque',
	formeID int(11) COMMENT 'Forme',
	genreID int(11) COMMENT 'Genre',
	instrumentationID int(11) COMMENT 'Instrumentation',
	tonaliteID int(11) COMMENT 'Tonalité',
	notes varchar(150) COMMENT 'Notes',
	FOREIGN KEY (exID) REFERENCES audios_videos(ID) ON DELETE CASCADE,
	FOREIGN KEY (tonaliteID) REFERENCES tonalites(ID),
	FOREIGN KEY (formeID) REFERENCES formes(ID),
	FOREIGN KEY (epoqueID) REFERENCES epoques(ID),
	FOREIGN KEY (instrumentationID) REFERENCES instrumentations(ID),
	FOREIGN KEY (genreID) REFERENCES genres(ID),
	FOREIGN KEY (catalogueID) REFERENCES catalogues(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS arrangeurs_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Arrangeur',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS artistes_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Artiste',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS compositeurs_details_imprimes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Compositeur',
	FOREIGN KEY (exID) REFERENCES details_imprimes(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS compositeurs_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Compositeur',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS emprunts (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	utilisateurID int(11) NOT NULL COMMENT 'Utilisateur',
	date_reservation date NOT NULL COMMENT 'Date de réservation',
	date_voulue date NOT NULL COMMENT 'Date voulue',
	date_emprunt date COMMENT 'Date d''emprunt',
	duree int(11) NOT NULL COMMENT 'Durée',
	date_retour date COMMENT 'Date de retour',
	mediaID int(11) NOT NULL COMMENT 'Média',
	FOREIGN KEY (utilisateurID) REFERENCES utilisateurs(ID),
	FOREIGN KEY (mediaID) REFERENCES medias(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS parolier_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Parolier',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS interpretes_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Interprête',
	taches varchar(50) NOT NULL COMMENT 'Tâche',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orchestrateurs_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Orchestrateur',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDB;

INSERT INTO epoques(ID, nom, inactif)
VALUES (1, 'Baroque', FALSE),
	(2, 'Classique', FALSE),
	(3, 'Médiéval', FALSE),
	(4, 'Renaissance', FALSE),
	(5, 'Romantique', FALSE);
