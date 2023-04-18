create table cliente(
    numero int AUTO_INCREMENT primary key,
    nombre varchar(100) Not null,
    num_soportes_alquilados int,
    max_alquiler_concurrente int default 3
);

create table cinta_video(
    numero int AUTO_INCREMENT primary key,
    titulo varchar(100) not null,
    precio float,
    duracion int,
    num_cliente int references cliente.numero
)