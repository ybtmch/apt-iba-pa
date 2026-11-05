<?php
    use Models\Property;
    use Models\Unit;
    use Models\Detail;
    include "../init.php";
    include "session.php";

    if(isset($_POST['property_id'], $_POST['unit_id'], $_POST['available_units'])){
        $property_id = $_POST['property_id'];
        $unit_id = $_POST['unit_id'];
        $available_units = $_POST['available_units'];

        $occupy = new Unit();
        $occupy->setConnection($connection);
        $check_total = $occupy->getUnit($unit_id);
        $total = $check_total['total_units'];
        $occupied_units = intval($total) - intval($available_units);

        $occupy->occupyUnit($unit_id, $property_id, $occupied_units);
        
        $units = $occupy->getUnits($property_id);
        $total_occupied_units = 0;
        foreach($units as $unit){
            $unit_occ = $unit['occupied_units'];
            $total_occupied_units = $total_occupied_units + $unit_occ;
        }
        $detail = new Detail();
        $detail->setConnection($connection);
        $detail->updateOccupancy($property_id, $total_occupied_units);
    }
?>