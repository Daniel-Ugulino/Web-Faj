CREATE VIEW news AS 
select  (id_news,titulo,subtitulo,noticia_p1,noticia_p2,news_image,news_files,situação,username,cargo) from noticias inner join usuario on usuario.id_user = noticias.idf_user where id_news = 55;
SELECT * FROM news;
drop view news