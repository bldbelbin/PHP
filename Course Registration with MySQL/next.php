<?php

require 'connect.php';

//linking up to the database
$link = mysqli_connect(HOST, USER, PASS, DB) or die (mysqli_connect_error());

//making a variable from the user data
$name = mysqli_real_escape_string ($link, $_POST["name"]);
$number = mysqli_real_escape_string ($link, $_POST["snumber"]);
$course = $_POST["pcourse"];

// select all from table student which show student name and number

$squery = "SELECT * FROM students WHERE uid=" .$number." AND student = '".$name."'";
$sresult = mysqli_query($link, $squery);

// check is name and number entered by user equals what is in database
$found =0;
while ($srow = mysqli_fetch_array($sresult)) {

  if ($name == $srow['student'] && $number == $srow['uid']) {

    $found =1;

  }  // end of if ($name == $srow['uid'] && $number == $srow['student'])
} // end of while ($srow = mysqli_fetch_array($sresult))

$toRep="";

if($found == 1) {
  $cquery = "SELECT * FROM course WHERE code='$course'";
  $cresult = mysqli_query($link, $cquery);

  while ($crow = mysqli_fetch_array($cresult)) {

    if ($crow['code']==$course) {

      // suppose to update the column max to decrease
      $cquery = "UPDATE course SET max = max -1 WHERE max>0";

      $found =2;
      if($crow[max]>0) {

        $found =3;
        $toRep = $line;

      } //if($crow[max]>0)

    } // if ($crow[code]==$course)
  } // while ($crow = mysqli_fetch_assoc($cresult))
} // if($found == 1)
else {
  echo "Student could not be found";
  die();
} // else "Student could not be found"

// if the course cannot be found
if ($found !=1) {
  echo "The course cannot be found";
  die();
} // if ($found !=1) "The course cannot be found"

// if the course can be found but is full
if($found==2) {
  echo "The course is full";
  die();

} // if ($found==2) "The course is full"

// if the course is found and the student is found then check if they have registered
if ($found==3) {

  $equery= "SELECT * FROM enrolment WHERE uid ='$number' AND code = '$course'";
  $eresult= mysqli_query($link, $equery);

  while ($erow = mysqli_fetch_array($eresult)) {
  if ($erow['code'] == $course && $number == ($erow['uid'])) {

    } // if ($erow['code'] == $course && $number == ($erow['uid']))

  } // while ($erow = mysqli_fetch_array($eresult))
} // if ($found==3)

//if the student isn't registered in the course

$equery = "INSERT INTO enrolment(uid,code) VALUES ('$number','$course')";

if (mysqli_query($link, $equery)) {

  echo "New record created successfully";
}// if (mysqli_query($link, $equery))
else {
  echo "Error: " .$link->error;
} // else echo "Error: " .$link->error;

mysqli_close ($link);

?>

<html>
<body>
<form action="index.php" method="post">
  <br>
    <input type = "submit" value="back" name="back">
</form>
</body>
</html>
