<!DOCTYPE html>
<html>
  <body>
    <h1>Course Selection</h1><br>


    <form action="next.php" method="post">


              Name: <input type="text" name="name" placeholder="Name" required="required" maxlength="50">
              <br><br>

              Student Number: <input type="text" name= "snumber" required="required" maxlength="9">
              <br><br>

        <?php
        //form
      require 'connect.php';

      $link = mysqli_connect(HOST, USER, PASS, DB) or die(mysqli_connect_error());

      echo "Select a course: <select name = \"pcourse\">\n";

      $query = "SELECT * FROM course";
      $result = mysqli_query($link, $query);

      while ($row = mysqli_fetch_array($result)) {
        echo "<option> $row[code] $row[name] $row[max]</option><br>";
      }

      mysqli_free_result($results);

      mysqli_close ($link);

      echo " </select>\n";


      ?>

      <br><br>
      <input type = "submit" value="submit" name= "submit">

    </form>

    </body>
    </html>
