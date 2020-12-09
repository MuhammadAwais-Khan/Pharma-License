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
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('form_8b/edit_dates', 'id="formID"'); ?>

<!--      <form id="formID" method="POST" action="" enctype="multipart/form-data"> -->
    <!-- Main content -->
    <section class="content">

      <div class="row">


<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('License Fee Detail'); ?></h3>
          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <!-- /.col -->
            <input type="hidden" name="id" id="id" value="<?php echo safe_encode($all['id']); ?>">
<?php $getFeesData = $this->global->getRecordByArray($all['tbl_name'], array('id' => $all['tbl_name_id']))?>
            <div class="col-md-12">
              <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                      <tr>
                        <?php $getBankData = $this->global->getRecordById($getFeesData['tbl_bank_id'], 'tbl_banks');?>
                        <td class="tdva">Bank Name :</td>
                        <td class="tdvb"><?php echo $getBankData['name']; ?></td>
                      </tr>
                      <tr>
                        <?php $getBankBranchData = $this->global->getRecordById($getFeesData['tbl_bank_branch_id'], 'tbl_bank_branch');?>
                        <td class="tdva">Bank Branch Name :</td>
                        <td class="tdvb"><?php echo $getBankBranchData['name']; ?></td>
                      </tr>
                      <tr>
                        <td class="tdva">Challan No :</td>
                        <td class="tdvb"><?php echo $getFeesData['challan_no']; ?></td>
                        </tr>
                        <tr>
                        <td class="tdva">Amount :</td>
                        <td class="tdvb"><?php echo $getFeesData['amount']; ?></td>
                      </tr>
                      <tr>
                        <td class="tdva">Challan Date :</td>
                        <td class="tdvb"><?php echo $getFeesData['challan_date']; ?></td>
                      </tr>

                      <tr>
                        <td class="tdva">Fee Recipt :</td>
                        <td class="tdvb">
                        <div class="tz-gallery">
                      <a class="lightbox" href="<?php echo base_url() . IMG_UPLOAD_PATH . 'fee_recipt/' . $getFeesData['fee_recipt']; ?>">
                      <img class="img-thumbnail" height="100px" width="50%" src="<?php echo base_url() . IMG_UPLOAD_PATH . 'fee_recipt/' . $getFeesData['fee_recipt']; ?>">
                      </a></div>


                    </td>
                      </tr>
                    </table>
                    </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>
  <!-- personal info end -->

  <!-- contact info start-->


  <!-- contact info end -->

</div>


<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('License Date Section'); ?></h3>
          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <div class="form-group">
                  <label><?php echo $label = ucwords('license type'); ?>:</label>
                  <div class="input-group">
                  <?php $getFormType = $this->global->getRecordById($all['tbl_form_type_id'], 'tbl_form_type')?>
                    <?php echo $getFormType['name'] . ' (' . ucwords($all['license_type'] . ')'); ?>
                </div><?php echo form_error('amount'); ?>
                </div>
              <div class="form-group">
                  <label><?php echo $label = ucwords('issue date'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
<?php if (isset($all['issue_date'])) {
	$issue_date = date('d-m-Y', strtotime($all['issue_date']));
}
?>

                  <input type="text" readonly autocomplete="off" value="<?php echo $issue_date; ?>" name="issue_date" id="issue_date" class="form-control validate[required,minSize[5]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('issue_date'); ?>
                </div>
                <div class="form-group">
                  <label><?php echo $label = ucwords('expiry date'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
<?php if (isset($all['expiry_date'])) {
	$expiry_date = date('d-m-Y', strtotime($all['expiry_date']));
}
?>
                  <input type="text" readonly autocomplete="off" value="<?php echo $expiry_date; ?>" name="expiry_date" id="expiry_date" class="form-control validate[required,minSize[5]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('expiry_date'); ?>
                </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>
  <!-- personal info end -->

  <!-- contact info start-->


  <!-- contact info end -->

</div>



  </div>

      <!-- /.box -->

        <div class="row">
         <!-- /.col -->
        <div class="col-xs-12 text-right">
          <button type="submit" value="submit" name="submit" class="btn btn-success  btn-sm"><i class="fa fa-refresh"> </i> Save Record</button>
    <a href="<?php echo base_url(dashboard); ?>" class="btn btn-danger  btn-sm" type="button"> <i class="fa fa-chevron-left"> </i> Cancel/Back</a>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
  </form>

    <!-- /.content -->
  </div>
<script>
    baguetteBox.run('.tz-gallery');
</script>
  <script type="text/javascript">
  $(function () {
        $('#expiry_date').datetimepicker({
            useCurrent: false,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });

    });

  $(function () {
        $('#issue_date').datetimepicker({
            useCurrent: false,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });

    });
</script>


<style type="text/css">
.tdva{
  height: 30px;
  width: 25%;
  font-weight: bold;
  vertical-align: middle !important;
}
.tdvb{
  height: 30px;
  width: 25%;
  vertical-align: middle !important;
}
</style>