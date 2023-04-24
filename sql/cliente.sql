create table cliente(
    numero int AUTO_INCREMENT primary key,
    nombre varchar(100) Not null,
    num_soportes_alquilados int,
    max_alquiler_concurrente int default 3
);



CREATE table soporte (
    numero int AUTO_INCREMENT primary key,
    titulo varchar(100),
    precio float default 2.5,
    num_cliente int,
    constraint fk_soporte_cliente FOREIGN key (num_cliente) references cliente(numero)
);

create table cinta_video(
    num_soporte int primary key,
    duracion int,
    CONSTRAINT fk_cinta_soporte FOREIGN KEY (num_soporte) references soporte(numero)
);
create table dvd (
     num_soporte int primary key,
     idiomas varchar(150),
     formato_pantalla varchar(10),
     CONSTRAINT fk_dvd_soporte FOREIGN KEY (num_soporte) REFERENCES soporte(numero)
);

create table juego(
      num_soporte int PRIMARY key,
      consola varchar(100),
      minnumjugadores int default 1,
      maxnumjugadores int,
      constraint fk_juego_soporte FOREIGN key (num_soporte) REFERENCES soporte(numero)
);