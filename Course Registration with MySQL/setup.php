<?php
require 'connect.php';

$link = mysqli_connect(HOST, USER, PASS, DB) or die(mysqli_connect_error());

/*$query = "DROP TABLE course";
$student_query = "DROP TABLE students";

if(mysqli_query($link, $query)) {
  echo "Table dropped succesfully";
}

$squery = "DROP TABLE students";
if(mysqli_query($link, $squery)) {
  echo "Table dropped succesfully";
}

$equery = "DROP TABLE enrolment";
if(mysqli_query($link, $equery)) {
  echo "Table dropped succesfully";
}*/
$query = "CREATE TABLE course (code VARCHAR(9), name VARCHAR(50), max CHAR(10))";

if ($link->query($query) ===TRUE) {
  echo "Table course created successfully";
} else {
  echo "Error creating table: " . $link->error;
}

$query = "INSERT INTO course(code,name,max) VALUES ('COMP-6002','Web Development','5'),
('COMP-1035','Networking Essentials','4'),
('COMP-3006','Dynamic Websites AMP','9'),
('COMP-1004','English','7')";

if (mysqli_query($link, $query)) {
  echo "New record created successfully";

} else {
  echo "Error: " .$link->error;
}

$squery = "CREATE TABLE students (uid CHAR(9), student VARCHAR(40))";

if ($link->query($squery) ===TRUE) {
  echo "Table student created successfully";
} else {
  echo "Error creating table: " . $link->error;
}

$squery = "INSERT INTO students(uid,student) VALUES ('400424565','Jim Smith'),
('534712479','Sarah Hillier'),
('764134296','Jonathan Quinlan'),
('123456789','Keith Roberts'),
('200343656','Jim Smith'),
('678123987','Chloe Butler')";

if (mysqli_query($link, $squery)) {
  echo "New record created successfully";
} else {
  echo "Error: " .$link->error;
}

$equery = "CREATE TABLE enrolment(uid int(9), code VARCHAR(9), PRIMARY KEY(uid,code))";

if ($link->query($equery) ===TRUE) {
  echo "Table enrolment created successfully";
} else {
  echo "Error creating table: " . $link->error;
}

mysqli_close ($link);
 ?>
