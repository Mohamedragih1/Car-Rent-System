$(document).ready(function(){
    function fetchCars() {
        $.ajax({
            type: 'POST',
            url: 'fetchCars.php',
            success: function(response) {
                $('#Car').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    fetchCars();
});