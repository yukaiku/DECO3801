<?php

require_once 'includes/dbStudent.php';
if(isset($_POST["import"]) && isset($_POST['schoolId']))
{
    echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");

        $count = 0;                                         // add this line
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
//            print_r($emapData[0]);
//            exit();
            $count++;                                      // add this line

            if($count>1){
                $studentArray = ["school"=>$_POST['schoolId'],"firstname" => "$emapData[1]","lastname"=>"$emapData[2]","username"=>"$emapData[3]","pwd"=>"$emapData[4]","grade"=>"$emapData[5]","class"=>"$emapData[6]"];
                $studentArray = setStudentAttributes($studentArray);
                $studentCreationStatus = createStudent($studentArray);
                //print_r($studentCreationStatus);
                if($studentCreationStatus){
                    echo "Uploaded Students";
                }else{
                    print_r($studentArray);
                }

            }                                              // add this line
        }
        fclose($file);
        echo 'CSV File has been successfully Imported';
    }
    else
        echo 'Invalid File:Please Upload CSV File';


}
?>