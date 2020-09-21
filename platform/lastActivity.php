<div id="user_model_details"></div>
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

        //onclick stuff
        $(document).on('click', '.chatButton', function(){
            $('#chatListModal').modal('hide');
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);
            $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                width:400
            });
            $('#user_dialog_'+to_user_id).dialog('open');
        });

        $(document).on('click', '.send_chat', function(){
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_'+to_user_id).val();
            $.ajax({
                url:"ajax/insertChat.php",
                method:"POST",
                data:{to_user_id:to_user_id, chat_message:chat_message},
                success:function(data)
                {
                    $('#chat_message_'+to_user_id).val('');
                    $('#chat_history_'+to_user_id).html(data);
                }
            })
        });

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

        function displayOnlineUsers(onlineUsers){
            var string = "";
            for(var i = 1; i <= onlineUsers.length; i++){
                string += "<div class='row'>";
                string += "<div class='col-lg-9' style='margin-top: 3px'>Name: " + onlineUsers[i-1].firstname + " " + onlineUsers[i-1].lastname + " </div>";
                string += "<div class='col-lg-3'><button data-touserid='"+ onlineUsers[i-1].id + "' data-tousername='"+ onlineUsers[i-1].username + "' class='btn btn-outline-dark chatButton'>chat</button></div>";
                string += "</div><hr>";
            }
            $('.chatListModalBody').html(string);
        }

        function displayOfflineUsers(offlineUsers){
            var string = "";
            string += '<div class="modal-header">\n' +
                '                <h3 class="modal-title">Offline Users</h3>\n' +
                '            </div>';
            for(var i = 1; i <= offlineUsers.length; i++){
                string += "<div class='row'>";
                string += "<div class='col-lg-9' style='margin-top: 3px'>Name: " + offlineUsers[i-1].firstname + " " + offlineUsers[i-1].lastname + " </div>";
                string += "<div class='col-lg-3'><button data-touserid='"+ offlineUsers[i-1].id + "' data-tousername='"+ offlineUsers[i-1].username + "' class='btn btn-outline-dark chatButton'>chat</button></div>";
                string += "</div><hr>";
            }
            $('.chatListModalBody').append(string);
        }

        //chat messages functions
        function update_chat_history_data()
        {
            $('.chat_history').each(function(){
                var to_user_id = $(this).data('touserid');
                fetchUserChatHistory(to_user_id);
            });
        }

        function fetchUserChatHistory(to_user_id)
        {
            $.ajax({
                url:"ajax/fetchUserChatHistory.php",
                method:"POST",
                data:{to_user_id:to_user_id},
                success:function(data){
                    $('#chat_history_'+to_user_id).html(data);
                }
            })
        }

        //updating last activity and retrieving it stuff.
        //Updates user activity every 5 seconds.
        function fetch_user()
        {
            $.post("ajax/fetchOnline.php",
                {
                },function(result){
                    var result = $.parseJSON(result);
                    console.log(result.length);
                    $('#onlineButton').html("Chat (" + result.length + " Online)");
                    displayOnlineUsers(result)
                });
        }

        function fetch_user_offline()
        {
            $.post("ajax/fetchOffline.php",
                {
                },function(result){
                    var result = $.parseJSON(result);
                    console.log(result.length);
                    displayOfflineUsers(result)
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

        fetch_user();
        fetch_user_offline();

        setInterval(function(){
            update_last_activity();
            fetch_user();
            fetch_user_offline();
            update_chat_history_data();
        }, 5000);
    });
</script>