// const editableDiv = document.getElementById('propertyAddress');
// const submitButton = document.getElementById('submitButton');

// // Attach a click event listener to the div
// editableDiv.addEventListener('click', () => {
//     submitButton.style.display = 'block';
//     // Create a text area element
//     const textarea = document.createElement('textarea');
//     textarea.value = editableDiv.innerText;

//     // Replace the div with the textarea
//     editableDiv.replaceWith(textarea);

//     // Focus on the textarea
//     textarea.focus();

//     // Add a blur event listener to the textarea
//     textarea.addEventListener('blur', () => {
//         // Create a new div element to replace the textarea
//         const newDiv = document.createElement('div');
//         newDiv.classList.add('editable-div');
//         newDiv.id = 'propertyAddress';
//         newDiv.innerText = textarea.value;

//         // Replace the textarea with the new div
//         textarea.replaceWith(newDiv);

//         // Attach the click event listener again to the new div
//         newDiv.addEventListener('click', () => {
//             editDiv(newDiv);
//         });
//         submitButton.style.display="none";
//     });

//     // Function to make the div editable again
//     function editDiv(element) {
//         const newTextarea = document.createElement('textarea');
//         newTextarea.value = element.innerText;

//         // Replace the div with the textarea
//         element.replaceWith(newTextarea);

//         // Focus on the textarea
//         newTextarea.focus();

//         // Add a blur event listener to the textarea
//         newTextarea.addEventListener('blur', () => {
//             // Create a new div element to replace the textarea
//             const newDiv = document.createElement('div');
//             newDiv.classList.add('editable-div');
//             newDiv.id = 'propertyAddress';
//             newDiv.innerText = newTextarea.value;

//             // Replace the textarea with the new div
//             newTextarea.replaceWith(newDiv);

//             // Attach the click event listener again to the new div
//             newDiv.addEventListener('click', () => {
//                 editDiv(newDiv);
//             });
//             submitButton.style.display='block';
//         });
//     }

//     // Attach the click event listener again to the textarea
//     textarea.addEventListener('click', (event) => {
//         event.stopPropagation();
//     });

//     // Show the submit button when the div is clicked
//     submitButton.style.display = 'block';
// });

// submitButton.addEventListener('click', () => {
//     // Get the edited content
//     const editedContent = editableDiv.innerText;

//     // Add the content to a hidden input field before submitting
//     const hiddenInput = document.createElement('input');
//     hiddenInput.setAttribute('type', 'hidden');
//     hiddenInput.setAttribute('name', 'editedContent');
//     hiddenInput.setAttribute('value', editedContent);

//     // Append the hidden input to the form
//     const form = document.querySelector('form');
//     form.appendChild(hiddenInput);

//     // Submit the form
//     form.submit();
// });


// ORIGINAL

// function makeDivEditable(divElement, submitButton) {
//     divElement.addEventListener('click', () => {
//         submitButton.style.display = 'block';
//         const textarea = document.createElement('textarea');
//         textarea.value = divElement.innerText;
//         divElement.replaceWith(textarea);
//         textarea.focus();

//         textarea.addEventListener('blur', () => {
//             const newDiv = document.createElement('div');
//             newDiv.classList.add('editable-div');
//             newDiv.id = divElement.id; // Preserve the original ID
//             newDiv.innerText = textarea.value;
//             textarea.replaceWith(newDiv);

//             newDiv.addEventListener('click', () => {
//                 makeDivEditable(newDiv, submitButton); // Recreate the editable behavior
//             });
//             submitButton.style.display = 'none';
//         });

//         textarea.addEventListener('click', (event) => {
//             event.stopPropagation();
//         });

//         submitButton.addEventListener('click', () => {
//             const editedContent = newDiv.innerText;
//             const hiddenInput = document.createElement('input');
//             hiddenInput.setAttribute('type', 'hidden');
//             hiddenInput.setAttribute('name', 'editedContent');
//             hiddenInput.setAttribute('value', editedContent);

//             const form = document.querySelector('form');
//             form.appendChild(hiddenInput);
//             form.submit();
//         });
//     });
// }

// const editableDivs = document.querySelectorAll('.editable-div');
// const submitButton = document.getElementById('submitButton');

// editableDivs.forEach((divElement) => {
//     makeDivEditable(divElement, submitButton);
// });

// for HTML only
var text = document.getElementById('propertyAddress');
// for HTML only
var textName = document.getElementById('propertyName');

