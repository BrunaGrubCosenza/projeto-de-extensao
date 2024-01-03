create database ILPISystem

create table ILPI (
id int auto_increment primary key,
cnpj varchar(18) not null,
nome varchar(200) not null,
endereco varchar(200) not null,
municipio varchar(100) not null, 
cep varchar(9) not null, 
email varchar(100) not null, 
telefone varchar(20) not null,
responsavel varchar(100) not null, 
capacidade_acolhimento int not null, 
vagas int not null, 
equipe_tecnica text, 
estrutura_fisica text, 
atividades_semanais text,
privada boolean,
filantropica boolean,
convenio_publico_estadual boolean,
convenio_publico_municipal boolean
) engine = innodb; 

create table usuarios(
id_usuario int primary key,
email varchar(100),
senha_hash binary(64) not null, 
usuario_admin boolean,
status_usuario int
) engine = innodb;

alter table usuarios add constraint fk_ilpi_usuarios foreign key (id_usuario) references ilpi(id);

