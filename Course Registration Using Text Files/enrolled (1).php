<?php

$students = "student.txt"; // text file for students and student number

//converting a string into a variable

$name = $_POST["name"];
$number = $_POST["snumber"];
$course = $_POST["pcourse"];

$found = 0;

// turning students into an array to read

$fileHandle = fopen($students, "r") or die ("Student file does not exist");

while($line=fgets($fileHandle)) {
  $drop = explode(',',$line);

  if($name==$drop[0]&&$number == trim($drop[1])) { //trip to remove whitespace in student number

    $found = 1;
    break; // break if found
  }
}

fclose($fileHandle);
$toRep="";

// check to see if the course is found and if there are seats available

if($found==1) {

  $fileHandle = fopen("course.txt", 'r');
  while($line=fgets($fileHandle)) {

    $drop = explode('||',$line);

    if($drop[1]==$course) {

      $found = 2;  // course found
      if($drop[2]>0) {

        $found = 3;       // couse has seats
        $toRep= $line;
        break;
      }
    }

  }
} else {
  echo "Student could not be found.";
  die();
}

// if the course cannot be found

if($found ==1) {

  echo "The course cannot be found";
  die();
}
// if the course can be found but is full
if($found==2) {

  echo "The course is full";
  die();
}

// if the course is found and the student is found then check if the they have registered
if($found==3) {

  $eHandle = fopen("enrolled.txt",'r');

  while($line = fgets($eHandle)) {
    $drop = explode(',', $line); // turn into an array

    if(trim($drop[1])==$course) { // checking if the student is already registered for the course

      echo "You have already registered for the course.";
      die();
    }
  }
}
// if the student isn't registered in the course
$eHandle2 = fopen("enrolled.txt", 'a');

// write to load.txt the student number and the course code
fwrite($eHandle2,"$name,$course\n");

fclose($eHandle2);
fclose($eHandle);

$courseHandle = fopen('course.txt', 'r'); //open course text
$whole = file_get_contents('./course.txt');// read the whole file

$drop = explode('||', $toRep); // turning the course into an array

$count = (int)$drop[2];
$count = $count - 1; // make one seat less

$newStr = $drop[0]."||".$drop[1]."||".$count."\n";  // make a new string with new seat count

$whole =str_replace($toRep, $newStr, $whole); // replace the old text with new


$courseHandle2 = fopen('course.txt', 'w');
fwrite($courseHandle2, $whole); // overwrite the entire file.

echo "Sucessfully Enrolled."

?>
<html>
<body>
<form action="index.php" method="post">
  <br>
    <input type = "submit" value="back" name= "back">
</form>
</body>
</html>
