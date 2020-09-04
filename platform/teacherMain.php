<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once  'includes/dbSchool.php';
$schoolInfo = getByIdSchool($user['school']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Home</title>

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
            <div class="row" style="position: absolute; top: 75px">
                <?php echo "<h1>{$schoolInfo['name']}</h1>" ?>
            </div>
            <div class="row" id="searchbar-row" style="position: absolute; top: 100px; width: 67%">
                <div class="col-lg-6">
                    <input id='searchClass' name='search_name' class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                            <a type="button" class="btn btn-primary" href="teacherAdd.php">Add Class</a>
                </div>
            </div>

            <div class = "row" style="position: absolute; top: 250px; width: 67%">
                <div class="col-lg-3">
                    <a type="button" class="btn btn-danger" id="deleteClass">Delete Class</a>
                </div>
            </div>
            <div class="table-responsive" style="position: absolute; top: 300px; width: 75%">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Select All</th>
                        <th>Grade</th>
                        <th>Class</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody id="classTableBody">
                    </tbody>
                </table>
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
            $.post("ajax/classSearchFilter.php",
                {
                    search: search,
                    school: <?php echo $schoolInfo['id']; ?>
                },
                function(result){
                    console.log(result);
                    var result = $.parseJSON(result);
                    var string = "";
                    $("#classTableBody").empty();
                    for(var i = 1; i <= result.length; i++){
                        string += "<tr>";

                        string += "<td>";
                        string += '<input type="checkbox" class="categoryIds" id="check1" name="category" value="' + result[i-1].id + '">';
                        string += "</td>";

                        string += "<td>";
                        string += result[i-1].grade ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].class ;
                        string += "</td>";
                        string += "<td>";
                        string += "<a href='teacherClass.php?grade="+ result[i-1].grade + "&class=" + result[i-1].class + "&school=" + result[i-1].school + "'>Edit</a>";
                        string += "</td>";
                        string += "</tr>";
                    }
                    $("#classTableBody").append(string);
                    console.log(string);

                });
        }

    });
</script>

</body>
</html>
