
	document.addEventListener("DOMContentLoaded", function() {
    var checkAllCheckbox = document.getElementById("checkAll");
    var reservationCheckboxes = document.querySelectorAll('input[type="checkbox"][id^="reservation_id"]');
    var confirmButtons = document.querySelectorAll('#confirm_reservation, #decline_reservation');
    var countSelectedSpan = document.getElementById("countSelected");

    function updateCountAndButtons() {
        var selectedCount = document.querySelectorAll('input[type="checkbox"][id^="reservation_id"]:checked').length;
        countSelectedSpan.textContent = (selectedCount === 0) ? "" : selectedCount + " selected";

        confirmButtons.forEach(function(button) {
            button.disabled = (selectedCount === 0);
        });

        checkAllCheckbox.checked = (selectedCount === reservationCheckboxes.length);
    }

    checkAllCheckbox.addEventListener("change", function() {
        var isChecked = checkAllCheckbox.checked;

        reservationCheckboxes.forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });

        updateCountAndButtons();
    });

    reservationCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", function() {
            updateCountAndButtons();
        });
    });
});

</script>
<script>
	function confirmSingle(reservationId){
		var confirmButton = document.getElementById('confirm_single');
		var reservation = document.getElementById('reservation');

        reservation.value=reservationId;

		var userConfirmed = confirm("Confirm this reservation?");
		if (userConfirmed) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}
	
	function declineSingle(reservationId){
		var declineButton = document.getElementById('decline_single');
		var reservation = document.getElementById('reservation');

		reservation.value=reservationId;

		var userDeclined = confirm("Decline this reservation?");
		if (userDeclined) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}

	function confirmMultiple(){
		var reservation = document.getElementById('reservation');
		var selected = document.getElementById('countSelected');
		var checkboxes = document.querySelectorAll('input[type="checkbox"][id="reservation_id"]:checked');
		var selectedValues = [];
		checkboxes.forEach(function(checkbox) {
			selectedValues.push(checkbox.value);
		});

		reservation.value = selectedValues;

		const multipleDeclined = confirm("Confirm "+ selected.textContent + " reservations?");
		if (multipleDeclined) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}

	function declineMultiple(){
		var reservation = document.getElementById('reservation');
		var selected = document.getElementById('countSelected');
		var checkboxes = document.querySelectorAll('input[type="checkbox"][id="reservation_id"]:checked');
		var selectedValues = [];
		checkboxes.forEach(function(checkbox) {
			selectedValues.push(checkbox.value);
		});

		reservation.value = selectedValues;

		const multipleDeclined = confirm("Decline "+ selected.textContent + " reservations?");
		if (multipleDeclined) {
			document.getElementById("reserveForm").submit();
		} else {
			return false;
		}
	}

