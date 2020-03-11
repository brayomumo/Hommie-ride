CREATE TABLE users(
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(200) NOT NULL,
    first_name VARCHAR(200) NOT NULL,
    last_name VARCHAR(200) NOT NULL,
    licence_number VARCHAR(20) NOT NULL UNIQUE,
    email  VARCHAR(200) NOT NULL,
    password  VARCHAR(200) NOT NULL,
    workArea  VARCHAR(200) NOT NULL,
    homeArea  VARCHAR(200) NOT NULL,
    cartype VARCHAR(20) NOT NULL,
    car_plate_number VARCHAR(10) NOT NULL
);
CREATE TABLE groups(
    group_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    group_name VARCHAR(200) NOT NULL,
    workArea VARCHAR(200) NOT NULL,
    neighbourhood VARCHAR(200) NOT NULL
);
CREATE TABLE user_group (
    group_id INT NOT NULL,
    user_id INT NOT NULL,

    CONSTRAINT FK_userGroup1 FOREIGN KEY(group_id) REFERENCES groups(group_id),
    CONSTRAINT FK_userGroup2 FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE trips
(
    trip_id INT NOT NULL PRIMARY KEY,
    destination NVARCHAR(200) NOT NULL,
    origin  VARCHAR(200) NOT NULL,
    departure_time  DATETIME
);
CREATE TABLE group_trip(
    trip_id INT NOT NULL,
    group_id INT NOT NULL,

    CONSTRAINT FK_groupTrip1 FOREIGN KEY(trip_id) REFERENCES trips(trip_id),
    CONSTRAINT FK_groupTrip2 FOREIGN KEY(group_id) REFERENCES groups(group_id)
);

CREATE TABLE drivers(
    driver_licence_number VARCHAR(20) NOT NULL,
    trip_id INT NOT NULL,
    driving_day DATETIME,
    CONSTRAINT FK_driver1 FOREIGN KEY(driver_licence_number) REFERENCES users(licence_number),
    CONSTRAINT FK_driver2 FOREIGN KEY(trip_id) REFERENCES trips(trip_id)
);
GO