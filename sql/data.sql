create table users ( 
    user_id int primary key not null auto_increment,
    username varchar(50) not null unique,
    password varchar(100) not null,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    date_of_birth date not null,
    date_created timestamp default current_timestamp not null
);

create table network_admins ( 
    net_admin_id int primary key not null auto_increment,
    user_id int not null unique,
    specialization varchar(50) not null,
    date_of_hiring timestamp not null,
    constraint fk_user_id foreign key (user_id) references users(user_id)
          on delete cascade
          on update cascade
);

create table tasks ( 
    task_id int primary key not null auto_increment,
    task_name varchar(100) not null,
    technologies_used varchar(100) not null,
    net_admin_id int,
    start_of_task date not null,
    end_of_task date,
    constraint fk_net_admin_id foreign key (net_admin_id) references network_admins(net_admin_id)
          on delete cascade
          on update cascade
);

delimiter //

create procedure add_user_with_network_admin( 
    in p_username varchar(50),
    in p_password varchar(100),
    in p_first_name varchar(50),
    in p_last_name varchar(50),
    in p_date_of_birth date,
    in p_specialization varchar(50)
)

begin
    
    declare last_user_id int;

    insert into users(username, password, first_name, last_name, date_of_birth, date_created)
    values (p_username, p_first_name, p_last_name, p_date_of_birth, current_timestamp);

    set last_user_id = last_insert_id();

    insert into network_admins(user_id, specialization, date_of_hiring)
    values (last_user_id, p_specialization, current_timestamp);
end //

delimiter ;