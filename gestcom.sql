-- --------------------------------------------------------
-- Hôte :                        cridip.com
-- Version du serveur:           5.5.47-0+deb7u1 - (Debian)
-- SE du serveur:                debian-linux-gnu
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de table gc. article
CREATE TABLE IF NOT EXISTS `article` (
  `idarticle` int(11) NOT NULL AUTO_INCREMENT,
  `num_article` varchar(255) DEFAULT NULL,
  `idfamille` int(11) DEFAULT NULL,
  `designation_article` varchar(255) DEFAULT NULL,
  `prix_ht` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `nb_stock` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idarticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. client
CREATE TABLE IF NOT EXISTS `client` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `societe` varchar(255) DEFAULT NULL,
  `nom_client` varchar(255) DEFAULT NULL,
  `prenom_client` varchar(255) DEFAULT NULL,
  `adresse_client` varchar(255) DEFAULT NULL,
  `code_postal` varchar(255) DEFAULT NULL,
  `ville_client` varchar(255) DEFAULT NULL,
  `tel_client` varchar(255) DEFAULT NULL,
  `mail_client` varchar(255) DEFAULT NULL,
  `num_client` varchar(255) DEFAULT NULL,
  `cat_client` int(11) DEFAULT NULL,
  `column_12` int(11) DEFAULT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. client_communication
CREATE TABLE IF NOT EXISTS `client_communication` (
  `idclientmessage` int(11) NOT NULL AUTO_INCREMENT,
  `idclient` int(11) DEFAULT NULL,
  `objet` varchar(255) DEFAULT NULL,
  `message` longtext,
  `iduser` int(11) DEFAULT NULL,
  `date_expedition` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idclientmessage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. client_info_default
CREATE TABLE IF NOT EXISTS `client_info_default` (
  `idclientinfo` int(11) NOT NULL AUTO_INCREMENT,
  `idclient` int(11) DEFAULT NULL,
  `type_facturation` int(11) DEFAULT NULL COMMENT '1: immédiate / 2: Quotidient / 3: hebdomadaire / 4: bimensuel / 5: mensuel / 6: Trimestriel / 7: semestriel / 8: Annuel',
  `type_reglement` int(11) DEFAULT NULL COMMENT '1: Espèce / 2: Chèque / 3: CB / 4: Virement / 5: TNA / 6: PRLV / 7: TA',
  `encours` varchar(255) DEFAULT NULL,
  `delai_reglement` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idclientinfo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. client_service
CREATE TABLE IF NOT EXISTS `client_service` (
  `idclientservice` int(11) NOT NULL,
  `idclient` int(11) NOT NULL,
  `nom_service` varchar(255) NOT NULL,
  `desc_service` longtext NOT NULL,
  `num_serie` varchar(255) NOT NULL,
  `serial_key` varchar(255) NOT NULL,
  `date_debut` varchar(255) NOT NULL,
  `date_fin` varchar(255) NOT NULL,
  `etat_service` int(11) NOT NULL COMMENT '0: Inactif / 1: Actif / 2: Maintenance / 3: Bloqué / 4: Expiré',
  PRIMARY KEY (`idclientservice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. collab_event
CREATE TABLE IF NOT EXISTS `collab_event` (
  `idevent` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `titre_event` varchar(255) DEFAULT NULL,
  `lieu_event` varchar(255) DEFAULT NULL,
  `desc_event` longtext,
  `start_event` varchar(255) DEFAULT NULL,
  `end_event` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idevent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. collab_inbox
CREATE TABLE IF NOT EXISTS `collab_inbox` (
  `idinbox` int(13) NOT NULL AUTO_INCREMENT,
  `destinataire` int(13) NOT NULL,
  `expediteur` int(13) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `date_message` varchar(255) NOT NULL,
  `importance` int(1) NOT NULL,
  `lu` int(1) NOT NULL,
  PRIMARY KEY (`idinbox`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. collab_pj
CREATE TABLE IF NOT EXISTS `collab_pj` (
  `idpj` int(13) NOT NULL AUTO_INCREMENT,
  `idinbox` int(13) NOT NULL,
  `nom_pj` varchar(255) NOT NULL,
  `type_pj` varchar(255) NOT NULL,
  `taille_pj` int(13) NOT NULL,
  PRIMARY KEY (`idpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. collab_sentbox
CREATE TABLE IF NOT EXISTS `collab_sentbox` (
  `idsentbox` int(13) NOT NULL AUTO_INCREMENT,
  `destinataire` int(13) NOT NULL,
  `expediteur` int(13) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `date_message` varchar(255) NOT NULL,
  `importance` int(1) NOT NULL,
  PRIMARY KEY (`idsentbox`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. commande
CREATE TABLE IF NOT EXISTS `commande` (
  `idcommande` int(11) NOT NULL AUTO_INCREMENT,
  `num_devis` varchar(255) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL,
  `num_commande` varchar(255) DEFAULT NULL,
  `date_commande` varchar(255) DEFAULT NULL,
  `total_commande` varchar(255) DEFAULT NULL,
  `etat_commande` int(11) DEFAULT NULL COMMENT '0: saisie / 1: En attente / 2: Valider / 3: Transferer',
  PRIMARY KEY (`idcommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. commande_article
CREATE TABLE IF NOT EXISTS `commande_article` (
  `idcommandearticle` int(11) NOT NULL AUTO_INCREMENT,
  `num_commande` varchar(255) DEFAULT NULL,
  `idarticle` int(11) DEFAULT NULL,
  `qte` varchar(255) DEFAULT NULL,
  `total_ligne` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcommandearticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. compta_achat
CREATE TABLE IF NOT EXISTS `compta_achat` (
  `idachat` int(11) NOT NULL AUTO_INCREMENT,
  `code_compte` varchar(255) DEFAULT NULL,
  `date_mouvement` varchar(255) DEFAULT NULL,
  `num_mouvement` varchar(255) DEFAULT NULL,
  `libelle_mouvement` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idachat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. compta_banque
CREATE TABLE IF NOT EXISTS `compta_banque` (
  `idbanque` varchar(255) DEFAULT NULL,
  `code_compte` varchar(255) DEFAULT NULL,
  `date_mouvement` varchar(255) DEFAULT NULL,
  `num_mouvement` varchar(255) DEFAULT NULL,
  `libelle_mouvement` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. compta_caisse
CREATE TABLE IF NOT EXISTS `compta_caisse` (
  `idcaisse` int(11) NOT NULL AUTO_INCREMENT,
  `code_compte` varchar(255) DEFAULT NULL,
  `date_mouvement` varchar(255) DEFAULT NULL,
  `num_mouvement` varchar(255) DEFAULT NULL,
  `libelle_mouvement` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcaisse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. compta_classe
CREATE TABLE IF NOT EXISTS `compta_classe` (
  `idcomptaclasse` int(11) NOT NULL AUTO_INCREMENT,
  `code_classe` varchar(255) DEFAULT NULL,
  `libelle_classe` varchar(255) DEFAULT NULL,
  `total_classe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcomptaclasse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. compta_compte
CREATE TABLE IF NOT EXISTS `compta_compte` (
  `idcompte` int(11) NOT NULL AUTO_INCREMENT,
  `code_sousclasse` varchar(255) DEFAULT NULL,
  `code_compte` varchar(255) DEFAULT NULL,
  `libelle_compte` varchar(255) DEFAULT NULL,
  `total_compte` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcompte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. compta_sousclasse
CREATE TABLE IF NOT EXISTS `compta_sousclasse` (
  `idsousclasse` int(11) NOT NULL AUTO_INCREMENT,
  `code_classe` varchar(255) DEFAULT NULL,
  `code_sousclasse` varchar(255) DEFAULT NULL,
  `libelle_sousclasse` varchar(255) DEFAULT NULL,
  `total_sousclasse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idsousclasse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. compta_vente
CREATE TABLE IF NOT EXISTS `compta_vente` (
  `idvente` int(11) NOT NULL AUTO_INCREMENT,
  `code_compte` varchar(255) DEFAULT NULL,
  `date_mouvement` varchar(255) DEFAULT NULL,
  `num_mouvement` varchar(255) DEFAULT NULL,
  `libelle_mouvement` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idvente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. conf_annuaire_cat_client
CREATE TABLE IF NOT EXISTS `conf_annuaire_cat_client` (
  `idcatclient` int(13) NOT NULL AUTO_INCREMENT,
  `libelle_cat_client` varchar(255) NOT NULL,
  `encours` varchar(255) NOT NULL,
  `delai_rglt` varchar(255) NOT NULL,
  PRIMARY KEY (`idcatclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. conf_annuaire_groupe
CREATE TABLE IF NOT EXISTS `conf_annuaire_groupe` (
  `idgroupe` int(13) NOT NULL AUTO_INCREMENT,
  `nom_groupe` varchar(255) NOT NULL,
  PRIMARY KEY (`idgroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. conf_catalogue
CREATE TABLE IF NOT EXISTS `conf_catalogue` (
  `idconf` int(13) NOT NULL AUTO_INCREMENT,
  `gestion_stock` int(1) NOT NULL,
  `gestion_trackeur` int(1) NOT NULL,
  `gestion_construct` int(1) NOT NULL,
  `duree_garantie` varchar(255) NOT NULL COMMENT 'En mois',
  PRIMARY KEY (`idconf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. conf_entreprise_activite
CREATE TABLE IF NOT EXISTS `conf_entreprise_activite` (
  `idconf` int(13) NOT NULL AUTO_INCREMENT,
  `debut_activite` varchar(255) NOT NULL COMMENT 'strtotime',
  `pays` varchar(255) NOT NULL DEFAULT 'France',
  PRIMARY KEY (`idconf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. conf_entreprise_doc_general
CREATE TABLE IF NOT EXISTS `conf_entreprise_doc_general` (
  `idconf` int(13) NOT NULL AUTO_INCREMENT,
  `delai_devis_client_recent` varchar(255) NOT NULL,
  `delai_devis_client_perime` varchar(255) NOT NULL,
  PRIMARY KEY (`idconf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. conf_entreprise_general
CREATE TABLE IF NOT EXISTS `conf_entreprise_general` (
  `idconf` int(13) NOT NULL AUTO_INCREMENT,
  `societe` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `siret` varchar(255) NOT NULL,
  `num_tva` varchar(255) NOT NULL,
  `capital` varchar(100) NOT NULL,
  PRIMARY KEY (`idconf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. devis
CREATE TABLE IF NOT EXISTS `devis` (
  `iddevis` int(11) NOT NULL AUTO_INCREMENT,
  `idclient` int(11) DEFAULT NULL,
  `num_devis` varchar(255) DEFAULT NULL,
  `date_devis` varchar(255) DEFAULT NULL,
  `total_devis` varchar(255) DEFAULT NULL,
  `etat_devis` int(11) DEFAULT NULL COMMENT '0: Saisie / 1: En attente / 2: Valider / 3: Refuser / 4: Transferer',
  `explication` longtext NOT NULL,
  PRIMARY KEY (`iddevis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. devis_article
CREATE TABLE IF NOT EXISTS `devis_article` (
  `iddevisarticle` int(11) NOT NULL AUTO_INCREMENT,
  `num_devis` varchar(255) DEFAULT NULL,
  `idarticle` varchar(255) DEFAULT NULL,
  `qte` varchar(255) DEFAULT NULL,
  `total_ligne` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iddevisarticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. error
CREATE TABLE IF NOT EXISTS `error` (
  `iderror` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `msg` longtext,
  PRIMARY KEY (`iderror`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. facture
CREATE TABLE IF NOT EXISTS `facture` (
  `idfacture` int(11) NOT NULL AUTO_INCREMENT,
  `num_commande` varchar(255) DEFAULT NULL,
  `num_facture` varchar(255) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL,
  `date_facture` varchar(255) DEFAULT NULL,
  `total_facture` varchar(255) DEFAULT NULL,
  `etat_facture` int(11) DEFAULT NULL COMMENT '0: Saisie / 1: Attente RGLT / 2: PP / 3: Payer / 4: Retard / 5: Contentieux',
  PRIMARY KEY (`idfacture`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. facture_article
CREATE TABLE IF NOT EXISTS `facture_article` (
  `idfacturearticle` int(11) NOT NULL AUTO_INCREMENT,
  `num_facture` varchar(255) DEFAULT NULL,
  `idarticle` int(11) DEFAULT NULL,
  `description_sup` longtext,
  `qte` varchar(255) DEFAULT NULL,
  `total_ligne` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idfacturearticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. famille_article
CREATE TABLE IF NOT EXISTS `famille_article` (
  `idfamille` int(11) NOT NULL AUTO_INCREMENT,
  `designation_famille` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idfamille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. notif
CREATE TABLE IF NOT EXISTS `notif` (
  `idnotif` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1: Ajout | 2: Modification | 3: Suppression',
  `notification` varchar(255) DEFAULT NULL,
  `date_notification` varchar(255) DEFAULT NULL,
  `vu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idnotif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. reglement_facture
CREATE TABLE IF NOT EXISTS `reglement_facture` (
  `idreglementfacture` int(11) NOT NULL AUTO_INCREMENT,
  `num_facture` varchar(255) DEFAULT NULL,
  `num_reglement` varchar(255) DEFAULT NULL,
  `montant` varchar(255) DEFAULT NULL,
  `num_chq` varchar(255) DEFAULT NULL,
  `banque_chq` varchar(255) DEFAULT NULL,
  `porteur_chq` varchar(255) DEFAULT NULL,
  `date_reglement` varchar(255) DEFAULT NULL,
  `type_reglement` int(11) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL,
  PRIMARY KEY (`idreglementfacture`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. users
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(13) NOT NULL AUTO_INCREMENT,
  `groupe` int(13) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `connect` int(1) NOT NULL COMMENT '0: offline | 1: away | 2: online',
  `last_connect` varchar(255) NOT NULL,
  `poste_user` varchar(255) DEFAULT NULL,
  `date_naissance` varchar(255) NOT NULL,
  `num_tel_poste` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `totp` int(11) DEFAULT '0',
  `totp_token` varchar(255) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.


-- Export de la structure de table gc. user_average
CREATE TABLE IF NOT EXISTS `user_average` (
  `idaverage` int(13) NOT NULL AUTO_INCREMENT,
  `iduser` int(13) NOT NULL,
  `nouritture` int(3) NOT NULL,
  `boisson` int(3) NOT NULL,
  `sommeil` int(3) NOT NULL,
  `designing` int(3) NOT NULL,
  `codeur` int(3) NOT NULL,
  `velo` int(3) NOT NULL,
  `course` int(3) NOT NULL,
  PRIMARY KEY (`idaverage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L'exportation de données n'était pas sélectionnée.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
