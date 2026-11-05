<?php
use Models\Property;
use Models\Reservation;
include ("../init.php");
include ("session.php");
// print_r($stat);

if(isset($_POST['selected_month'])){
    $selected_month = $_POST['selected_month'];
} else {
    $selected_month = date('Y-m');
}
?>
<table>
						<thead>
							<tr>
								<th>Property ID</th>
								<th>Property Name</th>
                                <th>Barangay</th>
								<th>Landlord</th>
                                <th>Total Units</th>
                                <th>Occupied Units</th>
                                <th>Reservations by Month</th>
                                <th>Total Reservations</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                                $property = new Property();
                                $property->setConnection($connection);
                                $properties = $property->getPropertiesStatistics();
                                //var_dump($properties);
                                if (isset($_POST['barangay'])) {
                                    $barangay = $_POST['barangay'] ?? array();
                                
                                    if (!empty($barangay)) {
                                        $filteredProperties = array_filter($properties, function ($property) use ($barangay) {
                                            return in_array($property['barangay'], $barangay);
                                        });
                                        // Use $filteredProperties which contains filtered data based on $barangay
                                        // Do something with $filteredProperties
                                    } else {
                                        // $barangay is empty, so no filtering needed
                                        // Use $properties directly without any filtering
                                        // Do something with $properties
                                    }
                                    $properties = $filteredProperties;
                                }
                                foreach($properties as $property){
                                    $property_id = $property['property_id'];
                                    $property_name = $property['property_name'];
                                    $property_barangay = $property['barangay'];
                                    $full_name = $property['first_name'] . ' ' . $property['last_name'];
                                    $total_units = $property['total_units'];
                                    $occupied_units = $property['occupied_units'];
                                    $month_reservation = 0;
                                    $total_reservations = 0;
                                    
                                    $reservations = new Reservation();
                                    $reservations->setConnection($connection);
                                    $reservations = $reservations->getReservations($property_id);

                                    if($reservations){
                                        foreach($reservations as $reservation){
                                                $reservation_date = $reservation['reservation_date'];
                                                $reservation_month = date("Y-m", strtotime($reservation_date));
                                                
                                                    if($reservation_month === $selected_month){
                                                        $month_reservation = $month_reservation + 1;
                                                    }
                                                    $total_reservations = $total_reservations + 1;
                                            
                                        }
                                    }
                            ?>
							<tr>
								<td>
                                    <?php echo $property_id ?>
								</td>
								<td><p><a href="view?property_id=<?php echo $property_id ?>"><?php echo $property_name ?></a></p></td>
                                <td><p><?php echo $property_barangay ?></p></td>
								<td><p><?php echo $full_name ?></p></td>
                                <td><p><?php echo $total_units ?></p></td>
                                <td><p><?php echo $occupied_units ?></p></td>
                                <td><p><?php echo $month_reservation ?></p></td>
                                <td><p><?php echo $total_reservations ?></p></td>
							</tr>		
                            <?php } ?>

							
						</tbody>
					</table>