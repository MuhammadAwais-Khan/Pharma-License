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
              <h3 class="box-title pull-left"><?php echo ucwords('Pendency Report'); ?></h3>
              <h3 class="box-title pull-right"><?php echo 'Date: ' . date('d-m-Y'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="full_table_print" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                  <tr>
                  <th colspan="4"></th>
                  <th colspan="3" class="text-center bg-gray" >DG Drug</th>
                  <th colspan="3" class="text-center bg-blue" >Inspector</th>
                </tr>
                <tr>
                  <th width="2%">No.</th>
                  <th width="10%">Forms</th>
                  <th width="5%">Total Application</th>
                  <th width="5%">Approved</th>
                  <th width="10%">Approved for Inspection</th>
                  <th width="5%">Pending</th>
                  <th width="5%">Reject</th>
                  <th width="5%">Accept</th>
                  <th width="5%">Pending</th>
                  <th width="5%">Reject</th>
                </tr>
                </thead>
                <tbody>
        <?php for ($i = 1; $i < 5; $i++) {?>
        <tr>
          <td>1</td>
          <td>Form 8a - Pharmacy</td>
          <?php $totalApplication8a = $this->global->count('tbl_form_8a');?>
          <td><?php echo $totalApplication8a; ?></td>

          <?php $approved8a = $this->global->count('tbl_form_8a', array('status' => '4'));?>
          <td><?php echo $approved8a; ?></td>

          <?php $acceptDG8a = $this->global->count('tbl_form_8a', array('status' => '1'));?>
          <td><?php echo $acceptDG8a; ?></td>

          <?php $pendingDG8a = $this->global->count('tbl_form_8a', array('status' => '2'));?>
          <td><?php echo $pendingDG8a; ?></td>

          <?php $rejectDG8a = $this->global->count('tbl_form_8a', array('status' => '0'));?>
          <td><?php echo $rejectDG8a; ?></td>


          <?php $approvedInspector8a = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8a', 'inspection_status' => '1'));?>
          <td><?php echo $approvedInspector8a; ?></td>

          <?php $pendingInspector8a = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8a', 'inspection_status' => '2'));?>
          <td><?php echo $pendingInspector8a; ?></td>

          <?php $rejectInspector8a = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8a', 'inspection_status' => '0'));?>
          <td><?php echo $rejectInspector8a; ?></td>
        </tr>
        <?php }?>

        <tr>
          <td>2</td>
          <td>Form 8b - Retail Store</td>
          <?php $totalApplication8b = $this->global->count('tbl_form_8b');?>
          <td><?php echo $totalApplication8b; ?></td>

          <?php $approved8b = $this->global->count('tbl_form_8b', array('status' => '4'));?>
          <td><?php echo $approved8b; ?></td>

          <?php $acceptDG8b = $this->global->count('tbl_form_8b', array('status' => '1'));?>
          <td><?php echo $acceptDG8b; ?></td>

          <?php $pendingDG8b = $this->global->count('tbl_form_8b', array('status' => '2'));?>
          <td><?php echo $pendingDG8b; ?></td>

          <?php $rejectDG8b = $this->global->count('tbl_form_8b', array('status' => '0'));?>
          <td><?php echo $rejectDG8b; ?></td>


          <?php $approvedInspector8b = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8b', 'inspection_status' => '1'));?>
          <td><?php echo $approvedInspector8b; ?></td>

          <?php $pendingInspector8b = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8b', 'inspection_status' => '2'));?>
          <td><?php echo $pendingInspector8b; ?></td>

          <?php $rejectInspector8b = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8b', 'inspection_status' => '0'));?>
          <td><?php echo $rejectInspector8b; ?></td>
        </tr>

        <tr>
          <td>3</td>
          <td>Form 8c - Whole Sale</td>
          <?php $totalApplication8c = $this->global->count('tbl_form_8c');?>
          <td><?php echo $totalApplication8c; ?></td>

          <?php $approved8c = $this->global->count('tbl_form_8c', array('status' => '4'));?>
          <td><?php echo $approved8c; ?></td>

          <?php $acceptDG8c = $this->global->count('tbl_form_8c', array('status' => '1'));?>
          <td><?php echo $acceptDG8c; ?></td>

          <?php $pendingDG8c = $this->global->count('tbl_form_8c', array('status' => '2'));?>
          <td><?php echo $pendingDG8c; ?></td>

          <?php $rejectDG8c = $this->global->count('tbl_form_8c', array('status' => '0'));?>
          <td><?php echo $rejectDG8c; ?></td>


          <?php $approvedInspector8c = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8c', 'inspection_status' => '1'));?>
          <td><?php echo $approvedInspector8c; ?></td>

          <?php $pendingInspector8c = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8c', 'inspection_status' => '2'));?>
          <td><?php echo $pendingInspector8c; ?></td>

          <?php $rejectInspector8c = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8c', 'inspection_status' => '0'));?>
          <td><?php echo $rejectInspector8c; ?></td>
        </tr>

        <tr>
          <td>4</td>
          <td>Form 8d - Narcotics</td>
          <?php $totalApplication8d = $this->global->count('tbl_form_8d');?>
          <td><?php echo $totalApplication8d; ?></td>

          <?php $approved8d = $this->global->count('tbl_form_8d', array('status' => '4'));?>
          <td><?php echo $approved8d; ?></td>

          <?php $acceptDG8d = $this->global->count('tbl_form_8d', array('status' => '1'));?>
          <td><?php echo $acceptDG8d; ?></td>

          <?php $pendingDG8d = $this->global->count('tbl_form_8d', array('status' => '2'));?>
          <td><?php echo $pendingDG8d; ?></td>

          <?php $rejectDG8d = $this->global->count('tbl_form_8d', array('status' => '0'));?>
          <td><?php echo $rejectDG8d; ?></td>


          <?php $approvedInspector8d = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8d', 'inspection_status' => '1'));?>
          <td><?php echo $approvedInspector8d; ?></td>

          <?php $pendingInspector8d = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8d', 'inspection_status' => '2'));?>
          <td><?php echo $pendingInspector8d; ?></td>

          <?php $rejectInspector8d = $this->global->count('tbl_inspection', array('tbl_name' => 'tbl_form_8d', 'inspection_status' => '0'));?>
          <td><?php echo $rejectInspector8d; ?></td>
        </tr>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->

  </div>