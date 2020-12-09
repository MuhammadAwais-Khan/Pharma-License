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
    <?php validation_errors();?>
    <?php echo form_open_multipart('common/setting', 'id="formID"'); ?>

<!--      <form id="formID" method="POST" action="" enctype="multipart/form-data"> -->
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Setting Information</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-4">

                <div class="form-group">
                  <label><?php echo $label = ucwords('set auto deposite date') ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <?php $insertion_date = strtotime($all['insertion_date']);
$insertion_date = date('d-m-Y', $insertion_date);?>

                  <input type="text" readonly value="<?php echo $insertion_date; ?>" name="insertion_date" id="insertion_date" class="form-control validate[required,minSize[1]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('insertion_date'); ?>
                </div>
                <input type="hidden" name="id" id="id" value="<?php echo $all['id']; ?>">

            </div>

            <div class="col-md-4">

                <div class="form-group">
                  <label><?php echo $label = ucwords('next increment') ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                  </div>

                  <input type="text" value="<?php echo $all['increment']; ?>" name="increment" id="increment" class="form-control validate[required,minSize[1]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('increment'); ?>
                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group">
                  <label><?php echo $label = ucwords('next increment date') ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php $increment_date = strtotime($all['increment_date']);
$increment_date = date('d-m-Y', $increment_date);?>

                  <input type="text" readonly value="<?php echo $increment_date; ?>" name="increment_date" id="increment_date" class="form-control validate[required,minSize[1]]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('increment_date'); ?>
                </div>

            </div>

        </div>

        </div>

      </div>
      <!-- /.box -->



        <div class="row">
         <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" value="submit" name="submit" class="btn btn-primary  btn-sm"><i class="fa fa-plus"> </i> Update Record</button>
    <a href="<?php echo base_url(dashboard); ?>" class="btn btn-info  btn-sm" type="button"> <i class="fa fa-chevron-left"> </i> Cancel/Back</a>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<?php echo form_close(); ?>
    <!-- /.content -->
</div>
<script type="text/javascript">

$('#insertion_date').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    toggleActive: true
});



$('#increment_date').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    toggleActive: true
});

</script>
