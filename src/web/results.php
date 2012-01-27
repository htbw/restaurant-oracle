<?php
/**
 * Results front-end controller.
 * 
 *  @author Laure Thompson <laurejt@cs.washington.edu>
 */

require_once 'includes/common.php';
require_once 'services/results.php';
require_once 'views/results.php';

// Get group/user id from post form
$group = $_POST['group'];

page_header('Results');
page_body(service_get_results($group));
page_footer();

?>
