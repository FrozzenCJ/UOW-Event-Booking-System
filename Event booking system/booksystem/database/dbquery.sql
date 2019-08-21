create table customer (
name text not null, 
phonenum text  not null,
username varchar(30) primary key,
password text not null,
role varchar(30) not null default 'user'
);

create table field(
fieldnum int primary key,
tipe text not null
);

create table booking(
transnum serial primary key,
username varchar(30) references customer(username),
tgl date not null,
start int not null,
end int not null,
duration int not null,
fieldnum int references field(fieldnum),
status varchar(30) not null default 'Waiting for Confirmation',
datecreated datetime not null default CURRENT_TIMESTAMP
);

create table pricelist(
opt int primary key,
fieldnum int references field(fieldnum),
startday int not null,
endday int not null,
starttime int not null,
endtime int not null,
price int not null
);

create table price(
transnum int references booking(transnum),
opt int references pricelist(opt),
totalprice int not null
);

create view transaksi as select booking.transnum, tgl, customer.username, phonenum, start, end, duration, field.fieldnum, tipe, price.totalprice, status
from customer inner join booking on customer.username=booking.username inner join price on booking.transnum=price.transnum inner join field on booking.fieldnum=field.fieldnum
where status != 'Waiting for Confirmation'; 

create view verifikasi as select booking.transnum, customer.username, phonenum, tgl, start, end, duration, field.fieldnum, tipe, status
from customer inner join booking on customer.username=booking.username inner join price on booking.transnum=price.transnum inner join field on booking.fieldnum=field.fieldnum
where status = 'Waiting for Confirmation'; 

create view booking_price as transnum,username,tgl,start,end,duration,fieldnum,status,datecreated, totalprice as price from booking natural join price;

insert into field values
(1,'Sintetis'),
(2,'Finil'),
(3,'Finil'),
(4,'Sintetis');

INSERT INTO `pricelist` (`opt`, `fieldnum`, `startday`, `endday`, `starttime`, `endtime`, `price`) VALUES 
    ('1', '1', '1', '5', '7', '14', '75000'), 
    ('2', '2', '1', '5', '7', '14', '100000'),
    ('3', '1', '7', '3', '14', '24', '125000'),
    ('4', '2', '7', '3', '14', '24', '135000'), 
    ('5', '1', '6', '7', '7', '14', '100000'), 
    ('6', '2', '6', '7', '7', '14', '110000'),
    ('7', '1', '4', '6', '14', '24', '150000'), 
    ('8', '2', '4', '6', '14', '24', '160000'),
    ('9', '4', '1', '5', '7', '14', '75000'), 
    ('10','3', '1', '5', '7', '14', '100000'),
    ('11', '4', '7', '3', '14', '24', '125000'), 
    ('12', '3', '7', '3', '14', '24', '135000'), 
    ('13', '4', '6', '7', '7', '14', '100000'), 
    ('14', '3', '6', '7', '7', '14', '110000'), 
    ('15', '4', '4', '6', '14', '24', '150000'), 
    ('16', '3', '4', '6', '14', '24', '160000');