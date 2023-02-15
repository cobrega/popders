-- 1.- Creamos la Base de Datos
create database popders DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Seleccionamos la base de datos
use popders
;
-- 2.- Creamos las tablas

-- 2.1.1.- Tabla coder
create table if not exists `coder` (
  `id_coder` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 2.1.2 .- Tabla song
create table if not exists `song` (
  `id_song` int(11) NOT NULL,
  `id_coder` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `img` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 3.- Índices
-- Indices de la tabla `coder`
ALTER TABLE `coder`
  ADD PRIMARY KEY (`id_coder`);

ALTER TABLE `coder`
MODIFY `id_coder` int(11) NOT NULL AUTO_INCREMENT;

-- Indices de la tabla `song`
ALTER TABLE `song`
  ADD PRIMARY KEY (`id_song`);
  
  ALTER TABLE `song`
  MODIFY `id_song` int(11) NOT NULL AUTO_INCREMENT;
  
-- 4.- Clave foránea
ALTER TABLE `song`
  ADD CONSTRAINT `selec_fk` FOREIGN KEY (`id_coder`) REFERENCES `coder` (`id_coder`);
COMMIT;
