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
) ENGINE=InnoDB COMMENT 'Époques';

CREATE TABLE IF NOT EXISTS maisons_edition (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDB COMMENT 'Maisons d''édition';

CREATE TABLE IF NOT EXISTS instrumentations (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Instrumentations';

CREATE TABLE IF NOT EXISTS categoriesMedia (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	image varchar(100) COMMENT 'Image'
) ENGINE=InnoDb COMMENT 'Types de support';

CREATE TABLE IF NOT EXISTS supports (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	description varchar(100) NOT NULL COMMENT 'Description',
	categorieMediaID int(11) NOT NULL COMMENT 'Type de support',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif',
	FOREIGN KEY(categorieMediaID) REFERENCES categoriesMedia(ID)
) ENGINE=InnoDb COMMENT 'Catégories';

CREATE TABLE IF NOT EXISTS nationalites (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Nationalités';

CREATE TABLE IF NOT EXISTS collections (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	type smallint NOT NULL COMMENT 'Type de média',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Collections';

CREATE TABLE IF NOT EXISTS catalogues (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	code varchar(10) NOT NULL COMMENT 'Code',
	description varchar(100) COMMENT 'Description',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Catalogues';

CREATE TABLE IF NOT EXISTS tonalites (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Tonalités';

CREATE TABLE IF NOT EXISTS utilisateurs (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	matricule int(8) NOT NULL COMMENT 'Matricule',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	prenom varchar(50) NOT NULL COMMENT 'Prénom',
	telephone varchar(10) NOT NULL COMMENT 'Téléphone',
	courriel varchar(320) COMMENT 'Addresse de courriel',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Utilisateurs';

CREATE TABLE IF NOT EXISTS genres (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Genres';

CREATE TABLE IF NOT EXISTS artistes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Artistes';

CREATE TABLE IF NOT EXISTS formes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Formes';

CREATE TABLE IF NOT EXISTS medias (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	titre varchar(50) NOT NULL COMMENT 'Titre',
	annee_publication int(11) COMMENT 'Année de publication',
	image varchar(100) COMMENT 'Image',
	artisteID int(11) COMMENT 'Artiste',
	genreID int(11) COMMENT 'Genre',
	quantite int(11) COMMENT 'Quantité',
	reference varchar(50) NOT NULL COMMENT 'Numéro de référence',
	notes varchar(150) COMMENT 'Notes',
	maison_editionID int(11) COMMENT 'Maison d''édition',
	supportID int(11) NOT NULL COMMENT 'Catégorie',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif',
	FOREIGN KEY(maison_editionID) REFERENCES maisons_edition(ID),
	FOREIGN KEY(supportID) REFERENCES supports(ID),
	FOREIGN KEY(genreID) REFERENCES genres(ID),
	FOREIGN KEY(artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Médias';

-- INSERT INTO imprimes(ID, exID, sous_titre, collectionID, position_collection)
CREATE TABLE IF NOT EXISTS imprimes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	sous_titre varchar(100) COMMENT 'Sous-titre',
	collectionID int(11) COMMENT 'Collection',
	position_collection int(11) COMMENT 'Position dans la collection',
	FOREIGN KEY(exID) REFERENCES medias(ID) ON DELETE CASCADE,
	FOREIGN KEY(collectionID) REFERENCES collections(ID)
) ENGINE=InnoDb COMMENT 'Médias imprimés';


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
) ENGINE=InnoDb COMMENT 'Détails des médias imprimés';


CREATE TABLE IF NOT EXISTS arrangeurs_details_imprimes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Arrangeur',
	FOREIGN KEY(artisteID) REFERENCES artistes(ID),
	FOREIGN KEY(exID) REFERENCES details_imprimes(ID) ON DELETE CASCADE
) ENGINE=InnoDb COMMENT 'Arrangeurs';


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
) ENGINE=InnoDb COMMENT 'Médias audios vidéos';


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
) ENGINE=InnoDb COMMENT 'Pieces';

CREATE TABLE IF NOT EXISTS arrangeurs_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Arrangeur',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Arrangeurs';

CREATE TABLE IF NOT EXISTS artistes_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Artiste',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Artistes';

CREATE TABLE IF NOT EXISTS compositeurs_details_imprimes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Compositeur',
	FOREIGN KEY (exID) REFERENCES details_imprimes(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Compositeurs';

CREATE TABLE IF NOT EXISTS compositeurs_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Compositeur',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Compositeurs';

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
) ENGINE=InnoDb COMMENT 'Emprunts';

CREATE TABLE IF NOT EXISTS parolier_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Parolier',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Paroliers';

CREATE TABLE IF NOT EXISTS interpretes_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Interprête',
	taches varchar(50) NOT NULL COMMENT 'Tâche',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Interprètes';

CREATE TABLE IF NOT EXISTS orchestrateurs_pieces (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) NOT NULL,
	artisteID int(11) NOT NULL COMMENT 'Orchestrateur',
	FOREIGN KEY (exID) REFERENCES pieces(ID) ON DELETE CASCADE,
	FOREIGN KEY (artisteID) REFERENCES artistes(ID)
) ENGINE=InnoDb COMMENT 'Orchestrateurs';

INSERT INTO epoques(ID, nom, inactif)
VALUES
	(1, 'Baroque', TRUE),
	(2, 'Classique', FALSE),
	(3, 'Médiéval', FALSE),
	(4, 'Renaissance', TRUE),
	(5, 'Romantique', FALSE);

INSERT INTO `maisons_edition` (`ID`, `nom`, `inactif`) VALUES
(1, 'Actes Sud', 0),
(2, 'Les 400 coups', 0),
(3, 'Les Allusifs', 0),
(4, 'Éditions De Courberon', 0),
(5, 'Éditions Liber', 0),
(6, 'Paris Pocket', 0),
(7, 'Lucasfilm', 0);

INSERT INTO categoriesMedia(ID, nom, image)
VALUES
	(1, 'Imprimé', 'imprime.png'),
	(2, 'Audio', 'audio.png'),
	(3, 'Vidéo', 'video.png');

INSERT INTO supports(ID, nom, description, categorieMediaID, inactif)
VALUES
	(1, 'CD', 'Disque compact', 2, FALSE),
	(2, 'CS', 'Cassette audio', 2, TRUE),
	(3, 'VHS', 'Vidéocassette VHS', 3, FALSE),
	(4, 'Méthode', '', 1, FALSE),
	(5, 'Recueil', '', 1, FALSE),
	(6, 'Volume', '', 1, FALSE),
	(7, 'Références', '', 1, FALSE),
	(8, 'Livre roman', '', 1, FALSE);

INSERT INTO nationalites (ID, nom, inactif)
VALUES
	(1, 'Américain', TRUE),
	(2, 'Français', TRUE),
	(3, 'Canadien', TRUE),
	(4, 'Belge', FALSE),
	(5, 'Néo-zélandais', TRUE);

INSERT INTO genres (ID, nom, inactif)
VALUES
	(1, 'Aventure', TRUE),
	(2, 'Merveilleux', TRUE);
	
INSERT INTO `medias` (`ID`, `titre`, `annee_publication`, `image`, `artisteID`, `genreID`, `quantite`, `reference`, `notes`, `maison_editionID`, `supportID`, `inactif`) VALUES
(1, 'La communauté de l’anneau', 1972, '', NULL, 2, 1, '1 Livre roman', '', 6, 8, 0),
(2, 'Les deux tours', 1992, '2.jpg', NULL, 2, 1, '2 Livre roman', '', 6, 8, 0),
(3, 'Le retour du Roi', 1994, '', NULL, 2, 1, '3 Livre roman', '', 6, 8, 0),
(4, 'Indiana Jones et la Dernière Croisade', 1987, '', NULL, 1, 1, '1 VHS', '', 7, 3, 0),
(5, 'Indiana Jones et le Temple maudit', 1990, '', NULL, 1, 1, '2 VHS', 'Film extraordinaire', 7, 3, 0);

INSERT INTO collections (ID, nom, type, inactif)
VALUES
	(1, 'Le seigneur des anneaux', '1', TRUE),
	(2, 'Indiana Jones', '3', TRUE);

INSERT INTO audios_videos (ID, exID, collectionID, position_collection, CUP, realisateurs, nationaliteID)
VALUES
	(1, 4, 2, 3, 2131234, 'Steven Spielberg', 1),
	(2, 5, 2, 2, 3232444, 'Steven Spielberg', 1);

INSERT INTO imprimes (ID, exID, sous_titre, collectionID, position_collection)
VALUES
	(1, 1, NULL, 1, 1),
	(2, 2, NULL, 1, 2),
	(3, 3, NULL, 1, 3);

INSERT INTO utilisateurs (ID, matricule, nom, prenom, telephone, courriel, inactif)
VALUES
	(1, 834612, 'Boudreault', 'Émile', '8192323232', 'findumonde@gmail.com', TRUE),
	(2, 974364, 'Borduas', 'Paul-Émile', '8192324433', 'borduas@gmail.com', TRUE);

INSERT INTO artistes (ID, nom, inactif)
VALUES
	(1, 'Wolgang Amadeus Mozart', TRUE),
	(2, 'André Mathieu', TRUE),
	(3, 'Ludwig van Beethoven', TRUE),
	(4, 'Frédéric Chopin', TRUE),
	(5, 'Johann Sebastian Bach', TRUE),
	(6, 'Antonio Salieri', TRUE),
	(7, 'Lorenzo da Ponte', TRUE);


