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
    <?php echo form_open_multipart('form_8d/edit_dg', 'id="formID"'); ?>

<!--      <form id="formID" method="POST" action="" enctype="multipart/form-data"> -->
    <!-- Main content -->
    <section class="content">

      <div class="row">


<div class="col-md-12">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">

        <?php $getFormType = $this->global->getRecordById($all['tbl_form_type_id'], 'tbl_form_type');?>

          <h3 class="box-title"><?php echo ucwords('Applicant Detail'); ?> - <?php echo $getFormType['name']; ?></h3>
          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">



            <div class="col-md-6">
              <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                      <tr>
                        <td colspan="3" class="tdva"><span style="color: green;">Proprietor Detail</span></td>
                      </tr>
                      <?php $getProprietor = $this->global->getRecordById($all['tbl_proprietor_id'], 'tbl_proprietor');?>

                      <tr>
                        <td class="tdva">Proprietor Name</td>
                        <td class="tdva">Proprietor CNIC No</td>
                        <td class="tdva">Proprietor Mobile No</td>
                      </tr>

                      <tr>
                        <td class="tdvb"><?php echo $getProprietor['name']; ?></td>
                        <td class="tdvb"><?php echo $getProprietor['cnic_no']; ?></td>
                        <td class="tdvb"><?php echo $getProprietor['mobile_no']; ?></td>
                      </tr>


                      <?php $getMoreProprietors = $this->global->getAllRecordByArray('tbl_more_proprietor', array('tbl_proprietor_id' => $all['tbl_proprietor_id']));
if ($getMoreProprietors) {
	foreach ($getMoreProprietors as $key => $getMoreProprietorsInfo) {?>
                      <tr>
                        <td class="tdvb"><?php echo $getMoreProprietorsInfo['proprietor_name']; ?></td>
                        <td class="tdvb"><?php echo $getMoreProprietorsInfo['proprietor_cnic_no']; ?></td>
                        <td class="tdvb"><?php echo $getMoreProprietorsInfo['proprietor_mobile_no']; ?></td>
                      </tr>
                    <?php }?>
                    <?php }?>

                    <tr>
                        <td class="tdva">Business Name :</td>
                        <td colspan="2" class="tdvb"><?php echo $getProprietor['business_name']; ?></td>
                    </tr>
                    <tr>
                        <td class="tdva">Business Address :</td>
                        <td colspan="2" class="tdvb"><?php echo $getProprietor['business_address']; ?></td>
                    </tr>
                    </table>
                    </div>
            </div>

            <div class="col-md-6">
              <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                      <tr>
                        <td colspan="4" class="tdva"><span style="color: green;">Qualified Person Detail</span></td>
                      </tr>
                      <?php $getPharmacist = $this->global->getRecordById($all['tbl_pharmacist_id'], 'tbl_pharmacist');?>

                      <tr>
                        <td class="tdva">Name :</td>
                        <td class="tdvb"><?php echo $getPharmacist['name']; ?></td>

                        <td class="tdva">CNIC No :</td>
                        <td class="tdvb"><?php echo $getPharmacist['cnic']; ?></td>
                      </tr>

                      <tr>
                        <td class="tdva">Father Name :</td>
                        <td class="tdvb"><?php echo $getPharmacist['father_name']; ?></td>
                        <?php if ($getPharmacist['tbl_qualification_id']) {?>

                        <?php $get = $this->global->getRecordById($getPharmacist['tbl_qualification_id'], 'tbl_qualification');?>
                        <td class="tdva">Qualification :</td>
                        <td class="tdvb"><?php echo $get['name']; ?></td>
                      <?php } else {?>
                        <td class="tdva">Qualification :</td>
                        <td class="tdvb"><?php echo $getPharmacist['qualification']; ?></td>
                      <?php }?>
                      </tr>

                      <tr>
                        <?php if ($getPharmacist['tbl_institute_id']) {?>
                        <td class="tdva">Institute :</td>
                        <?php $get = $this->global->getRecordById($getPharmacist['tbl_institute_id'], 'tbl_institute');?>
                        <td class="tdvb"><?php echo $get['name']; ?></td>
                      <?php } else {?>
                        <td class="tdva">Institute :</td>
                        <td class="tdvb"><?php echo $getPharmacist['institute']; ?></td>
                      <?php }?>

                      <?php if ($getPharmacist['tbl_pharmacist_category_id']) {?>

                      <?php $get = $this->global->getRecordById($getPharmacist['tbl_pharmacist_category_id'], 'tbl_pharmacist_category');?>
                        <td class="tdva">Category :</td>
                        <td class="tdvb"><?php echo $get['name']; ?></td>
                      <?php } else {?>
                        <td class="tdva">Category :</td>
                        <td class="tdvb"><?php echo $getPharmacist['category']; ?></td>
                      <?php }?>

                      </tr>

                      <tr>
                        <td class="tdva">Country :</td>
                        <td class="tdvb"><?php echo $getPharmacist['country']; ?></td>

                        <td class="tdva">Province :</td>
                        <td class="tdvb"><?php echo $getPharmacist['province']; ?></td>
                      </tr>

                      <tr>
                        <td class="tdva">Registration No :</td>
                        <td class="tdvb"><?php echo $getPharmacist['pharmacy_reg_no']; ?></td>

                        <td class="tdva">Is Verified?</td>
                        <?php
