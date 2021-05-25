-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 09-11-2020 a las 15:54:37
-- Versión del servidor: 5.5.62
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arturnito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_turnos`
--

CREATE TABLE `control_turnos` (
  `Id_Control` smallint(10) NOT NULL,
  `Modulo` varchar(50) DEFAULT NULL,
  `Fecha_Turno` date DEFAULT NULL,
  `Max_Num_Turno` smallint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `Id_Estado` smallint(10) NOT NULL,
  `Estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Id_Estado`, `Estado`) VALUES
(0, 'Deshabilitado'),
(1, 'Habilitado'),
(2, 'Eliminado'),
(3, 'Llamado'),
(4, 'Anulado'),
(5, 'Atendido'),
(6, 'Finalizado'),
(7, 'Anulado_por_admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `Id_Modulo` smallint(10) NOT NULL,
  `Modulo` varchar(100) DEFAULT NULL,
  `Cod_Modulo` varchar(100) DEFAULT NULL,
  `Estado_Modulo` smallint(10) DEFAULT NULL,
  `Fecha_Alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `modulo`
--
DELIMITER $$
CREATE TRIGGER `modulo_auditoria_AD` AFTER DELETE ON `modulo` FOR EACH ROW INSERT INTO modulo_auditoria (Id_Modulo,Modulo,Cod_Modulo,Estado_Modulo,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.Id_Modulo,OLD.Modulo,OLD.Cod_Modulo,OLD.Estado_Modulo,OLD.Fecha_Alta,'AFTER DELETE',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `modulo_auditoria_AI` AFTER INSERT ON `modulo` FOR EACH ROW INSERT INTO modulo_auditoria (Id_Modulo,Modulo,Cod_Modulo,Estado_Modulo,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(NEW.Id_Modulo,NEW.Modulo,NEW.Cod_Modulo,NEW.Estado_Modulo,NEW.Fecha_Alta,'AFTER INSERT',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `modulo_auditoria_BU` BEFORE UPDATE ON `modulo` FOR EACH ROW INSERT INTO modulo_auditoria (Id_Modulo,Modulo,Cod_Modulo,Estado_Modulo,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.Id_Modulo,OLD.Modulo,OLD.Cod_Modulo,OLD.Estado_Modulo,OLD.Fecha_Alta,'BEFORE UPDATE',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_auditoria`
--

CREATE TABLE `modulo_auditoria` (
  `Id_Modulo` smallint(10) DEFAULT NULL,
  `Modulo` varchar(100) DEFAULT NULL,
  `Cod_Modulo` varchar(100) DEFAULT NULL,
  `Estado_Modulo` smallint(10) DEFAULT NULL,
  `Fecha_Alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Tipo_Trigger` varchar(100) DEFAULT NULL,
  `Fecha_Trigger_Ejecucion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `Id_Puesto` smallint(10) NOT NULL,
  `Puesto` varchar(100) DEFAULT NULL,
  `Estado_puesto` smallint(10) DEFAULT NULL,
  `Fecha_Alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `puesto`
--
DELIMITER $$
CREATE TRIGGER `puesto_auditoria_AD` AFTER DELETE ON `puesto` FOR EACH ROW INSERT INTO puesto_auditoria (Id_Puesto,Puesto,Estado_puesto,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.Id_Puesto,OLD.Puesto,OLD.Estado_puesto,OLD.Fecha_Alta,'AFTER DELETE',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `puesto_auditoria_AI` AFTER INSERT ON `puesto` FOR EACH ROW INSERT INTO puesto_auditoria (Id_Puesto,Puesto,Estado_puesto,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(NEW.Id_Puesto,NEW.Puesto,NEW.Estado_puesto,NEW.Fecha_Alta,'AFTER INSERT',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `puesto_auditoria_BU` BEFORE UPDATE ON `puesto` FOR EACH ROW INSERT INTO puesto_auditoria (Id_Puesto,Puesto,Estado_puesto,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.Id_Puesto,OLD.Puesto,OLD.Estado_puesto,OLD.Fecha_Alta,'BEFORE UPDATE',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto_auditoria`
--

CREATE TABLE `puesto_auditoria` (
  `Id_Puesto` smallint(10) DEFAULT NULL,
  `Puesto` varchar(100) DEFAULT NULL,
  `Estado_puesto` smallint(10) DEFAULT NULL,
  `Fecha_Alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Tipo_Trigger` varchar(100) DEFAULT NULL,
  `Fecha_Trigger_Ejecucion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `turnostomados_vista`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `turnostomados_vista` (
`Turno` varchar(100)
,`Puesto` varchar(100)
,`Id_Estado` smallint(10)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos_tomados`
--

CREATE TABLE `turnos_tomados` (
  `id_TTomados` int(10) NOT NULL,
  `Id_Puesto` smallint(10) DEFAULT NULL,
  `Id_Usuario` smallint(10) DEFAULT NULL,
  `Id_Estado` smallint(10) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Id_Modulo` smallint(10) DEFAULT NULL,
  `Turno` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `turnos_tomados`
--
DELIMITER $$
CREATE TRIGGER `turnos_auditoria_AD` AFTER DELETE ON `turnos_tomados` FOR EACH ROW INSERT INTO turnos_tomados_auditoria (id_TTomados,Id_Puesto,Id_Usuario,Id_Estado,datetime,Id_Modulo,Turno,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.id_TTomados,OLD.Id_Puesto,OLD.Id_Usuario,OLD.Id_Estado,OLD.datetime,OLD.Id_Modulo,OLD.Turno,'AFTER DELETE',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `turnos_auditoria_AI` AFTER INSERT ON `turnos_tomados` FOR EACH ROW INSERT INTO turnos_tomados_auditoria (id_TTomados,Id_Puesto,Id_Usuario,Id_Estado,datetime,Id_Modulo,Turno,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(NEW.id_TTomados,NEW.Id_Puesto,NEW.Id_Usuario,NEW.Id_Estado,NEW.datetime,NEW.Id_Modulo,NEW.Turno,'AFTER INSERT',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `turnos_auditoria_BU` BEFORE UPDATE ON `turnos_tomados` FOR EACH ROW INSERT INTO turnos_tomados_auditoria (id_TTomados,Id_Puesto,Id_Usuario,Id_Estado,datetime,Id_Modulo,Turno,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.id_TTomados,OLD.Id_Puesto,OLD.Id_Usuario,OLD.Id_Estado,OLD.datetime,OLD.Id_Modulo,OLD.Turno,'BEFORE UPDATE',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos_tomados_auditoria`
--

CREATE TABLE `turnos_tomados_auditoria` (
  `id_TTomados` int(10) DEFAULT NULL,
  `Id_Puesto` smallint(10) DEFAULT NULL,
  `Id_Usuario` smallint(10) DEFAULT NULL,
  `Id_Estado` smallint(10) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT NULL,
  `Id_Modulo` smallint(10) DEFAULT NULL,
  `Turno` varchar(100) DEFAULT NULL,
  `Tipo_Trigger` varchar(100) DEFAULT NULL,
  `Fecha_Trigger_Ejecucion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` smallint(10) NOT NULL,
  `NombreUs` varchar(100) DEFAULT NULL,
  `Cod_Usuario` varchar(100) DEFAULT NULL,
  `Rol` smallint(10) DEFAULT NULL,
  `Id_Estado` smallint(10) DEFAULT NULL,
  `Id_Puesto` smallint(10) DEFAULT NULL,
  `Fecha_Alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Foto` varchar(80) NOT NULL DEFAULT 'fotoperfil/unnamed.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `NombreUs`, `Cod_Usuario`, `Rol`, `Id_Estado`, `Id_Puesto`, `Fecha_Alta`, `Foto`) VALUES
(1, 'Root', '5f8e355a60253c112d6a68e2', 1, 1, 1, '2020-11-08 03:54:52', 'fotoperfil/unnamed.jpg');

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `usuario_auditoria_AD` AFTER DELETE ON `usuario` FOR EACH ROW INSERT INTO usuario_auditoria (Id_Usuario,NombreUs,Cod_Usuario,Rol,Id_Estado,Id_Puesto,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.Id_Usuario,OLD.NombreUs,OLD.Cod_Usuario,OLD.Rol,OLD.Id_Estado,OLD.Id_Puesto,OLD.Fecha_Alta,'AFTER DELETE',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuario_auditoria_AI` AFTER INSERT ON `usuario` FOR EACH ROW INSERT INTO usuario_auditoria (Id_Usuario,NombreUs,Cod_Usuario,Rol,Id_Estado,Id_Puesto,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(NEW.Id_Usuario,NEW.NombreUs,NEW.Cod_Usuario,NEW.Rol,NEW.Id_Estado,NEW.Id_Puesto,NEW.Fecha_Alta,'AFTER INSERT',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuario_auditoria_BU` BEFORE UPDATE ON `usuario` FOR EACH ROW INSERT INTO usuario_auditoria (Id_Usuario,NombreUs,Cod_Usuario,Rol,Id_Estado,Id_Puesto,Fecha_Alta,Tipo_Trigger,Fecha_Trigger_Ejecucion) VALUES 
(OLD.Id_Usuario,OLD.NombreUs,OLD.Cod_Usuario,OLD.Rol,OLD.Id_Estado,OLD.Id_Puesto,OLD.Fecha_Alta,'BEFORE UPDATE',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_auditoria`
--

CREATE TABLE `usuario_auditoria` (
  `Id_Usuario` smallint(10) DEFAULT NULL,
  `NombreUs` varchar(100) DEFAULT NULL,
  `Cod_Usuario` varchar(100) DEFAULT NULL,
  `Rol` smallint(10) DEFAULT NULL,
  `Id_Estado` smallint(10) DEFAULT NULL,
  `Id_Puesto` smallint(10) DEFAULT NULL,
  `Fecha_Alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Tipo_Trigger` varchar(100) DEFAULT NULL,
  `Fecha_Trigger_Ejecucion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_modulo`
--

CREATE TABLE `usuario_modulo` (
  `Id` smallint(10) NOT NULL,
  `Id_Usuario` smallint(10) DEFAULT NULL,
  `Id_Modulo` smallint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_turnos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_turnos` (
`Id_Turno` int(10)
,`Turno` varchar(100)
,`Estado` varchar(100)
,`Usuario` varchar(100)
,`Puesto` varchar(100)
,`Modulo` varchar(100)
,`Fecha_Turno` timestamp
);

-- --------------------------------------------------------

--
-- Estructura para la vista `turnostomados_vista`
--
DROP TABLE IF EXISTS `turnostomados_vista`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `turnostomados_vista`  AS  select `turnos_tomados`.`Turno` AS `Turno`,`puesto`.`Puesto` AS `Puesto`,`turnos_tomados`.`Id_Estado` AS `Id_Estado` from (`turnos_tomados` left join `puesto` on((`turnos_tomados`.`Id_Puesto` = `puesto`.`Id_Puesto`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_turnos`
--
DROP TABLE IF EXISTS `vista_turnos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_turnos`  AS  select `tt`.`id_TTomados` AS `Id_Turno`,`tt`.`Turno` AS `Turno`,`e`.`Estado` AS `Estado`,`u`.`NombreUs` AS `Usuario`,`p`.`Puesto` AS `Puesto`,`m`.`Modulo` AS `Modulo`,`tt`.`datetime` AS `Fecha_Turno` from ((((`turnos_tomados` `tt` left join `puesto` `p` on((`p`.`Id_Puesto` = `tt`.`Id_Puesto`))) left join `modulo` `m` on((`m`.`Id_Modulo` = `tt`.`Id_Modulo`))) left join `estado` `e` on((`e`.`Id_Estado` = `tt`.`Id_Estado`))) left join `usuario` `u` on((`u`.`Id_Usuario` = `tt`.`Id_Usuario`))) where ((`tt`.`Id_Puesto` in (select `puesto`.`Id_Puesto` from `puesto` where (`puesto`.`Estado_puesto` <> 2)) or isnull(`tt`.`Id_Puesto`)) and `tt`.`Id_Modulo` in (select `modulo`.`Id_Modulo` from `modulo` where (`modulo`.`Estado_Modulo` <> 2))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `control_turnos`
--
ALTER TABLE `control_turnos`
  ADD PRIMARY KEY (`Id_Control`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Id_Estado`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`Id_Modulo`),
  ADD KEY `Estado_Modulo` (`Estado_Modulo`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`Id_Puesto`),
  ADD KEY `Estado_puesto` (`Estado_puesto`);

--
-- Indices de la tabla `turnos_tomados`
--
ALTER TABLE `turnos_tomados`
  ADD PRIMARY KEY (`id_TTomados`),
  ADD KEY `Id_Puesto` (`Id_Puesto`),
  ADD KEY `Id_Estado` (`Id_Estado`),
  ADD KEY `Id_Modulo` (`Id_Modulo`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD UNIQUE KEY `NombreUs` (`NombreUs`),
  ADD UNIQUE KEY `Id_Puesto_2` (`Id_Puesto`),
  ADD UNIQUE KEY `Cod_Usuario` (`Cod_Usuario`),
  ADD KEY `Id_Puesto` (`Id_Puesto`),
  ADD KEY `Id_Estado` (`Id_Estado`);

--
-- Indices de la tabla `usuario_modulo`
--
ALTER TABLE `usuario_modulo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario` (`Id_Usuario`),
  ADD KEY `Id_Modulo` (`Id_Modulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `control_turnos`
--
ALTER TABLE `control_turnos`
  MODIFY `Id_Control` smallint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `Id_Estado` smallint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `Id_Modulo` smallint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `Id_Puesto` smallint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos_tomados`
--
ALTER TABLE `turnos_tomados`
  MODIFY `id_TTomados` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` smallint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_modulo`
--
ALTER TABLE `usuario_modulo`
  MODIFY `Id` smallint(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`Estado_Modulo`) REFERENCES `estado` (`Id_Estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`Estado_puesto`) REFERENCES `estado` (`Id_Estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `turnos_tomados`
--
ALTER TABLE `turnos_tomados`
  ADD CONSTRAINT `turnos_tomados_ibfk_2` FOREIGN KEY (`Id_Puesto`) REFERENCES `puesto` (`Id_Puesto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `turnos_tomados_ibfk_3` FOREIGN KEY (`Id_Modulo`) REFERENCES `modulo` (`Id_Modulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `turnos_tomados_ibfk_4` FOREIGN KEY (`Id_Estado`) REFERENCES `estado` (`Id_Estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `turnos_tomados_ibfk_5` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Id_Puesto`) REFERENCES `puesto` (`Id_Puesto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`Id_Estado`) REFERENCES `estado` (`Id_Estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_modulo`
--
ALTER TABLE `usuario_modulo`
  ADD CONSTRAINT `usuario_modulo_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_modulo_ibfk_2` FOREIGN KEY (`Id_Modulo`) REFERENCES `modulo` (`Id_Modulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
