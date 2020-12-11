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
    <?php echo form_open_multipart('form_8d/edit_form_8d', 'id="formID"'); ?>

<!--      <form id="formID" method="POST" action="" enctype="multipart/form-data"> -->
    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Proprietor Information'); ?></h3>
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
                  <label><?php echo $label = ucwords('proprietor'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <select onchange="proprietor(this.value)" name="tbl_proprietor_id" id="tbl_proprietor_id" class="form-control select2 validate[required]">
                    <option value="">Select Proprietor</option>

                    <?php foreach ($proprietor as $proprietorInfo): ?>
                      <option <?php if ($proprietorInfo['id'] == $all['tbl_proprietor_id']) {echo 'selected="selected"';}?> value="<?php echo $proprietorInfo['id']; ?>"><?php echo $proprietorInfo['name']; ?>, <?php echo $proprietorInfo['business_name']; ?></option>
                    <?php endforeach;?>
                  </select>
                </div><?php echo form_error('tbl_proprietor_id'); ?>
                </div>
                <input type="hidden" id="tbl_form_type_id" name="tbl_form_type_id" value="4">
                <input type="hidden" id="id" name="id" value="<?php echo $all['id']; ?>">

                <div id="proprietorData"></div>

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
  <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Qualified Person Information'); ?></h3>
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

                <?php $getPharmacist = $this->global->getRecordById($all['tbl_pharmacist_id'], 'tbl_pharmacist')?>
                  <label><?php echo $label = ucwords('Qualified Person Province'); ?>:</label>
                  <br>
                  <input <?php if ($getPharmacist['is_kp_province'] == 'yes') {echo 'checked="checked"';}?> type="radio" class="validate[required]" name="qpp" id="qpp" value="kp"> KP
                  <input <?php if ($getPharmacist['is_kp_province'] == 'no') {echo 'checked="checked"';}?> type="radio" class="validate[required]" name="qpp" id="qpp" value="other"> Other
                  <?php echo form_error('qpp'); ?>
                </div>

                <div class="form-group">
                  <label><?php echo $label = ucwords('Qualified Person Registration No'); ?>:</label>
                  <div class="input-group">


                  <input type="text" onchange="pharmacist()" autocomplete="off" value="<?php echo $getPharmacist['pharmacy_reg_no']; ?>" name="reg_no" id="reg_no" class="form-control validate[required,minSize[3]" placeholder="Enter <?php echo $label; ?>" />

                  <div class="input-group-addon" style="padding: 0 4px;" >
                    <button type="button" onclick="pharmacist()" class="btn btn-block btn-success btn-sm">
                <i class="fa fa-search"></i>
              </button>
                  </div>

                </div><?php echo form_error('reg_no'); ?>
                <input type="hidden" id="tbl_pharmacist_id" name="tbl_pharmacist_id" value="<?php echo $all['tbl_pharmacist_id']; ?>">
                </div>

              <div id="pharmacistData">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                      <tr>
                        <td class="tdva">Qualified Person :</td>
                        <td class="tdvb"><?php echo $getPharmacist['name']; ?></td>
                      </tr>
                      <tr>
                        <td class="tdva">CNIC No :</td>
                        <td class="tdvb"><?php echo $getPharmacist['cnic']; ?></td>
                      </tr>
                      <tr>
                        <td class="tdva">Registration No :</td>
                        <td class="tdvb"><?php echo $getPharmacist['pharmacy_reg_no']; ?></td>
                        </tr>
                        <tr>
                        <td class="tdva">Country :</td>
                        <td class="tdvb"><?php echo $getPharmacist['country']; ?></td>
                      </tr>
                      <tr>
                        <td class="tdva">Province :</td>
                        <td class="tdvb"><?php echo $getPharmacist['province']; ?></td>
                      </tr>
                    </table>
                    </div>
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
      <div class="row">

<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('General Information'); ?></h3>
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

                  <label><?php echo $label = ucwords('license type'); ?>:</label>
                  <br>
                  <input <?php if ($all['license_type'] == 'new') {echo 'checked="checked"';}?> type="radio" class="validate[required]" name="license_type" id="license_type" value="new"> New
                  <input <?php if ($all['license_type'] == 'renewal') {echo 'checked="checked"';}?> type="radio" class="validate[required]" name="license_type" id="license_type" value="renewal"> Renewal
                  <?php echo form_error('license_type'); ?>
                </div>

              <div class="form-group">
                  <label><?php echo $label = ucwords('province'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map"></i>
                  </div>
                  <select name="tbl_province_id" id="tbl_province_id" class="form-control select2 validate[required]">
                    <option value="">Select Province</option>

                    <?php foreach ($province as $provinceInfo): ?>
                      <option <?php if ($all['tbl_province_id'] == $provinceInfo['id']) {echo 'selected="selected"';}?> value="<?php echo $provinceInfo['id']; ?>"><?php echo $provinceInfo['name']; ?></option>
                    <?php endforeach;?>
                  </select>
                </div><?php echo form_error('tbl_province_id'); ?>
                </div>

                <div class="form-group">

                  <label><?php echo $label = ucwords('district'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-building-o"></i>
                  </div>
                  <select name="tbl_district_id" id="tbl_district_id" class="form-control select2 validate[required]">
                <option value="">Select District</option>

                <?php $getDistrict = $this->global->getAllRecordByArray('tbl_district', array('tbl_province_id' => $all['tbl_province_id'], 'status' => '1'))?>

                    <?php foreach ($getDistrict as $getDistrictInfo): ?>
                      <option <?php if ($all['tbl_district_id'] == $getDistrictInfo['id']) {echo 'selected="selected"';}?> value="<?php echo $getDistrictInfo['id']; ?>"><?php echo $getDistrictInfo['name']; ?></option>
                    <?php endforeach;?>
                    <!-- data through ajax-->
                  </select>
                </div><?php echo form_error('tbl_district_id'); ?>
                </div>

                <div class="form-group">

                  <label><?php echo $label = ucwords('tehsil'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-building-o"></i>
                  </div>
                  <select name="tbl_tehsil_id" id="tbl_tehsil_id" class="form-control select2 validate[required]">
                    <option value="">Select Tehsil</option>
                    <?php $gettehsil = $this->global->getAllRecordByArray('tbl_tehsil', array('tbl_province_id' => $all['tbl_province_id'], 'status' => '1'))?>

                    <?php foreach ($gettehsil as $gettehsilInfo): ?>
                      <option <?php if ($all['tbl_tehsil_id'] == $gettehsilInfo['id']) {echo 'selected="selected"';}?> value="<?php echo $gettehsilInfo['id']; ?>"><?php echo $gettehsilInfo['name']; ?></option>
                    <?php endforeach;?>
                    <!-- data through ajax-->
                  </select>
                </div><?php echo form_error('tbl_tehsil_id'); ?>
                </div>

              <div class="form-group">
                  <label><?php echo $label = ucwords(str_replace('_', ' ', 'ware house address')); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>

                  <textarea name="godaam_address" id="godaam_address" autocomplete="off" class="form-control validate[required,minSize[5]"><?php echo $all['godaam_address']; ?></textarea>
                </div><?php echo form_error('godaam_address'); ?>
                </div>

            </div>

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>

</div>

<div class="col-md-6">

  <!-- personal info start -->
  <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Documents'); ?></h3>
          <br><i style="color: #9c0404;">All the documents should be properly scanned. <br>Maximum size of every document is 1 MB</i>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <?php /*?><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button><?php */?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <?php $getFormTypeDoc = $this->global->getFormTypeDocForm8d($all['id']);?>

            <!-- /.col -->
            <div class="col-md-12">
              <?php foreach ($getFormTypeDoc as $key => $form_type_docInfo) {?>

              <div class="form-group">
                  <label><?php echo $form_type_docInfo['name']; ?>:</label>

                  <input type="file" onclick="validatee('<?php echo $form_type_docInfo['tag_name']; ?>')" class="validate[funcCall[fileTypeValidation]]" name="<?php echo $form_type_docInfo['tag_name']; ?>" id="<?php echo $form_type_docInfo['tag_name']; ?>" />
                <?php echo form_error($form_type_docInfo['tag_name']); ?>

                <?php if ($form_type_docInfo['uploaded_document']) {?>

                <a id="" href="<?php echo base_url() . IMG_UPLOAD_PATH . 'form_8d/' . $form_type_docInfo['uploaded_document']; ?>" target="_blank">Click here for Uploaded Document <?php echo $form_type_docInfo['name']; ?></a>
              <?php }?>

                </div>



                <input type='hidden' name='tbl_form_type_doc_id<?php echo $form_type_docInfo['tblFromTypeDocID']; ?>' id='tbl_form_type_doc_id<?php echo $form_type_docInfo['tblFromTypeDocID']; ?>' value='<?php echo $form_type_docInfo['tblFromTypeDocID']; ?>'>

                <input type='hidden' name='document_name_<?php echo $form_type_docInfo['tag_name']; ?>' id='document_name_<?php echo $form_type_docInfo['tag_name']; ?>' value='<?php echo $form_type_docInfo['tag_name']; ?>'>

                <input type='hidden' name='hide_document_<?php echo $form_type_docInfo['tag_name']; ?>' id='hide_document_<?php echo $form_type_docInfo['tag_name']; ?>' value='<?php echo $form_type_docInfo['uploaded_document']; ?>'>

                <input type='hidden' name='tbl_form_8d_apply_documents<?php echo $form_type_docInfo['tblForm8dApplyDocID']; ?>' id='tbl_form_8d_apply_documents<?php echo $form_type_docInfo['tblForm8dApplyDocID']; ?>' value='<?php echo $form_type_docInfo['tblForm8dApplyDocID']; ?>'>

                <!-- <input type='hidden' name='tbl_form_8d_apply_documents[]' id='tbl_form_8d_apply_documents[]' value='<?php echo $form_type_docInfo['tblForm8dApplyDocID']; ?>'> -->


              <?php }?>

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
<style type="text/css">

  hr {
    margin-top: 8px;
    margin-bottom: 8px;
    border: 1;
    border-top: 1px solid #008E4B;
}
</style>

<script type="text/javascript">

  // file type validation
  function fileTypeValidation(field, rules, i, options)
  {
    var RegEx = /^.*\.(jpg|jpeg|png|PNG|JPEG|JPG|pdf|PDF)$/;

    if (!RegEx.test(field.val()))
    {
      var alertText = 'Only jpg, jpeg, png and pdf files are allowed';
      return alertText;
    }

  }

  function validatee(val){
  var imageField = document.getElementById(val);

  imageField.onchange = function() {
    if(this.files[0].size > 1000000){ // 1MB = 1000000 byte
       alert("File is too big! Not exceed from 1MB");
       this.value = "";
    };
  };
  // });
}
</script>

<script type="text/javascript">

    $(document).ready(function() {

        // $('#tbl_province_id').val('<?php echo $all['tbl_province_id']; ?>').trigger('change');
        // $('#tbl_district_id').val('<?php echo $all['tbl_district_id']; ?>').trigger('change');
        // $('#tbl_tehsil_id').val('<?php echo $all['tbl_tehsil_id']; ?>').trigger('change');



        $('select[id="tbl_province_id"]').on('change', function() {
          var base_url = "<?php echo base_url(); ?>";
          var tbl_province_id = $('#tbl_province_id').val();
            if(tbl_province_id) {
              $(".overlay").show();
                $.ajax({
                    url: base_url +'common/fetchDistrictByProvinceID/'+tbl_province_id,

                    type: "post",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="tbl_district_id"]').empty();
                        $('select[id="tbl_district_id"]').append('<option value="">-- Select District --</option>');
                        $('select[id="tbl_tehsil_id"]').empty();
                        $('select[id="tbl_tehsil_id"]').append('<option value="">-- Select Tehsil --</option>');

                        $.each(data, function(key, value) {
                            $('select[id="tbl_district_id"]').append('<option value="'+ value.id +'">'+value.name+'</option>');
                        });
                        $(".overlay").hide();
                    }
                });
            }else{
                $('select[id="tbl_district_id"]').empty();
                $('select[id="tbl_district_id"]').append('<option value="">Select District</option>');

                $('select[id="tbl_tehsil_id"]').empty();
                $('select[id="tbl_tehsil_id"]').append('<option value="">Select Tehsil</option>');

            }
        });
    });


    $(document).ready(function() {
        $('select[id="tbl_district_id"]').on('change', function() {
          var base_url = "<?php echo base_url(); ?>";
          var tbl_district_id = $('#tbl_district_id').val();
            if(tbl_district_id) {
              $(".overlay").show();
                $.ajax({
                    url: base_url +'common/fetchTehsilByDistrictID/'+tbl_district_id,

                    type: "post",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="tbl_tehsil_id"]').empty();
                        $('select[id="tbl_tehsil_id"]').append('<option value="">-- Select Tehsil --</option>');

                        $.each(data, function(key, value) {
                            $('select[id="tbl_tehsil_id"]').append('<option value="'+ value.id +'">'+value.name+'</option>');
                        });
                        $(".overlay").hide();
                    }
                });
            }else{
                $('select[id="tbl_tehsil_id"]').empty();
                $('select[id="tbl_tehsil_id"]').append('<option value="">Select Tehsil</option>');

            }
        });
    });