if ($getPharmacist['is_verify'] == 'no') {
	$is_verify = '<span class="label btn btn-xs label-danger"><i class="fa fa-remove"></i> No</span> <a href="javascript:void(0)" onclick="verify(' . "'" . $all['tbl_pharmacist_id'] . "'" . ')">
                      <button type="button" id="item_edit" class="label item_edit btn btn-xs btn-success"><i class="fa fa-check"></i> Verify it.</button>
                      </a>
  ';

} else if ($getPharmacist['is_verify'] == 'yes') {
	$is_verify = '<span class="label label-success"><i class="fa fa-check-circle"></i> Yes</span>';
}?>
                        <td class="tdvb"><?php echo $is_verify; ?></td>
                      </tr>
                    </table>
                    </div>
            </div>
          </div>
                    <div class="row">


            <div class="col-md-6">
              <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                      <tr>
                        <td colspan="4" class="tdva"><span style="color: green;">General Information</span></td>
                      </tr>
                      <tr>
                        <td class="tdva">License Type</td>
                        <td class="tdvb"><?php echo ucwords($all['license_type']); ?></td>
                      </tr>
                        <?php $get = $this->global->getRecordById($all['tbl_province_id'], 'tbl_province');?>
                      <tr>
                        <td class="tdva">Province</td>
                        <td class="tdvb"><?php echo $get['name']; ?></td>
                      </tr>

                      <?php $get = $this->global->getRecordById($all['tbl_district_id'], 'tbl_district');?>
                      <tr>
                        <td class="tdva">District</td>
                        <td class="tdvb"><?php echo $get['name']; ?></td>
                      </tr>
                      <?php $get = $this->global->getRecordById($all['tbl_tehsil_id'], 'tbl_tehsil');?>
                      <tr>
                        <td class="tdva">Tehsil</td>
                        <td class="tdvb"><?php echo $get['name']; ?></td>
                      </tr>
                      <tr>
                        <td class="tdva">Godaam Address</td>
                        <td class="tdvb"><?php echo $all['godaam_address']; ?></td>
                      </tr>
                    </table>
                    </div>
            </div>

            <div class="col-md-6 no-print">
              <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                      <tr>
                        <td colspan="4" class="tdva"><span style="color: green;">Uploaded Documents</span></td>
                      </tr>
                      <?php $getDocs = $this->global->getAllRecordByArray('tbl_form_8d_apply_documents', array('tbl_form_8d_id' => $all['id']));?>

                      <?php foreach ($getDocs as $key => $getDocsInfo) {?>
                      <tr>
                        <td class="tdva"><?php echo $getDocsInfo['document_name']; ?></td>
                        <td class="tdvb"><a target="_blank" href="<?php echo base_url() . IMG_UPLOAD_PATH . 'form_8d/' . $getDocsInfo['uploaded_document']; ?>">Uploaded <?php echo $getDocsInfo['document_name']; ?></a></td>
                      </tr>
                    <?php }?>
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


