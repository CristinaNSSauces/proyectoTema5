-- CREACION BASE DE DATOS
-- Creacion de la base de datos DAW215DBDepartamentos
CREATE DATABASE if NOT EXISTS DAW215DBProyectoTema5;
-- Creacion de tablas de la base de datos
CREATE TABLE if NOT EXISTS DAW215DBProyectoTema5.Departamento (
    CodDepartamento VARCHAR(3) PRIMARY KEY,
    DescDepartamento VARCHAR(255) NOT NULL,
    FechaBajaDepartamento INT NULL,
    FechaCreacionDepartamento INT NULL,
    VolumenNegocio FLOAT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS DAW215DBProyectoTema5.Usuario(
        CodUsuario varchar(15) PRIMARY KEY,
        DescUsuario varchar(25) NOT null,
        Password varchar(64) NOT null,
        Perfil enum('administrador', 'usuario') default 'usuario', -- Valor por defecto usuario
        FechaHoraUltimaConexion int,
        NumConexiones int default 0,
        ImagenUsuario mediumblob
)ENGINE=INNODB;

-- CREACION USUARIO ADMINISTRADOR
-- Creacion de usuario administrador de la base de datos: usuarioDAW215DBDepartamentos / paso
CREATE USER 'usuarioDAW215DBProyectoTema5'@'%' IDENTIFIED BY 'P@ssw0rd';
-- Permisos para la base de datos
GRANT ALL PRIVILEGES ON DAW215DBProyectoTema5.* TO 'usuarioDAW215DBProyectoTema5'@'%';