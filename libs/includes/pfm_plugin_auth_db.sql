-- PFM Framework
-- Auth plugin
-- Tables creation data

drop table if exists pfm_group_credential;
drop table if exists pfm_credential;
drop table if exists pfm_user_group;
drop table if exists pfm_groups;
drop table if exists pfm_users;

create table pfm_users (
	id int(9) auto_increment,
	login varchar(32),
	password varchar(32),
	regdate date,
	constraint pk_user primary key(id)
);

create table pfm_groups (
	id int(9) auto_increment,
	groupname varchar(255),
	constraint pk_group primary key(id)
);

create table pfm_user_group (
	id int(9) auto_increment,
	userid int(9),
	groupid int(9),
	constraint fk_ug_u foreign key(userid)
		references pfm_users(id),
	constraint fk_ug_g foreign key(groupid)
		references pfm_groups(id),
	constraint pk_ug primary key(id)
);

create table pfm_credential (
	id int(9) auto_increment,
	name varchar(32),
	constraint pk_cred primary key(id)
);

create table pfm_group_credential (
	id int(9) auto_increment,
	groupid int(9),
	credential int(9),
	constraint fk_gc_g foreign key(groupid)
		references pfm_groups(id),
	constraint fk_gc_c foreign key(credential)
		references pfm_credential(id),
	constraint pk_gc primary key(id)
);


-- données par défaut
insert into pfm_credential values (null, 'admin');
insert into pfm_groups values(null, 'admin');
insert into pfm_users values(null, 'pfm_admin', 'admin', NOW());
insert into pfm_user_group values(null, 1, 1);
insert into pfm_group_credential values (null, 1, 1);
