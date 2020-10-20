<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbAnnouncements.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Announcements</title>

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
        <div class="col-lg-10 border rounded">
            <div class="jumbotron text-left">
                <div class="row">
                    <h1 class="col-lg-10">Announcements</h1>
                    <?php
                    if($status == "teacher"){?>
                        <div class="col-lg-2">
                                <button class="btn-primary border rounded" data-toggle="modal" data-target="#newAnnouncementModal">Add Announcements</button>
                        </div>
                        <?php
                    }
                    ?>
                    <hr>
                </div>
            </div>
            <div class="container">
                <div class="row border rounded">
                    <div class="text-left">
                        <h3>Column 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
                    </div>
                </div>
                <div class="row border rounded">
                    <div class="text-left">
                        <h3>Column 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php
include 'lastActivity.php';
include 'modals/newAnnouncementModal.php';
?>

</body>
</html>
