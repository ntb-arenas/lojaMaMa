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

