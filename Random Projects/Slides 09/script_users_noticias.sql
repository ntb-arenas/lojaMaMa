--
-- Estrutura da tabela `USERS`
--

CREATE TABLE `USERS` (
  `CODIGO` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `NOME` varchar(200) NOT NULL,
  `NIVEL` int(11) NOT NULL DEFAULT '0',
  `USER_STATUS` int(11) NOT NULL DEFAULT '0',
  `TOKEN_CODE` varchar(200) DEFAULT NULL,
  `MENSAGENS_MARKETING` int(11) NOT NULL DEFAULT '0',
  `DATA_HORA` varchar(100) NOT NULL DEFAULT '2021-01-15 04:56:38'
 
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`CODIGO`);
  
  


  
--
-- Estrutura da tabela `NOTICIAS`
--
-- TIPO:
-- 0 - Link para website
-- 1 - Vídeo Youtube
-- 2 - RESERVADO PARA VÍDEOS NO SERVIDOR (E.g. MP4)
-- 3 - PDF
-- 4 - Imagem
--  

CREATE TABLE `NOTICIAS` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(100) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `TIPO` int(11) NOT NULL DEFAULT '0',
  `LIGACAO` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `NOTICIAS`
--

INSERT INTO `NOTICIAS` (`ID`, `TITULO`, `DESCRICAO`, `TIPO`, `LIGACAO`) VALUES
(1, 'Imagens de fotógrafos da Magnum', 'A agência Magnum reúne uma coleção de trabalhos dos mais prestigiados fotógrafos internacionais', 0, 'https://www.magnumphotos.com/photographers/'),
(2, 'Sebastião Salgado', 'Vídeo com a vida e obra deste importante fotógrafo.', 1, 'ruo4RNr7nRI'),
(3, 'Fotografia Digital ', 'Visualização de páginas do livro de Alexandre Barão.´', 3, 'https://recursos.wook.pt/recurso?&id=24939293'),
(4, 'A Rapariga Afegã', 'A edição de junho de 1985 da National Geographic que tornou a “Rapariga Afegã” mundialmente famosa. FOTOGRAFIA DE STEVE MCCURRY, NATIONAL GEOGRAPHIC CREATIVE.', 4, 'https://static.natgeo.pt/files/styles/image_3200/public/05-sharbat-gula-house.webp?w=710&h=1029');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `NOTICIAS`
--
ALTER TABLE `NOTICIAS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `NOTICIAS`
--
ALTER TABLE `NOTICIAS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

