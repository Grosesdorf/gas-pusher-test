$(document).ready(function(){
    function sendCurrentTemperature(value)
    {
        $.ajax({
            type: 'POST',
            url: '../../helper/ajaxStore.php',
            dataType: 'json',
            data: {value: value},
            success: function(json) {
                Console.log(json);
            }
        });
        Console.log('Value: ' + value);
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('11b036156bca156ca915', {
        cluster: 'eu',
        forceTLS: true
    });

    var channel = pusher.subscribe('current-temp-channel');
    channel.bind('current-temp', function(data) {

        $('#temp_value').html(data.value);
        sendCurrentTemperature(data.value);
    });
});
