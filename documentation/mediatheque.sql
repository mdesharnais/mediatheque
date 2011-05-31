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

CREATE TABLE IF NOT EXISTS categories_media (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	image varchar(100) COMMENT 'Image',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif'
) ENGINE=InnoDb COMMENT 'Types de support';

CREATE TABLE IF NOT EXISTS supports (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	description varchar(100) NOT NULL COMMENT 'Description',
	categorie_mediaID int(11) NOT NULL COMMENT 'Type de support',
	inactif BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Inactif',
	FOREIGN KEY(categorie_mediaID) REFERENCES categories_media(ID)
) ENGINE=InnoDb COMMENT 'Supports';

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

CREATE TABLE IF NOT EXISTS groupes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	nom varchar(50) NOT NULL COMMENT 'Nom',
	inactif BOOLEAN NOT NULL COMMENT 'Inactif',
	UNIQUE(nom)
) ENGINE=InnoDb COMMENT 'Groupes';

CREATE TABLE IF NOT EXISTS groupes_utilisateurs (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	exID int(11) COMMENT 'Utilisateur',
	groupeID int(11) COMMENT 'Groupe',
	FOREIGN KEY(exID) REFERENCES utilisateurs(ID) ON DELETE CASCADE,
	FOREIGN KEY(groupeID) REFERENCES groupes(ID)
) ENGINE=InnoDb COMMENT 'Groupes des utilisateurs';

CREATE TABLE IF NOT EXISTS droits_groupes (
	ID int(11) PRIMARY KEY COMMENT 'ID',
	section varchar(250) NOT NULL COMMENT 'Section',
	groupeID int(11) COMMENT 'Groupe',
	droits BIGINT NOT NULL COMMENT 'Droits',
	FOREIGN KEY(groupeID) REFERENCES groupes(ID),
	UNIQUE(section, groupeID)
) ENGINE=InnoDb COMMENT 'Droits des groupes';

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
	titre varchar(75) NOT NULL COMMENT 'Titre',
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
	CUP int(11) COMMENT 'CUP',
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
	duree TIME COMMENT 'Durée',
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

INSERT INTO artistes (ID, nom, inactif)
VALUES
	(1,  'Wolgang Amadeus Mozart', TRUE),
	(2,  'André Mathieu', FALSE),
	(3,  'Ludwig van Beethoven', TRUE),
	(4,  'Frédéric Chopin', TRUE),
	(5,  'Johann Sebastian Bach', TRUE),
	(6,  'Antonio Salieri', TRUE),
	(7,  'Lorenzo da Ponte', TRUE),
	(8,  'Les cowboys fringants', TRUE),
	(9,  'Gilles Vigneault', TRUE),
	(10, 'Polémil Bazar', TRUE);

INSERT INTO epoques(ID, nom, inactif)
VALUES
	(1, 'Baroque', TRUE),
	(2, 'Classique', FALSE),
	(3, 'Médiéval', FALSE),
	(4, 'Renaissance', TRUE),
	(5, 'Romantique', FALSE);

INSERT INTO maisons_edition (ID, nom, inactif)
VALUES
	(1,  'Actes Sud', FALSE),
	(2,  'Les 400 coups', FALSE),
	(3,  'Les Allusifs', FALSE),
	(4,  'Éditions De Courberon', FALSE),
	(5,  'Éditions Liber', FALSE),
	(6,  'Paris Pocket', TRUE),
	(7,  'Lucasfilm', FALSE),
	(8,  'Music sales', FALSE),
	(9,  'Deutsche Grammophon', FALSE),
	(10, 'Éditions Reprises', FALSE),
	(11, 'La tribune', FALSE),
	(12, 'Tacca Musique', FALSE);

INSERT INTO categories_media(ID, nom, image)
VALUES
	(1, 'Imprimé', 'imprime.png'),
	(2, 'Audio', 'audio.png'),
	(3, 'Vidéo', 'video.png');

