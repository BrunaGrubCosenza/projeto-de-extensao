create database ILPISystem
use ILPISystem
create table ILPI (
cnpj varchar(18) not null primary key,
nome varchar(200) not null,
endereco varchar(200) not null,
municipio varchar(100) not null, 
cep varchar(9) not null, 
email varchar(18) not null, 
telefone varchar(20) not null,
responsavel varchar(100) not null, 
capacidade_acolhimento int not null, 
vagas int not null,
privada boolean,
filantropica boolean,
convenio_publico_estadual boolean,
convenio_publico_municipal boolean, 
equipe_tecnica text, 
estrutura_fisica text, 
atividades_semanais text
) engine = innodb; 

create table usuarios(
id int auto_increment primary key,
cnpj_ilpi varchar(18),
email varchar(18),
senha_hash varchar(200) not null, 
usuario_admin boolean
) engine = innodb;

CREATE INDEX idx_email ON ILPI(email);
alter table usuarios add constraint fk_ilpi_email foreign key (email) references ilpi(email);

INSERT INTO usuarios (cnpj_ilpi, email, senha_hash, usuario_admin) 
VALUES ('12345', 'teste@email.com', 'senha', 1);

SELECT senha_hash, email FROM usuarios WHERE email = 'teste@email.com' AND senha_hash = 'senha1234'