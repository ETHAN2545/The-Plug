http://localhost:8080/The-Plug/db_connect.php (E)
http://localhost:8080/ThePlug/db_connect.php (M)

Put into mySQL for creation of the datbase
Name the database theplug_db

INSERT INTO `users` (`user_id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(NULL, 'James St Patrick', 'JamesStPatrick@power.com', 'Ghost123', 'Customer', current_timestamp()),
(NULL, 'Tommy Egan', 'TommyEgan@power.com', 'TommyGun456', 'Customer', current_timestamp()),
(NULL, 'Tasha Green', 'TashaGreen@power.com', 'Tasha789', 'Customer', current_timestamp()),
(NULL, 'Kanan Starkk', 'KananStarkk@power.com', 'KananPower', 'Admin', current_timestamp()),
(NULL, 'Tariq St Patrick', 'TariqStPatrick@power.com', 'TariqFuture', 'Customer', current_timestamp());
