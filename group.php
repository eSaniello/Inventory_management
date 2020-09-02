<?php

/**
 * group.php
 *
 * @package default
 */


$page_title = 'Gebruikers groepen';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
page_require_level(1);

$all_groups = find_all('user_groups');

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
          <!--     *************************     -->
          <span class="glyphicon glyphicon-th"></span>
          <span>Gebruikers groepen</span>
          <!--     *************************     -->
        </strong>
        <a href="add_group.php" class="btn btn-info pull-right btn-sm"> Nieuwe groep toevoegen</a>
      </div>
      <!--     *************************     -->
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <!--     *************************     -->
              <th>Groep naam</th>
              <!--     *************************     -->
              <th class="text-center" style="width: 20%;">Groep level</th>
              <th class="text-center" style="width: 15%;">Status</th>
              <th class="text-center" style="width: 100px;">Acties</th>
            </tr>
          </thead>
          <tbody>


            <?php foreach ($all_groups as $a_group) : ?>

              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk(ucwords($a_group['group_name'])) ?></td>
                <td class="text-center">
                  <?php echo remove_junk(ucwords($a_group['group_level'])) ?>
                </td>
                <!--     *************************     -->
                <td class="text-center">
                  <?php if ($a_group['group_status'] === '1') : ?>
                    <span class="label label-success"><?php echo "Actief"; ?></span>
                  <?php else : ?>
                    <span class="label label-danger"><?php echo "Inactief"; ?></span>
                  <?php endif; ?>
                </td>
                <!--     *************************     -->
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_group.php?id=<?php echo (int)$a_group['id']; ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                      <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="delete_group.php?id=<?php echo (int)$a_group['id']; ?>" onClick=\"return confirm('Are you sure you want to delete?')\" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                      <i class="glyphicon glyphicon-remove"></i>
                    </a>
                  </div>
                </td>
                <!--     *************************     -->
              </tr>


            <?php endforeach; ?>


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once 'layouts/footer.php'; ?>