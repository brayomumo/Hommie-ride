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


CREATE TABLE posts(
    post_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    when_posted DATETIME,
    group_id INT,
    post VARCHAR(500), 

    CONSTRAINT FK_post1 FOREIGN KEY(userID) REFERENCES users(user_id),
    CONSTRAINT FK_post2 FOREIGN KEY(group_id) REFERENCES groups(group_id)
)
SELECT groups.*  FROM groups LEFT OUTER JOIN user_group ON groups.group_id = user_group.group_id WHERE user_group.user_id = 1;
-- user details
SELECT users.username,users.cartype, users.car_plate_number from users LEFT JOIN user_group ON user_group.user_id = users.user_id WHERE users.user_id = 22
SELECT users.username, users.company FROM users LEFT JOIN ridealongs ON ridealongs.user_id = users.user_id WHERE rideAlongs.trip_id = 30

CREATE TABLE tirpmembers(
    group_id INT,
    user_id INT,
    trip_id INT
)

-- save trip details ... tripid date driverid destination groupid origin  seat_available  departure_time
-- passengers ----trip_id user_id
-- 
CREATE TABLE trips(
    trip_id INT PRIMARY KEY  NOT NULL AUTO_CORRECT,
    Tdate DATETIME,
    driver_id INT NOT NULL,
    group_id INT NOT NULL,   
    destination VARCHAR(100),
    origin VARCHAR(100),
    seats_available INT NOT NULL,
    departure_time DATETIME,
    CONSTRAINT FK_trips1 FOREIGN KEY(driver_id) REFERENCES users(user_id),
    CONSTRAINT FK_trips2 FOREIGN KEY(group_id) REFERENCES groups(group_id)
)
CREATE TABLE ridealongs(
    trip_id INT NOT  NULL,
    user_id INT NOT NULL,
    CONSTRAINT ridealong_FK1 FOREIGN KEY(trip_id) REFERENCES trips(trip_id),
    CONSTRAINT ridealong_FK2 FOREIGN KEY(user_id) REFERENCES user_group(user_id)
)
CREATE TABLE group_trip(
    trip_id INT NOT NULL,
    group_id INT NOT NULL,
    CONSTRAINT gt_FK1 FOREIGN KEY(trip_id) REFERENCES trips(trip_id),
    CONSTRAINT gt_FK2 FOREIGN KEY(group_id) REFERENCES groups(group_id)
)