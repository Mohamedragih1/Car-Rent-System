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

    function toggleDateInputs() {
        var status = $('#status').val();
        if (status === '1') { // Check if 'Out Of Service' is selected
            $('#startDate').show();
            $('#endDate').show();
            $('#startDateLabel').show();
            $('#endDateLabel').show();
        } else {
            $('#startDate').hide();
            $('#endDate').hide();
            $('#startDateLabel').hide();
            $('#endDateLabel').hide();
        }
    }

    // Event handler for status dropdown change
    $('#status').change(function() {
        toggleDateInputs();
    });

    $('#startDate').hide();
    $('#endDate').hide();
    $('#startDateLabel').hide();
    $('#endDateLabel').hide();
    fetchCars();
});