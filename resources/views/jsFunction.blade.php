<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var timeout;

    var pusher = new Pusher('3b03e4542ab580a0d689', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('data-monitoring');
    channel.bind('connection', function(data) {
        if (data) {
           $('#connecting-icon').removeClass('text-muted').addClass('text-primary'); 
           $('#status-connection').text('Conneted to :');
           $('#ip-connection').text('IP Address : ' + data.data.ip_address); 
           $('#ssid-connection').text('SSID : ' + data.data.ssid);
           $('#driver-name').text(data.data.driver);
           if (data.data.status_gps == 'true') {
               $('#gps-status').html(`Terdeteksi <i class="bi bi-check-circle text-success"></i>`);
           } else {
               $('#gps-status').html(`Tidak Terdeteksi <i class="bi bi-x-circle text-danger"></i>`);
           }
        }

        clearTimeout(timeout);

        // Set a new timeout for 5 seconds to revert to not connected
        timeout = setTimeout(setNotConnected, 60000);
    });

    function setNotConnected() {
        $('#connecting-icon').removeClass('text-primary').addClass('text-muted');
        $('#status-connection').text('Not Connected');
        $('#ip-connection').text('');
        $('#ssid-connection').text('');
        $('#driver-name').text('');
    }
</script>
<script>
    function getAkun(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('index.account') }}",
            data: {
                id: id
            },
            success: function(response) {
                console.log(response);
                $('#user-name').text((response.first_name ?? '') + ' ' + (response.last_name ?? ''));
                $('#user-dob').text(response.date_of_birth ?? '');
                $('#user-username').text(response.username ?? '');
                $('#user-password').text(response.password ?? '');
            }, error: function(xhr, status, error) {
                swal("Error", xhr.responseText, "error");
            }
        });
    }

    function logout() {
        $.ajax({
            type: "GET",
            url: "{{ route('logout') }}",
            success: function(response) {
                location.reload();
            }, error: function(xhr, status, error) {
                swal("Error", xhr.responseText, "error");
            }
        });
    }
</script>