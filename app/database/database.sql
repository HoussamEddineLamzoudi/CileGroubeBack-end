CREATE DATABASE IF NOT EXISTS ciel_groube;
use ciel_groube;
CREATE TABLE IF NOT EXISTS Clients (
  id int not null auto_increment PRIMARY KEY,
  first_name varchar(25),
  last_name varchar(25),
  age int not null,
  profession varchar(50),
  ref varchar(20) unique not null
);

create index client_ref on Clients(ref);

CREATE TABLE IF NOT EXISTS Crenaus (
  id int auto_increment not null primary key,
  value varchar(12)
);

CREATE TABLE IF NOT EXISTS Rdvs (
  id int not null auto_increment PRIMARY KEY,
  day date not null,
  subject text,
  crenau_id int,
  client_id int,
  CONSTRAINT rdvs_crenau_id FOREIGN KEY (crenau_id) REFERENCES Crenaus(id) on delete cascade on update cascade,
  CONSTRAINT rdvs_client_id FOREIGN KEY (client_id) REFERENCES Clients(id) on delete cascade on update cascade
);

create index rdv_day_index on Rdvs(day);

insert into Clients values (null, 'emad', 'ouchaib', 21, 'student', 'eo1'), (null, 'houssam', 'eddin', 22, 'student', 'he2');
insert into Crenau values (1, '10:00-10:30'), (2, '11:00-11:30'), (3, '14:00-14:30'), (4, '15:00-15:30'), (5, '16:00-16:30');
insert into Rdvs values (null, '2022-04-06', 'building a new house', 4, 1), (null, '2022-04-10', 'fix a part in a factory', 2, 2);
