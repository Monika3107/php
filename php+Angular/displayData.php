<?php
session_start();
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" media="screen" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function (){
                    $("#btnSearch").click(function (){
                        var url1="search_api.php?firstname="+document.getElementById("firstname").value+"&lastname="+document.getElementById("lastname").value;

                        $("#results").load(url1);
                    })
/*
            $("#addingData").click(function (){
               console.log("addingData");
               var url="addData.php?id="+document.getElementById("id").value+"&email="+document.getElementById("email").value+"&firstname="+document.getElementById("firstname").value+"&lastname="+document.getElementById("lastname").value;
               alert(url)
               console.log("url ::"+url);
               $("#result").load(url);
               console.log("data added");
             });*/
      });

      function init() {
        hideAll();
        //document.getElementById('welcomeDiv').classList.remove("hideClass");
        document.getElementById('dispData').addEventListener("click",function() { toogleDivs('dispDataDiv'); } );
        document.getElementById('searchData').addEventListener("click",function() { toogleDivs('searchDataDiv'); } );
        document.getElementById('envData').addEventListener("click", function() { toogleDivs('envDataDiv'); } );
        <?php
        if($username=='admin'){
        ?>
          document.getElementById('addData').addEventListener("click", function() { toogleDivs('addDataDiv'); } );
        <?php
        }
        ?>
      }
      function hideAll() {
        //document.getElementById('welcomeDiv').classList.add("hideClass");
        document.getElementById('dispDataDiv').classList.add("hideClass");
        document.getElementById('searchDataDiv').classList.add("hideClass");
        document.getElementById('envDataDiv').classList.add("hideClass");
        document.getElementById('addDataDiv').classList.add("hideClass");
        //  document.getElementById('backgroundDiv').classList.add("hideClass");
      }
      function toogleDivs(id) {
        hideAll();
        document.getElementById(id).classList.remove('hideClass');
      }
    </script>
  </head>
  <body onload="init();">
    <div id="links">
      <br>
    <br>
    <br><br><br>
      <div>
        <a id="dispData" href="#">Display employee data</a>
      </div>
      <?php
      if ($username == 'admin'):
      ?>
      <br>
      <br>
      <div>
        <a id="addData" href="#">Insert employee data</a>
      </div>
      <?php
      endif;
      ?>
     <br>
      <div>
      <a id="envData" href="#">View environmental data</a>
      </div>
      <br>
      <div>
        <a id="searchData" href="#">Search data</a>
      </div>
      <br>
      <div>
        <a href="logout.php">Logout
        </a>
      </div>
      <br>
    </div>
    <div id="content">
      <div id="welcomeDiv">
        <?php
          if ($username == 'guest'):
        ?>
         <h1>Welcome, guest You are now logged in under guest user privilege</h1>
        <br>
        <?php
          endif;
        ?>
        <?php
          if ($username == 'admin'):
        ?>
       <h1>Welcome, admin You are now logged in under administrator privilege </h1>
       <?php
        endif;
       ?>
      </div>
      <div id="dispDataDiv">
        <div>
          <h2>Employee Details
          </h2>
        </div>
        <br>
        <table>
          <thead>
            <tr>
              <th>Employee ID
              </th>
              <th>Email
              </th>
              <th>First Name
              </th>
              <th>Last Name
              </th>
            </tr>
          </thead>
          <?php
            $myfile = fopen("employees.xml", "r") or die("Unable to open file!");
            $data = fread($myfile, filesize("employees.xml"));
            fclose($myfile);
            $xml = simplexml_load_string($data) or die("Error: Cannot create object");
            $xml = (array) $xml;
            foreach ($xml['employee'] as $employee) {
                $employee = (array) $employee;
                echo "<tr>";
                echo "<td>";
                echo $employee['employee_id'];
                echo "</td>";
                echo "<td>";
                echo $employee['email'];
                echo "</td>";
                echo "<td>";
                echo $employee['firstname'];
                echo "</td>";
                echo "<td>";
                echo $employee['lastname'];
                echo "</td>";
                echo "</tr>";
            }
            ?>
       </table>
      </div>
      <div id="searchDataDiv">
        <div id="content">
          <div>
            <h2>Search Employee
            </h2>
          </div>
          <form method="post">
            <p>
              <input  placeholder="First Name"  type="text" id="firstname" >
            </p>
            <p>
              <input  placeholder="Last Name"type="text" id="lastname">
            </p>
            <p>
              <input  id="btnSearch" type="button" value="Search" name="submit">
            </p>
          </form>
        </div>
        <div id="results">
        </div>
      </div>
      <div id="addDataDiv">
         <div id="content">
             <div>
             <h2>Add data</h2>
             </div>
             <form method="POST" action="addData.php">
             <p>
             <input placeholder="Emoployee ID" type="text" name="id">
             </p>
             <p>
             <input  placeholder="Email" type="text" name="email">
           </p>
             <p>
             <input  placeholder="First Name" type="text" name="firstname" >
             </p>
             <p>
             <input  placeholder="Last Name"  type="text" name="lastname">
             </p>
             <p><input id="addingData" type="submit" value="Submit" name="submit"></p>
             </form>
         </div>
         <div id="result">
         </div>
      </div>
      <div id="envDataDiv">
        <object type="text/html" data="https://personal-sites.deakin.edu.au/~mvsolanki/my-app/index.html" width="100%" height="600px" style="overflow:auto;">
        </object>
      </div>
    </div>
  </body>
</html>
