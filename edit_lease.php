<?php

/**
 * edit_lease.php
 *
 * @package default
 */


require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
$status = (int)$_GET['status'];

if ($status == 1)
    $update_lease = update_single_table_colummn('leases', (int)$_GET['id'], 'status', '0');
else if ($status == 0)
    $update_lease = update_single_table_colummn('leases', (int)$_GET['id'], 'status', '1');

if ($update_lease) {
    $session->msg("s", "Ingeleverd.");
    redirect('leases.php');
} else {
    $session->msg("d", "Iets is mis gegaan, probeer nogmaals.");
    redirect('leases.php');
}
?>
