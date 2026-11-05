$(document).ready(function () {
    // Initialize the query variable with an empty string
    var query = $('#search_bar').val();
    // Make the initial AJAX request when the page loads
    performAjax({ query: query }); // Use an empty query initially

    // Function to perform the AJAX request
    function performAjax(data) {
        $.ajax({
            url: 'search.php',
            type: 'POST',
            data: data,
            success: function (response) {
                $('#results').html(response);
            }
        });
    }

    // Listen for input changes in the search bar
    $('#search_bar').on('input', function () {
        // Update the query variable with the current search bar value
        query = $('#search_bar').val();

        // Perform AJAX request to fetch results
        performAjax({ query: query });
    });

    // Listen for form submission
    $('#filter_form').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        performAjax({
            price: $('input[name="price"]:checked').val(),
            property_type: $('input[name="property_type[]"]:checked').map(function () {
                return $(this).val();
            }).get(),
            barangay: $('input[name="barangay[]"]:checked').map(function () {
                return $(this).val();
            }).get(),
            submit_filter: $('#submit_filter').val()
        }); // Perform AJAX request when the form is submitted
    });
});