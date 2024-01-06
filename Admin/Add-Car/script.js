$(document).ready(function(){
    function fetchLocations() {
        $.ajax({
            type: 'POST',
            url: 'fetchLocations.php',
            success: function(response) {
                $('#Location').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    fetchLocations();
});