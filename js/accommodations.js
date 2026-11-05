// Get all elements with the class "btnBookmark"
var bookmarkButtons = document.querySelectorAll(".btnBookmark");

// Add click event listeners to each bookmark button
bookmarkButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    toggleBookmark(button);
  });
});

function toggleBookmark(button) {
    // Assuming "fa-solid" is initially present
    if (button.classList.contains("fa-solid")) {
      // Remove "fa-solid" and add "fa-regular"
      button.classList.remove("fa-solid");
      button.classList.add("fa-regular");
    } else {
      // Remove "fa-regular" and add "fa-solid"
      button.classList.remove("fa-regular");
      button.classList.add("fa-solid");
    }
  }

document.querySelectorAll('.view-property .details .thumb .small-images img').forEach(images =>{
  images.onclick = () =>{
     src = images.getAttribute('src');
     document.querySelector('.view-property .details .thumb .big-image img').src = src;
  }
});


