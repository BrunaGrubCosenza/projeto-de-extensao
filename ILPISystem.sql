create database ILPISystem;

create table ILPI (
cnpj varchar(18) not null primary key,
nome varchar(200) not null,
endereco varchar(200) not null,
municipio varchar(100) not null, 
cep varchar(9) not null, 
email varchar(255) not null, 
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
atividades_semanais text,
custo_vaga text 
) engine = innodb; 

create table usuarios(
id varchar(6) primary key,
cnpj_ilpi varchar(18),
email varchar(255),
senha_hash varchar(200) not null,
usuario_admin boolean,
primeiro_acesso boolean  
) engine = innodb;

create table usuarioAdmin(
id int auto_increment primary key,
email varchar(255),
senha_hash varchar(200) not null, 
usuario_admin boolean
) engine = innodb;

INSERT INTO usuarioAdmin (email, senha_hash, usuario_admin) 
VALUES ('teste@email.com', '$argon2i$v=19$m=12,t=3,p=1$bW96eGtzZHA4c2EwMDAwMA$wjavWle25i/PaAqSZukvCQ', 1);