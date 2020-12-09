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
    <?php echo form_open_multipart('form_8a/fees_form_8a', 'id="formID"'); ?>

<!--      <form id="formID" method="POST" action="" enctype="multipart/form-data"> -->
    <!-- Main content -->
    <section class="content">

      <div class="row">


<div class="col-md-12">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Fee Detail Section'); ?></h3>
          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <!-- /.col -->
            <input type="hidden" name="id" id="id" value="<?php echo $all['id']; ?>">

            <div class="col-md-6">

              <div class="form-group">
                  <label><?php echo $label = ucwords('license type'); ?>:</label>
                  <div class="input-group">
                  <?php $getFormType = $this->global->getRecordById($all['tbl_form_type_id'], 'tbl_form_type')?>
                    <?php echo $getFormType['name'] . ' (' . ucwords($all['license_type'] . ')'); ?>
                </div><?php echo form_error('amount'); ?>
                </div>


              <div class="form-group">
                  <label><?php echo $label = ucwords('Bank'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </div>
                  <select name="tbl_bank_id" id="tbl_bank_id" class="form-control select2 validate[required]">
                    <option value="">Select Bank</option>

                    <?php foreach ($bank as $bankInfo): ?>
                      <option <?php if ($bankInfo['id'] == $all['tbl_bank_id']) {echo 'selected="selected"';}?> value="<?php echo $bankInfo['id']; ?>"><?php echo $bankInfo['name']; ?></option>
                    <?php endforeach;?>
                  </select>
                </div><?php echo form_error('tbl_bank_id'); ?>
                </div>

                <div class="form-group">

                  <label><?php echo $label = ucwords('bank Branch'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </div>
                  <select name="tbl_bank_branch_id" id="tbl_bank_branch_id" class="form-control select2 validate[required]">
                    <option value="">Select Bank Branch</option>
                    <!-- data through ajax-->
                  </select>
                </div><?php echo form_error('tbl_bank_branch_id'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords('challan no'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-print"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo $all['challan_no']; ?>" name="challan_no" id="challan_no" class="form-control validate[required,minSize[1]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('challan_no'); ?>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label><?php echo $label = ucwords('Amount'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>

                  <input type="text" autocomplete="off" value="<?php echo $all['amount']; ?>" name="amount" id="amount" class="form-control validate[required,minSize[1]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('amount'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords('challan Date'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" readonly autocomplete="off" value="<?php echo $all['challan_date']; ?>" name="challan_date" id="challan_date" class="form-control validate[required,minSize[1]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('challan_date'); ?>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Fee Recipt:</label>

                  <input type="file" class="validate[funcCall[imageTypeValidation]]" name="fee_recipt" id="fee_recipt" />

          <p>For best resolution width and height Should be same </p>
          <?php echo form_error('fee_recipt'); ?>
          <input type="hidden" name="hide_fee_recipt" id="hide_fee_recipt" value="<?php echo $all['fee_recipt']; ?>" />
          <img src="<?php if ($all['fee_recipt']) {echo base_url() . IMG_UPLOAD_PATH . 'fee_recipt/' . $all['fee_recipt'];} else {echo 'http://placehold.it/100x100';}?>" height="100" width="100" id="image_upload_preview" class="img-thumbnail">


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

  <script type="text/javascript">

       $(document).ready(function() {
        $('select[id="tbl_bank_id"]').on('change', function() {
          var base_url = "<?php echo base_url(); ?>";
          var tbl_bank_id = $('#tbl_bank_id').val();
            if(tbl_bank_id) {
              $(".overlay").show();
                $.ajax({
                    url: base_url +'form_8a/fetchBankBranchesByBankID/'+tbl_bank_id,

                    type: "post",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="tbl_bank_branch_id"]').empty();
                        $('select[id="tbl_bank_branch_id"]').append('<option value="">-- Select Bank Branch --</option>');

                        $.each(data, function(key, value) {
                            $('select[id="tbl_bank_branch_id"]').append('<option value="'+ value.id +'">'+value.name+' ('+value.branch_code+') </option>');
                        });
                        $(".overlay").hide();
                    }
                });
            }else{
                $('select[id="tbl_bank_branch_id"]').empty();
                $('select[id="tbl_bank_branch_id"]').append('<option value="">Select Bank Branch</option>');
            }
        });
    });

       var base_url = "<?php echo base_url(); ?>";
          var tbl_bank_id = $('#tbl_bank_id').val();
            if(tbl_bank_id) {
              $(".overlay").show();
                $.ajax({
                    url: base_url +'form_8a/fetchBankBranchesByBankID/'+tbl_bank_id,

                    type: "post",
                    dataType: "json",
                    success:function(data) {
                        // $('select[id="tbl_bank_branch_id"]').empty();
                        // $('select[id="tbl_bank_branch_id"]').append('<option value="">-- Select Bank Branch --</option>');
                        // $('#tbl_bank_branch_id').val(data.tbl_bank_branch_id).trigger('change');



                        $.each(data, function(key, value) {
                            $('select[id="tbl_bank_branch_id"]').append('<option value="'+ value.id +'">'+value.name+' ('+value.branch_code+') </option>');

                        $('#tbl_bank_branch_id').val(value.id).trigger('change');
                        });
                        // $('#tbl_bank_branch_id').val(value.tbl_bank_branch_id).trigger('change');


                        $(".overlay").hide();
                    }
                });
            }else{
                $('select[id="tbl_bank_branch_id"]').empty();
                $('select[id="tbl_bank_branch_id"]').append('<option value="">Select Bank Branch</option>');
            }
  </script>

  <script type="text/javascript">
  $(function () {
        $('#challan_date').datetimepicker({
            useCurrent: false,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });

    });
</script>
<script>

  // image type validation
  function imageTypeValidation(field, rules, i, options)
  {
    var RegEx = /^.*\.(jpg|jpeg|png|PNG|JPEG|JPG)$/;

    if (!RegEx.test(field.val()))
    {
      var alertText = 'Only jpg, png and jpeg files are allowed';
      return alertText;
    }

  }

  // image type validation
  function fileTypeValidation(field, rules, i, options)
  {
    var RegEx = /^.*\.(PDF|pdf)$/;

    if (!RegEx.test(field.val()))
    {
      var alertText = 'Only pdf files are allowed';
      return alertText;
    }

  }

  var imageField = document.getElementById("fee_recipt");

  imageField.onchange = function() {
    if(this.files[0].size > 1000000){ // 1MB = 1000000 byte
       alert("File is too big! Not exceed from 1MB");
       this.value = "";
    };
  };


  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fee_recipt").change(function () {
        readURL(this);
    });

</script>