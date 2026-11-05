function updateButtonStatus(parent) {
    var currentVal = parseInt(parent.find('input[name="quantity"]').val(), 10);
    var totalUnit = parseInt(parent.find('#total-units').val(), 10);

    $('.button-minus', parent).prop('disabled', currentVal <= 0);
    
    $('.button-plus', parent).prop('disabled', currentVal >= totalUnit);
}

function incrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).data('field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    var propertyId = parent.find('#property-id').val(); 
    var unitId = parent.find('#unit-id').val();
    var totalUnit = parseInt(parent.find('#total-units').val(), 10);

    if (!isNaN(currentVal) && currentVal < totalUnit) {
        parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        currentVal++; 
    } else {
        parent.find('input[name=' + fieldName + ']').val(0);
        currentVal = 0; 
    }

    updateButtonStatus(parent);

    occupyUnit({
        property_id: propertyId,
        unit_id: unitId,
        available_units: currentVal
    });
}


function decrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).data('field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    var propertyId = parent.find('#property-id').val(); 
    var unitId = parent.find('#unit-id').val();

    if (!isNaN(currentVal) && currentVal > 0) {
        parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
    } else {
        parent.find('input[name=' + fieldName + ']').val(0);
    }

    updateButtonStatus(parent);

    occupyUnit({
        property_id: propertyId,
        unit_id: unitId,
        available_units: currentVal - 1
    });
}

$('.input-group').on('click', '.button-plus', function(e) {
    incrementValue(e);
});

$('.input-group').on('click', '.button-minus', function(e) {
    decrementValue(e);
});

$('.input-group input[name="quantity"]').on('input', function() {
    var parent = $(this).closest('.input-group');
    updateButtonStatus(parent);
});

function occupyUnit(data){
    $.ajax({
        url: 'occupy',
        type: 'POST',
        data: data,
        success: function (response) {
        }
    });
}

// Initialize button status
$('.input-group').each(function() {
    updateButtonStatus($(this));
});
