<?php
// $admin_detail = $this->admin->getRecordById($_SESSION['admin_id'], $tbl_name = 'tbl_admin');
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

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <?php foreach ($all as $key => $allInfo) {
	?>


            <!-- timeline time label -->
            <li class="time-label">

          <?php if ($allInfo['action_type'] == 'add') {?>

                  <span class="bg-blue">
                    <?php echo date("d-m-Y", strtotime($allInfo['record_add_date'])); ?>
                  </span>

          <?php } else if ($allInfo['action_type'] == 'update') {?>

                  <span class="bg-green">
                    <?php echo date("d-m-Y", strtotime($allInfo['record_add_date'])); ?>
                  </span>

          <?php }?>

            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <?php if ($allInfo['action_type'] == 'add') {echo '<i class="fa fa-plus bg-blue"></i>';} else if ($allInfo['action_type'] == 'update') {echo '<i class="fa fa-refresh bg-green"></i>';}?>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("d-m-Y h:i:s a", strtotime($allInfo['record_add_date'])); ?></span>

                <?php $getUser = $this->global->getRecordById($allInfo['record_add_by'], $tbl_name = 'tbl_user');?>

                <h3 class="timeline-header">Record <?php echo $allInfo['action_type']; ?> by <?php echo $getUser['name']; ?> </h3>


                <div class="timeline-footer">
                  <?php if ($allInfo['action_type'] == 'add') {
		?>

                  <span>
                    <a class="btn btn-primary btn-xs"><?php echo ucwords($allInfo['action_type']) . ' : Detail of Record'; ?></a>
                    <?php if ($allInfo['license_type']) {?>
<a class="btn btn-primary btn-xs">License Type : <?php echo ucwords($allInfo['license_type']); ?></a>
<?php }?>

      <?php if ($allInfo['status'] == '0') {
			echo '<a class="btn btn-danger btn-xs">Status: Rejected / Not Approved</a>';} else if ($allInfo['status'] == '1') {
			echo '<a class="btn btn-success btn-xs">Status: Approved</a>';} else if ($allInfo['status'] == '2') {
			echo '<a class="btn btn-primary btn-xs">Status: Pending / In process</a>';}?>
      <br>

      <?php if ($allInfo['assign_to'] == '0') {$assign_to = 'DG Drug';} else {
			?>

      <?php $getUserDetail = $this->global->getRecordById($allInfo['assign_to'], $tbl_name = 'tbl_user');
			$assign_to = $getUserDetail['name'];
		}?>


      Record <?php echo $allInfo['action_type']; ?> by Applicant (<?php echo $getUser['name']; ?>) on <?php echo date("d-m-Y", strtotime($allInfo['status_date'])); ?>, assign to <?php echo $assign_to; ?> on <?php echo date("d-m-Y", strtotime($allInfo['assign_date'])); ?>
      </span>



                  <?php } else if ($allInfo['action_type'] == 'update') {
		?>

                  <span>
                    <a class="btn btn-success btn-xs"><?php echo ucwords($allInfo['action_type']) . ' : Detail of Record'; ?></a>
                    <?php if ($allInfo['license_type']) {?>
<a class="btn btn-primary btn-xs">License Type : <?php echo ucwords($allInfo['license_type']); ?></a>
<?php }?>
                    <?php if ($allInfo['status'] == '0') {
			echo '<a class="btn btn-danger btn-xs">Status: Rejected / Not Approved</a>';
		} else if ($allInfo['status'] == '1') {
			echo '<a class="btn btn-success btn-xs">Status: Approved</a>';
		} else if ($allInfo['status'] == '2') {
			echo '<a class="btn btn-primary btn-xs">Status: Pending / In process</a>';}?>
      <br>

      <?php if ($allInfo['assign_to'] == '0') {$assign_to = 'DG Drug';}
		// if ($allInfo['status'] == '0') {$assign_to = 'Rejected';}
		else {
			?>

      <?php $getUserDetail = $this->global->getRecordById($allInfo['assign_to'], $tbl_name = 'tbl_user');
			$assign_to = $getUserDetail['name'];
		}?>


      Record <?php echo $allInfo['action_type']; ?> by <?php echo $getUser['name']; ?> on <?php echo date("d-m-Y", strtotime($allInfo['status_date'])); ?>, assign to <?php echo $assign_to; ?> on <?php echo date("d-m-Y", strtotime($allInfo['assign_date'])); ?>

                  </span>

                  <?php }?>
                </div>

                <div class="timeline-body">
                  <div class="box-body table-responsive">
              <table id="ssp_datatable" class="table table-bordered table-striped table-hover table-condensed">
                <?php echo $allInfo['remarks']; ?>
              </table></div>

                </div>
              </div>
            </li>
          <?php }?>



            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- /.row -->

    </section>
    <!-- /.content -->

  </div>