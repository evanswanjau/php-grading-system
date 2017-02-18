<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>School Grading System</title>
    <style media="screen">
      body{
        background-color:#21252B;
      }
      .myform{
        text-align: center;
        position:absolute;
        top:5%;
        width:99%;
        font-family:century gothic;
        color:white;
      }
      input{
        background-color:transparent;
        border:1px solid grey;
        width:25%;
        padding:10px;
        color:white;
        font:14px century gothic;
        border-radius:5px;
      }
      input:focus{
        border:none;
	      border:2px solid white;
	      outline:none !important;
      }
      input:active{
	      border:none;
        border:1px solid transparent;
       }
      .button{
        cursor:pointer;
      }
      .button:hover{
        background-color:white;
        color:black;
      }
      .errs{
        font-family:monospace;
        position:absolute;
        text-align: right;
        top:40%;
        background-color:#fff;
        color:#000;
        width:25%;
        padding:1%;
        border-radius:5px;
        margin:5%;
      }
      .errs p{
        text-align: left;
      }
      .reveal{
        color:white;
        position: absolute;
        top:100%;
        font-family:century gothic;
        text-align: center;
      }
      table{
        padding:5%;
      }
      td{
        padding:2%;
        width:5%;
      }
    </style>
  </head>
  <body>
    <div class="myform">
      <h1>School Grading System</h1>
      <form class="gsystem" action="" method="post">
        <input type="text" name="name" placeholder="Enter students name"><br><br>
        <input type="text" name="maths" placeholder="Maths"><br><br>
        <input type="text" name="english" placeholder="English"><br><br>
        <input type="text" name="swahili" placeholder="Swahili"><br><br>
        <input type="text" name="science" placeholder="Science"><br><br>
        <input type="text" name="sscre" placeholder="SSCRE"><br><br>
        <input  class="button" type="submit" name="submit" value="submit"><br>
      </form>
      <div class="errs">
      <?php
      /*
      Grading system
      By Evans Wanjau
      */
      //Assigning variables
      if (isset($_POST['submit'])){

        function test_input($data) {
	         $data = trim($data);
	         $data = stripslashes($data);
	         $data = htmlspecialchars($data);
	         return $data;
	      }

        //Variables
        $nameErr = $mathsErr = $englishErr = $swahiliErr = $scienceErr = $sscreErr = "";
        $name = $maths = $english = $swahili = $science = $sscre = "";

        //Students name assignment
        if(empty($_POST['name'])){
          $nameErr = "<p>You have not entered a students name</p>";
        }else {
          $name = test_input($_POST['name']);
        }

        //Maths
        if(empty($_POST['maths'])){
          $mathsErr = "<p>You have not entered Maths marks</p>";
        }else {
          $maths = test_input(intval($_POST['maths']));
        }

        //English
        if(empty($_POST['english'])){
          $englishErr = "<p>You have not entered English marks</p>";
        }else {
          $english = test_input(intval($_POST['english']));
        }

        //Swahili marks
        if(empty($_POST['swahili'])){
          $swahiliErr = "<p>You have not entered Swahili marks</p>";
        }else {
          $swahili = test_input(intval($_POST['swahili']));
        }

        //Science marks
        if(empty($_POST['science'])){
          $scienceErr = "<p>You have not entered Science marks</p>";
        }else {
          $science = test_input(intval($_POST['science']));
        }

        //SSCRE marks
        if(empty($_POST['sscre'])){
          $sscreErr = "<p>You have not entered SSCRE marks</p>";
        }else {
          $sscre = test_input(intval($_POST['sscre']));
        }

        $m = ($maths * 100) / 50;
        $e = ($english * 100) / 50;
        $s = ($swahili * 100) / 50;
        $sc = ($science * 100) / 50;
        $ss = ($sscre * 100) / 50;

        $total = $m + $e + $s + $sc + $ss;
        $t = ($total * 100) / 500;
        //Grading system
        function getGrade($value){
            if($value >= 80 && $value <= 100){
              $grade = 'A - Excellent';
            }
            elseif ($value >= 60 && $value < 80) {
              $grade = 'B - Very Good';
            }
            elseif ($value >= 40 && $value < 60) {
              $grade = 'C - Good';
            }
            elseif ($value >= 20 && $value < 40) {
              $grade = 'D - Fail';
            }
            elseif ($value >= 0 && $value < 20) {
              $grade = 'E - Jembe';
            }
            else {
              $grade = 'X - You did not do the exam';
            }
          return $grade;
          }

          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "db";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $grade = getGrade($t);

          if($name == true){
            $sql = "INSERT INTO students (name, maths, english, swahili, science, sscre, total, grade)
            VALUES ('$name', '$maths', '$english', '$swahili', '$science', '$sscre', '$t', '$grade')";

            if ($conn->query($sql) === TRUE) {
              echo "<p>Student: " . $name . '</p>';
              echo '<p>Maths: '. $m . '</p><p>English: ' . $e . '</p><p>Swahili: ' . $s .'</p><p>Science: '. $sc . '</p><p>SSCRE: ' . $ss . '</p>';
              echo '<p>' . intval($t) . '% ' . $grade . '</p>';
            }else{
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }else{
            echo $nameErr;
            echo $mathsErr;
            echo $englishErr;
            echo $swahiliErr;
            echo $scienceErr;
            echo $sscreErr;
          }


      }
       ?>
     </div>
    </div>
    <div class="reveal">
      <h1>Student's results</h1>
      <table border="1">
        <tr>
          <th>Student</th>
          <th>Maths</th>
          <th>English</th>
          <th>Swahili</th>
          <th>Science</th>
          <th>SSCRE</th>
          <th>Total(%)</th>
          <th>Grade</th>
        </tr>
      <?php

      $sql2 = "SELECT * FROM students ORDER BY `total` DESC";
      $result = $conn->query($sql2);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["name"] . "</td><td>" . $row["maths"] . "</td><td>" . $row["english"] . "</td><td>" . $row["swahili"] . "</td><td>" . $row["science"] . "</td><td>" . $row["sscre"] . "</td><td>" . $row["total"] . "</td><td>" . $row["grade"] . "</td></tr>";
      }
    }else{
        echo "No data to display";
      }

       ?>

     </table>
    </div>
  </body>
</html>
