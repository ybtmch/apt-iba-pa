    
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

    const checkboxes = form.querySelectorAll('#room_amenities');
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

    alert("Selected values: " + hiddenInput.value);
  });
