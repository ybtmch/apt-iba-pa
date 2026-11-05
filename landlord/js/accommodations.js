// Get all elements with the class "btnBookmark"
var bookmarkButtons = document.querySelectorAll(".btnBookmark");

// Add click event listeners to each bookmark button
bookmarkButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    toggleBookmark(button);
  });
});

function toggleBookmark(button) {
  if (button.style.color === "grey") {
    button.style.color = "#232A3D";
  } else {
    button.style.color = "grey";
  }
}

document.querySelectorAll('.view-property .details .thumb .small-images img').forEach(images =>{
  images.onclick = () =>{
     src = images.getAttribute('src');
     document.querySelector('.view-property .details .thumb .big-image img').src = src;
  }
});


