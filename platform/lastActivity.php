<div id= "chatListModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" >
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Online Users</h3>
            </div>
            <div class="modal-body chatListModalBody"></div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss ="modal">Close</a>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    /* CSS used here will be applied after bootstrap.css */
    .modal-dialog{
        overflow-y: initial !important
    }
    .chatListModalBody{
        height: 250px;
        overflow-y: auto;
    }
</style>
<script type="text/javascript">
//display chat box stuff
    $(document).ready(function(){
        function make_chat_dialog_box(to_user_id, to_user_name)
        {
            var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
            $('#user_model_details').html(modal_content);
        }
        $(document).on('click', '.start_chat', function(){
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);
            $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                width:400
            });
            $('#user_dialog_'+to_user_id).dialog('open');
        });

    //updating last activity and retrieving it stuff.
    //Updates user activity every 5 seconds.

        fetch_user();

        setInterval(function(){
            update_last_activity();
            fetch_user();
        }, 5000);

        function fetch_user()
        {
            $.post("ajax/fetchOnline.php",
                {
                },function(result){
                    var result = $.parseJSON(result);
                    console.log(result.length);
                    $('#onlineButton').html("Chat (" + result.length + " Online)");
                    var string = "";
                    for(var i = 1; i <= result.length; i++){
                        string += "<div class='row'>";
                        string += "<div class='col-lg-9' style='margin-top: 3px'>Name: " + result[i-1].firstname + " " + result[i-1].lastname + " </div>";
                        string += "<div class='col-lg-3'><button class='btn btn-outline-dark'>chat</button></div>";
                        string += "</div><hr>";
                    }
                    $('.chatListModalBody').html(string);
                });
        }

        function update_last_activity()
        {
            $.ajax({
                url:"ajax/updateLastActivity.php",
                success:function(result)
                {
                    //console.log(result);
                }
            })
        }

    });
</script>