INSERT INTO supports(ID, nom, description, categorie_mediaID, inactif)
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
	(1, 'Américain', FALSE),
	(2, 'Français', FALSE),
	(3, 'Canadien', FALSE),
	(4, 'Belge', FALSE),
	(5, 'Néo-zélandais', TRUE),
	(6, 'Autrichienne', FALSE);

INSERT INTO genres (ID, nom, inactif)
VALUES
	(1, 'Aventure', FALSE),
	(2, 'Merveilleux', TRUE),
	(3, 'Musique classique', FALSE),
	(4, 'Traditionnel', FALSE),
	(5, 'Folk', FALSE),
	(6, 'Country', FALSE),
	(7, 'Rock alternatif', FALSE),
	(8, 'Pop (Franco)', FALSE);

INSERT INTO collections (ID, nom, type, inactif)
VALUES
	(1, 'Le seigneur des anneaux', '1', TRUE),
	(2, 'Indiana Jones', '3', TRUE),
	(3, 'Mozart 3 D collection', 2, 0);

INSERT INTO medias (ID, titre, annee_publication, image, artisteID, genreID, quantite, reference, notes, maison_editionID, supportID, inactif)
VALUES
	(1,  'La communauté de l''anneau', 1972, 'leSeigneurDesAnneaux1.png', NULL, 2, 1, '1 Livre roman', '', 6, 8, 0),
	(2,  'Les deux tours', 1992, '2.jpg', NULL, 2, 1, '2 Livre roman', '', 6, 8, 0),
	(3,  'Le retour du Roi', 1994, '', NULL, 2, 1, '3 Livre roman', '', 6, 8, 0),
	(4,  'Indiana Jones et la Dernière Croisade', 1987, '', NULL, 1, 1, '1 VHS', '', 7, 3, 0),
	(5,  'Indiana Jones et le Temple maudit', 1990, '', NULL, 1, 1, '2 VHS', 'Film extraordinaire', 7, 3, 0),
	(13, '20 chansons faciles de Gilles Vigneault', 1997, '20chansons.jpeg', 9, 4, NULL, '3t3d', NULL, 10, 5, 0),
	(14, 'Symphonien no. 35 KV 385 Haffner, no. 36 KV 425 Linzer', 1988, NULL, 1, 3, 1, '3f22', '1 disque son. (63 min) : numérique, stéréo ; 12 cm + ', 9, 1, 0);

INSERT INTO medias(ID, supportID, artisteID, annee_publication, reference, genreID, maison_editionID, inactif, titre, image)
VALUES
	(6,  1,  8, 2008, 'CD-C00001', 5, 11, FALSE, 'L''expédition',         'L''Expédition.jpg'),
	(7,  1,  8, 2008, 'CD-C00002', 6, 11, FALSE, 'Sur un air de déjà vu', 'surUnAirDeDéjàVu.jpg'),
	(8,  1,  8, 2004, 'CD-C00003', 7, 11, FALSE, 'La grand-messe',        NULL),
	(9,  1,  8, 2002, 'CD-C00004', 6, 11, FALSE, 'Break syndical',        NULL),
	(10, 1,  8, 2000, 'CD-C00005', 5, 11, FALSE, 'Motel capri',           NULL),
	(11, 1,  8, 1998, 'CD-C00006', 6, 11, FALSE, 'Sur mon canapé',        NULL),
	(12, 1,  8, 1997, 'CD-C00007', 7, 11, FALSE, '12 grandes chansons',   NULL),
	(15, 1, 10, 2005, 'CD-C00008', 8, 12, FALSE, 'Avale ta montre',       'avaleTaMontre.jpg');

