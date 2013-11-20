-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 01 Novembre 2013 à 17:47
-- Version du serveur: 5.5.34-0ubuntu0.13.04.1
-- Version de PHP: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `nature` int(11) DEFAULT NULL,
  `content` text,
  `isVisible` tinyint(1) DEFAULT NULL,
  `point` int(11) DEFAULT '0',
  `datePublication` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `title`, `nature`, `content`, `isVisible`, `point`, `datePublication`, `category_id`, `date_created`) VALUES
(25, 'Sécurité routière : Souriez ! Vous êtes flashés - le retour', NULL, '									<p style="text-align: justify;"></p><p>Vous connaissiez les radars fixes, les radars de feu rouge, les radars embarqués, les radars de tronçon et plus récemment les nouveaux radars mobiles dits RMNG. A partir de lundi de nouveaux joujoux seront aux mains de force de l’ordre et il sera difficile de leur échapper.</p><p style="text-align: justify;"><span style="color: #ff6600;"><strong>Flashés même en croisant le véhicule à partir de lundi</strong></span></p><p style="text-align: justify;">Jusqu’à présent, il y avait 46 Renault Mégane banalisées qui embarquaient la dernière technologie en matière de radar. Invisibles et capables de «&nbsp;flasher&nbsp;» (pas de flash en fait NDLA) en roulant les véhicules qui dépassaient la voiture et la limitation de vitesse, ces petites bêtes ne prenaient jusqu’alors pas les véhicules venant de face. A partir de lundi, 20 nouveaux véhicules (13 Mégane et 7 Peugeot 208) circuleront avec la version «&nbsp;améliorée&nbsp;» du dispositif, capable de flasher les véhicules doublant la 208 mais aussi ceux la croisant et roulant au-delà des limitations.</p><p style="text-align: justify;">Autant dire que si l’on pouvait détecter au dernier moment un véhicule avec un radar avant de le doubler, il sera impossible de voir ces véhicules avant de les croiser et donc de se faire prendre par la patrouille en cas d’excès de vitesse. Les 46 autres véhicules seront mis à jour pour être eux aussi opérationnels tant en dépassement qu’en croisement ainsi que stationnés sur le bord de la route.</p><p style="text-align: justify;"><span style="color: #ff6600;"><strong>36 PVs par jour</strong></span></p><p style="text-align: justify;">Si les RMNG (radars mobiles de nouvelle génération) ne sont pour le moment que 66, ils seront une centaine d’ici la fin de l’année et 300 d’ici la fin 2015. A 70 000 euros le véhicule, autant dire qu’ils vont être très vite rentabilisés. En effet, selon les chiffres de la Sécurité Routière, plus de 50 000 contraventions ont été dressées en 6 mois d’utilisation des premiers RMNG. 36 infractions par jour. A 45 euros par infraction (au minimum) il ne faut que 43 jours de flash pour amortir le véhicule (et un peu plus en comptant le carburant et le salaire des officiers).</p><table style="width: 630px;"><tbody><tr><td style="width: 250px; text-align: justify; color: white; background: #3F647F; padding: 10px; font-weight: bold; font-size: 14px;">La tolérance de ces radars est plus élevées que pour les radars fixe :&nbsp;10 km/h en deçà de 100 km/h et de 10% au-delà, contre 5% et 5km/h pour les radars fixes.</td><td style="width: 380px; text-align: justify; vertical-align: top; padding-left: 20px;">Bref du coté de l’Etat on remercie (sans le dire) tous les contrevenants qui vont cette année contribuer à hauteur de 800 millions d’euros aux recettes de l’Etat.</td></tr></tbody></table><p style="text-align: justify;">Lire également : Sécurité Routière, -9,6% en septembre, la baisse continue</p><p style="text-align: justify;">Source : Sécurité Routière via OuestFrance, photo :&nbsp;Préfecture de la Somme</p><span id="id_a" class="3377112"></span>\r\n', NULL, 2, '2013-11-05 00:00:00', 2, NULL),
(27, 'L''Ukraine adversaire de la France en barrages du Mondial 2014 : l''équipe qui était déjà éliminée', NULL, 'Ce sera donc l’Ukraine… Il n’y avait pas besoin de faire preuve d’autant de mesquinerie en pleurnichant sur le classement FIFA : la France retrouvera l’adversaire que la plupart des commentateurs lui souhaitaient. Une sélection battue chez elle à l’Euro 2012 (0-2) et sur laquelle Marvin Martin avait dansé un an plus tôt (1-4). Vue comme ça, elle ne peut pas être bien dangereuse sur la route du Brésil.\r\n\r\nSauf qu’en football, 2012, c’est déjà très loin, pour les Bleus comme pour l’Ukraine. Après l’Euro, les Ukrainiens ont connu quelques turbulences et un début de qualifications compliqué. Après un nul en Angleterre (1-1), Oleg Blokhine a rejoint le banc du Dynamo Kiev, qu’il pourrait bientôt devoir quitter. L’intérim d’Andriy Bal s’est avéré catastrophique avec un nul en Moldavie (0-0) et une défaite à domicile contre le Monténégro (0-1).\r\n\r\nLa fédération a alors demandé au vieux Mykhaylo Fomenko de présider un comité chargé de trouver un nouveau sélectionneur. Sauf que ni Reknapp, happé par QPR, ni Shevchenko, qui ne se sentait pas prêt, n’ont répondu de façon affirmative. Quant à Eriksson, il était trop cher. On a donc fini par demander à Fomenko, qui n’avait plus entraîné depuis plusieurs saisons et dont la carrière d’entraîneur n’a jamais été à la hauteur du solide défenseur qu’il fut dans le Dynamo Kiev de Lobanovskiy, de prendre la sélection, en considérant que comme l’Ukraine était larguée dans son groupe. Il assurerait l’intérim avant peut-être de relancer Sheva en 2014. Sauf que Fomenko a fait de l’excellent boulot, à commencer par le match charnière en Pologne, remporté 1-3. Ont suivi quatre autres victoires, dont deux amusements contre Saint Marin (9-0 et 8-0) et un nul contre l’Angleterre à nouveau (0-0).', NULL, 3, '2013-10-26 00:00:00', 1, NULL),
(28, 'Le groupe pharmaceutique GSK va supprimer 271 postes en France', NULL, 'GlaxoSmithKline (GSK) prévoit de supprimer 271 postes dans sa filiale française. Ce sont les syndicats du laboratoire pharmaceutique britannique qui ont annoncé la nouvelle, lundi 21 octobre.\n\nCe plan, annoncé aux représentants des salariés à l''occasion d''un comité central d''entreprise extraordinaire, ne concernera que 181 personnes puisque 90 emplois sont vacants. La direction a également annoncé la création de 49 postes.\n\n"Il y aura un plan de licenciements économiques"\n"Très clairement, il y aura un plan de licenciements économiques", a estimé le délégué syndical central de la CFE-CGC, Guislain Lebrun. Les suppressions de postes concernent 89 personnes au siège social à Marly-le-Roi (Yvelines), 78 salariés de la force de vente, 11 à Evreux et trois à Mayenne.\n\n"Sous motif de sauvegarde de compétitivité, l''entreprise a présenté un projet de réorganisation basé, entre autre, sur une prévision de perte de chiffre d''affaires d''ici 2016", selon un communiqué de la CFE-CGC. Le plan doit être négocié avec les organisations syndicales conformément à la loi sur la sécurisation de l''emploi. L''effectif global de GSK en France s''élève à 2 900 salariés.', NULL, 3, '2013-10-22 00:00:00', 4, NULL),
(47, 'Gérard de Villiers, "honorable correspondant" des services secrets français', 2, 'Mort le 31 octobre à 83 ans, Gérard de Villiers n''a jamais fait mystère de ses sources excellentes au sein des services secrets. Français, mais pas seulement... Les personnages imaginaires et folkloriques parsemant ses romans de gare se meuvent toujours dans un univers décrit avec soin, situé dans un contexte géopolitique cohérent et conforme pour l''essentiel à la réalité du moment. Gérard de Villiers, trésor national à sa façon, recevait le meilleur accueil des ambassadeurs de France dans les pays les plus brûlants et a entretenu dès la fin des années 1960 des relations étroites avec le SDECE (Service de documentation extérieure et de contre-espionnage), ancienne appellation de la DGSE. Alors jeune officier de renseignements affecté au service Action, le général Philippe Rondot a bien voulu se souvenir d''une relation avec l''écrivain qui s''est poursuivie jusqu''à sa mort.', 0, 21, '2013-11-20 09:25:00', 3, NULL),
(48, 'Près de Nancy : le Dr Muller acquitté du meurtre de sa femme', 2, 'La cour d''assises de Meurthe-et-Moselle a acquitté jeudi le docteur Jean-Louis Muller de l''accusation de meurtre de sa femme en 1999. Il comparaissait pour la troisième fois dans cette affaire, après avoir été condamné à deux reprises à 20 ans de prison.', 1, 9, '2014-12-10 00:00:00', 4, NULL),
(49, 'Ici le titre de mon article de test', 1, 'Contnu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:08:35'),
(50, 'Ici le titre de mon article de test', 1, 'Contenu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:11:43'),
(51, 'Ici le titre de mon article de test', 1, 'Contenu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:12:47'),
(52, 'Ici le titre de mon article de test', 1, 'Contenu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:14:54'),
(53, 'Ici le titre de mon article de test', 1, 'Contenu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:17:10'),
(54, 'Ici le titre de mon article de test', 1, 'Contenu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:19:54'),
(55, 'Ici le titre de mon article de test', 1, 'Contenu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:22:36'),
(56, 'Ici le titre de mon article de test', 1, 'Contenu de mon article test', 1, 8, '2015-05-07 00:00:00', 1, '2013-11-01 17:23:08');

