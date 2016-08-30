# sql语句总结

## create 

```
create table customers
(customer_id int unsigned not null auto_increment primary key,
name char(50) not null,
address char(100) not null,
city char(30) not null
); 
```

```
create table orders (
order_id int unsigned not null auto_increment primary key,
customer_id int unsigned not null,
amount float(6,2),
date date not null
);
```

```
create table books(
isbn char(13) not null primary key,
author char(50),
title char(100),
price float(4,2)
);
```

```
create table order_items (
order_id int unsigned not null,
isbn char(13) not null,
quantity tinyint unsigned,
PRIMARY key (order_id,isbn)
);
```

```
create table book_reviews(
isbn char(13) not null primary key,
review text
);
```

## insert 

```
insert into customers values (null,'Julies Smith','25 Ok Street','Airport West');
```

```
insert into customers (name,address,city) values('Meslissa Jones','American','Nar Nar Goon North');
```

```
insert customers 
set name = 'HaHa',
    address = 'American',
    city = 'NewYork'
```


```
insert into orders values
(null,3,69.98,'2007-04-02'),
(null,1,49.99,'2007-04-15'),
(null,2,74.98,'2007-04-19'),
(null,3,24.99,'2007-05-01');
```

## select

```
select * from orders where customer_id =3;
```

```
select name, city from customers
```

```
select name, city from customers where customer_id =1;
```

```
select * from orders where customer_id =2 or customer_id=3;
```

```
select orders.order_id,orders.amount,orders.date
from customers,orders
where customers.name = 'Julies Smith'
and customers.customer_id = orders.customer_id;
```

```
select customers.name,orders.order_id,order_items.quantity,books.author,books.`title`
from customers,orders,order_items,books
where customers.customer_id = orders.customer_id
and orders.order_id = order_items.order_id
and order_items.isbn = books.isbn
and books.title like '%Java%';
```

left join
```
select customers.customer_id, customers.name,orders.order_id
from customers left join orders
on customers.customer_id = orders.customer_id;
```
left join
```
select customers.customer_id,customers.name ,orders.order_id
from customers left join orders
using (customer_id)
where orders.order_id is null;
```

使用别名
```
select c.name,o.order_id
from customers as c,orders as o,order_items as oi, books as b
where o.customer_id = c.customer_id
and o.order_id = oi.order_id
and oi.isbn = b.isbn
and b.title like '%Java%';
```