INSERT INTO audios_videos (ID, exID, nationaliteID, collectionID, position_collection, CUP, realisateurs)
VALUES
	(1,  4,  1, 2,    3,    2131234, 'Steven Spielberg'),
	(2,  5,  1, 2,    2,    3232444, 'Steven Spielberg'),
	(3,  6,  3, NULL, NULL, NULL,    NULL),
	(4,  7,  3, NULL, NULL, NULL,    NULL),
	(5,  8,  3, NULL, NULL, NULL,    NULL),
	(6,  9,  3, NULL, NULL, NULL,    NULL),
	(7,  10, 3, NULL, NULL, NULL,    NULL),
	(8,  11, 3, NULL, NULL, NULL,    NULL),
	(9,  12, 3, NULL, NULL, NULL,    NULL),
	(10, 13, 3, 1,    3453, NULL,    'James Levine'),
	(11, 15, 3, NULL, NULL, NULL,    NULL);


INSERT INTO pieces(ID, exID, titre, annee_enregistrement, duree, genreID)
VALUES
	(200, 10, 'Symphonie nº 35', 1988, '00:13:40', 3),
	(201, 10, 'Symphonie nº 36', 1988, '00:12:33', 3);

INSERT INTO pieces(ID, exID, position_media, duree, titre)
VALUES
	( 1 ,  3,  1, '00:04:45', 'Droit devant'),
	( 2 ,  3,  2, '00:02:12', 'Chêne et roseau'),
	( 3 ,  3,  3, '00:03:32', 'Entre deux taxis'),
	( 4 ,  3,  4, '00:03:03', 'La Catherine'),
	( 5 ,  3,  5, '00:03:09', 'Histoire de pêche'),
	( 6 ,  3,  6, '00:03:37', 'Bobo'),
	( 7 ,  3,  7, '00:02:50', 'Rue des souvenirs'),
	( 8 ,  3,  8, '00:03:54', 'Monsieur'),
	( 9 ,  3,  9, '00:04:32', 'La tête haute'),
	( 10,  3, 10, '00:04:33', 'Les hirondelles'),
	( 11,  3, 11, '00:03:54', 'Tant qu''on aura de l''amour'),
	( 12,  3, 12, '00:03:29', 'La bonne pomme'),
	( 13,  3, 13, '00:02:47', 'Train de vie'),
	( 14,  3, 14, '00:05:33', 'Une autre journée qui se lève'),

	( 15,  4,  1, '00:04:27', 'Chanteur pop'),
	( 16,  4,  2, '00:03:06', 'Beau-frère'),
	( 17,  4,  3, '00:01:31', 'La ballade de Jipi Labrosse'),
	( 18,  4,  4, '00:01:40', 'Sur un air de déjà vu'),
	( 19,  4,  5, '00:03:23', 'Par chez nous'),
	( 20,  4,  6, '00:00:26', 'Sans tambour ni trompette'),
	( 21,  4,  7, '00:02:26', 'Normal Tremblay'),
	( 22,  4,  8, '00:03:45', '1994'),
	( 23,  4,  9, '00:02:15', 'Pittoresque!'),
	( 24,  4, 10, '00:02:50', 'Vacances 31'),
	( 25,  4, 11, '00:01:26', 'Le blues d''la vie'),
	( 26,  4, 12, '00:04:27', 'Titi Tancrède / Le reel d''la fesse'),
	( 27,  4, 13, '00:02:44', 'Rentre à pied'),
	( 28,  4, 14, '00:01:26', 'Quand tu pars'),
	( 29,  4, 15, '00:04:04', 'Döner au suivant'),

	( 30,  5,  1, '00:01:05', 'Intro'),
	( 31,  5,  2, '00:04:25', 'Les étoiles filantes'),
	( 32,  5,  3, '00:03:27', 'Ti-cul'),
	( 33,  5,  4, '00:04:05', '8 secondes'),
	( 34,  5,  5, '00:03:36', 'Plus rien'),
	( 35,  5,  6, '00:05:24', 'Hannah'),
	( 36,  5,  7, '00:05:36', 'Symphonie pour Caza'),
	( 37,  5,  8, '00:02:50', 'La Reine'),
	( 38,  5,  9, '00:04:48', 'En attendant (Le reel de nos gens)'),
	( 39,  5, 10, '00:03:36', 'Lettre à Lévesque'),
	( 40,  5, 11, '00:03:59', 'Ces temps-ci'),
	( 41,  5, 12, '00:03:31', 'Ma belle Sophie'),
	( 42,  5, 13, '00:01:41', 'Shish Taouk'),
	( 43,  5, 14, '00:03:34', 'Camping Ste-Germaine'),
	( 44,  5, 15, '00:05:55', 'Si la vie vous intéresse'),

	( 45,  6,  1, '00:04:08', 'En berne'),
	( 46,  6,  2, '00:04:30', 'La tête à Papineau'),
	( 47,  6,  3, '00:03:34', 'Toune d''automne'),
	( 48,  6,  4, '00:03:40', 'Heavy metal'),
	( 49,  6,  5, '00:03:21', 'La manifestation'),
	( 50,  6,  6, '00:02:45', 'Break syndical'),
	( 51,  6,  7, '00:05:23', 'L''hiver approche'),
	( 52,  6,  8, '00:01:12', 'À'' polyvalente'),
	( 53,  6,  9, '00:03:56', 'La noce'),
	( 54,  6, 10, '00:01:52', 'Quand je r''garde'),
	( 55,  6, 11, '00:04:00', 'Mon chum Rémi'),
	( 56,  6, 12, '00:04:05', 'Salu mon Run'),
	( 57,  6, 13, '00:03:17', 'Joyeux calvair!'),
	( 58,  6, 14, '00:04:47', 'Ruelle Laurier/Toune cachée'),

	( 59,  7,  1, '00:00:10', 'Su'' mon big wheel (C''tait l''fun'),
	( 60,  7,  2, '00:03:03', 'Le plombier'),
	( 61,  7,  3, '00:02:04', 'Québécois de souche'),
	( 62,  7,  4, '00:02:37', 'Awikatchikaën'),
	( 63,  7,  5, '00:03:30', 'Maurice au bistro'),
	( 64,  7,  6, '00:05:41', 'M''a vivre avec toi'),
	( 65,  7,  7, '00:04:41', 'Le shack à Hector'),
	( 66,  7,  8, '00:02:39', 'Marcel Galarneau'),
	( 67,  7,  9, '00:04:15', 'Mon pays suivi du real des aristocrates'),
	( 68,  7, 10, '00:04:25', 'Rue Chapdelaine'),
	( 69,  7, 11, '00:04:46', 'Banlieue'),
	( 70,  7, 12, '00:02:54', 'Voyou'),
	( 71,  7, 13, '00:05:22', 'Léopold'),
	( 72,  7, 14, '00:03:17', 'Le gars d''la compagnie'),
	( 73,  7, 15, '00:03:11', 'Le pouceux'),
	( 74,  7, 16, '00:03:09', 'Un p''tit tour'),

	( 75,  8,  1, '00:02:43', 'Marcel Galarneau'),
	( 76,  8,  2, '00:03:06', 'Le plombier'),
	( 77,  8,  3, '00:03:51', 'Spécial #6'),
	( 78,  8,  4, '00:03:48', 'Maurice au bistro'),
	( 79,  8,  5, '00:03:30', 'Goldie'),
	( 80,  8,  6, '00:03:07', 'Denise Martinez'),
	( 81,  8,  7, '00:04:49', 'Mon pays (real des aristocrates)'),
	( 82,  8,  8, '00:04:57', 'Le quai de Bertier'),
	( 83,  8,  9, '00:03:15', 'Grosse femme'),
	( 84,  8, 10, '00:05:19', 'La gosse à Comeau'),
	( 85,  8, 11, '00:02:39', 'La culbute'),
	( 86,  8, 12, '00:04:42', 'Banlieue'),

	( 87,  9,  1, '00:03:36', 'Les routes du bonheur'),
	( 88,  9,  2, '00:02:50', 'Awikatchikaën'),
	( 89,  9,  3, '00:03:40', 'Évangéline'),
	( 90,  9,  4, '00:03:22', 'Cass de pouëlle'),
	( 91,  9,  5, '00:03:16', 'L''agacepésie'),
	( 92,  9,  6, '00:03:52', 'Dieudonné Rastapopoulos'),
	( 93,  9,  7, '00:03:39', 'Plattsburg'),
	( 94,  9,  8, '00:02:34', 'Willie Jos Hachey'),
	( 95,  9,  9, '00:04:38', 'Gaétane'),
	( 96,  9, 10, '00:02:39', 'Repentigny-by-the-sea'),
	( 97,  9, 11, '00:03:21', 'Le hurlot'),
	( 98,  9, 12, '00:04:46', 'Impala blues'),

	( 99, 11,  1, '00:03:45', 'Culturé, bien élevé'),
	(100, 11,  2, '00:02:40', 'Besoin de lunettes?'),
	(101, 11,  3, '00:04:06', 'Gaétan'),
	(102, 11,  4, '00:02:58', 'La chanson du vaurien'),
	(103, 11,  5, '00:03:15', 'On efface tout'),
	(104, 11,  6, '00:03:35', 'Mode d''emploi'),
	(105, 11,  7, '00:03:02', 'Les chiffres vont parler'),
	(106, 11,  8, '00:03:03', 'Les viscères'),
	(107, 11,  9, '00:04:12', 'L''usure'),
	(108, 11, 10, '00:04:10', 'Qu''à cela ne tienne'),
	(109, 11, 11, '00:04:57', 'Aux quatres coins de la sphère'),
	(110, 11, 12, '00:03:06', 'L''homme tonneau'),
	(111, 11, 13, '00:00:58', 'Fantasme bulgare');

