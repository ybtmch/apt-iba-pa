<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Room Information Form</title>
<style>
  .room-form {
    margin-bottom: 10px;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <form action="check.php" method="POST" id="property-form">
  <div id="room-container">
    <input type="hidden" name="rooms[]" value="">
    <div class="room-fields">
      <label for="total_beds">Type of room</label>
      <select name="total_beds[]" required>
        <option value="0" selected disabled>Select Room</option>
        <option value="1">Room for one</option>
        <option value="2">Room for two</option>
        <option value="3">Room for three</option>
        <option value="4">Room for four</option>
        <option value="5">Room for five</option>
        <option value="6">Room for six</option>
        <option value="7">Room for seven</option>
        <option value="8">Room for eight</option>
      </select>
      <br>
      <label for="monthly_rent">Rate per person</label>
      <input type="text" name="monthly_rent[]" required>
      <br>
      <label for="furnished_type">Furnished type</label>
      <select name="furnished_type[]" required>
        <option value="0" selected disabled>Select Furnished Type</option>
        <option value="Furnished">Furnished</option>
        <option value="Semi-furnished">Semi-furnished</option>
        <option value="Unfurnished">Unfurnished</option>
      </select>
      <br>
      <label>Room Amenities:</label>
      <?php 
      $roomAmenities = array("aircon","cushion","drinking water","refrigerator","electric fan","wifi");
      foreach($roomAmenities as $amenity){?>
      <input type="checkbox" name="room_amenities[][<?=$amenity?>]" value="<?=$amenity?>">
      <label for="room_amenities"><?=$amenity?></label><br>
      <?php } ?>
    </div>
  </div>
  <button type="button" id="add-room">Add Another Room</button>
  <input type="hidden" id="hiddenInput" name="selected_amenities">
  <button type="submit">Submit</button>
  </form>

  <script>
  const addRoomButton = document.getElementById('add-room');
  const roomContainer = document.getElementById('room-container');
  const form = document.getElementById('property-form');

  addRoomButton.addEventListener('click', function(event) {
    event.preventDefault();

    const lastRoomFields = roomContainer.lastElementChild;
    const clonedRoomFields = lastRoomFields.cloneNode(true);
    

    // Clear input values and uncheck checkboxes of the cloned fields
    const clonedInputs = clonedRoomFields.querySelectorAll('input, select, textarea');
    clonedInputs.forEach(input => {
      if (input.type === 'checkbox') {
        input.checked = false; // Uncheck checkboxes
      } else {
        input.value = ''; // Reset other input values
      }
    });

    // Add delete button to the original fields only
    if (!clonedRoomFields.querySelector('.delete-room')) {
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete Room';
        deleteButton.classList.add('delete-room');
        clonedRoomFields.appendChild(deleteButton);
      }

    // Append the cloned fields
    roomContainer.appendChild(clonedRoomFields);
    });


  // Event delegation for delete buttons
  roomContainer.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-room')) {
      event.target.parentElement.remove();
    }
  });

  // Collect the selected amenities for each form submission
  form.addEventListener("submit", function(event) {

    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    const hiddenInput = form.querySelector('#hiddenInput');
    
    const groupedArrays = [];
    let tempArray = [];
    

    checkboxes.forEach((checkbox, index) => {
      if (checkbox.checked) {
        tempArray.push(checkbox.value);
      }
      
      if ((index + 1) % 5 === 0 || index === checkboxes.length - 1) {
        groupedArrays.push(tempArray);
        tempArray = [];
      }
    });
  
  hiddenInput.value = JSON.stringify(groupedArrays);
  });
</script>
</body>
</html>
