-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : hugoscqbidgames.mysql.db
-- Généré le : mer. 08 déc. 2021 à 21:23
-- Version du serveur : 5.6.50-log
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hugoscqbidgames`
--
CREATE DATABASE IF NOT EXISTS `hugoscqbidgames` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hugoscqbidgames`;

-- --------------------------------------------------------

--
-- Structure de la table `Add_favorites`
--

CREATE TABLE `Add_favorites` (
  `user_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `addAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Add_favorites`
--

INSERT INTO `Add_favorites` (`user_id`, `object_id`, `addAt`) VALUES
(1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Be_warned`
--

CREATE TABLE `Be_warned` (
  `user_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Be_warned`
--

INSERT INTO `Be_warned` (`user_id`, `sale_id`, `createdAt`) VALUES
(1, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Bid`
--

CREATE TABLE `Bid` (
  `bid_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `bid_price` decimal(15,2) DEFAULT NULL,
  `bidAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Bid`
--

INSERT INTO `Bid` (`bid_id`, `user_id`, `object_id`, `bid_price`, `bidAt`) VALUES
(11, 1, 4, '30.00', '2021-12-08 16:43:42');

-- --------------------------------------------------------

--
-- Structure de la table `Buy_order`
--

CREATE TABLE `Buy_order` (
  `user_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `buy_order_price` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Buy_order`
--

INSERT INTO `Buy_order` (`user_id`, `object_id`, `buy_order_price`) VALUES
(1, 1, '1000.00'),
(1, 2, '1000.00');

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

CREATE TABLE `Categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Categories`
--

INSERT INTO `Categories` (`category_id`, `name`) VALUES
(1, 'Cartes'),
(2, 'Jeux de stratégies'),
(3, 'Jeux d\'exterieur'),
(4, 'Jeux classique'),
(5, 'Vieux jeux'),
(6, 'Jeux familiale');

-- --------------------------------------------------------

--
-- Structure de la table `Flash_sale`
--

CREATE TABLE `Flash_sale` (
  `user_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `flash_price` decimal(15,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Flash_sale`
--

INSERT INTO `Flash_sale` (`user_id`, `object_id`, `flash_price`, `status`) VALUES
(1, 1, '150.02', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Groups`
--

CREATE TABLE `Groups` (
  `object_id` int(11) NOT NULL,
  `object_id_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Houses`
--

CREATE TABLE `Houses` (
  `house_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `adress` text,
  `address_details` text,
  `cp` varchar(10) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `tel` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `web_site` varchar(100) NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Houses`
--

INSERT INTO `Houses` (`house_id`, `name`, `adress`, `address_details`, `cp`, `city`, `tel`, `fax`, `mail`, `web_site`, `createdAt`) VALUES
(1, 'Bubb Kuyper Auctioneers of Books', 'Kenaupark 30', '', '2011MT', ' Pays-Bas', '+31 576 428', '+31 0996 254', 'bubb@kuyper-contact.com', 'www.kuyoerforever.com', '2021-12-01 20:37:52'),
(2, 'Richelieu Drouot', '9 rue Drouot', NULL, '75009', 'Paris', '09 87 12 35 46', '02 34 34 58 37', 'drouotpereetfils@pro.com', 'www.richeulieudrouhot.com', '2021-12-02 09:06:25'),
(3, 'Hôtel de Marseille', '117 rue du pastis', NULL, '13000', 'Marseille', '06 35 16 48 27', '05 13 46 85 29', 'marseille@lhotel.com', 'www.marseille-hotel.fr', '2021-12-02 09:06:25'),
(4, 'dump', 'dump', NULL, '26333', 'dump', '', '', '', '', '2021-12-02 09:39:29'),
(5, 'Marechal', '17 rue du Popaul', NULL, '13000', 'Marseille', '04 36 58 29 73', '+25 46 82 69 17 32', 'marechal.marepropre@pro.com', 'www.marechalpopaul.com', '2021-12-02 09:06:25');

-- --------------------------------------------------------

--
-- Structure de la table `Images`
--

CREATE TABLE `Images` (
  `image_id` int(11) NOT NULL,
  `path` text,
  `sale_id` int(11) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Images`
--

INSERT INTO `Images` (`image_id`, `path`, `sale_id`, `object_id`) VALUES
(12, 'paypalLogo.svg', NULL, NULL),
(26, 'salersImage.jpg', 4, NULL),
(27, 'cardProduct.jpg', NULL, 1),
(28, 'productCard4.jpg', NULL, 2),
(29, 'productCard3.jpg', NULL, 4),
(30, 'productCard2.jpg', NULL, 3),
(58, 'paypal.png', NULL, NULL),
(77, 'UPSLogo.svg', NULL, 4),
(121, 'fnac.jpg', 9, NULL),
(122, 'inkingshop.jpg', 10, NULL),
(123, 'mixtape.jpg', 11, NULL),
(124, 'asmodee.png', 12, NULL),
(125, 'joueclub.jpg', 5, NULL),
(126, 'collection.jpg', 6, NULL),
(127, 'forrain.jpg', 7, NULL),
(128, 'descartes.jpg', 8, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Objects`
--

CREATE TABLE `Objects` (
  `object_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lower_price` decimal(15,2) DEFAULT NULL,
  `description` text,
  `bid_start` datetime DEFAULT NULL,
  `bid_end` datetime DEFAULT NULL,
  `buy_year` date DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `createdAt` datetime DEFAULT NULL,
  `house_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Objects`
--

INSERT INTO `Objects` (`object_id`, `name`, `lower_price`, `description`, `bid_start`, `bid_end`, `buy_year`, `type`, `createdAt`, `house_id`, `sale_id`, `category_id`, `user_id`) VALUES
(1, 'Jeux de cartes Bicycle 54 cartes', '30.00', 'Les cartes à jouer Bicycle Distilled Top Shelf sont un éloge à l\'âge d\'or de la fabrication de liqueurs. Ce deck a été conçu par The Well Suited Custom Playing Card Company et fabriqué par Bicycle, garantissant une qualité incomparable.', '2021-11-24 21:07:07', NULL, '2021-09-06', 5, '2021-12-01 21:07:07', 2, 4, 1, 1),
(2, 'Bicycle® hypnosis 2 bleu et rose', '70.00', 'Hypnosis from Bicycle Playing Cards is traditional playing card deck with standard faces, but the playing card back is specifically designed with the cardist in mind. With a borderless back design and  hypnotizing, colorful, seamless graphics, the Hypnosis deck from Bicycle Playing Cards is sure to enhance the flow of flourishes, fans, spreads, and more.  ', '2021-12-02 21:07:07', NULL, NULL, 1, '2021-12-01 21:07:07', 2, 4, 1, 1),
(3, 'Bicycle® stargazer bundle', '80.00', 'If you could look past our upper atmosphere, the expanse of space that arches over the earth and opens up to the stars is something to behold of magnificent beauty - Bicycle has created a bundle of playing cards depicting some of its most beautiful features.', '2021-11-01 13:53:40', '2021-11-04 13:45:51', NULL, 1, '2021-12-01 21:07:07', 2, 4, 1, 1),
(4, 'USPC SIGNATURE EDITION BOX SET', '20.00', 'The USPC Signature Edition Playing Cards Box Set is an exclusive collection of your favorite USPC playing cards, all in the highly requested Thin-Crushed Cardstock for that premium card-handling experience. These cards feel broken-in right out of the pack and are beloved by Magicians and Cardists for their handling, ease of use, and ability to showcase certain moves. Only 1,750 of these box sets will be sold, and each set includes a unique, serialized label to ensure authenticity and collectability. The focal point of the set is the coveted Red Bicycle Celebration 2020 deck that sits in the middle of the set. ', '2021-12-08 11:07:07', '2021-12-09 13:44:53', '2013-12-19', 1, '2021-12-01 21:07:07', 2, 4, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Orders`
--

CREATE TABLE `Orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_price` decimal(15,2) DEFAULT NULL,
  `object_price` decimal(15,2) DEFAULT NULL,
  `sale_tax` decimal(15,2) DEFAULT NULL,
  `delivery_fees` decimal(15,2) DEFAULT NULL,
  `type_recovering` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `transport_society_id` int(11) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Payment_history`
--

CREATE TABLE `Payment_history` (
  `order_id` int(11) NOT NULL,
  `transaction_number` int(11) DEFAULT NULL,
  `payment_way_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Payment_ways`
--

CREATE TABLE `Payment_ways` (
  `payment_way_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Payment_ways`
--

INSERT INTO `Payment_ways` (`payment_way_id`, `name`, `image_id`) VALUES
(1, 'Paypal', 12),
(2, 'UPS', 77);

-- --------------------------------------------------------

--
-- Structure de la table `Sales`
--

CREATE TABLE `Sales` (
  `sale_id` int(11) NOT NULL,
  `sale_date` datetime DEFAULT NULL,
  `sale_start` datetime NOT NULL,
  `sale_end` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `createdAt` datetime DEFAULT NULL,
  `house_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Sales`
--

INSERT INTO `Sales` (`sale_id`, `sale_date`, `sale_start`, `sale_end`, `name`, `type`, `createdAt`, `house_id`, `user_id`) VALUES
(4, '2021-12-01 20:38:07', '2021-12-08 14:38:52', NULL, 'Vente caritative “Le des à 3 faces”', 0, '2021-12-01 20:38:07', 1, 1),
(5, '2021-09-07 20:38:07', '2021-12-17 14:38:59', NULL, 'Magasin jouet club 1990', 1, '2021-12-01 20:38:07', 1, 1),
(6, '2021-12-31 20:38:07', '2021-10-12 14:39:03', NULL, 'Henry filthie collectionneur', 1, '2021-12-01 20:38:07', 1, 1),
(7, '2021-12-01 20:38:07', '2022-02-09 14:39:08', NULL, 'Musée des arts forains', 0, '2021-12-01 20:38:07', 1, 1),
(8, '2021-12-24 20:38:07', '2021-07-05 14:39:12', NULL, 'Descartes ludothèque', 0, '2021-12-01 20:38:07', 3, 1),
(9, '2021-11-10 20:38:07', '2022-03-23 14:39:17', NULL, 'Fnac meriadec destock', 1, '2021-12-01 20:38:07', 1, 1),
(10, '2021-12-01 20:38:07', '2021-12-07 14:39:22', NULL, 'Inking stuff', 0, '2021-12-01 20:38:07', 2, 1),
(11, '2021-12-01 20:38:07', '2021-12-08 14:39:25', NULL, 'Mixtape shop', 1, '2021-12-01 20:38:07', 1, 1),
(12, '2021-12-01 20:38:07', '2021-12-17 14:39:32', NULL, 'Asmodee', 1, '2021-12-01 20:38:07', 1, 1),
(13, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Maxime\'s ', 0, '2021-12-01 20:38:07', 1, 1),
(14, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Antonin\'s & Co', 0, '2021-12-01 20:38:07', 1, 1),
(15, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Matisception', 0, '2021-12-01 20:38:07', 1, 1),
(16, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Hugothèque', 0, '2021-12-01 20:38:07', 1, 1),
(17, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Henry society', 0, '2021-12-01 20:38:07', 2, 1),
(18, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'NoinspirationCo', 0, '2021-12-01 20:38:07', 3, 1),
(19, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Harry and Louis', 0, '2021-12-01 20:38:07', 2, 1),
(20, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Michel Savate', 0, '2021-12-01 20:38:07', 1, 1),
(21, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Asbroo', 0, '2021-12-01 20:38:07', 3, 1),
(22, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Epsiripp', 0, '2021-12-01 20:38:07', 1, 1),
(23, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'bidgame stock', 0, '2021-12-01 20:38:07', 1, 1),
(24, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Les prisonniers de la cave', 0, '2021-12-01 20:38:07', 2, 1),
(25, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'La canebière', 0, '2021-12-01 20:38:07', 3, 1),
(26, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Dioudothèque', 0, '2021-12-01 20:38:07', 1, 1),
(27, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Immatell\'s game', 0, '2021-12-01 20:38:07', 1, 1),
(28, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Veillée ludique', 0, '2021-12-01 20:38:07', 1, 1),
(29, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Le loup garou', 0, '2021-12-01 20:38:07', 2, 1),
(30, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Pretty little games', 0, '2021-12-01 20:38:07', 1, 1),
(31, '2021-12-01 20:38:07', '0000-00-00 00:00:00', NULL, 'Breaking game', 0, '2021-12-01 20:38:07', 1, 1),
(61, '2021-12-04 09:10:17', '0000-00-00 00:00:00', NULL, 'Vente caritative “Le des à 3 faces”', 0, '2021-12-02 09:10:17', 2, 1),
(62, '2021-10-06 09:10:17', '0000-00-00 00:00:00', NULL, 'Magasin jouet club 1990', 0, '2021-12-02 09:10:17', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Transport_societies`
--

CREATE TABLE `Transport_societies` (
  `transport_society_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `max_delay` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Transport_societies`
--

INSERT INTO `Transport_societies` (`transport_society_id`, `name`, `price`, `max_delay`) VALUES
(1, 'UPS', '4.00', '2021-12-08 09:40:40'),
(2, 'DPD', '12.00', '2021-12-23 09:40:40');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text,
  `address_details` text,
  `cp` varchar(10) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`user_id`, `lastname`, `firstname`, `birthdate`, `email`, `password`, `address`, `address_details`, `cp`, `city`, `role`, `createdAt`) VALUES
(1, 'GALVINE', 'Matisse', '2021-12-16', 'majf@gmail.Com', 'gezgzevsdgz', 'gezg', 'zegz', 'ze', 'ze', 1, '2021-12-01 20:38:45');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Add_favorites`
--
ALTER TABLE `Add_favorites`
  ADD PRIMARY KEY (`user_id`,`object_id`),
  ADD KEY `object_id` (`object_id`);

--
-- Index pour la table `Be_warned`
--
ALTER TABLE `Be_warned`
  ADD PRIMARY KEY (`user_id`,`sale_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Index pour la table `Bid`
--
ALTER TABLE `Bid`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `object_id` (`object_id`);

--
-- Index pour la table `Buy_order`
--
ALTER TABLE `Buy_order`
  ADD PRIMARY KEY (`user_id`,`object_id`),
  ADD KEY `object_id` (`object_id`);

--
-- Index pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `Flash_sale`
--
ALTER TABLE `Flash_sale`
  ADD PRIMARY KEY (`user_id`,`object_id`),
  ADD KEY `object_id` (`object_id`);

--
-- Index pour la table `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`object_id`,`object_id_1`),
  ADD KEY `object_id_1` (`object_id_1`);

--
-- Index pour la table `Houses`
--
ALTER TABLE `Houses`
  ADD PRIMARY KEY (`house_id`);

--
-- Index pour la table `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `object_id` (`object_id`);

--
-- Index pour la table `Objects`
--
ALTER TABLE `Objects`
  ADD PRIMARY KEY (`object_id`),
  ADD KEY `house_id` (`house_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transport_society_id` (`transport_society_id`),
  ADD KEY `object_id` (`object_id`);

--
-- Index pour la table `Payment_history`
--
ALTER TABLE `Payment_history`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `payment_way_id` (`payment_way_id`);

--
-- Index pour la table `Payment_ways`
--
ALTER TABLE `Payment_ways`
  ADD PRIMARY KEY (`payment_way_id`),
  ADD KEY `FK_PAW_IMA` (`image_id`);

--
-- Index pour la table `Sales`
--
ALTER TABLE `Sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `house_id` (`house_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `Transport_societies`
--
ALTER TABLE `Transport_societies`
  ADD PRIMARY KEY (`transport_society_id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Bid`
--
ALTER TABLE `Bid`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Houses`
--
ALTER TABLE `Houses`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Images`
--
ALTER TABLE `Images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT pour la table `Objects`
--
ALTER TABLE `Objects`
  MODIFY `object_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Payment_ways`
--
ALTER TABLE `Payment_ways`
  MODIFY `payment_way_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Sales`
--
ALTER TABLE `Sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `Transport_societies`
--
ALTER TABLE `Transport_societies`
  MODIFY `transport_society_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Add_favorites`
--
ALTER TABLE `Add_favorites`
  ADD CONSTRAINT `Add_favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Add_favorites_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`);

--
-- Contraintes pour la table `Be_warned`
--
ALTER TABLE `Be_warned`
  ADD CONSTRAINT `Be_warned_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Be_warned_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `Sales` (`sale_id`);

--
-- Contraintes pour la table `Bid`
--
ALTER TABLE `Bid`
  ADD CONSTRAINT `Bid_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Bid_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`);

--
-- Contraintes pour la table `Buy_order`
--
ALTER TABLE `Buy_order`
  ADD CONSTRAINT `Buy_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Buy_order_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`);

--
-- Contraintes pour la table `Flash_sale`
--
ALTER TABLE `Flash_sale`
  ADD CONSTRAINT `Flash_sale_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Flash_sale_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`);

--
-- Contraintes pour la table `Groups`
--
ALTER TABLE `Groups`
  ADD CONSTRAINT `Groups_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`),
  ADD CONSTRAINT `Groups_ibfk_2` FOREIGN KEY (`object_id_1`) REFERENCES `Objects` (`object_id`);

--
-- Contraintes pour la table `Images`
--
ALTER TABLE `Images`
  ADD CONSTRAINT `Images_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `Sales` (`sale_id`),
  ADD CONSTRAINT `Images_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`);

--
-- Contraintes pour la table `Objects`
--
ALTER TABLE `Objects`
  ADD CONSTRAINT `Objects_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `Houses` (`house_id`),
  ADD CONSTRAINT `Objects_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `Sales` (`sale_id`),
  ADD CONSTRAINT `Objects_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `Categories` (`category_id`),
  ADD CONSTRAINT `Objects_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Contraintes pour la table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`transport_society_id`) REFERENCES `Transport_societies` (`transport_society_id`),
  ADD CONSTRAINT `Orders_ibfk_3` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`);

--
-- Contraintes pour la table `Payment_history`
--
ALTER TABLE `Payment_history`
  ADD CONSTRAINT `Payment_history_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`),
  ADD CONSTRAINT `Payment_history_ibfk_2` FOREIGN KEY (`payment_way_id`) REFERENCES `Payment_ways` (`payment_way_id`);

--
-- Contraintes pour la table `Payment_ways`
--
ALTER TABLE `Payment_ways`
  ADD CONSTRAINT `FK_PAW_IMA` FOREIGN KEY (`image_id`) REFERENCES `Images` (`image_id`);

--
-- Contraintes pour la table `Sales`
--
ALTER TABLE `Sales`
  ADD CONSTRAINT `Sales_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `Houses` (`house_id`),
  ADD CONSTRAINT `Sales_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
