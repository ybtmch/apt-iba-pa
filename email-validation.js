document.addEventListener("DOMContentLoaded", () => {
    const emailInput = document.getElementById("email");
    const emailError = document.getElementById("email-exist");
    const submitBtn = document.getElementById("submit");
    
    emailInput.addEventListener("input", () => {
        const email = emailInput.value;
        if (email.trim() !== "") {
            checkEmailAvailability(email);
        } else {
            emailError.textContent = "";
        }
    });

    function checkEmailAvailability(email) {
        // Send an AJAX request to the server to check if the email exists
        // You will need to implement the server-side logic in check_email.php
        fetch("check-email.php", {
            method: "POST",
            body: JSON.stringify({ email: email }),
            headers: {
                "Content-Type": "application/json",
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.emailExists) {
                emailError.textContent = "Email already exists.";
                submitBtn.disabled = true;
            } else {
                emailError.textContent = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
});