var savePnameButton = document.getElementById('savePnameButton');
var resetPnameButton = document.getElementById('resetPnameButton');

var savePaddressButton = document.getElementById('savePaddressButton');
var resetPaddressButton = document.getElementById('resetPaddressButton');

var savePdescriptionButton = document.getElementById('savePdescriptionButton');
var resetPdescriptionButton = document.getElementById('resetPdescriptionButton');

var savePpriceButton = document.getElementById('savePpriceButton');
var resetPpriceButton = document.getElementById('resetPpriceButton');



// for HTML only
var myData;
var postData = window.localStorage.getItem("save");
var reset = text.innerHTML;

// if no data
if (postData == null || postData == '') {
    myData = text.innerHTML;
    // store default value
    window.localStorage.setItem("save", myData);
    // make it placeholder style
    text.classList.remove('changed');
} else {
    // if there is a value post it
    text.innerHTML = postData;
    // make dark text
    text.classList.add('changed');
}

function saveChanges() {
    // store the current value
    myData = text.innerHTML;
    // local store the value
    window.localStorage.setItem("save", myData);
    text.classList.add('changed');
}

function clearStorage() {
    text.classList.remove('changed');
    // clear storage
    window.localStorage.clear("save");
    // return to default text
    text.innerHTML = reset;
}

function showPnameButtons() {
    savePnameButton.style.display = "block";
    resetPnameButton.style.display = "block";
}

function hidePnameButtons() {
    savePnameButton.style.display = "none";
    resetPnameButton.style.display = "none";
}

function showPaddressButtons() {
    savePaddressButton.style.display = "block";
    resetPaddressButton.style.display = "block";
}

function hidePaddressButtons() {
    savePaddressButton.style.display = "none";
    resetPaddressButton.style.display = "none";
}

function showPdescriptionButtons() {
    savePdescriptionButton.style.display = "block";
    resetPdescriptionButton.style.display = "block";
}

function hidePdescriptionButtons() {
    savePdescriptionButton.style.display = "none";
    resetPdescriptionButton.style.display = "none";
}

function showPpriceButtons() {
    savePpriceButton.style.display = "block";
    resetPpriceButton.style.display = "block";
}

function hidePpriceButtons() {
    savePpriceButton.style.display = "none";
    resetPpriceButton.style.display = "none";
}


const numericInput = document.getElementById('propertyPrice');

    numericInput.addEventListener('input', function(event) {
        const input = event.data || '';
        const numericInput = /^[0-9]*$/;

        if (!numericInput.test(input)) {
            event.preventDefault();
        }
    });


// document.addEventListener('DOMContentLoaded', function() {
//     const propertyPrice = document.getElementById('propertyPrice');
    
//     propertyPrice.addEventListener('click', function() {
//         const inputValue = propertyPrice.textContent;
//         const inputField = document.createElement('input');
//         inputField.classList.add('input-field');
//         inputField.value = inputValue;
    
//         propertyPrice.parentNode.replaceChild(inputField, propertyPrice);
    
//         inputField.focus();
    
//         inputField.addEventListener('blur', function() {
//         propertyPrice.textContent = inputField.value;
//         inputField.parentNode.replaceChild(propertyPrice, inputField);
//         });
//     });
//     });

const textDiv = document.getElementById('propertyPrice');
  const inputField = document.getElementById('inputField');

  textDiv.addEventListener('click', () => {
    inputField.value = textDiv.textContent;
    inputField.style.display = 'block';
    inputField.focus();
    textDiv.style.display = 'none';
  });

  inputField.addEventListener('blur', () => {
    textDiv.textContent = inputField.value;
    inputField.style.display = 'none';
    textDiv.style.display = 'block';
  });

  const numberDiv = document.getElementById('propertyPrice');
  const numberField = document.getElementById('inputField');

  numberDiv.addEventListener('click', () => {
    numberField.value = parseInt(numberDiv.textContent.replace(/,/g, '').replace('₱ ', ''), 10);
    numberField.placeholder = `₱ ${numericValue.toLocaleString('en-US')}`;
    numberField.style.display = 'block';
    numberField.focus();
    numberDiv.style.display = 'none';
  });

  numberField.addEventListener('blur', () => {
    const formattedNumber = '₱' + Number(numberField.value).toLocaleString('en-US');
    numberDiv.textContent = formattedNumber;
    numberField.style.display = 'none';
    numberDiv.style.display = 'block';
  });