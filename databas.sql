set FOREIGN_KEY_CHECKS = 0;
drop table if exists Players;
drop table if exists Teams;

create table Players (
	name varchar(30),
	winmoneyfifa int default 0,
	winmoneypoker int default 0,
	roundsplayed int default 0,
	active bool default true,
	primary key(name)
);

create table Teams (
	player1 varchar(30),
	player2 varchar(30),
	round int not null,
	primary key(player1, player2),
	foreign key (player1) references Players(name),
	foreign key (player2) references Players(name)
);


insert into Players (name) values ('Ola'), ('Padde'), ('Frick'), ('Tim'), ('Dizza'), ('Hall'), ('Basse'), ('Mackan'), ('Frettan'), ('Simon'), ('Skogh'), ('Vakant');
update Players set active=0 where name='Vakant';

insert into Teams(player1, player2, round) values ('Hall', 'Mackan', 1), ('Frick', 'Dizza', 1), ('Ola', 'Basse', 1), ('Padde', 'Tim', 1);
set FOREIGN_KEY_CHECKS = 1;


update Players set winmoneyfifa=400 where name = 'Mackan';
update Players set winmoneyfifa=400 where name = 'Hall';

update Players set winmoneypoker=800 where name = 'Mackan';
update Players set winmoneypoker=500 where name = 'Frettan';
update Players set winmoneypoker=100 where name = 'Ola';
update Players set winmoneypoker=100 where name = 'Padde';

update Players set roundsplayed=3 where name = 'Ola';
update Players set roundsplayed=3 where name = 'Padde';
update Players set roundsplayed=3 where name = 'Dizza';
update Players set roundsplayed=3 where name = 'Frick';
update Players set roundsplayed=3 where name = 'Tim';
update Players set roundsplayed=2 where name = 'Mackan';
update Players set roundsplayed=2 where name = 'Hall';
update Players set roundsplayed=1 where name = 'Basse';
update Players set roundsplayed=1 where name = 'Frettan';
update Players set roundsplayed=1 where name = 'Simon';
update Players set roundsplayed=1 where name = 'Skogh';


select name, winmoneyfifa, winmoneypoker, winmoneyfifa+winmoneypoker as winmoneytotal, (winmoneyfifa+winmoneypoker-(100*roundsplayed)) as total, roundsplayed from players order by winmoneytotal desc;