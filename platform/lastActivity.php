<script>
    //Updates user activity every 5 seconds.
    $(document).ready(function(){

        fetch_user();

        setInterval(function(){
            update_last_activity();
            fetch_user();
        }, 5000);

        function fetch_user()
        {
            $.ajax({
                url:"ajax/fetchOnline.php",
                method:"POST",
                success:function(data){
                    //$('#user_details').html(data);
                    console.log("online users");
                    console.log(data);
                }
            })
        }

        function update_last_activity()
        {
            $.ajax({
                url:"ajax/updateLastActivity.php",
                success:function(result)
                {
                    console.log(result);
                }
            })
        }

    });
</script>