<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbAnnouncements.php';
$announcementSql = getAllAnnouncementWithTeacherName("","","10");
$announcementArr = getAnnouncementsBySql($announcementSql);
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
        <div role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4">
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
                <?php
                foreach($announcementArr as $key => $value) {
                    ?>
                    <div class="row border rounded" name="row<?=$value['id']?>">
                        <div class="text-left col-lg-10">
                            <h3><?php
                                echo $value['title'];
                                ?></h3>
                            <p><?php
                                echo $value['message'];
                                ?></p>
                            <span>
                                    <?php
                                    echo $value['timeStamp'];
                                    ?>
                                </span>

                            </span>
                        </div>
                        <?php
                        if($status == "teacher"){?>
                            <div class="col-lg-2">
                                <button class="btn-primary border rounded deleteAnnouncementButton" name="<?=$value['id']?>">Delete</button>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
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
<script type="text/javascript">
    $(document).ready(function() {
        addListener();
    });

    function addListener() {
        $('body').on('click', '.deleteAnnouncementButton', function() {
            deleteAnnouncement(this.name)
        });
    }

    function deleteAnnouncement(id){
        $.ajax({
            url:"ajax/deleteAnnouncement.php",
            method:"POST",
            data:{id:id},
            success:function(data)
            {
                var nameid = id;
                    $( "[name =row"+ nameid +"]" ).remove();
            }
        })
    }
</script>

</body>
</html>