-- --------------------------------------------------------

--
-- Structure de la table `article_tags`
--

CREATE TABLE IF NOT EXISTS `article_tags` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  KEY `article_id` (`article_id`,`tag_id`),
  KEY `article_id_2` (`article_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article_tags`
--

INSERT INTO `article_tags` (`article_id`, `tag_id`) VALUES
(25, 6),
(25, 14),
(27, 8),
(28, 9),
(28, 11),
(47, 5),
(47, 8),
(47, 9),
(47, 11),
(48, 5),
(48, 8),
(48, 11),
(48, 16),
(49, 10),
(50, 10),
(51, 10),
(52, 10),
(53, 10),
(54, 10),
(55, 10),
(56, 10);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Actua BD', 'Actua BD et Series TV'),
(2, 'Insolite', 'Insolite'),
(3, 'A la une', 'A la une'),
(4, 'Sports extremes', 'Actualités Sportives extremes'),
(9, 'New Caté !', 'Contenu de ma category test');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(120) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `comment` text,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `article_id_2` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `word`) VALUES
(1, 'footballeur'),
(2, 'Une fillette'),
(3, 'sex-appeal'),
(4, 'NRJ Music Awards'),
(5, 'Lilian Thuram'),
(6, 'Pékin Express'),
(7, 'Duke Nukem '),
(8, 'RMNG'),
(9, '800 millions d’euros'),
(10, 'migrants africains'),
(11, 'les Bleus'),
(12, 'Dynamo Kiev'),
(13, 'GlaxoSmithKline'),
(14, 'suppressions de postes'),
(15, 'MSC Croisières'),
(16, 'objet ultra-lumineux');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `article_tags`
--
ALTER TABLE `article_tags`
  ADD CONSTRAINT `article_tags_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
