<?php

include 'class.deploy.php';

// options

$options = array(
	'log' 			=> 'deployments.log',
	'date_format' 	=> 'Y-m-d H:i:sP',
	'branch' 		=> 'master',
	'remote' 		=> 'origin',
);

$deploy = new Deploy('/var/www/DIR', $options);

// configure post deploy

$deploy->post_deploy = function() use ($deploy) {
	exec('curl http://www.foobar.com/wp-admin/upgrade.php?step=upgrade_db');
	$deploy->log('Updating wordpress database... ');
};

// go

$deploy->execute();

?>
