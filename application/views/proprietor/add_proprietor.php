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
    <?php echo form_open_multipart('add_proprietor', 'id="formID"'); ?>

<!--      <form id="formID" method="POST" action="" enctype="multipart/form-data"> -->
    <!-- Main content -->
    <section class="content">

      <div class="row">


<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Personal Information'); ?></h3>
          <br>
          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
              <div class="form-group">
                  <label><?php echo $label = ucwords('proprietor name'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo set_value('name'); ?>" name="name" id="name" class="form-control validate[required,minSize[5]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('name'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords(str_replace('_', ' ', 'father_name')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo set_value('father_name'); ?>" name="father_name" id="father_name" class="form-control validate[required,minSize[5]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('father_name'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords(str_replace('_', ' ', 'CNIC_no')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-id-card"></i>
                  </div>

                  <input data-mask type="text" autocomplete="off" value="<?php echo set_value('cnic_no'); ?>" name="cnic_no" id="cnic_no" class="cnic_no form-control validate[required,minSize[15],maxSize[15]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('cnic_no'); ?>
                </div>
                <div class="form-group">
                  <label><?php echo $label = ucwords('Gender'); ?>:</label>
                  <br>
                  <input type="radio" class="validate[required]" checked name="gender" id="gender" value="male"> Male
                  <input type="radio" class="validate[required]" name="gender" id="gender" value="female"> Female
                  <?php echo form_error('gender'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords(str_replace('_', ' ', 'mobile_no')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-mobile"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo set_value('mobile_no'); ?>" name="mobile_no" id="mobile_no" class="form-control validate[required,minSize[12],maxSize[12]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('mobile_no'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords(str_replace('_', ' ', 'home_address')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>

                  <textarea name="home_address" id="home_address" autocomplete="off" class="form-control validate[required,minSize[5]"></textarea>
                </div><?php echo form_error('home_address'); ?>
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
  <!-- login info start -->
  <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Business Information'); ?></h3>
          <br>


          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
<div class="box-body">
  <div class="row">
    <!-- /.col -->
    <div class="col-md-12">
      <div class="form-group">
        <label><?php echo $label = ucwords(str_replace('_', ' ', 'business_name')); ?>:</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-building-o"></i>
          </div>
          <input type="text" autocomplete="off" value="<?php echo set_value('business_name'); ?>" name="business_name" id="business_name" class="form-control validate[required,minSize[5]" placeholder="Enter <?php echo $label; ?>" />
        </div><?php echo form_error('business_name'); ?>
      </div>
      <div class="form-group">
        <label><?php echo $label = ucwords(str_replace('_', ' ', 'business_address')); ?>:</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-map-marker"></i>
          </div>
          <textarea name="business_address" id="business_address" autocomplete="off" class="form-control validate[required,minSize[5]"></textarea>
        </div><?php echo form_error('business_address'); ?>
      </div>
      <div id="dynamic_field"></div>

      <div class="col-md-12">
      <div class="form-group">
        <label>Add More proprietors</label>
        <div class="input-group">
          <button type="button" id="add_row" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
        </div>
      </div>
    </div>

    </div>
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
          <button type="submit" value="submit" name="submit" class="btn btn-success  btn-sm"><i class="fa fa-plus"> </i> Add Record</button>
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

  var i=1;
    $('#add_row').click(function(){


           i++;
           $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added">'+
            '<div class="row">'+
            '<div class="col-md-6">'+

            '<div class="form-group">'+
                  '<label><?php echo $label = ucwords('proprietor name'); ?> '+i+':</label>'+
                  '<div class="input-group">'+
                  '<div class="input-group-addon">'+
                    '<i class="fa fa-user"></i>'+
                  '</div>'+

                  '<input type="text" autocomplete="off" value="<?php echo set_value('proprietor_name'); ?>" name="proprietor_name[]" id="proprietor_name'+i+'" class="form-control validate[required,minSize[5]" placeholder="Enter <?php echo $label; ?>" />'+
                '</div><?php echo form_error('proprietor_name[]'); ?>'+
            '</div>'+
            '</div>'+

            '<div class="col-md-6">'+
            '<div class="form-group">'+
                  '<label><?php echo $label = ucwords(str_replace('_', ' ', 'CNIC_no')); ?> '+i+':</label>'+
                  '<div class="input-group">'+
                  '<div class="input-group-addon">'+
                    '<i class="fa fa-id-card"></i>'+
                  '</div>'+

                  '<input type="text" autocomplete="off" value="<?php echo set_value('proprietor_cnic_no'); ?>" name="proprietor_cnic_no[]" id="proprietor_cnic_no'+i+'" class="proprietor_cnic_no form-control validate[required,minSize[15],maxSize[15]" placeholder="Enter <?php echo $label; ?>" />'+
                  '</div><?php echo form_error('proprietor_cnic_no[]'); ?>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6">'+

                '<div class="form-group">'+
                  '<label><?php echo $label = ucwords(str_replace('_', ' ', 'mobile_no')); ?> '+i+':</label>'+
                  '<div class="input-group">'+
                  '<div class="input-group-addon">'+
                    '<i class="fa fa-mobile"></i>'+
                  '</div>'+

                  '<input type="text" autocomplete="off" value="<?php echo set_value('proprietor_mobile_no'); ?>" name="proprietor_mobile_no[]" id="proprietor_mobile_no'+i+'" class="proprietor_mobile_no form-control validate[required,minSize[12],maxSize[12]" placeholder="Enter <?php echo $label; ?>" />'+
                '</div><?php echo form_error('proprietor_mobile_no[]'); ?>'+
                '</div>'+
                '</div>'+

            '<div class="col-md-6 text-right">'+

            '<br><button type="button" name="remove" onclick="removeRow('+i+')" id="'+i+'" class="btn btn-danger btn_remove">X</button>'+
            '</div>'+
            '</div>'+
            '<hr>'+
            '</div>');
      });

  $(document).on("focus", ".proprietor_cnic_no", function() {
    $(".proprietor_cnic_no").mask("99999-9999999-9");
  });
   $(document).on("focus", ".proprietor_mobile_no", function() {
    $(".proprietor_mobile_no").mask("9999-9999999");
  });

      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });

function removeRow(tr_id)
  {
    $("#dynamic_field tbody tr#row"+tr_id).remove();
  }

</script>
<style type="text/css">

  hr {
    margin-top: 8px;
    margin-bottom: 8px;
    border: 1;
    border-top: 1px solid #008E4B;
}
</style>