$(document).ready(function() {
    var tblProprietorID= '<?php echo $all['tbl_proprietor_id']; ?>';
    proprietor(tblProprietorID);
  });

    // $(document).ready(function() {
        // $('select[id="tbl_proprietor_id"]').on('change', function() {
    function proprietor(tblProprietorID)
    {
          var base_url = "<?php echo base_url(); ?>";
          // var tbl_proprietor_id = $('#tbl_proprietor_id').val();
          var tbl_proprietor_id = tblProprietorID;
            if(tbl_proprietor_id) {
              $(".overlay").show();
                $.ajax({
                    url: base_url +'common/getProprietor/'+tbl_proprietor_id,

                    type: "post",
                    dataType: "json",
                    success:function(data) {

                    $( "#proprietorData" ).html(
                    '<div class="table-responsive">'+
                    '<table class="table table-bordered table-striped table-hover table-condensed">'+
                      '<tr>'+
                        '<td class="tdva">Proprietor :</td>'+
                        '<td class="tdvb">'+data.name+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td class="tdva">CNIC No :</td>'+
                        '<td class="tdvb">'+data.cnic_no+'</td>'+
                      '</tr>'+
                      '<tr>'+
                        '<td class="tdva">Business Name :</td>'+
                        '<td class="tdvb">'+data.business_name+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td class="tdva">Business Address :</td>'+
                        '<td class="tdvb">'+data.business_address+'</td>'+
                      '</tr>'+
                    '</table>'+
                    '</div>'
                      );
                    $(".overlay").hide();
                    }
                });
            }else{
                alert('Please Select the Proprietor');
                $( "#proprietorData" ).empty();
                $( "#proprietorData" ).html(" ");
            }
    }
        // });
    // });


