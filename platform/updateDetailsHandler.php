<?php
require_once 'includes/checkLoginStatusForBoth.php';
require_once 'includes/uploadImageFunction.php';
if($status == "teacher"){
    require_once 'includes/dbTeacher.php';
    if (isset($_POST["update"])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $profileImage = $_FILES['profileImage'];

        $updateDetails = setTeacherAttributes($_POST);
        if($profileImage != ""){
            $uploadResult = handleImageUpload($profileImage, FOLDER_IMG, $id);
            if ($uploadResult) {
                $updateDetails['profileimage'] = $uploadResult;
                $teacherDetails = getByIdTeacher($id);
                $updatingImage = 1;
            }else{
                header("Location: teacherProfile.php?error=Upload {$uploadResult} failed");
            }
        }
        $updateResult = updateTeacher($updateDetails);
        if ($updateResult) {
            $row = getByIdTeacher($id);
            $_SESSION['teacher'] = $row; // put the record into the session
            if (file_exists("img/" . $teacherDetails['profileImage']) && $updatingImage == 1) {
                unlink("img/" . $teacherDetails['profileImage']);
            }
            header("Location: teacherProfile.php");
        }else{
            header("Location: teacherProfile.php?error=Update Failed");
        }

    } else {
        header("Location: teacherProfile.php?error=Update Failed");
    }
}else{
    require_once 'includes/dbStudent.php';
    if (isset($_POST["update"])) {
        $id = $_POST['id'];
        $profileImage = $_FILES['profileImage'];

        $updateDetails = setStudentAttributes($_POST);
        if($profileImage != ""){
            $uploadResult = handleImageUpload($profileImage, FOLDER_IMG, $id);
            if ($uploadResult) {
                $updateDetails['profileimage'] = $uploadResult;
                $studentDetails = getByIdStudent($id);
                $updatingImage = 1;
            }else{
                header("Location: studentProfile.php?id={$id}&&error=Upload {$uploadResult} failed");
            }
        }
        $updateResult = updateStudent($updateDetails);
        if ($updateResult) {
            $row = getByIdStudent($id);
            $_SESSION['student'] = $row; // put the record into the session
            if (file_exists("img/" . $studentDetails['profileImage']) && $updatingImage == 1) {
                unlink("img/" . $studentDetails['profileImage']);
            }
            header("Location: studentProfile.php?id={$id}");
        }else{
            header("Location: studentProfile.php?id={$id}&&error=Update Failed");
        }

    } else {
        header("Location: teacherProfile.php?error=Update Failed");
    }
}




?>