<?php

/**
 * users.php
 *
 * @package default
 */


?>

<?php
$page_title = 'All User';
require_once 'includes/load.php';
?>

<?php
// Checkin What level user has permission to view this page
page_require_level(1);
//pull out all user form database

$all_leases = find_all_leases();

?>

<?php include_once 'layouts/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<!--     *************************     -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Uitleningen</span>
                    <!--     *************************     -->
                </strong>
                <a href="add_lease.php" class="btn btn-info pull-right">Nieuwe uitleen</a>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <!--     *************************     -->
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Datum </th>
                            <th>Naam </th>
                            <th>Afdeling</th>
                            <th>Product</th>
                            <th>Aantal</th>
                            <th>Reden</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <!--     *************************     -->
                    </thead>
                    <tbody>
                        <!--     *************************     -->
                        <?php foreach ($all_leases as $lease) : ?>
                            <tr>
                                <td class="text-center"><?php echo count_id(); ?></td>
                                <td><?php echo read_date($lease['date']) ?></td>
                                <td><?php echo remove_junk(ucwords($lease['fullname'])) ?></td>
                                <td class="text-center"><?php echo remove_junk(ucwords($lease['department'])) ?></td>
                                <td><?php echo remove_junk(ucwords($lease['name'])) ?></td>
                                <td><?php echo remove_junk(ucwords($lease['number'])) ?></td>
                                <td><?php echo remove_junk(ucwords($lease['reason'])) ?></td>
                                <!--     *************************     -->
                                <td class="text-center">
                                    <?php if ($lease['status'] === '1') : ?>
                                        <span class="label label-success"><?php echo "Ingeleverd"; ?></span>
                                    <?php else : ?>
                                        <span class="label label-danger"><?php echo "Niet ingeleverd"; ?></span>
                                    <?php endif; ?>
                                </td>
                                <!--     *************************     -->
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit_lease.php?id=<?php echo (int)$lease['id'] . "&status=" . (int)$lease['status']; ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Ingeleverd">
                                            <i class="glyphicon glyphicon-check"></i>
                                        </a>
                                        <a href="delete_lease.php?id=<?php echo (int)$lease['id']; ?>" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </div>
                                </td>
                                <!--     *************************     -->
                            </tr>
                        <?php endforeach; ?>
                        <!--     *************************     -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once 'layouts/footer.php'; ?>