
Create type setor as enum('adm','marinha','marketing');

create table usuario
(
id_user SERIAL primary key not null,
username varchar(20),
senha varchar(10),
cargo setor
);

create table noticias
(
id_news SERIAL primary key not null,
idF_user integer,
foreign key (idF_user) references usuario(id_user),
titulo varchar(12),
subtitulo varchar(70),
noticia_p1 text,
noticia_p2 text,
news_image bytea,
news_files bytea,
post_day date,
situação boolean
);


create table ip_control
(
ip char primary key,
idf_news integer,
foreign key (idf_news) references noticias(id_news)
);

insert into usuario values (DEFAULT,'Daniel','abc,123','adm');

select * from noticias