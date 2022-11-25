create database pethero;
use pethero;

CREATE TABLE duenios (
  dni_duenio int(11) NOT NULL,
  email varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  nombre varchar(45) DEFAULT NULL,
  apellido varchar(45) DEFAULT NULL,
  telefono int(11) DEFAULT NULL,
  direccion varchar(45) DEFAULT NULL,
  cumpleanios date DEFAULT NULL,
  primary key (dni_duenio)
)engine=InnoDB;

CREATE TABLE guardianes (
  dni_guardian int(11) NOT NULL,
  email varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  nombre varchar(45) DEFAULT NULL,
  apellido varchar(45) DEFAULT NULL,
  telefono varchar(10) DEFAULT NULL,
  direccion varchar(45) DEFAULT NULL,
  cumpleanios date DEFAULT NULL,
  tarifa float(11) DEFAULT NULL,
  preferencia varchar(10) DEFAULT NULL,
  cbu varchar(22) DEFAULT NULL,
  alias varchar(45) DEFAULT NULL,
  primary key (dni_guardian)
)engine=InnoDB;

CREATE TABLE disponibilidades (
  dni_guardian int(11) NOT NULL,
  fecha date DEFAULT NULL,
  disponibilidad varchar(45) DEFAULT NULL,
  constraint fk_dni_guardian FOREIGN KEY (dni_guardian) REFERENCES guardianes(dni_guardian) ON UPDATE CASCADE
)engine=InnoDB;

CREATE TABLE mascotas (
  dni_duenio int(11) NOT NULL,
  nombre varchar(45) NOT NULL,
  tipo varchar(5) DEFAULT NULL,
  edad int(2) DEFAULT NULL,
  raza varchar(45) DEFAULT NULL,
  tamanio varchar(10) DEFAULT NULL,
  observaciones varchar(256) DEFAULT NULL,
  foto varchar(50) DEFAULT NULL,
  vacunacion varchar(50) DEFAULT NULL,
  video varchar(50) DEFAULT NULL,
  primary key(nombre),
  constraint fk_dni_duenio FOREIGN KEY (dni_duenio) REFERENCES duenios(dni_duenio)
)engine=InnoDB;

CREATE TABLE reservas (
n_reserva int auto_increment,
  dni_duenio int(11) NOT NULL,
  dni_guardian int(11) NOT NULL,
  nombre_mascota varchar(45) NOT NULL,
  id_reserva int(10) DEFAULT NULL,
  fecha date DEFAULT NULL,
  hora time DEFAULT NULL,
  encuentro varchar(50) DEFAULT NULL,
  estado varchar(20) DEFAULT NULL,
  primary key (n_reserva),
  constraint fk_dni_d FOREIGN KEY (dni_duenio) REFERENCES duenios(dni_duenio),
  constraint fk_dni_g FOREIGN KEY (dni_guardian) REFERENCES guardianes(dni_guardian) ON UPDATE CASCADE,
  constraint fk_nombre_mascota FOREIGN KEY (nombre_mascota) REFERENCES mascotas(nombre)
)engine=InnoDB;

CREATE TABLE pago (
  n_reserva int(10) NOT NULL,
  forma_pago varchar(45),
  fecha date DEFAULT NULL, 
  monto float DEFAULT NULL,
  primary key (n_reserva),
  constraint fk_id_reserva FOREIGN KEY (n_reserva) REFERENCES reservas(n_reserva)
)engine=InnoDB;

CREATE TABLE cupones (
n_reserva int(10) NOT NULL,
fecha date DEFAULT NULL,
detalles varchar(70),
monto float(6),
primary key(n_reserva),
constraint fk_idreserva foreign key (n_reserva) references reservas(n_reserva)
)engine=InnoDB;

