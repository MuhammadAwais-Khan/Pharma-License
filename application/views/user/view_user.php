<?php
if ($_SESSION['user_id']) {
	$user_detail = $this->global->getRecordById($_SESSION['user_id'], $tbl_name = 'tbl_user');
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <?php $this->load->view('templates/alerts');?>

      <h1>
        <?php echo ucwords(str_replace('_', ' ', $page_title)); ?>
        <small><?php echo ucwords(str_replace('_', ' ', $description)); ?></small>
      </h1>

    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title pull-left"><?php echo ucwords('Users Detail'); ?></h3>
             <!--  <h3 class="box-title pull-right">
                <a href="<?php echo base_url(); ?>add_user" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash-o"> all </i></a></h3> -->

                <h3 class="box-title pull-right">
                  <?php if ($_SESSION['tbl_role_id'] == '1') {?>

                <a href="<?php echo base_url(); ?>add_user" type="button" class="btn btn-block btn-success btn-sm"><i class="fa fa-plus"> New </i></a><?php }?>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="full_table" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                <tr>
                  <th width="2%">Sr.</th>
                  <th width="12%">Name</th>
                  <th width="12%">Username</th>
                  <th width="10%">Role</th>
                  <th width="15%">Email</th>
                  <th width="7%">Status</th>
                  <th width="5%" class="no-print">Action</th>
                </tr>
                </thead>
                <tbody>
          <?php
$all = $view_user;
// echo '<pre>';
// print_r($all);exit;
if ($all) {
	$i = 1;
	foreach ($all as $key => $allInfo) {
		//$doEdit = base64_encode($allInfo['id']);

		?>
                      <tr>
                      <td class="TAR"><?php echo $i; ?></td>
                      <td><?php echo $allInfo['name']; ?></td>
                      <td><?php echo $allInfo['username']; ?></td>
                      <?php $getRoles = $this->global->getRecordById($allInfo['tbl_role_id'], $tbl_name = 'tbl_role');?>
                      <td><?php echo $getRoles['name']; ?></td>
                      <td><?php echo $allInfo['email']; ?></td>
                      <td><?php if ($allInfo['status'] == 1) {?>
                      <span class="label label-success">Active</span>
                    <?php } else {?>
                      <span class="label label-danger">Inactive</span>
                    <?php }?>

                  </td>
                      <td class="TAC no-print">
                      <div class="btn-group-horizontal">

                      <a href="<?php echo site_url('user/edit_user/' . safe_encode($allInfo['id'])); ?>">
                      <button type="button" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                      </a>
                      <?php if ($user_detail['id'] != $allInfo['id']) {?>

                      <!-- <a href="#">
                      <button type="button" onclick="delFunc('<?php echo $allInfo['id']; ?>','<?php echo 'tbl_user'; ?>','<?php echo 'view_user'; ?>')" id="delbtn" name="delbtn" class="btn btn-sm btn-xs btn-danger"  data-toggle="modal" data-target=".modal-danger"><i class="fa fa-trash-o"></i></button>
                      </a> -->
                    <?php }?>

									</div>
                                </td>
                            </tr>
                        <?php
$i++;
	}
}
?>
                        </tbody>
                <!-- <tfoot>
                <tr>
                  <th width="2%">Sr.</th>
                  <th width="15%">Name</th>
                  <th width="15%">Username</th>
                  <th width="10%">Role</th>
                  <th width="15%">Email</th>
                  <th width="5%">Status</th>
                  <th width="14%">Picture</th>
                  <th width="8%" class="no-print">Action</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->

  </div>


  <!-- /.content-wrapper -->
      <!-- /.del dilog box start -->

    <div class="example-modal">
        <div class="modal modal-danger" id="delete" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Record?</h4>
              </div>
              <div class="modal-body">
                <p><strong>Are you sure you want to delete this record ?</strong></p>
              </div>
              <div class="modal-footer">
                <button type="button" id="" name="" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="confirm" name="confirm" class="btn btn-outline">Del</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- /.modal -->
      </div>

<!-- for image / gallery -->
<script>
    baguetteBox.run('.tz-gallery');
</script>

<script type="text/javascript">

function delFunc(param,tbl_name,redirection)
{
  $('#confirm').on('click', function (e) {
    $('#delete').modal('hide');

    window.location.href="<?php echo base_url(); ?>common/deleteImageAndRecordByID/"+param+"/"+tbl_name+"/"+redirection+"/user";
    //window.location.href="<?php //echo base_url(); ?>common/deleteRecordByID/"+param+"/"+tbl_name+"/"+redirection;


});
}

</script>