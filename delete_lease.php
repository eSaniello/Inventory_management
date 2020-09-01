<?php

/**
 * delete_lease.php
 *
 * @package default
 */


require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
$delete_id = delete_by_id('leases', (int)$_GET['id']);
if ($delete_id) {
    $session->msg("s", "Uitleen verwijderd.");
    redirect('leases.php');
} else {
    $session->msg("d", "Iets is mis gegaan, probeer nogmaals.");
    redirect('leases.php');
}
?>
