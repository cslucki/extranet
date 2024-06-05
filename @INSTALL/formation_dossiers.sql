-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 juin 2024 à 14:20
-- Version du serveur : 8.3.0
-- Version de PHP : 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `extranet`
--

-- --------------------------------------------------------

--
-- Structure de la table `formation_dossiers`
--

DROP TABLE IF EXISTS `formation_dossiers`;
CREATE TABLE IF NOT EXISTS `formation_dossiers` (
  `id_formation_dossiers` int NOT NULL AUTO_INCREMENT,
  `id_formation_catalogue` int DEFAULT NULL,
  `id_menustatutformation` int DEFAULT NULL,
  `id_guid` varchar(32) DEFAULT NULL,
  `date_convocation` date DEFAULT NULL,
  `date_devis` date DEFAULT NULL,
  `date_devis_signe` date DEFAULT NULL,
  `date_pec` date DEFAULT NULL,
  `pec_numero` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `date_debut_formation` date DEFAULT NULL,
  `date_fin_formation` date DEFAULT NULL,
  `date_cheque_caution_recu` date DEFAULT NULL,
  `date_envoi_attestation` date DEFAULT NULL,
  `moyen_paiement` enum('CH','VIR') DEFAULT NULL,
  `date_fond_recu_par_stagiaire` date DEFAULT NULL,
  `date_solde_dossier` date DEFAULT NULL,
  `date_evaluation` date DEFAULT NULL,
  `date_envoi_evaluation` date DEFAULT NULL,
  `formation_collective` enum('Y','N') DEFAULT NULL,
  `nbre_seances_faites` int DEFAULT NULL,
  `p10_brief_formation` enum('Y','N') DEFAULT NULL,
  `p20_individualisation` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p30_ae_cree` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p40_attestation_cfp` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p50_demande_pec` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p60_pec_ok` enum('Y','N') DEFAULT NULL,
  `p70_certificat_fin` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `f10_dossier_termine` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `f20_abandon` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'N',
  `f20_abandon_raison` text,
  `f20_abandon_raison_date` date DEFAULT NULL,
  `f20_abandon_solution` text,
  `f20_abandon_solution_date` date DEFAULT NULL,
  `annee_comptabilisation` year DEFAULT NULL,
  `adresse_url_support` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `eval1` text,
  `eval2` text,
  `eval3` text,
  `eval_note` tinyint UNSIGNED DEFAULT NULL,
  `pre_eval1` tinyint UNSIGNED NOT NULL,
  `pre_eval2` tinyint UNSIGNED NOT NULL,
  `pre_eval3` tinyint UNSIGNED NOT NULL,
  `pre_eval4` tinyint UNSIGNED NOT NULL,
  `pre_eval5` tinyint UNSIGNED NOT NULL,
  `pre_eval_note` text,
  PRIMARY KEY (`id_formation_dossiers`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
