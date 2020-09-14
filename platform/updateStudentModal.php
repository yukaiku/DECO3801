<div class="modal fade" id="updateDetailsModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class ="form-horizontal" action="handler/updateStudentHandler.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4>Update Details</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" name="id" value="<?=$studentInfo['id'];?>">
                        <input type="hidden" name="statustype" value="<?=$status?>">
                    </div>
                    <div class="form-group">

                        <label for ="name" class="col-lg-2 control-label">
                            Nickname:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" class="form-control" id="contact-name" placeholder="nick name" name="nickname" value="<?= $studentInfo['nickname']; ?>">

                        </div>

                    </div>
                    <div class="form-group">

                        <label for ="name" class="col-lg-2 control-label">
                            Password:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" class="form-control" id="contact-name" placeholder="password" name="pwd" value="<?= $studentInfo['password']; ?>">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for ="profileImage" class="col-lg-4 control-label">
                            Profile Image:
                        </label>
                        <div class="col-lg-8">

                            <input type="file" name="profileImage" /></br>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss ="modal">Close</a>
                    <button class="btn btn-primary" type="submit" name="update" value="Submit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