// $(document).ready(function() {
//     var tblPharmacistID= '<?php echo $all['tbl_pharmacist_id']; ?>';
//     pharmacistt();
//   });

//    function pharmacistt()
//     {
//       var pharmacistData = $('#reg_no').val();
//       var base_url = "<?php echo base_url(); ?>";
//       if(pharmacistData) {
//               $(".overlay").show();
//                 $.ajax({
//                     url: base_url +'common/getPharmacist/'+pharmacistData,

//                     type: "post",
//                     dataType: "json",
//                     success:function(data) {
//                     if(data){

//                     $( "#pharmacistData" ).html(
//                     '<div class="table-responsive">'+
//                     '<table class="table table-bordered table-striped table-hover table-condensed">'+
//                       '<tr>'+
//                         '<td class="tdva">Qualified Person :</td>'+
//                         '<td class="tdvb">'+data.name+'</td>'+
//                       '</tr>'+
//                       '<tr>'+
//                         '<td class="tdva">CNIC No :</td>'+
//                         '<td class="tdvb">'+data.cnic+'</td>'+
//                       '</tr>'+
//                       '<tr>'+
//                         '<td class="tdva"> Registration No :</td>'+
//                         '<td class="tdvb">'+data.pharmacy_reg_no+'</td>'+
//                         '</tr>'+
//                         '<tr>'+
//                         '<td class="tdva">Address :</td>'+
//                         '<td class="tdvb">'+data.address+'</td>'+
//                       '</tr>'+
//                     '</table>'+
//                     '</div>'
//                       );
//                     // $('[id="tbl_pharmacist_id"]').val(data.id);
//                     $('#tbl_pharmacist_id').attr('value', data.id);
//                     $('#reg_no').attr('value', data.pharmacy_reg_no);

