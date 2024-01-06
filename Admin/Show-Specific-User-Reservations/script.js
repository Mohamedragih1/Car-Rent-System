$(document).ready(function(){
    function fetchUsers() {
        $.ajax({
            type: 'POST',
            url: 'fetchUsers.php',
            success: function(response) {
                $('#User').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    fetchUsers();
});