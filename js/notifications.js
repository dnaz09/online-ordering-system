$(document).ready(function() {
    function load_unseen_notification(view = '') {
        $.ajax({
        url:"../admin/fetch_notifications.php",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data) {
            $('#dropdown-menu').html(data.notification);
            if(data.unseen_notification > 0) {
            $('.count').html(data.unseen_notification);
            }
        }});
    }

    load_unseen_notification();
 
 
    $(document).on('click', '.dropdown-toggle', function() {
        $('.count').html('');
        load_unseen_notification('yes');
    });
 
    setInterval(function() { 
        load_unseen_notification();
    }, 5000);
});

$(document).ready(function(){
 
    function load_unseen_messages(view = '') {
        $.ajax({
        url:"../admin/fetch_message.php",
        method:"POST",
        data:{view:view},
        dataType:"json",
            success:function(data) {
                $('#dropdown-menus').html(data.messages);
                if(data.unseen_messages > 0) {
                    $('.counts').html(data.unseen_messages);
                }
            }
        });
    }
 
    load_unseen_messages();
 
 
    $(document).on('click', '.dropdown-toggle', function() {
        $('.counts').html('');
        load_unseen_messages('yes');
    });
 
    setInterval(function() { 
        load_unseen_messages();; 
    }, 5000);
});