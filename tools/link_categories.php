<?php
/*
 * Links categories withrestaurants. Requires the 'raw_places' table,
 * generously provided by Zach Stein <steinz@cs.washington.edu>.
 * 
 * Run this in shell mode from the tools directory:
 *   php link_categories.php
 *
 * @author Henry Baba-Weiss <htw@cs.washington.edu>
 */
require_once '../src/web/includes/functions.php';  // Don't use common.php; it has session stuff
define('DEBUG', true);

// Grab all raw place data
$sql = 'select id, metadata_json from raw_places';
$query = db()->prepare($sql);
$query->execute();

$data = $query->fetchAll(PDO::FETCH_ASSOC);
$all_categories = array();

foreach ($data as $row)
{
	$rid = $data['id'];
	
	// Decode JSON and grab category list
	$metadata = json_decode($row['metadata_json']);
	$categories = explode(', ', $metadata->{'Category'});

	foreach ($categories as $cat)
	{
		if ($cat != 'Restaurants')
		{
			db()->beginTransaction();
			
			// Grab category ID to insert
			$sql = 'select cat_id from categories where name = ?';
			$query = db()->prepare($sql);
			$query->execute(array($cat));

			$data = $query->fetch(PDO::FETCH_ASSOC);
			$cat_id = $data['cat_id'];

			// Insert into restaurant_categories
			$query = db()->prepare('insert into restaurant_categories ' .
				'values(:rid, :cid)');
			$query->bindParam(':rid', $rid);
			$query->bindParam(':cid', $cat_id);
			$query->execute();
			
			db()->commit();
		}
	}
}

?>
