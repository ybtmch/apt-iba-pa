<?php
var_dump($_POST);


?>
<head>
    <!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<form action="test" id="propertyForm">
<select name="property" id="propertySelect">
    <option selected disabled>Choose a property</option>
    <option name="property_name" value="1" >Choose a property 1</option>
    <option name="property_name" value="2" >Choose a property 2</option>
</select>
</form>
<script>
                                
$(document).ready(function() {
        $('#propertySelect').change(function() {
            // Submit the form when an option is selected
            $('#propertyForm').submit();
        });
    });
</script>