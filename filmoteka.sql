-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 10:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmoteka`
--

-- --------------------------------------------------------

--
-- Table structure for table `filmovi`
--

CREATE TABLE `filmovi` (
  `id` int(11) NOT NULL,
  `zanr_id` int(3) NOT NULL,
  `naziv` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datum` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `poster` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sadrzaj` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `glumci` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `zemlja` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `studio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tagovi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prosecna_ocena` float DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `broj_pregleda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filmovi`
--

INSERT INTO `filmovi` (`id`, `zanr_id`, `naziv`, `autor`, `datum`, `poster`, `sadrzaj`, `glumci`, `zemlja`, `studio`, `tagovi`, `prosecna_ocena`, `status`, `broj_pregleda`) VALUES
(1, 2, 'Kad porastem bicu Kengur', 'Radivoje Andric', '25.03.2004', 'bicu-kengur.jpg', '<p>Tokom jedne osebujne noći, životi nekoliko međusobno povezanih ljudi se menjaju, jer oni brzo doživljavaju ljubav, razočaranje, radost, pohlepu i kajanje.</p>', 'Sergej Trifunović, Marija Karan, Nebojša Glogovac, Boris Milojević, Gordan Kičić, Nikola Vujović', 'Srbija i Crna Gora', '44.7708408 , 20.4919493', 'kad porastem bicu kengur, radivoje andric', 4.5, 'objavljen', 51),
(2, 5, 'Sivi kamion crvene boje', 'Srdjan Koljevic', '16.03.2005', 'sivi-kamion.jpg', '<p>Ovaj film je uglavnom ljubavna priča, a scenografija je prvi dan građanskog rata u bivšoj Jugoslaviji (jun 1991). Glavni lik je Ratko, bivši prevarant, iz jednog bosanskog mjesta \"nikad ne idi tamo\". Njegova najvažnija karakteristika je da je zaslepljen u boji, što mu daje, na simboličan način, mogućnost da stvari vidi drugačije od „većine oko sebe“ (to je ujedno i objašnjenje naslova filma).</p>', 'Srdjan Žika Todorović, Aleksandra Balmazović, Dragan Bjelogrlić, Bogdan Diklić, Boris Milojević, Milutin Mima Karadžić, Milorad Manda Mandić', 'Slovenija', '42.6504959 , 18.0912973', 'sivi kamion crvene boje, srdjan koljevic', 4, 'objavljen', 52),
(3, 4, 'Lajanje na zvezde', 'Zdravko Šotra', '01.06.1998', 'lajanje-na-zvezde.jpg', '<p>Komedija o učiteljima i učenicima u srednjoj školi u malom provincijskom gradu. Mihailo pokušava da osvoji srce devojke koju njegov brat takođe juri.</p>', 'Dragan Mićanović, Nataša Tapušković, Nikola Simić, Velimir Bata Živojinović, Bogdan Diklić, Nikola Djuričko', 'Jugoslavija', '45.2017742 , 19.9312942', 'lajanje na zvezde, zdravko sotra', 5, 'objavljen', 20),
(4, 1, 'Šišanje', 'Stevan Filipović', '06.10.2010', 'sisanje.jpg', '<p>Život je ponekad bezobrazna igra: jedna greška može vam kupiti kartu u pakao.</p>', 'Nikola Rakočevic, Viktor Savić, Bojana Novaković, Nikola Kojo, Dragan Mićanović', 'Srbija', '44.7752992 , 20.4666281', 'sisanje, stevan filipovic', 4.25, 'objavljen', 53),
(5, 4, 'Titanik', 'James Cameron', '19.12.1997', 'titanik.jpg', '<p>Sedamnaestogodišnja aristokratka se zaljubila u dobrog, ali siromašnog umetnika na luksuznom, zlobnom R.M.S. Titanic.</p>', 'Leonardo DiCaprio, Kate Winslet, Billy Zane, Kathy Bates, Frances Fisher, Gloria Stuart', 'Sjedinjene Američke Države', '54.5953851 , -5.9530356', 'titanik, leonardo dicaprio, kate winslet', 2.5, 'objavljen', 10),
(6, 3, 'The Shining', 'Stanley Kubrick', '13.06.1980', 'shining.jpg', '<p>Porodica se zimi upućuje u izolovani hotel gde zlobna prisutnost utiče na oca nasilje, dok njegov psihički sin vidi užasne predispozicije i prošlosti i budućnosti.</p>', ' Jack Nicholson, Shelley Duvall, Danny Lloyd', 'Sjedinjene Američke Države', '45.331111 , -121.71', 'the shining, stanley kubrick', 1, 'objavljen', 9),
(7, 1, 'Deadpool', 'Tim Miller', '12.02.2016', 'deadpool.jpg', '<p>Plaćenik koji se bavi mudrim udaranjem eksperimentiše i postaje besmrtan, ali ružan i kreće u potragu za čovekom koji mu je upropastio izgled.</p>', 'Ryan Reynolds, Morena Baccarin, T.J. Miller', 'Sjedinjene Američke Države', '49.2771839 , -123.1072224', 'deadpool, dedpul, miller', 4, 'objavljen', 29),
(8, 2, 'Čudovišta', 'Pete Docter, David Silverman', '02.11.2001', 'cudovista.jpg', '<p>Da bi napali grad, čudovišta moraju uplašiti decu da bi vrištala. Međutim, deca su toksična za čudovišta i nakon što dete prođe, dva čudovišta shvate da stvari možda nisu ono što misle.</p>', ' Billy Crystal, John Goodman, Mary Gibbs', 'Sjedinjene Američke Države', '37.8328362 , -122.2861573', 'monsters inc, cudovista, pete docter', 5, 'objavljen', 7),
(9, 5, 'Inception', 'Christopher Nolan', '16.07.2010', 'inception.jpg', '<p>Lopovu koji krade korporativne tajne korišćenjem tehnologije deljenja snova dobija inverzni zadatak da zasadi ideju u um C.E.O.</p>', ' Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'Sjedinjene Američke Države', '48.8474711 , 2.3076826', 'inception, leonardo dicaprio, christopher nolan', 0, 'objavljen', 11),
(10, 1, 'Suicide Squad', 'David Ayer', '05.08.2016', 'suicide-squad.jpg', '<p>Tajna vladina agencija regrutuje neke od najopasnijih zatvorenih super-negativaca radi formiranja odbrambene radne grupe. Njihova prva misija: spasiti svet od apokalipse.</p>', 'Will Smith, Jared Leto, Margot Robbie', 'Sjedinjene Američke Države', '43.659853 , -79.3839292', 'suicide squad, david ayer, margot robbie, will smith', 5, 'objavljen', 15),
(11, 3, 'It', 'Andy Muschietti', '08.09.2017', 'it.jpg', '<p>U leto 1989. godine grupa maltretiranih klinaca udružila se kako bi uništila čudovište koje se menjalo u obliku, a koje se prerušava u klauna i pleni decu iz Derrija, svog malog grada Mainea.</p>', 'Bill Skarsgard, Jaeden Martell, Finn Wolfhard', 'Sjedinjene Američke Države', '43.8933828 , -78.9117391', 'it, andy muschietti', 0, 'objavljen', 12),
(15, 2, 'Test', 'Milos Ja', '03.12.2021', 'eed0f57b36988e02b064ed861f55084972a0e6f4.jpg', '<p>test neki</p>', 'Petra metla', 'Srbija brale', '43.583333, 21.326667', 'Lolika', NULL, 'objavljen', 47);

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `sadrzaj` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ocena` int(5) NOT NULL,
  `status` varchar(55) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unapproved',
  `datum` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `film_id`, `autor_id`, `sadrzaj`, `ocena`, `status`, `datum`) VALUES
