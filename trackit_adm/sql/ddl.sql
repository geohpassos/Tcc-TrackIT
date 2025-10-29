CREATE DATABASE trackIt;
USE trackIt;
CREATE TABLE login(
idLogin INT AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(250),
senha VARCHAR(250)
);

CREATE TABLE administrador(
idAdm INT AUTO_INCREMENT PRIMARY KEY,
nomeCompleto VARCHAR(250),
email VARCHAR(250),
senha VARCHAR(250),
idlogin INT, 
FOREIGN KEY (idlogin) REFERENCES login(idLogin)
);
CREATE TABLE proprietario(
idUsuario INT AUTO_INCREMENT PRIMARY KEY,
nomeCompleto VARCHAR(250),
email VARCHAR(250),
senha VARCHAR(250),
idlogin INT, 
FOREIGN KEY (idlogin) REFERENCES login(idLogin)
);
CREATE TABLE arduino(
codArduino VARCHAR(50) PRIMARY KEY
);
CREATE TABLE veiculos(
idVeiculos INT AUTO_INCREMENT PRIMARY KEY,
placa VARCHAR(7),
modelo VARCHAR(250),
idProprietario INT,
codArduino VARCHAR(50),
FOREIGN KEY (idProprietario) REFERENCES proprietario(idUsuario),
FOREIGN KEY (codArduino) REFERENCES arduino(codArduino)
);
CREATE TABLE localizacao(
idLocalizacao INT AUTO_INCREMENT PRIMARY KEY,
token_dispositivo VARCHAR(50) NOT NULL,
latitude DECIMAL(10,6) NOT NULL,
longitude DECIMAL(10,6) NOT NULL,
altitude DECIMAL(10,2),
timestamp_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (token_dispositivo) REFERENCES arduino(codArduino)
);