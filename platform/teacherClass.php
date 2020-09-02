<?php
include_once 'includes/checkLoginStatusForTeacher.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once 'includes/dbStudent.php';
$grade = isset($_GET['grade']) ? $_GET['grade'] : '';
$class = isset($_GET['class']) ? $_GET['class'] : '';
$school = isset($_GET['school']) ? $_GET['school'] : '';
if($grade == "" || $class == "" || $school == ""){
    header('Location: teacherMain.php'); // redirect to the login page.
}
$studentsRecord = getByGradeClassStudent($grade, $class, $school);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Class</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("teacherSideBar.php");
        ?>
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="row" id="schoolName" style="position: absolute; top: 75px">
                <?php echo "<h1>Class {$grade}{$class} </h1>"?>
            </div>
            <div class="row" id="searchbar-row" style="position: absolute; top: 100px; width: 100%">
                <div class="col-lg-6">
                    <input id='searchClass' name='search_name' class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
                </div>
            </div>
            <div class="row" style=" overflow-y: auto; max-height: 30%; width: 80%; position:absolute; top:250px;">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="checkAll" name="selectAll" value="1">
                                Select All
                            </th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody id="studentTableBody">

                        </tbody>
                    </table>
            </div>


            <div class="row" style="position: absolute; top: 500px;">
                <hr>
                <h2>Add new class member</h2>
                <form action="addNewStudent.php" method="post">
                    <div class="form-row row">
                        <input type="hidden" name="school" value ="<?php $school ?>">
                        <div class="col-lg-3">
                            Username:
                            <input type="text" class="text-input--underbar width-half" name="username" placeholder="Username" value="">
                        </div>
                    </div>
                    <div class="form-row row">
                        <div class="col-lg-3">
                            First Name:
                            <input type="text" class="text-input--underbar width-half" name="firstName" placeholder="First" value="">
                        </div>
                        <div class="col-lg-3">
                            Last Name:
                            <input type="text" class="text-input--underbar width-half" name="lastName" placeholder="Last" value="" style="border-width-left: 1px">
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary mb-2" style="text-align: center">Confirm</button>
                        </div>
                    </div>
                    <hr>

                </form>
                <a class="btn btn-primary mb-2" style="text-align: center" href="teacherMain.php">Back</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.5.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/collapsibleSideBar.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        var search = "";
        var html = "";
        refreshData();
        $('input[name=search_name]').on('input',function(e){
            search = $(this).val();
            refreshData();
        });

        function refreshData(){
            $.post("ajax/studentSearchFilter.php",
                {
                    search: search,
                    grade: <?= $grade?>,
                    class: '<?= $class?>',
                    school: <?= $school?>

                },
                function(result){
                    console.log(result);
                    var result = $.parseJSON(result);
                    var string = "";
                    $("#studentTableBody").empty();
                    for(var i = 1; i <= result.length; i++){
                        string += "<tr>";

                        string += "<td>";
                        string += '<input type="checkbox" class="categoryIds" id="check1" name="category" value="' + result[i-1].id + '">';
                        string += "</td>";

                        string += "<td>";
                        string += result[i-1].username ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].firstname ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].lastname ;
                        string += "</td>";
                        string += "<td>";
                        string += "<a href='teacherClass.php?grade="+ result[i-1].grade + "&class=" + result[i-1].class + "&school=" + result[i-1].school + "'>Edit</a>";
                        string += "</td>";
                        string += "</tr>";
                    }

                    $("#studentTableBody").append(string);
                    console.log(string);

                });
        }

    });
</script>
</body>
</html>
