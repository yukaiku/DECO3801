<div class="modal fade" id="newAnnouncementModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addAnnouncementForm" class ="form-horizontal" action="addAnnouncementHandler.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4>Add Announcement</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" name="teacherId" value="<?=user['id'];?>">
                        <input type="hidden" name="status" value="0">
                    </div>
                    <div class="form-group">

                        <label for ="title" class="col-lg-2 control-label">
                            Title:
                        </label>
                        <div class="col-lg-10">

                            <input type="text" class="form-control" placeholder="Title" name="title" value="">

                        </div>

                    </div>
                    <div class="form-group">

                        <label for ="message" class="col-lg-2 control-label">
                            Message:
                        </label>
                        <div class="col-lg-10">

                            <textarea form="addAnnouncementForm" type="text" class="form-control" placeholder="Message" name="message" value=""></textarea>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss ="modal">Close</a>
                    <button class="btn btn-primary" type="submit" name="submit" value="Submit">Enter</button>
                </div>
            </form>

        </div>
    </div>
</div>

