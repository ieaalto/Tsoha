insert into Kayttaja(kayttajatunnus, salasana)
values('AkuAnkka', 'testi');

insert into Kayttaja(kayttajatunnus, salasana)
values('PellePel0ton', 'testi');

insert into Kayttaja(kayttajatunnus, salasana)
values('MikkiHiiri', 'testi');

insert into Kalenteri(nimi,omistaja,julkinen,saajakaa)
values('Pellen kalenteri', 'PellePel0ton', 0,0);

insert into Kalenteri(nimi,omistaja,julkinen,saajakaa)
values('Akun kalenteri', 'AkuAnkka', 0,1);

insert into Kalenteri(nimi,omistaja,julkinen,saajakaa)
values('Mikin julkinen kalenteri', 'MikkiHiiri', 1,0);

insert into KayttajanKalenteri(kayttaja, kalenteri)
values('PellePel0ton',1);

insert into KayttajanKalenteri(kayttaja, kalenteri)
values('AkuAnkka',1);

insert into KayttajanKalenteri(kayttaja, kalenteri)
values('MikkiHiiri',1);

insert into KayttajanKalenteri(kayttaja, kalenteri)
values('MikkiHiiri',3);

insert into KayttajanKalenteri(kayttaja, kalenteri)
values('AkuAnkka',2);

insert into Merkinta(aihe,pvm,klo)
values('Mikin willit bileet', date'2014-4-28',time'21:00:00');

insert into Merkinta(aihe,pvm,klo)
values('Tsohan deadline', date'2014-4-27',time'23:00:00');

insert into Merkinta(aihe,pvm,klo)
values('Työhaastattelu', date'2014-4-29',time'10:30:00');


insert into KalenterinMerkinta(merkinta, kalenteri)
values(2,1);

insert into KalenterinMerkinta(merkinta, kalenteri)
values(1,3);

insert into KalenterinMerkinta(merkinta, kalenteri)
values(3,2);
