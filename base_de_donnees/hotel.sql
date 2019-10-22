
--
-- Database: `hotel`
--

-- --------------------------------------------------------
--
-- Table structure for table `classe`
--
CREATE TABLE IF NOT EXISTS classe (
   id_classe int auto_increment primary key,
   nombre_etoile int,
   caracteristique varchar(100)
);

--
-- Table structure for table `hotel`
--
CREATE TABLE IF NOT EXISTS hotel (
   id_hotel int auto_increment primary key,
   id_classe int,
   nom_hotel varchar(100),
   addresse_hotel varchar(100),
   ville_hotel varchar(100),
   telephone_hotel varchar(100),
   email_hotel varchar(100)
);
Alter table hotel add constraint foreign key(id_classe) references classe(id_classe); 

--
-- Table structure for table `categorie`
--
CREATE TABLE IF NOT EXISTS categorie (
   id_categorie int auto_increment primary key,
   nom_categorie varchar(100),
   code_categorie varchar(100),
   prix_categorie varchar(100),
   description varchar(100),
   photo varchar(100)
);

--
-- Table structure for table `chambre`
--
CREATE TABLE IF NOT EXISTS chambre (
   id_chambre int auto_increment primary key,
   id_categorie int,
   designation_chambre varchar(100),
   localisation varchar(100),
   prix_chambre double,
   nbre_personnes int,
   etat_chambre varchar(100),
   photo_chambre varchar(100)
);
ALTER table chambre add constraint foreign key(id_categorie) references categorie(id_categorie);

--
-- Table structure for table `client`
--
CREATE TABLE IF NOT EXISTS client (
   id_client int auto_increment primary key,
   nom_client varchar(100),
   prenom_client varchar(100),
   addresse_client varchar(100),
   ville_client varchar(100),
   pays_client varchar(100),
   telephone_client varchar(100),
   email_client varchar(100)
);

-- --------------------------------------------------------
--
-- Table structure for table `reservation`
--
CREATE TABLE IF NOT EXISTS reservation (
   id_reservation int auto_increment primary key,
   id_client int,
   id_chambre int,
   numero_reservation varchar(100),
   date_debut date,
   date_fin date,
   payement_Avance double,
   date_PayAvance date
);
ALTER table reservation add constraint foreign key(id_client) references client(id_client);
ALTER table reservation add constraint foreign key(id_chambre) references chambre(id_chambre);

-- --------------------------------------------------------
--
-- Table structure for table `payement`
--
CREATE TABLE IF NOT EXISTS payement (
   id_payement int auto_increment primary key,
   id_reservation int,
   type varchar(100),
   montant_verse double,
   montant_restant double,
   date_payement date
);
ALTER table payement add constraint foreign key(id_reservation) references reservation(id_reservation);

-- --------------------------------------------------------
--
-- Table structure for table `menu`
--
CREATE TABLE IF NOT EXISTS menu (
   id_menu int auto_increment primary key,
   code_menu varchar(100),
   type varchar(100),
   designation varchar(100),
   prix double,
   description varchar(100)
);

-- --------------------------------------------------------
--
-- Table structure for table `commande`
--
CREATE TABLE IF NOT EXISTS commande (
   id_commande int auto_increment primary key,
   id_client int,
   num_commande varchar(100),
   date_commande date,
   heure_commande time,
   description varchar(100)
);
ALTER table commande add constraint foreign key(id_client) references client(id_client);

-- --------------------------------------------------------
--
-- Table structure for table `ligneCommande`
--
CREATE TABLE IF NOT EXISTS ligneCommande (
   id_ligneCommande int auto_increment primary key,
   id_menu int,
   id_commande int,
   qualite int,
   date date
);
ALTER table ligneCommande add constraint foreign key(id_menu) references menu(id_menu);
ALTER table ligneCommande add constraint foreign key(id_commande) references commande(id_commande);

-- --------------------------------------------------------
--
-- Table structure for table `offre`
--
CREATE TABLE IF NOT EXISTS offre (
   id_offre int auto_increment primary key,
   id_menu int,
   id_hotel int,
   nature varchar(100),
   qualite varchar(100)
);
ALTER table offre add constraint foreign key(id_hotel) references hotel(id_hotel);
ALTER table offre add constraint foreign key(id_menu) references menu(id_menu);

-- --------------------------------------------------------
--
-- Table structure for table `tarif`
--
CREATE TABLE IF NOT EXISTS tarif (
   id_tarif int auto_increment primary key,
   id_categorie int,
   id_classe int,
   tarif_unitaire double
);
ALTER table tarif add constraint foreign key(id_classe) references classe(id_classe);
ALTER table tarif add constraint foreign key(id_categorie) references categorie(id_categorie);

-- --------------------------------------------------------
--
-- Table structure for table `role`
--
CREATE TABLE IF NOT EXISTS role(
   id_role int auto_increment primary key,
   nom_role varchar(100)
);

-- --------------------------------------------------------
--
-- Table structure for table `utilisateur`
--
CREATE TABLE IF NOT EXISTS utilisateur (
   id_utilisateur int auto_increment primary key,
   id_role int,
   username varchar(100),
   password varchar(100),
   poste varchar(100),
   actived boolean
);
Alter table utilisateur add constraint foreign key(id_role) references role(id_role);


-- --------------------------------------------------------
--
-- Table structure for table `agent`
--
CREATE TABLE IF NOT EXISTS agent (
   id_agent int auto_increment primary key,
   id_utilisateur int,
   nom_agent varchar(100),
   prenom_agent varchar(100),
   tel_agent varchar(100),
   email_agent varchar(100)
);
Alter table agent add constraint foreign key(id_utilisateur) references utilisateur(id_utilisateur);

-- --------------------------------------------------------
--
-- Table structure for table `comptable`
--
CREATE TABLE IF NOT EXISTS comptable (
   id_comptable int auto_increment primary key,
   id_utilisateur int,
   nom_comptable varchar(100),
   prenom_comptable varchar(100),
   tel_comptable varchar(100),
   email_comptable varchar(100)
);
Alter table comptable add constraint foreign key(id_utilisateur) references utilisateur(id_utilisateur);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS contact(
  id_contact int unsigned auto_increment primary key,
  title varchar(52),
  subject varchar(100),
  news text
);