<?php if ($all['status'] != 1 && $all['status'] != 4 && $getPharmacist['is_verify'] == 'yes') {?>
<div class="col-md-12 no-print">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Office Section'); ?></h3>
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
            <input type="hidden" name="license_type" id="license_type" value="<?php echo $all['license_type']; ?>">

            <input type="hidden" name="tbl_form_type_id" id="tbl_form_type_id" value="4">
            <input type="hidden" name="tbl_name" id="tbl_name" value="tbl_form_8d">
            <!-- <input type="hidden" name="tbl_district_id" id="tbl_district_id" value="<?php echo $all['tbl_district_id']; ?>">

            <input type="hidden" name="tbl_pharmacist_id" id="tbl_pharmacist_id" value="<?php echo $all['tbl_pharmacist_id']; ?>">

            <input type="hidden" name="tbl_proprietor_id" id="tbl_proprietor_id" value="<?php echo $all['tbl_proprietor_id']; ?>"> -->

            <div class="col-md-6">

               <div class="form-group">
                  <label><?php echo $label = ucwords('status') ?>:</label>
                  <div class="input-group">
                    <input class="validate[required]" <?php if ($all['status'] == '0') {echo 'checked="checked"';}?> type="radio" name="status" value="0"> Rejected / Not Approved
                    <br>
                    <input class="validate[required]" <?php if ($all['status'] == '1') {echo 'checked="checked"';}?> type="radio" name="status" value="1"> Approve for Inspection
                    <br>
                    <input class="validate[required]" <?php if ($all['status'] == '2') {echo 'checked="checked"';}?> type="radio" name="status" value="2"> Pending / Inprocess
                </div><?php echo form_error('status'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords(str_replace('_', ' ', 'inspector')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>

                  <select  name="assign_to" id="assign_to" class="form-control select2 validate[]">
                    <option value="0">Select Inspector</option>

                    <?php foreach ($inspector as $inspectorInfo): ?>
                      <?php $getDistrict = $this->global->getRecordById($inspectorInfo['tbl_district_id'], 'tbl_district');?>
                      <option <?php if ($inspectorInfo['id'] == $all['assign_to']) {echo 'selected="selected"';}?> value="<?php echo $inspectorInfo['id']; ?>"><?php echo $inspectorInfo['name']; ?>, <?php echo $getDistrict['name']; ?></option>
                    <?php endforeach;?>
                  </select>
                </div><?php echo form_error('assign_to'); ?>
                </div>

            </div>

            <div class="col-md-6">

              <div class="form-group">
                  <label><?php echo $label = ucwords(str_replace('_', ' ', 'DG Drug Remarks')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-comments"></i>
                  </div>
                  <textarea autocomplete="off" name="remarks" id="remarks" class="form-control validate[required,minSize[3]]" ><?php echo $all['dg_remarks']; ?></textarea>

                </div><?php echo form_error('remarks'); ?>
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
<?php }?>



  </div>



      <!-- /.box -->

        <div class="row no-print">
<?php if ($all['status'] != 1 && $all['status'] != 4 && $getPharmacist['is_verify'] == 'yes') {?>

          <div class="col-xs-12 text-right">
          <button type="submit" value="submit" name="submit" class="btn btn-success  btn-sm"><i class="fa fa-refresh"> </i> Save Record</button>
    <a href="<?php echo base_url(view_form_8d); ?>" class="btn btn-danger  btn-sm" type="button"> <i class="fa fa-chevron-left"> </i> Cancel/Back</a>
          </div>
<?php } else {?>

      <div class="col-xs-12 text-right">
    <a href="<?php echo base_url('view_form_8d'); ?>" class="btn btn-danger  btn-sm" type="button"> <i class="fa fa-chevron-left"> </i> Back</a>
    <button type="button" name="print" value="print" class="btn btn-success  btn-sm" onclick="window.print();"><i class="fa fa-print"> </i> Print</button>


        </div>
      <?php }?>

      </div>
      <!-- /.row -->

    </section>
  </form>

    <!-- /.content -->
  </div>

<div id="modal_form" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title"></h4>
</div>
<p class="jquery_alert_modal"></p>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('#', 'id="formIDd" class="form-horizontal"'); ?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <input type="hidden" value="" id="other_pharmacist_id" name="other_pharmacist_id" />
      <div class="form-group">
        <label class="label-control col-md-4"><?php echo $label = ucwords('is this qualified person verified?') ?>:</label>
        <div class="col-md-8">
          <div class="input-group">
            <input type="radio" id="is_verify" name="is_verify" value="yes"> Yes
            <input type="radio" id="is_verify" name="is_verify" value="no"> No
            </div><div id="error"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" onclick="save()" id="btnSave" name="btnSave" class="btn btn-primary  btn-sm"><i class="fa fa-check-circle"> </i> Save</button>
    <!-- <button type="submit" value="submit" name="submit" class="btn btn-primary  btn-sm"><i class="fa fa-plus"> </i> Add Record</button> -->
  </div>
  <?php echo form_close(); ?>
  </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

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

<script type="text/javascript">
$(document).ready(function(){
            // for form error validation
            $('#error').html(" ");

            $('#formIDd input').on('keyup', function () {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).parents('.form-group').find('#error').html(" ");
            });
        });

  function form_reset()
    {
      $('#formIDd')[0].reset(); // reset form on modals
      $('#error').html(" ");
      $('div[id=error]').html(" ");
      // $('#tbl_qualification_id').val('').trigger('change');
      // $('#tbl_institute_id').val('').trigger('change');
      // $('#tbl_other_pharmacist_category_id').val('').trigger('change');
      $('#image_upload_preview').attr('src', 'http://placehold.it/100x100');
 };


  // getData function for get data for editment and updating
  function verify(id)
  {
      form_reset();
      $('.overlay').show();

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('other_pharmacist/getData/') ?>/" + id,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {


          $('[name="other_pharmacist_id"]').val(data.id);
          $('input[name^="is_verify"][value="'+data.is_verify+'"').prop('checked',true);
          $('.modal-title').text('<?php echo ucwords(str_replace('_', ' ', 'qualified person verification')); ?>'); // Set Title to Bootstrap modal title
          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          $('#error').html(" ");
          $('.overlay').hide();

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from database');
          }
        });
      // $('#modalEdit').modal('show');
      // $('#formID')[0].reset();
    }


    function save()
    {

        url = "<?php echo site_url('other_pharmacist/verify_other_pharmacist') ?>";
       // ajax adding data to database
       var formData = new FormData($('#formIDd')[0]);
        //reset error messsage


        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
          data: formData,
          async: true,
          beforeSend: function() {
            $('.overlay').show();
          },
          success: function(data){
                        $.each(data, function(key, value) {
                          // alert(key);
                          // alert(value);
                          if(value==true){
                            $('#modal_form').modal('hide');
                            form_reset();
                            $('.jquery_alert').html('<p class="alert alert-success">! Record has been successfully Added / Updated</p>').fadeIn().delay(4000).fadeOut('slow');
                            location.reload();
                          }
                          else {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).parents('.form-group').find('#error').html(value);
                          }
                        });
                    },
          complete: function() {
            $('.overlay').hide();
          },
          cache: false,
          contentType: false,
          processData: false

                });
     }
</script>