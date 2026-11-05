const numberInput = document.getElementById("contact_number");

        numberInput.addEventListener("input", limitInputLength);

        function limitInputLength() {
            const inputValue = numberInput.value;

            if (inputValue.startsWith("639") && inputValue.length >= 12) {
                numberInput.value = inputValue.slice(0, 12); // Truncate to 9 characters
            } else if (inputValue.startsWith("09") && inputValue.length >=11){
                numberInput.value = inputValue.slice(0, 11); // Truncate to 9 characters
            } else if (inputValue.startsWith("+639") && inputValue.length >=13){
                numberInput.value = inputValue.slice(0, 13); // Truncate to 9 characters
            }
        }