<?php
/**
 * Test web service.
 */

set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once 'includes/common.php';

// If file is requested directly, return the service's data encoded in JSON
if (basename(getcwd()) == basename(dirname(__FILE__)))
{
	header('Content-Type: text/plain');
	echo json_encode(service_get_data());
}

//-----------------------------------------------------------------------------
// Functions
//-----------------------------------------------------------------------------

/**
 * TODO: document this
 *
 * @return array An associative array of data for the view to display.
 */
function service_get_data()
{
	$data = array();
	$query = db()->prepare('select * from users');
	$query->execute();

	$data['test'] = $query->fetchColumn();
	return $data;
}

?>