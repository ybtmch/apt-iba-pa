document.addEventListener("DOMContentLoaded", function() {
    const propertyInput = document.getElementById("property_name");
    const postalCodeInput = document.getElementById("postal_code");
    const totalFloorsInput = document.getElementById("total_floors");
    const totalRoomsInput = document.getElementById("total_rooms");
    const monthlyRentInput = document.getElementById("monthly_rent");
    const reservationFeeInput = document.getElementById("reservation_fee");
    const advanceDepositInput = document.getElementById("advance_deposit");
    const propertyNumberInput = document.getElementById("property_number");
    const streetInput = document.getElementById("street");
    const descriptionInput = document.getElementById("description");
    const totalBedsSelect = document.getElementById("total_beds");
    const furnishedTypeSelect = document.getElementById("furnished_type");
    const minWeeksSelect = document.getElementById("min_weeks");
    const fromCurfewSelect = document.getElementById("from_curfew");
    const toCurfewSelect = document.getElementById("to_curfew");
    const curfewRadioYes = document.getElementById("withCurfew");
    const regionSelect = document.getElementById("region");
    const provinceSelect = document.getElementById("province");
    const citySelect = document.getElementById("city");
    const barangaySelect = document.getElementById("barangay");
    const submitButton = document.getElementById("submit-button");
  
    function isValidNumberInput(input) {
      return /^[1-9][0-9]*$/.test(input.value);
    }
  
    function areLocationSelectsValid() {
      return (
        regionSelect.value !== "" &&
        provinceSelect.value !== "" &&
        citySelect.value !== "" &&
        barangaySelect.value !== ""
      );
    }
  
    function areSelectsValid() {
      return (
        totalBedsSelect.value !== "" &&
        furnishedTypeSelect.value !== "" &&
        minWeeksSelect.value !== "" &&
        (curfewRadioYes.checked ? (fromCurfewSelect.value !== "" && toCurfewSelect.value !== "") : true) &&
        areLocationSelectsValid()
      );
    }
  
    function areNumberInputsValid() {
      return (
        isValidNumberInput(postalCodeInput) &&
        isValidNumberInput(totalFloorsInput) &&
        isValidNumberInput(totalRoomsInput) &&
        isValidNumberInput(monthlyRentInput) &&
        isValidNumberInput(reservationFeeInput) &&
        isValidNumberInput(advanceDepositInput)
      );
    }
  
    function areTextInputsValid() {
      return (
        propertyInput.value.trim() !== "" &&
        propertyNumberInput.value.trim() !== "" &&
        streetInput.value.trim() !== "" &&
        descriptionInput.value.trim() !== ""
      );
    }
  
    function updateSubmitButtonState() {
      const areInputsValid = areNumberInputsValid() && areSelectsValid() && areTextInputsValid();
  
      submitButton.disabled = !areInputsValid;
    }
  
    [propertyInput, postalCodeInput, totalFloorsInput, totalRoomsInput, monthlyRentInput, reservationFeeInput, advanceDepositInput, propertyNumberInput, streetInput, descriptionInput].forEach(input => {
      input.addEventListener("input", updateSubmitButtonState);
    });
  
    [totalBedsSelect, furnishedTypeSelect, minWeeksSelect, fromCurfewSelect, toCurfewSelect, regionSelect, provinceSelect, citySelect, barangaySelect].forEach(select => {
      select.addEventListener("change", updateSubmitButtonState);
    });
  
    [curfewRadioYes].forEach(radio => {
      radio.addEventListener("change", updateSubmitButtonState);
    });
  });
  
  //for checkboxes
// document.addEventListener("DOMContentLoaded", function() {
//   const amenitiesCheckboxes = document.querySelectorAll("[name='amenities[]']");
//   const roomAmenitiesCheckboxes = document.querySelectorAll("[name^='room_amenities']");

//   const submitButton = document.getElementById("submit-button");

//   function updateSubmitButtonState() {
//     const areAmenitiesChecked = Array.from(amenitiesCheckboxes).some(checkbox => checkbox.checked);
//     const areRoomAmenitiesChecked = Array.from(roomAmenitiesCheckboxes).some(checkbox => checkbox.checked);
    
//     submitButton.disabled = !(areAmenitiesChecked && areRoomAmenitiesChecked);
//   }

//   amenitiesCheckboxes.forEach(checkbox => {
//     checkbox.addEventListener("change", updateSubmitButtonState);
//   });

//   roomAmenitiesCheckboxes.forEach(checkbox => {
//     checkbox.addEventListener("change", updateSubmitButtonState);
//   });
// });

