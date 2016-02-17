<?php

require_once('../includes/initialize.php');

$routes = BusRoute::find_all();
$stops = BusStop::find_all();
$buses = Bus::find_all();
$bus_personnel = BusPersonnel::find_all();
$object_type = new ObjectType();
$bp_role = new BusPersonnelRole();
$bus_route_object = new BusRoute();
$bus_object = new Bus();
$complaint_type = new ComplaintType();

$q = $_GET['q'];

$selected_complaint_type = $complaint_type->find_by_id($q);

$selected_object_type = $object_type->find_by_id($selected_complaint_type->related_object_type);

if ($selected_object_type->object_type_name == 'route') {
	
	echo '<label for="bus_route_id" class="control-label">Bus Route</label>';
	echo '<div class="controls">';
	echo '<select name="bus_route_id">';
	
	foreach ($routes as $route){
		echo '<option value="' . $route->id . '"';
		echo '>';
		echo $route->route_number;
		echo '</option>';
	}
	
	echo '</select>';
	echo '</div>';
	
} else if ($selected_object_type->object_type_name == 'stop') {
	
	echo '<label for="stop_id" class="control-label">Bus Stop</label>';
	echo '<div class="controls">';
	echo '<select name="stop_id">';
	
	foreach ($stops as $stop){
		echo '<option value="' . $stop->id . '"';
		echo '>';
		echo $stop->name;
		echo '</option>';
	}
	
	echo '</select>';
	echo '</div>';
	
} else if ($selected_object_type->object_type_name == 'bus') {
	
	echo '<label for="bus_id" class="control-label">Bus</label>';
	echo '<div class="controls">';
	echo '<select name="bus_id">';
	
	foreach ($buses as $bus){
		echo '<option value="' . $bus->id . '"';
		echo '>';
		echo $bus_route_object->find_by_id($bus->route_id)->route_number . ' - ' . $bus->reg_number;
		echo '</option>';
	}
	
	echo '</select>';
	echo '</div>';
	
} else if ($selected_object_type->object_type_name == 'bus_personnel') {
	
	echo '<label for="bus_personnel_id" class="control-label">Bus Personnel</label>';
	echo '<div class="controls">';
	echo '<select name="bus_personnel_id">';
	
	foreach ($bus_personnel as $bp){
		echo '<option value="' . $bp->id . '"';
		echo '>';
		echo $bp->full_name() . ' - ' . $bp_role->find_by_id($bp->role)->role_name;
		echo '</option>';
	}
	
	echo '</select>';
	echo '</div>';
	
}

?>