INSERT INTO imprimes (ID, exID, sous_titre, collectionID, position_collection)
VALUES
	(1, 1, NULL, 1, 1),
	(2, 2, NULL, 1, 2),
	(3, 3, NULL, 1, 3),
	(4, 13, NULL, NULL, NULL);

INSERT INTO details_imprimes (ID, exID, titre, position_media, catalogueID, genreID) VALUES
(1, 4, 'Qu''il est difficile d''aimer', 1, NULL, NULL),
(2, 4, 'Pendant que', 2, NULL, NULL),
(3, 4, 'Quand les bateaux s''en vont', 3, NULL, NULL),
(5, 4, 'J''ai pour toi un lac', 4, NULL, NULL),
(6, 4, 'Quand vous mourrez de nos amours', 5, NULL, NULL),
(7, 4, 'J''ai planté un chêne', 7, NULL, NULL),
(8, 4, 'Ma jeunesse', 8, NULL, NULL),
(9, 4, 'Tombée la nuit', 9, NULL, NULL),
(10, 4, 'Il n''y a pas de bout du monde', 10, NULL, NULL),
(11, 4, 'Le grand cerf-volant', 11, NULL, NULL),
(12, 4, 'L''horloge', 12, NULL, NULL),
(13, 4, 'La vieille école', 13, NULL, NULL),
(14, 4, 'Si les bateaux', 14, NULL, NULL),
(15, 4, 'Mon pays', 15, NULL, NULL),
(16, 4, 'Printemps vient de vous', 16, NULL, NULL),
(17, 4, 'Avec nos yeux', 17, NULL, NULL),
(18, 4, 'Tante Irène', 18, NULL, NULL),
(19, 4, 'Le rendez-vous', 19, NULL, NULL),
(20, 4, 'L''escalier du temps', 20, NULL, NULL),
(21, 4, 'L''hiver', 21, NULL, NULL),
(22, 4, 'Laurelou', 22, NULL, NULL);

INSERT INTO utilisateurs (ID, matricule, nom, prenom, telephone, courriel, inactif)
VALUES
	(1, 834612, 'Boudreault', 'Émile', '8192323232', 'findumonde@gmail.com', TRUE),
	(2, 974364, 'Borduas', 'Paul-Émile', '8192324433', 'borduas@gmail.com', TRUE);
