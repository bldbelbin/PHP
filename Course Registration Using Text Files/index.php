<!DOCTYPE html>
<html>
  <body>
    <h1>Course Selection</h1><br>


    <form action="enrolled.php" method="post">


              Name: <input type="text" name="name" placeholder="Name" required="required" maxlength="50">
              <br><br>

              Student Number: <input type="text" name= "snumber" required="required" maxlength="9">
              <br><br>

        <?php
        //form

      $coursedata = "course.txt"; // text file coursedata
      echo "Select a course: <select name = \"pcourse\">\n";

      $cfile = fopen ($coursedata, 'r') or die ("File does not exist or you do not have permission");

      while ($line = fgets ($cfile)) {
        $drop = explode ('||', $line);

      echo " <option value =\"$drop[1]\">$drop[0] $drop[1] $drop[2]</option>\n";


      }

      fclose ($cfile);

      echo " </select>\n";


      ?>

      <br><br>
      <input type = "submit" value="submit" name= "submit">

    </form>

    </body>
    </html>