(1, 1, 1, 'Dulee Savic!', 4, 'approved', '14.11.2021');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `uloga` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `randSalt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `password`, `ime`, `prezime`, `email`, `avatar`, `uloga`, `randSalt`) VALUES
(1, 'milos', '$2y$10$KGZ6ssf4HxB3VTLzRXhlzeJ9JdNEMh75NDn47eP2/mUBaiVL/R4Fy', 'Milos', 'Mladenovic', 'milosmladenovic037@gmail.com', 'mm.png', 'admin', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `zanrovi`
--

CREATE TABLE `zanrovi` (
  `id` int(3) NOT NULL,
  `naziv` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zanrovi`
--

INSERT INTO `zanrovi` (`id`, `naziv`) VALUES
(1, 'Akcioni'),
(2, 'Komedije'),
(3, 'Horor'),
(4, 'Romantični'),
(5, 'Avanture');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zanr_id` (`zanr_id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `autor_id` (`autor_id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zanrovi`
--
ALTER TABLE `zanrovi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filmovi`
--
ALTER TABLE `filmovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zanrovi`
--
ALTER TABLE `zanrovi`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD CONSTRAINT `filmovi_ibfk_1` FOREIGN KEY (`zanr_id`) REFERENCES `zanrovi` (`id`);

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `filmovi` (`id`),
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `korisnici` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
