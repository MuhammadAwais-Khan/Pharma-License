<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo (!empty($page_title)) ? ucwords(str_replace('_', ' ', $page_title)) . ' : Drug Control & Pharmacy Services Health Department KP ' : ' Drug Control & Pharmacy Services Health Department KP'; ?></title>
  <!-- <script type="text/javascript" src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script> -->

  <link rel="icon" href="<?php echo base_url('assets/upload/images/'); ?>favicon.ico" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">


    <!-- Bootstrap 3.3.6
  <link rel="stylesheet" href="include_files/bootstrap/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css"> -->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/skins/skin-green.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/skins/all.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
  <!-- Bootstrap date Picker -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->

    <!-- Bootstrap date time Picker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

 <!-- jquery datepicker -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"/> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-collapse fixed" oncontextmenu="return false;">
<div class="box" style="margin-bottom: 0px; border-radius: 0;border-top: 0; position: unset; box-shadow: unset;"> <!-- class box ending tag is in endhtml.php -->

<style type="text/css">
/* this style is for overlay */
  .box .overlay, .overlay-wrapper .overlay {
    z-index: 1051;
    background: rgba(255,255,255,0.7);
    border-radius: 3px;
}
</style>
<div class="overlay" style="font-size: 50px;position: fixed;">
  <i style="font-size: 50px;position: fixed;" class="fa fa-spinner fa-spin"></i>
</div>

  <script type="text/javascript">

  document.onkeydown = function(e) {
    if(event.keyCode == 123) {
     return false;
   }
   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
   }
   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
   }
   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
   }
   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
   }
 }
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180938749-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-180938749-1');
</script>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->

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
              <div class="col-md-12">
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
              <div class="col-md-12">
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
            <div class="col-md-12">
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
            <div class="col-md-12 no-print">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed">
                  <tr>
                    <td colspan="4" class="tdva"><span style="color: green;">Uploaded Documents</span></td>
                  </tr>
                  <?php $getDocs = $this->global->getAllRecordByArray('tbl_form_8a_apply_documents', array('tbl_form_8a_id' => $all['id']));?>
                  <?php foreach ($getDocs as $key => $getDocsInfo) {?>
                  <tr>
                    <td class="tdva"><?php echo $getDocsInfo['document_name']; ?></td>
                    <td class="tdvb"><a target="_blank" href="<?php echo base_url() . IMG_UPLOAD_PATH . 'form_8a/' . $getDocsInfo['uploaded_document']; ?>">Uploaded <?php echo $getDocsInfo['document_name']; ?></a></td>
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

  </div>
</section>
<!-- /.content -->
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



<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- Sparkline -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.min.js"></script>
<!--<script src="include_files/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.all.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.1/basic/ckeditor.js"></script>

<!-- Slimscroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.css" type="text/css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
  </script>
  <script>
      jQuery(document).ready(function(){
      // binds form submission and fields to the validation engine
      jQuery("#formID").validationEngine();
      // jQuery("#formID").validationEngine('attach', {bindMethod:"live"});
      jQuery("#formID").validationEngine('attach', {autoHidePrompt:true});
      jQuery("#formID").validationEngine('attach', {promptPosition : "topLeft", scroll: false});
      $("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) });
});


  </script>


<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<!-- bootstrap time picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->

<!-- bootstrap date time picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
// formErrorContent
    // $('.btnProcess').hide();
    $('.overlay').hide();
    $('#formID').submit(function() {
    if ($('.formError:visible').length){

    $('.overlay').hide();}
else
   {
    // $(":submit").attr("disabled", true);
    // $(':input[type="submit"]').prop('disabled', true);
    // $('button[type="submit"]').prop('disabled', true);
      // $('#btnSubmit').hide();
      // $('.btnProcess').show();

    // $( 'i' ).addClass( "fa-refresh fa-spin");

      $('.overlay').show();
   }
      return true;
    });
});
</script>
</div>  <!-- ending tag of class box -->
</body>
</html>