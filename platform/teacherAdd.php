<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once 'includes/dbStudent.php';
include_once 'includes/dbSchool.php';
$grade = isset($_GET['grade']) ? $_GET['grade'] : '';
$class = isset($_GET['class']) ? $_GET['class'] : '';
$school = $user['school'];
$schoolInfo = getByIdSchool($user['school']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Add Class</title>

    <?php
    include 'css.php';
    ?>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="row" style="position: absolute; top: 50px">
                <?php echo "<h1>{$schoolInfo['name']}, {$grade}{$class}</h1>" ?>
            </div>
            <div clas="form-row" style="position: absolute; top: 150px; width: 80%; text-align: center;">
                <form action="uploadClassExcelHandler.php" method="post"
                      name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                    <div>
                        <input type="hidden" name="schoolId" value="<?=$schoolInfo['id'];?>">
                        <label>Choose Excel
                            File</label> <input type="file" name="file"
                                                id="file" accept=".xls,.xlsx,.csv">
                        <button type="submit" id="submit" name="import"
                                class="btn btn-success btn-submit">Import</button>

                    </div>

                </form>
            </div>
            <div class="table-responsive" style="position: absolute; top: 200px; max-height: 30%; width: 80%;">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody id="studentTableBody">

                    </tbody>
                </table>
            </div>
            <form style="position: absolute; top: 500px; width: 80%;">
                <div class="form-row row">
                    <div class="col-lg-6">
                        Username:
                        <input type="text" class="text-input--underbar width-half" name="username" id="usernameInput" placeholder="Username" value="">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-lg-6">
                        First Name:
                        <input type="text" class="text-input--underbar width-half" name="firstName" id="firstnameInput" placeholder="First" value="">
                    </div>
                    <div class="col-lg-6">
                        Last Name:
                        <input type="text" class="text-input--underbar width-half" name="lastName" id="lastnameInput" placeholder="Last" value="" style="border-width-left: 1px">
                    </div>
                </div>
                <hr>
            </form>
            <div clas="form-row" style="position: absolute; top: 625px; width: 80%; text-align: center;">
                <button  id="addStudentButton" class="btn btn-primary mb-2" style="text-align: center">Add Student</button>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn btn-primary mb-2" style="text-align: center" href="teacherMain.php">Back</a>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php
include 'lastActivity.php';
?>
<script type="text/javascript">

    $(document).ready(function() {
        var html = "";
        refreshData();

        $("#addStudentButton").click(function(){
            var username = $('#usernameInput').val();
            var firstname = $('#firstnameInput').val();
            var lastname = $('#lastnameInput').val();

            if(username != "" && lastname != "" && firstname != ""){
                addClass(username,firstname,lastname);
            }else{
                alert("Please key in all the fields");
            }

        });

        function addClass(username,firstname,lastname){
            var username = username;
            var lastname = lastname;
            var password = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            $.post("ajax/addStudent.php",
                {
                    grade: '<?= $grade?>',
                    class: '<?= $class?>',
                    school: <?= $school?>,
                    username: username,
                    lastname: lastname,
                    firstname: firstname,
                    pwd: password,
                    profileImage: "dummy.jpg"
                },
                function(result){
                    alert(result);
                    refreshData();
                });
        }

        function refreshData(){
            $.post("ajax/studentSearchFilter.php",
                {
                    grade: '<?= $grade?>',
                    class: '<?= $class?>',
                    school: <?= $school?>

                },
                function(result){
                    // console.log(result);
                    var result = $.parseJSON(result);
                    var string = "";
                    $("#studentTableBody").empty();
                    for(var i = 1; i <= result.length; i++){
                        string += "<tr>";

                        // string += "<td>";
                        // string += '<input type="checkbox" class="categoryIds" id="check1" name="category" value="' + result[i-1].id + '">';
                        // string += "</td>";

                        string += "<td>";
                        string += result[i-1].username ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].password ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].firstname ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].lastname ;
                        string += "</td>";
                        string += "<td>";
                        string += "<a href='studentProfile.php?id="+ result[i-1].id +"'>Edit</a>";
                        string += "</td>";
                        string += "</tr>";
                    }

                    $("#studentTableBody").append(string);
                    // console.log(string);

                });
        }

    });
</script>
</body>
</html>
