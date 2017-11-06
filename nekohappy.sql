-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2017 às 20:07
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nekohappy`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_amizades`
--

CREATE TABLE `neko_amizades` (
  `id` int(11) NOT NULL,
  `de` varchar(200) NOT NULL,
  `para` varchar(200) NOT NULL,
  `aceite` varchar(3) NOT NULL DEFAULT 'nao',
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_amizades`
--

INSERT INTO `neko_amizades` (`id`, `de`, `para`, `aceite`, `data`) VALUES
(3, '1', '66', 'nao', '2017-11-02'),
(4, '1', '61', 'nao', '2017-11-02'),
(5, '1', '59', 'nao', '2017-11-02'),
(6, '1', '60', 'nao', '2017-11-02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_anime`
--

CREATE TABLE `neko_anime` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `sinopse` text NOT NULL,
  `votacao` text NOT NULL,
  `foto` text NOT NULL,
  `background` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_anime`
--

INSERT INTO `neko_anime` (`id`, `nome`, `sinopse`, `votacao`, `foto`, `background`) VALUES
(1, 'One Punch Man', 'Nesta nova comédia de ação, tudo sobre o jovem chamado Saitama parece ser “NA MÉDIA”, desde sua expressão sem vida, sua cabeça careca e seu físico nada impressionante. No entanto, esse cara que parece normal não tem seu problema normal… Na verdade ele é um super-herói que está procurando oponentes poderosos! O problema é que toda vez que encontra um candidato promissor, ele acaba com sua raça em apenas um soco. Será que Saitama conseguirá finalmente encontrar um vilão forte o bastante para desafiá-lo? Siga Saitama em suas bagunças hilárias enquanto busca por malvados para desafiar!', '0', 'opm.jpg', 'background.jpg'),
(2, 'Boku dake ga Inai Machi', 'Nesta nova comédia de ação, tudo sobre o jovem chamado Saitama parece ser “NA MÉDIA”, desde sua expressão sem vida, sua cabeça careca e seu físico nada impressionante. No entanto, esse cara que parece normal não tem seu problema normal… Na verdade ele é um super-herói que está procurando oponentes poderosos! O problema é que toda vez que encontra um candidato promissor, ele acaba com sua raça em apenas um soco. Será que Saitama conseguirá finalmente encontrar um vilão forte o bastante para desafiá-lo? Siga Saitama em suas bagunças hilárias enquanto busca por malvados para desafiar!', '0', 'boku.jpg', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_back`
--

CREATE TABLE `neko_back` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_back`
--

INSERT INTO `neko_back` (`id`, `img`) VALUES
(1, 'back.jpg'),
(2, 'back2.png'),
(3, 'back3.png'),
(4, 'back4.jpg'),
(5, 'back5.jpg'),
(6, 'back6.jpg'),
(7, 'back7.png'),
(8, 'back8.jpg'),
(9, 'back9.jpg'),
(10, 'back10.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_comment`
--

CREATE TABLE `neko_comment` (
  `id` int(11) NOT NULL,
  `iduser` varchar(255) NOT NULL,
  `idpost` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_comment`
--

INSERT INTO `neko_comment` (`id`, `iduser`, `idpost`, `time`, `texto`) VALUES
(18, '68', '4', '2017-11-06 17:00:04', 'Olá pessoal'),
(19, '68', '4', '2017-11-06 17:00:07', 'teste'),
(20, '68', '4', '2017-11-06 17:00:13', 'huhu'),
(21, '68', '4', '2017-11-06 17:00:17', 'huhu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_list`
--

CREATE TABLE `neko_list` (
  `id` int(11) NOT NULL,
  `iduser` varchar(255) NOT NULL,
  `idanime` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_list`
--

INSERT INTO `neko_list` (`id`, `iduser`, `idanime`, `time`) VALUES
(3, '61', '1', '2017-11-01 20:12:20'),
(4, '1', '1', '2017-11-02 11:25:05'),
(5, '61', '1', '2017-11-02 15:30:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_noti`
--

CREATE TABLE `neko_noti` (
  `id` int(11) NOT NULL,
  `de` varchar(255) NOT NULL,
  `para` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_noti`
--

INSERT INTO `neko_noti` (`id`, `de`, `para`, `date`, `tipo`) VALUES
(1, '1', '2', '2017-10-30', '1'),
(2, '60', '1', '2017-10-30', '1'),
(3, '60', '1', '2017-10-30', '1'),
(4, '60', '59', '2017-10-30', '1'),
(5, '1', '60', '2017-10-30', '1'),
(6, '1', '60', '2017-10-30', '1'),
(7, '61', '59', '2017-10-30', '1'),
(8, '1', '64', '2017-10-31', '1'),
(9, '1', '63', '2017-11-02', '1'),
(10, '1', '63', '2017-11-02', '1'),
(11, '1', '66', '2017-11-02', '1'),
(12, '1', '61', '2017-11-02', '1'),
(13, '1', '59', '2017-11-02', '1'),
(14, '1', '60', '2017-11-02', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_post`
--

CREATE TABLE `neko_post` (
  `id` int(11) NOT NULL,
  `texto` text CHARACTER SET utf8 NOT NULL,
  `id_user` int(11) NOT NULL,
  `spam` varchar(2555) NOT NULL,
  `background` int(11) NOT NULL,
  `tim` datetime NOT NULL,
  `foto` text NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `anime` varchar(255) NOT NULL,
  `video` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_post`
--

INSERT INTO `neko_post` (`id`, `texto`, `id_user`, `spam`, `background`, `tim`, `foto`, `tipo`, `anime`, `video`) VALUES
(1, 'teste', 68, '28f0aaec745cb709a166634aa459150fdae32aba', 0, '2017-11-05 20:07:12', '', '1', '', ''),
(2, 'teste', 68, 'd781f2e25427228dc09fb1b0c9c5a4b6ac93bc16', 0, '2017-11-05 20:09:02', '', '1', '', ''),
(3, 'teste', 68, 'b975d4f0960077a38af3683b8a231ea98c404ed2', 0, '2017-11-05 20:10:30', '', '1', '', ''),
(4, 'Hello', 68, 'b9b6b153e37abd5a3d3e1f5ac30f26f63175e185', 0, '2017-11-06 16:30:36', '', '1', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_proezas`
--

CREATE TABLE `neko_proezas` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `tipo` varchar(2555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_proezas`
--

INSERT INTO `neko_proezas` (`id`, `id_user`, `data`, `tipo`) VALUES
(1, '1', '2017-10-30 00:00:00', '4'),
(2, '1', '2017-10-30 00:00:00', '3'),
(3, '1', '2017-10-30 00:00:00', '1'),
(4, '60', '2017-10-30 00:00:00', '3'),
(5, '60', '2017-10-30 00:00:00', '4'),
(6, '60', '2017-10-30 00:00:00', '1'),
(7, '1', '2017-10-30 00:00:00', '6'),
(8, '61', '2017-10-30 00:00:00', '1'),
(9, '61', '2017-10-30 00:00:00', '4'),
(10, '61', '2017-10-30 00:00:00', '3'),
(11, '62', '2017-10-30 00:00:00', '1'),
(12, '64', '2017-11-02 00:00:00', '1'),
(13, '68', '2017-11-05 00:00:00', '1'),
(14, '68', '2017-11-06 00:00:00', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_user`
--

CREATE TABLE `neko_user` (
  `id` int(11) NOT NULL,
  `idcry` varchar(2566) NOT NULL,
  `email` text NOT NULL,
  `senha` varchar(255) NOT NULL,
  `user` text CHARACTER SET utf8 NOT NULL,
  `nome` text CHARACTER SET utf8 NOT NULL,
  `sobname` text CHARACTER SET utf8 NOT NULL,
  `datec` date NOT NULL,
  `lastlogin` datetime NOT NULL,
  `photo` text NOT NULL,
  `fotoback` text NOT NULL,
  `configurado` int(11) NOT NULL,
  `inisession` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `gostas` text NOT NULL,
  `sexo` text NOT NULL,
  `estado` text NOT NULL,
  `myanimelist` text NOT NULL,
  `about` text NOT NULL,
  `anime_favorite` text NOT NULL,
  `coins` varchar(255) NOT NULL,
  `background` text NOT NULL,
  `vip` int(11) NOT NULL,
  `visitas` varchar(2512) NOT NULL DEFAULT '0',
  `xppor` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_user`
--

INSERT INTO `neko_user` (`id`, `idcry`, `email`, `senha`, `user`, `nome`, `sobname`, `datec`, `lastlogin`, `photo`, `fotoback`, `configurado`, `inisession`, `ip`, `pin`, `gostas`, `sexo`, `estado`, `myanimelist`, `about`, `anime_favorite`, `coins`, `background`, `vip`, `visitas`, `xppor`) VALUES
(68, '2ca635c8b2c53afe644991979cf4b954c6449f87', 'kaway@hotmail.com', 'a0b48bf6735b085374fa984535372a8025210e45', 'kaway404', 'Alexandre', 'Silva', '2017-11-04', '2017-11-06 13:06:42', 'default.png', 'xande.png', 1, '2017-11-04 22:26:53', '187.55.59.102', '5151', 'Programar', 'masc', 'sc', 'kaway404', 'Sou legal', 'Naruto', '390', '', 0, '0', '900'),
(69, '2ca635c8b2c53afe644991979cf4b954c6449f87', 'kaway@hotmail.com', 'a0b48bf6735b085374fa984535372a8025210e45', 'teste1', 'Alexandre', 'Silva', '2017-11-04', '2017-11-04 22:26:53', 'default.png', 'xande.png', 1, '2017-11-04 22:26:53', '177.2.36.40', '5151', 'Programar', 'masc', 'sc', 'kaway404', 'Sou legal', 'Naruto', '0', '', 0, '0', '0'),
(70, '2ca635c8b2c53afe644991979cf4b954c6449f87', 'kaway@hotmail.com', 'a0b48bf6735b085374fa984535372a8025210e45', 'teste2', 'Alexandre', 'Silva', '2017-11-04', '2017-11-04 22:26:53', 'default.png', 'xande.png', 1, '2017-11-04 22:26:53', '177.2.36.40', '5151', 'Programar', 'masc', 'sc', 'kaway404', 'Sou legal', 'Naruto', '0', '', 0, '0', '0'),
(71, '2ca635c8b2c53afe644991979cf4b954c6449f87', 'kaway@hotmail.com', 'a0b48bf6735b085374fa984535372a8025210e45', 'teste3', 'Alexandre', 'Silva', '2017-11-04', '2017-11-04 22:26:53', 'default.png', 'xande.png', 1, '2017-11-04 22:26:53', '177.2.36.40', '5151', 'Programar', 'masc', 'sc', 'kaway404', 'Sou legal', 'Naruto', '0', '', 0, '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `neko_videos`
--

CREATE TABLE `neko_videos` (
  `id` int(11) NOT NULL,
  `idanime` varchar(255) NOT NULL,
  `nome` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `neko_videos`
--

INSERT INTO `neko_videos` (`id`, `idanime`, `nome`, `link`) VALUES
(1, '1', 'EP 01', 'https://www.blogger.com/video-play.mp4?contentId=f685d4a92362a9e9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `neko_amizades`
--
ALTER TABLE `neko_amizades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_anime`
--
ALTER TABLE `neko_anime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_back`
--
ALTER TABLE `neko_back`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_comment`
--
ALTER TABLE `neko_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_list`
--
ALTER TABLE `neko_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_noti`
--
ALTER TABLE `neko_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_post`
--
ALTER TABLE `neko_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_proezas`
--
ALTER TABLE `neko_proezas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_user`
--
ALTER TABLE `neko_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neko_videos`
--
ALTER TABLE `neko_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `neko_amizades`
--
ALTER TABLE `neko_amizades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `neko_anime`
--
ALTER TABLE `neko_anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `neko_back`
--
ALTER TABLE `neko_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `neko_comment`
--
ALTER TABLE `neko_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `neko_list`
--
ALTER TABLE `neko_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `neko_noti`
--
ALTER TABLE `neko_noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `neko_post`
--
ALTER TABLE `neko_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `neko_proezas`
--
ALTER TABLE `neko_proezas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `neko_user`
--
ALTER TABLE `neko_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `neko_videos`
--
ALTER TABLE `neko_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
