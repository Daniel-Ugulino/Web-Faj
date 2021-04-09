
Create type setor as enum('adm','marinha','marketing');

create table usuario
(
id_user SERIAL primary key not null,
username varchar(20),
senha text,
cargo setor
);

create table noticias
(
id_news SERIAL primary key not null,
idF_user integer,
foreign key (idF_user) references usuario(id_user),
titulo varchar(70),
subtitulo varchar(100),
noticia_p1 text,
noticia_p2 text,
news_image text,
news_files text,
post_day date,
situação boolean
);

insert into usuario values (DEFAULT,'Daniel','abc,123','adm');

select * from noticias