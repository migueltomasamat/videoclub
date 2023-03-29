create table cliente(
    numero int AUTO_INCREMENT primary key,
    nombre varchar(100) Not null,
    num_soportes_alquilados int,
    max_alquiler_concurrente int default 3
);
