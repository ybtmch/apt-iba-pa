// script for validation for apply property
const floatingPropertyName = document.getElementById("floatingPropertyName");
const propertyType = document.getElementsByName("property_type");
// const nextButton = document.getElementById("next2");
//const locationModal = document.getElementById("location-modal");

// Disable the button at the start
// nextButton.disabled = true;
//locationModal.disabled = true;

// Add event listeners to the input and radio button elements
floatingPropertyName.addEventListener("input", checkValidity);
for (let i = 0; i < propertyType.length; i++) {
  propertyType[i].addEventListener("change", checkValidity);
}

// Function to check the validity of the input and radio button elements
function checkValidity() {
  if (floatingPropertyName.value !== "" && getSelectedRadio(propertyType) !== null) {
    // nextButton.disabled = false;
    // locationModal.disabled = false;
  } else {
    // nextButton.disabled = true;
    // locationModal.disabled = true;
  }
}

// Function to get the selected radio button
function getSelectedRadio(radioButtons) {
  for (let i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      return radioButtons[i];
    }
  }
  return null;
}

const propertyNumber = document.getElementById("property_number");
const street = document.getElementById("street");
const firstName = document.getElementById("first_name");
const lastName = document.getElementById("last_name");
const region = document.getElementById("region");
const province = document.getElementById("province");
const city = document.getElementById("city");
const barangay = document.getElementById("barangay");
const email = document.getElementById("email");
const contactNumber = document.getElementById("contact_number");
const password = document.getElementById("password");
const confpass = document.getElementById("confpass");
// const nextButton3 = document.getElementById("next3");
// const mapModal = document.getElementById("map-modal");

// Disable the button at the start
// nextButton3.disabled = true;
// mapModal.disabled = true;

// Add event listeners to the input and select elements
propertyNumber.addEventListener("input", validateLocation);
street.addEventListener("input", validateLocation);
firstName.addEventListener("input", validateOwner);
lastName.addEventListener("input", validateOwner);
region.addEventListener("change", validateLocation);
province.addEventListener("change", validateLocation);
city.addEventListener("change", validateLocation);
barangay.addEventListener("change", validateLocation);

// Function to validate the form
function validateLocation(){
let valid = true;

  // Validate property number
  if (propertyNumber.value === "") {
    valid = false;
  }

  // Validate street
  if (street.value === "") {
    valid = false;
  }

    // Validate select tags
  if (region.value === "" || province.value === "" || city.value === "" || barangay.value === "") {
    valid = false;
  }

  nextButton3.disabled = !valid;
  mapModal.disabled = !valid;
}


    const checkboxes = document.querySelectorAll(".checkbox-input");
// const nextButton5 = document.getElementById("next5");
// const roomModal = document.getElementById("room-modal");

// Disable the button at the start
// nextButton5.disabled = true;
// roomModal.disabled = true;

// Add event listeners to the checkbox elements
for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener("change", checkValidity);
}

// Function to check the validity of the checkbox elements
function checkValidity() {
  let checked = false;
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      checked = true;
      break;
    }
  }
//   nextButton5.disabled = !checked;
//   roomModal.disabled = !checked;
}

const roomFloat = document.getElementById("roomFloat");
const furnishFloat = document.getElementById("furnishFloat");
const roomRate = document.getElementById("roomRate");
const roomNo = document.getElementById("roomNo");
// const nextButton6 = document.getElementById("next6");
// const imagesModal = document.getElementById("images-modal");

// Disable the button at the start
// nextButton6.disabled = true;
// imagesModal.disabled = true;

// Add event listeners to the select and number input elements
roomFloat.addEventListener("change", validateForm);
furnishFloat.addEventListener("change", validateForm);
roomRate.addEventListener("input", validateForm);
roomNo.addEventListener("input", validateForm);

// Function to validate the form
function validateForm() {
  let valid = true;

  // Validate roomFloat and furnishFloat
  if (roomFloat.value === "" || furnishFloat.value === "") {
    valid = false;
  }

  // Validate roomRate and roomNo
  const rateRegex = /^\d+(\.\d{1,2})?$/;
  const noRegex = /^\d+$/;
  if (!rateRegex.test(roomRate.value) || !noRegex.test(roomNo.value)) {
    valid = false;
  }

  // Enable or disable the button based on validity
//   nextButton6.disabled = !valid;
//   imagesModal.disabled = !valid;
}

const fileInput = document.getElementById("upload-input");
// const nextButton7 = document.getElementById("next7");
// const descriptionModal = document.getElementById("description-modal");

// Disable the button at the start
// nextButton7.disabled = true;
// descriptionModal.disabled = true;

// Add event listener to the file input element
fileInput.addEventListener("change", checkValidity);

// Function to check the validity of the file input element
function checkValidity() {
  if (fileInput.files.length > 0) {
    nextButton7.disabled = false;
    // descriptionModal.disabled = false;
  } else {
    nextButton7.disabled = true;
    // descriptionModal.disabled = true;
  }
}

const description = document.getElementById("description");
const totalFloors = document.getElementById("totalFloors");
const reservationFee = document.getElementById("reservationFee");
const advanceDeposit = document.getElementById("advanceDeposit");
const totalbillWater = document.getElementById("totalbillWater");
const totalbillElectric = document.getElementById("totalbillElectric");
// const nextButton8 = document.getElementById("next8");
// const rulesModal = document.getElementById("rules-modal");

// Disable the button at the start
// nextButton8.disabled = true;
// rulesModal.disabled = true;

// Add event listeners to the textarea and number input elements
description.addEventListener("input", validateForm);
totalFloors.addEventListener("input", validateForm);
reservationFee.addEventListener("input", validateForm);
advanceDeposit.addEventListener("input", validateForm);
totalbillWater.addEventListener("input", validateForm);
totalbillElectric.addEventListener("input", validateForm);

// Function to validate the form
function validateForm() {
  let valid = true;

  // Validate description
  if (description.value === "") {
    valid = false;
  }

  // Validate totalFloors, reservationFee, totalbillWater, and totalbillElectric
  const numberRegex = /^\d+(\.\d{1,2})?$/;
  if (!numberRegex.test(totalFloors.value) || !numberRegex.test(reservationFee.value) || !numberRegex.test(advanceDeposit.value) || !numberRegex.test(totalbillWater.value) || !numberRegex.test(totalbillElectric.value)) {
    valid = false;
  }

  // Enable or disable the button based on validity
//   nextButton8.disabled = !valid;
//   rulesModal.disabled = !valid;
}