//                     $(".overlay").hide();
//                   }
//                   else{
//                     alert('Not Record Found');
//                     $('[id="reg_no"]').val('<?php echo $getPharmacist['pharmacy_reg_no']; ?>');
//                     $('[id="tbl_pharmacist_id"]').val('<?php echo $all['tbl_pharmacist_id']; ?>');
//                     // $( "#pharmacistData" ).empty();
//                     // $( "#pharmacistData" ).html(" ");
//                     $(".overlay").hide();
//                   }
//                     }
//                 });
//             }else{
//                 $( "#pharmacistData" ).empty();
//                 $( "#pharmacistData" ).html(" ");
//                 alert('Please Enter the Pharmacy Registration No.');

//             }
//     }

   function pharmacist()
    {
      var qpp = $('input[id="qpp"]:checked').val();
      var pharmacistData = $('#reg_no').val();
      var base_url = "<?php echo base_url(); ?>";

      if(qpp=='kp'){
        var url = base_url +'common/getPharmacist/'+pharmacistData;
        // $('#qpp').attr('value',qpp);
      }
      else if(qpp=='other'){
        var url = base_url +'common/getOtherPharmacist/'+pharmacistData;
        // $('#qpp').attr('value',qpp);
      }


      if(pharmacistData) {
              $(".overlay").show();
                $.ajax({
                    // url: base_url +'common/getPharmacist/'+pharmacistData,
                    url: url,

                    type: "post",
                    dataType: "json",
                    success:function(data) { // success start
                    // if(data.engage=='no'){
                    if(data){ // if 1 start

                      if(data.engage=='no'){

                    $( "#pharmacistData" ).html(
                    '<div class="table-responsive">'+
                    '<table class="table table-bordered table-striped table-hover table-condensed">'+
                      '<tr>'+
                        '<td class="tdva">Qualified Person :</td>'+
                        '<td class="tdvb">'+data.name+'</td>'+
                      '</tr>'+
                      '<tr>'+
                        '<td class="tdva">CNIC No :</td>'+
                        '<td class="tdvb">'+data.cnic+'</td>'+
                      '</tr>'+
                      '<tr>'+
                        '<td class="tdva">Registration No :</td>'+
                        '<td class="tdvb">'+data.pharmacy_reg_no+'</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td class="tdva">Country :</td>'+
                        '<td class="tdvb">'+data.country+'</td>'+
                      '</tr>'+
                        '<tr>'+
                        '<td class="tdva">Province :</td>'+
                        '<td class="tdvb">'+data.province+'</td>'+
                      '</tr>'+
                    '</table>'+
                    '</div>'
                      );
                    $('#tbl_pharmacist_id').attr('value', data.id);

                    $(".overlay").hide();
                  } // data.engage if end
                  else {
                    // alert('Qualified Person is Already Engaged');
                    $('.jquery_alert').html('<p class="alert alert-danger">! Qualified Person is Already Engaged, Please Try Another</p>').show(0).delay(10000).hide(0);

                    $('[id="reg_no"]').val("");
                    $('[id="tbl_pharmacist_id"]').val("");
                    $( "#pharmacistData" ).empty();
                    $( "#pharmacistData" ).html("");
                    $(".overlay").hide();

                }
                  } // if 1 end
                  else { //if 1 else
                    alert('Not Record Found');
                    $('[id="reg_no"]').val("");
                    $('[id="tbl_pharmacist_id"]').val("");
                    $( "#pharmacistData" ).empty();
                    $( "#pharmacistData" ).html("");
                    $(".overlay").hide();
                  } //if else end
                  } // success end
                });
            }else{
                $( "#pharmacistData" ).empty();
                $( "#pharmacistData" ).html(" ");
                alert('Please Enter the Pharmacy Registration No.');

            }
    }
</script>

<style type="text/css">
.tdva{
  height: 40px;
  width: 25%;
  font-weight: bold;
  vertical-align: middle !important;
}
.tdvb{
  height: 40px;
  width: 25%;
  vertical-align: middle !important;
}
</style>

