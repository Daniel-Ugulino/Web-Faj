CREATE SEQUENCE ids;
Create type setor as enum('adm','marinha','marketing');


create table usuario
(
id_user integer primary key DEFAULT nextval('ids'),
username varchar(20),
senha varchar(10),
cargo setor
);

create table noticias
(
id_news integer primary key DEFAULT nextval('ids'),
idF_user integer,
foreign key (idF_user) references usuario(id_user),
titulo text,
subtitulo text,
noticia_p1 text,
noticia_p2 text,
news_image bytea,
news_files bytea,
datehora timestamp,
situação boolean
);


create table ip_control
(
ip char primary key,
idf_news integer,
foreign key (idf_news) references noticias(id_news)
)