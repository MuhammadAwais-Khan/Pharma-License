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
    <?php echo form_open_multipart('inspection/edit_inspection', 'id="formID"'); ?>

<!--      <form id="formID" method="POST" action="" enctype="multipart/form-data"> -->
    <!-- Main content -->
    <section class="content">

      <div class="row">


<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('general information'); ?></h3>
          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <?php
$getApplication = $this->global->getRecordById($all['tbl_name_id'], $tbl_name = $all['tbl_name']);

$getFormType = $this->global->getRecordById($getApplication['tbl_form_type_id'], $tbl_name = 'tbl_form_type');

$getDistrict = $this->global->getRecordById($getApplication['tbl_district_id'], $tbl_name = 'tbl_district');

$getProprietor = $this->global->getRecordById($getApplication['tbl_proprietor_id'], $tbl_name = 'tbl_proprietor');

$getPharmacist = $this->global->getRecordById($getApplication['tbl_pharmacist_id'], $tbl_name = 'tbl_pharmacist');
?>
            <input type="hidden" name="id" id="id" value="<?php echo $all['id']; ?>">

            <!-- <input type="hidden" name="tbl_name" id="tbl_name" value="<?php echo $all['tbl_name']; ?>"> -->

            <!-- <input type="hidden" name="tbl_name_id" id="tbl_name_id" value="<?php echo $all['tbl_name_id']; ?>"> -->

            <!-- <input type="hidden" name="tbl_form_type_id" id="tbl_form_type_id" value="<?php echo $all['tbl_form_type_id']; ?>"> -->

            <div class="col-md-12">

              <div class="form-group">
                  <label><?php echo $label = ('Name of the Premises') ?>:</label>
                  <div class="input-group">
                    <?php echo $getProprietor['business_name']; ?>
                </div>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ('Business Address') ?>:</label>
                  <div class="input-group">
                    <?php echo $getProprietor['business_address']; ?>
                </div>
                </div>

                <div class="form-group">
                  <label><?php echo $label = (str_replace('_', ' ', 'Date of Inspection')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php if ($all['inspection_date']) {
	$inspection_date = date('d-m-Y', strtotime($all['inspection_date']));
}
?>


                  <input type="text" autocomplete="off" readonly value="<?php echo $inspection_date ?>" name="inspection_date" id="inspection_date" class="form-control validate[required,minSize[3]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('inspection_date'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = (str_replace('_', ' ', 'Reason of Inspection')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-info-circle"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo $all['inspection_reason']; ?>" name="inspection_reason" id="inspection_reason" class="form-control validate[required,minSize[3]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('inspection_reason'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ('Type of License') ?>:</label>
                  <div class="input-group">
                    <?php echo $getFormType['name'] . ' (' . $all['license_type'] . ')'; ?>
                </div>
                </div>

                <div class="form-group">
                  <label><?php echo $label = (str_replace('_', ' ', 'Validity of License (if renewal)')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-id-card"></i>
                  </div>
                  <?php if ($all['license_validity']) {
	$license_validity = date('d-m-Y', strtotime($all['license_validity']));
}
?>

                  <input type="text" readonly autocomplete="off" value="<?php echo $license_validity ?>" name="license_validity" id="license_validity" class="form-control validate[minSize[3]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('license_validity'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ('Name of Proprietor') ?>:</label>
                  <div class="input-group">
                    <?php echo $getProprietor['name']; ?>
                </div>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ('Name of Qualified Person') ?>:</label>
                  <div class="input-group">
                    <?php echo $getPharmacist['name']; ?>
                </div>
                </div>


                <div class="form-group">
                  <label><?php echo $label = ('Proprietor & Qualified Persons are Present') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['proprieter_qualified_present'] == '0') {echo 'checked="checked"';}?> type="radio" name="proprieter_qualified_present" value="0"> No
                    <input class="validate[required]" <?php if ($all['proprieter_qualified_present'] == '1') {echo 'checked="checked"';}?> type="radio" name="proprieter_qualified_present" value="1"> Yes
                </div><?php echo form_error('proprieter_qualified_present'); ?>
                </div>

            </div>
            <!-- /.col -->

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>


</div>

<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('outlook'); ?></h3>
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
                  <label><?php echo $label = ('Sign Board according to Specification Installed') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['sign_board'] == '0') {echo 'checked="checked"';}?> type="radio" name="sign_board" value="0"> No
                    <input class="validate[required]" <?php if ($all['sign_board'] == '1') {echo 'checked="checked"';}?> type="radio" name="sign_board" value="1"> Yes
                </div><?php echo form_error('sign_board'); ?>
                </div>


                <div class="form-group">
                  <label><?php echo $label = (str_replace('_', ' ', 'Area of Permises in square feet')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-area-chart"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo $all['area']; ?>" name="area" id="area" class="form-control validate[required,minSize[1]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('area'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = (str_replace('_', ' ', 'Front Area')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-area-chart"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo $all['front_area']; ?>" name="front_area" id="front_area" class="form-control validate[required,minSize[1]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('front_area'); ?>
                </div>

            </div>
            <!-- /.col -->

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>


</div>

<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Premises'); ?></h3>
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
                  <label><?php echo $label = ('Is the Premises Protected from dust/insect/rodents/other') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['protected'] == '0') {echo 'checked="checked"';}?> type="radio" name="protected" value="0"> No
                    <input class="validate[required]" <?php if ($all['protected'] == '1') {echo 'checked="checked"';}?> type="radio" name="protected" value="1"> Yes
                </div><?php echo form_error('protected'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ('Thermometer/Hygrometer Installed') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['thermometer'] == '0') {echo 'checked="checked"';}?> type="radio" name="thermometer" value="0"> No
                    <input class="validate[required]" <?php if ($all['thermometer'] == '1') {echo 'checked="checked"';}?> type="radio" name="thermometer" value="1"> Yes
                </div><?php echo form_error('thermometer'); ?>
                </div>



                <div class="form-group">
                  <label><?php echo $label = ('Cold Chain Facility Available') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['cool_chin'] == '0') {echo 'checked="checked"';}?> type="radio" name="cool_chin" value="0"> No
                    <input class="validate[required]" <?php if ($all['cool_chin'] == '1') {echo 'checked="checked"';}?> type="radio" name="cool_chin" value="1"> Yes
                </div><?php echo form_error('cool_chin'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ('Adequate lightening facility available') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['adequate_light'] == '0') {echo 'checked="checked"';}?> type="radio" name="adequate_light" value="0"> No
                    <input class="validate[required]" <?php if ($all['adequate_light'] == '1') {echo 'checked="checked"';}?> type="radio" name="adequate_light" value="1"> Yes
                </div><?php echo form_error('adequate_light'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ('The permises is properly painted') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['painted'] == '0') {echo 'checked="checked"';}?> type="radio" name="painted" value="0"> No
                    <input class="validate[required]" <?php if ($all['painted'] == '1') {echo 'checked="checked"';}?> type="radio" name="painted" value="1"> Yes
                </div><?php echo form_error('painted'); ?>
                </div>



            </div>
            <!-- /.col -->

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>


</div>

<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Drug Storage'); ?></h3>
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
                  <label><?php echo $label = ('Type of Almiras') ?>:</label>
                  <div class="input-group">
                    <input class="validate[]" <?php if ($all['almiras_wooden'] == '1') {echo 'checked="checked"';}?> type="checkbox" name="almiras_wooden" value="1"> Almiras Wooden
                    <?php echo form_error('almiras_wooden'); ?>
                    <br>
                    <input class="validate[]" <?php if ($all['almiras_glass'] == '1') {echo 'checked="checked"';}?> type="checkbox" name="almiras_glass" value="1"> Almiras Glass
                    <?php echo form_error('almiras_glass'); ?>
                    <br>
                    <input class="validate[]" <?php if ($all['almiras_metal'] == '1') {echo 'checked="checked"';}?> type="checkbox" name="almiras_metal" value="1"> Almiras Metal
                    <?php echo form_error('almiras_metal'); ?>
                </div>
                </div>



            </div>
            <!-- /.col -->

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>


</div>



<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Details'); ?></h3>
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
                  <label><?php echo $label = ('Inspection Status') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['inspection_status'] == '0') {echo 'checked="checked"';}?> type="radio" name="inspection_status" value="0"> Rejected / Not Approved
                    <br>
                    <input class="validate[required]" <?php if ($all['inspection_status'] == '1') {echo 'checked="checked"';}?> type="radio" name="inspection_status" value="1"> Approved
                    <br>
                    <input class="validate[required]" <?php if ($all['inspection_status'] == '2') {echo 'checked="checked"';}?> type="radio" name="inspection_status" value="2"> Pending / Inprocess
                </div><?php echo form_error('inspection_status'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = (str_replace('_', ' ', 'Inspection Remarks')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-comments"></i>
                  </div>
                  <textarea autocomplete="off" name="inspection_remarks" id="inspection_remarks" class="form-control validate[required,minSize[3]]" ><?php echo $all['inspection_remarks']; ?></textarea>

                </div><?php echo form_error('inspection_remarks'); ?>
                </div>
            </div>
            <!-- /.col -->

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>


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

<script type="text/javascript">
  $(function () {
        $('#inspection_date').datetimepicker({
            useCurrent: false,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });

    });

  $(function () {
        $('#license_validity').datetimepicker({
            useCurrent: false,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });

    });
</script>