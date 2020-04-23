<?php
if(isset($_REQUEST['firstname']) && isset($_REQUEST['lastname'])){
    $firstname =  $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];

}else{
    $firstname =  '';
    $lastname = '';
}
$myfile = fopen("employees.xml", "r") or die("Unable to open file!");
        $data = fread($myfile,filesize("employees.xml"));
        fclose($myfile);
        $xml=simplexml_load_string($data) or die("Error: Cannot create object");
        $xml = (array)$xml;
        $filered_data=array();
        foreach ($xml['employee'] as $employee)
        {
            $employee = (array)$employee;
            if($firstname != '' && $lastname != ''){
                if(stripos($employee['firstname'],$firstname) !== false && stripos($employee['lastname'],$lastname) !== false){
                    array_push($filered_data,$employee);
                }
            }elseif($firstname != '' && $lastname == ''){
                if(stripos($employee['firstname'],$firstname) !== false){
                    array_push($filered_data,$employee);
                }
            }elseif($firstname == '' && $lastname != ''){
                if(stripos($employee['lastname'],$lastname) !== false){
                    array_push($filered_data,$employee);
                }
            }else{
                array_push($filered_data,$employee);
            }
        }

?>
        <table>
        <thead>
          <tr>
            <th>Employee ID</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
          </tr>
        </thead>
         <?php
            foreach ($filered_data as $employee)
            {
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



            echo "</table>";
?>
