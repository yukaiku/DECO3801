
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Add Class</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/teacher.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("teacherSideBar.php");
        ?>
        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="row" id="schoolName">
                <h1><b>School: </b> U Q HI</h1>
            </div>
            <form>
                <div class="form-row row">
                    <div class="col-lg-6">
                        Username:
                        <input type="text" class="text-input--underbar width-half" name="username" placeholder="Username" value="">
                    </div>
                    <div class="col-lg-3">
                        Grade:
                        <select class="text-input--underbar width-half" name="grade">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        Class:
                        <select class="text-input--underbar width-half" name="class">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                        </select>
                    </div>



                </div>
                <div class="form-row row">
                    <div class="col-lg-6">
                        First Name:
                        <input type="text" class="text-input--underbar width-half" name="firstName" placeholder="First" value="">
                    </div>
                    <div class="col-lg-6">
                        Last Name:
                        <input type="text" class="text-input--underbar width-half" name="lastName" placeholder="Last" value="" style="border-width-left: 1px">
                    </div>
                </div>
                <hr>
                <div clas="form-row" style="text-align: center">
                    <button type="submit" class="btn btn-primary mb-2" style="text-align: center">Confirm</button>
                </div>

            </form>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Header</th>
                        <th>Header</th>
                        <th>Header</th>
                        <th>Header</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1,001</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td>sit</td>
                    </tr>
                    <tr>
                        <td>1,001</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td>sit</td>
                    </tr>
                    </tbody>
                </table>
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
<script src="js/jquery-3.5.0.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
