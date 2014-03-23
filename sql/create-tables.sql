create table Kayttaja(
kayttajatunnus varchar(24) primary key, 
salasana varchar(16)
);

create table Kalenteri(
tunnusnumero serial primary key,
nimi varchar(24),
omistaja varchar(24),
julkinen integer,
saaJakaa integer,

foreign key(omistaja) references Kayttaja
);

create table Merkinta(
tunnusnumero serial primary key,
aihe varchar(32),
pvm date,
klo time
);

create table KayttajanKalenteri(
kayttaja varchar(24),
kalenteri integer,
primary key(kayttaja, kalenteri), 
foreign key(kayttaja) references Kayttaja,
foreign key(kalenteri) references Kalenteri
);

create table KalenterinMerkinta(
merkinta integer,
kalenteri integer,
primary key(merkinta, kalenteri), 
foreign key(merkinta) references Merkinta,
foreign key(kalenteri) references Kalenteri
);