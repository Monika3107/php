<?php
if (isset($_REQUEST['submit'])) {
    $id        = $_REQUEST['id'];
    $email     = $_REQUEST['email'];
    $firstname = $_REQUEST['firstname'];
    $lastname  = $_REQUEST['lastname'];
    if ($id != '' && $email != '' && $firstname != '' && $lastname != '') {

        $myfile = fopen("employees.xml", "r") or die("Unable to open file!");
        $data = fread($myfile, filesize("employees.xml"));
        fclose($myfile);
        $xml = simplexml_load_string($data) or die("Error: Cannot create object");
        $employee = $xml->addChild('employee');
        $employee->addChild('employee_id', $id);
        $employee->addChild('email', $email);
        $employee->addChild('firstname', $firstname);
        $employee->addChild('lastname', $lastname);
        $xml->asXML('employees.xml');
?>
                   <div>
                    <div>

                    <h3>Success!</h3>
                    <p>Successfully added in the data List</p>
                    <a href="displayData.php"> Click to go back to main menu</a>
                    </div>
                    </div>
                    <?php
    } else {
?>
                   <p>Please Fill all the data</p>
                    <?php
    }
}


?>
