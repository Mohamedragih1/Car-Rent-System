document.addEventListener("DOMContentLoaded", function() {

    var pickupDate = document.getElementById("pickupDate");
    var returnDate = document.getElementById("pickupDate");
    var currentDate = new Date();
    var formattedDate = currentDate.toISOString().slice(0,10);
    pickupDate.value = formattedDate;
    returnDate.value = formattedDate;
  });

  function retrieveDates() {
    fetch("makeReservation.php")
      .then(response => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json(); // parse JSON response
      })
      .then(data => {
        // Process the retrieved data here
        alert("Pickup Date: " + data.pickup-date + "\nReturn Date: " + data.return-date);
      })
      .catch(error => console.error("Error:", error));
  }
