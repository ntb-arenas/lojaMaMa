CREATE TABLE `USERS` (
  `USERNAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `fNAME` varchar(200) NOT NULL,
  `lNAME` varchar(200) NOT NULL,
  `MORADA` varchar(200) NOT NULL,
  `COD_POSTAL` varchar(8) NOT NULL,
  `CIDADE` varchar(30) NOT NULL,
  `PAIS` varchar(50) NOT NULL,
  `TELEMOVEL` varchar(9) NOT NULL,
  `USER_LEVEL` int(11) NOT NULL DEFAULT '0',
  `USER_STATUS` int(11) NOT NULL DEFAULT '0',
  `TOKEN_CODE` varchar(200) DEFAULT NULL,
  `MSGS_MARKETING` int(11) NOT NULL DEFAULT '0',
  `DATE_HOUR` varchar(100) NOT NULL DEFAULT '2021-01-15 04:56:38'
 
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`USERNAME`);