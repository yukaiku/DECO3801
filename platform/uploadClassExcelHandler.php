<?php

require_once 'includes/dbStudent.php';
if(isset($_POST["import"]))
{
    echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");

        $count = 0;                                         // add this line
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            //print_r($emapData);
            //exit();
            $count++;                                      // add this line

            if($count>1){                                  // add this line
                $studentArray = ["firstName" => "$emapData[0]","lastname"=>"$emapData[1]","username"=>"$emapData[2]","pwd"=>"$emapData[3]","grade"=>"$emapData[4]","class"=>"$emapData[5]"];
                $studentArray = setStudentAttributes($studentArray);
                $studentCreationStatus = createStudent($studentArray);
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