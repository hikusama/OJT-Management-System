





CREATE TABLE users (
  user_id int(11) NOT NULL,
  username varchar(25) NOT NULL,
  password varchar(255) NOT NULL,
  user_role varchar(15) NOT NULL,
  email varchar(60) NOT NULL,
  created_at datetime NOT NULL DEFAULT current_timestamp()
);





CREATE TABLE trainee (
  trainee_id int(11) NOT NULL,
  stu_id int(11) NOT NULL,
  supervisor_info_id int(11) DEFAULT NULL,
  duty_at datetime DEFAULT NULL,
  attendance_access varchar(255) DEFAULT 'Close'
);



CREATE TABLE supervisors (
  supervisor_info_id int(11) NOT NULL,
  users_id int(11) NOT NULL,
  firstname varchar(50) NOT NULL,
  lastname varchar(50) NOT NULL,
  middlename varchar(50) NOT NULL,
  position varchar(50) NOT NULL,
  department varchar(150) NOT NULL,
  room varchar(50) NOT NULL,
  profile_pic longblob NOT NULL,
  gender varchar(20) NOT NULL,
  activeStatus time NOT NULL DEFAULT current_timestamp()
);


CREATE TABLE students (
  stu_id int(11) NOT NULL,
  users_id int(11) NOT NULL,
  student_id int(20) NOT NULL,
  profile_pic longblob NOT NULL,
  firstname varchar(55) NOT NULL,
  lastname varchar(55) NOT NULL,
  middlename varchar(55) NOT NULL,
  contact int(16) NOT NULL,
  address text NOT NULL,
  year_levelnsection varchar(30) NOT NULL,
  course varchar(255) NOT NULL,
  department varchar(55) NOT NULL,
  gender varchar(15) NOT NULL,
  updated_at datetime NOT NULL DEFAULT current_timestamp(),
  activeStatus time NOT NULL DEFAULT current_timestamp()
);


CREATE TABLE request (
  request_id int(11) NOT NULL,
  stu_id int(11) NOT NULL,
  supervisor_id int(11) DEFAULT NULL,
  request_status varchar(11) NOT NULL,
  request_at datetime NOT NULL DEFAULT current_timestamp(),
  requested_to varchar(25) DEFAULT NULL,
  respond_at datetime DEFAULT NULL
);




CREATE TABLE reports (
  report_id int(11) NOT NULL,
  pic_proof longblob NOT NULL,
  trainee_id int(11) NOT NULL,
  place varchar(100) NOT NULL,
  report_status varchar(15) DEFAULT 'Pending',
  title varchar(50) DEFAULT NULL,
  narrative varchar(250) DEFAULT NULL,
  time_acquired int(11) DEFAULT NULL,
  day_date date DEFAULT curdate()
);



CREATE TABLE department (
  program_id int(11) NOT NULL,
  program_pic longblob NOT NULL,
  department varchar(50) NOT NULL,
  deptAcronym varchar(20) NOT NULL
);


CREATE TABLE attendance (
  id int(11) NOT NULL,
  stu_id int(11) NOT NULL,
  trainee_id int(11) DEFAULT NULL,
  Mtime_in time DEFAULT NULL,
  Mtime_out time DEFAULT NULL,
  Atime_in time DEFAULT NULL,
  Atime_out time DEFAULT NULL,
  mins_time_acquired int(15) DEFAULT NULL,
  day_date date DEFAULT curdate()
);


CREATE TABLE course (
  course_id int(11) NOT NULL,
  dept_id int(11) NOT NULL,
  course varchar(80) DEFAULT NULL,
  crsAcronym varchar(25) DEFAULT NULL
);









