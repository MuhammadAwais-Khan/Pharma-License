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
              <h3 class="box-title pull-left"><?php echo ucwords(str_replace('_', ' ', 'Qualified person detail')); ?></h3>
             <!--  <h3 class="box-title pull-right">
                <a href="<?php echo base_url(); ?>add_admin" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash-o"> all </i></a></h3> -->

                <h3 class="box-title pull-right">

                  <?php if ($_SESSION['tbl_role_id'] == '4') {?>
                    <button type="button" onclick="add()" class="btn btn-block btn-success btn-sm">
                <i class="fa fa-plus"> New </i>
              </button>
              <?php }?>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="ssp_datatable" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                <tr>
                  <th width="2%"><?php echo ucwords(str_replace('_', ' ', 'Sr.')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'qualified Person')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'father name')); ?></th>
                  <th width="4%"><?php echo ucwords(str_replace('_', ' ', 'CNIC')); ?></th>
                  <th width="6%"><?php echo ucwords(str_replace('_', ' ', 'reg no')); ?></th>
                  <th width="5%"><?php echo ucwords(str_replace('_', ' ', 'add by/date')); ?></th>
                  <th width="4%"><?php echo ucwords(str_replace('_', ' ', 'status')); ?></th>
                  <th width="6%"><?php echo ucwords(str_replace('_', ' ', 'Picture')); ?></th>
                  <th width="2%" class="no-print"><?php echo ucwords(str_replace('_', ' ', 'action')); ?></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->

  </div>
<!-- modal for show data start -->
<style type="text/css">
.tdva{
  height: 60px;
  width: 25%;
  font-weight: bold;
  vertical-align: middle !important;
}
.tdvb{
  height: 60px;
  width: 25%;
  vertical-align: middle !important;
}
</style>
<div id="modal_form_show_data" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>

      </div>
      <p class="jquery_alert_modal"></p>


      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover table-condensed">
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'qualified_person')); ?></td>
              <td class="tdvb qualified_person"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'father_name')); ?></td>
              <td class="tdvb father_name"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'cnic')); ?></td>
              <td class="tdvb cnic"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'pharmacy_reg_no')); ?></td>
              <td class="tdvb pharmacy_reg_no"></td>
              <!-- <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'gender')); ?></td>
              <td class="tdvb gender"></td> -->
            </tr>
            <!-- <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'dob')); ?></td>
              <td class="tdvb dob"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'mobile_no')); ?></td>
              <td class="tdvb mobile_no"></td>
            </tr> -->
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'institute')); ?></td>
              <td class="tdvb tbl_institute"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'qualification')); ?></td>
              <td class="tdvb tbl_qualification"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'category')); ?></td>
              <td class="tdvb tbl_pharmacist_category"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'status')); ?></td>
              <td class="tdvb status"></td>
            </tr>
            <tr>
              <!-- <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'graduation_date')); ?></td>
              <td class="tdvb graduation_date"></td> -->
              <!-- <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'pharmacy_reg_no')); ?></td>
              <td class="tdvb pharmacy_reg_no"></td> -->
            </tr>
            <!-- <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'passing_year')); ?></td>
              <td colspan="3" class="tdvb passing_year"></td>
            </tr> -->
            <tr>
              <!-- <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'address')); ?></td>
              <td class="tdvb address"></td> -->
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'Image')); ?></td>
              <td class="tdvb"><span><img src="http://placehold.it/100x100" height="100" width="100" id="image_show" class="img-thumbnail"></span></td>
            </tr>

            <!-- <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'CNIC Document')); ?></td>
              <td class="tdvb"><span><a id="cnic_doc" href="#" target="_blank">CNIC Document</a></span></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'Degree Document')); ?></td>
              <td class="tdvb"><span><a id="degree_doc" href="#" target="_blank">Degree Document</a></span></td>

            </tr> -->


          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>



    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- modal for show data end -->
 <!-- modal for add record -->

<div id="modal_form" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>

      </div>
      <p class="jquery_alert_modal"></p>


        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('#', 'id="formID" class="form-horizontal"'); ?>
      <div class="modal-body">
        <div class="row">
<div class="col-md-12">
<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'full name')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-user"></i>
      </div>
      <input type="hidden" value="" id="id" name="id" />
      <input type="hidden" value="" id="hide_picture" name="hide_picture" />
      <!-- <input type="hidden" value="" id="hide_cnic_doc" name="hide_cnic_doc" /> -->
      <!-- <input type="hidden" value="" id="hide_degree_doc" name="hide_degree_doc" /> -->
      <!-- <div id="error"></div> -->
      <input type="text" autocomplete="off" value="<?php echo set_value('name'); ?>" name="name" id="name" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
  </div>

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'father_name')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-user"></i>
      </div>
      <input type="text" autocomplete="off" value="<?php echo set_value('father_name'); ?>" name="father_name" id="father_name" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
    </div>
    <div id="error"></div>
  </div>
</div>

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'CNIC')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-id-card"></i>
      </div>
      <!-- <div id="error"></div> -->
      <input type="text" autocomplete="off" value="<?php echo set_value('cnic'); ?>" name="cnic" id="cnic" class="form-control validate[minSize[15],maxSize[15]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
  </div>

<!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'mobile_no')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-mobile"></i>
      </div>
      <input type="text" autocomplete="off" value="<?php echo set_value('mobile_no'); ?>" name="mobile_no" id="mobile_no" class="form-control validate[required,minSize[12],maxSize[12]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
  </div> -->

<!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'Date of birth')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input type="text" readonly autocomplete="off" value="<?php echo set_value('dob'); ?>" name="dob" id="dob" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
  </div> -->

<!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords('gender') ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <input type="radio" id="gender" name="gender" value="male"> Male
      <input type="radio" id="gender" name="gender" value="female"> Female
      </div><div id="error"></div>
    </div>
  </div> -->

<!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'address')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-address-card"></i>
      </div>
      <textarea name="address" id="address" class="form-control validate[required,minSize[3]]" placeholder="Enter <?php echo $label; ?>"><?php echo set_value('address'); ?></textarea>
      </div><div id="error"></div>
    </div>
  </div> -->

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'qualification')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-graduation-cap"></i>
      </div>
      <select  name="tbl_qualification_id" id="tbl_qualification_id" class="form-control select2 validate[required]" style="width: 100%">
        <option value="">Select Qualification</option>
        <?php foreach ($qualification as $qualificationInfo): ?>
        <option value="<?php echo $qualificationInfo['id']; ?>"><?php echo $qualificationInfo['name']; ?></option>
        <?php endforeach;?>
      </select>
      </div><div id="error"></div>
    </div>
  </div>

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'institute')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-university"></i>
      </div>
      <select  name="tbl_institute_id" id="tbl_institute_id" class="form-control select2 validate[required]" style="width: 100%">
        <option value="">Select Institute</option>
        <?php foreach ($institute as $instituteInfo): ?>
        <option value="<?php echo $instituteInfo['id']; ?>"><?php echo $instituteInfo['name']; ?></option>
        <?php endforeach;?>
      </select>
      </div><div id="error"></div>
    </div>
  </div>

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', ' category')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-medkit"></i>
      </div>
      <select  name="tbl_pharmacist_category_id" id="tbl_pharmacist_category_id" class="form-control select2 validate[required]" style="width: 100%">
        <option value="">Select Category</option>
        <?php foreach ($pharmacist_category as $pharmacist_categoryInfo): ?>
        <option value="<?php echo $pharmacist_categoryInfo['id']; ?>"><?php echo $pharmacist_categoryInfo['name']; ?></option>
        <?php endforeach;?>
      </select>
      </div><div id="error"></div>
    </div>
  </div>

<!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'graduation_date')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input type="text" readonly autocomplete="off" value="<?php echo set_value('graduation_date'); ?>" name="graduation_date" id="graduation_date" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
  </div> -->

  <!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'passing_year')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input type="text" readonly autocomplete="off" value="<?php echo set_value('passing_year'); ?>" name="passing_year" id="passing_year" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
  </div> -->

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'pharmacy_reg_no')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-registered"></i>
      </div>
      <input type="text" autocomplete="off" value="<?php echo set_value('pharmacy_reg_no'); ?>" name="pharmacy_reg_no" id="pharmacy_reg_no" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
  </div>

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'Qualified person image')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <input type="file" class="validate[required,funcCall[imageTypeValidation]]" name="imageFile" id="imageFile" />
      <p>For best resolution width and height Should be same </p>
      <span><img src="http://placehold.it/100x100" height="100" width="100" id="image_upload_preview" class="img-thumbnail"></span>
      </div><div id="error"></div>
    </div>
  </div>

  <!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'Qualified person CNIC')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <input type="file" class="validate[required,funcCall[imageTypeValidation]]" name="cnic_doc" id="cnic_doc" />
      <p>Only jpg, png, jpeg and pdf files are allowed</p>
      <span><a id="edit_cnic_doc" target="_blank" href="#">Uploaded CNIC Document</a></span>
      </div><div id="error"></div>
    </div>
  </div> -->

<!-- <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'Qualified person degree')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <input type="file" class="validate[required,funcCall[TypeValidation]]" name="degree_doc" id="degree_doc" />
      <div id="error"></div>
      <p>Only jpg, png, jpeg and pdf files are allowed</p>
      <span><a id="edit_degree_doc" target="_blank" href="#">Uploaded Degree Document</a></span>
      </div>
    </div>
  </div> -->

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords('status') ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <input type="radio" id="status" name="status" value="1"> Active
      <input type="radio" id="status" name="status" value="0"> Inactive
      </div><div id="error"></div>
    </div>
  </div>

</div>
</div>

                    <!-- </div> -->

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="save()" id="btnSave" name="btnSave" class="btn btn-primary  btn-sm"><i class="fa fa-plus"> </i> Save Record</button>
          <!-- <button type="submit" value="submit" name="submit" class="btn btn-primary  btn-sm"><i class="fa fa-plus"> </i> Add Record</button> -->
      </div>
  <?php echo form_close(); ?>




    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
  <!-- /.content-wrapper -->

<!-- for image / gallery -->
<script>
    // baguetteBox.run('.tz-gallery');
</script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->



<script type="text/javascript">

var save_method; //for save method string
var sspDataTable;
$(document).ready(function(){
    sspDataTable=$('#ssp_datatable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('pharmacist/get_pharmacist/'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });

            // for form error validation
            $('#error').html(" ");

            $('#formID input').on('keyup', function () {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).parents('.form-group').find('#error').html(" ");
            });
        });

function reload_table()
    {
      ssp_datatable.ajax.reload(null,false); //reload datatable ajax
    }
function save()
    {

      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('pharmacist/add_pharmacist') ?>";
      }
      else
      {
        url = "<?php echo site_url('pharmacist/update_pharmacist') ?>";
      }

       // ajax adding data to database
       var formData = new FormData($('#formID')[0]);
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
                          if(key=='file'){
                            $('.jquery_alert_modal').html('<p class="alert alert-danger"> <strong>Oops! </strong>'+value+'</p>').fadeIn().delay(4000).fadeOut('slow');
                          }
                          if(value==true){
                            $('#modal_form').modal('hide');
                            form_reset();
                            sspDataTable.ajax.reload(); //reload datatable ajax
                            $('.jquery_alert').html('<p class="alert alert-success">! Record has been successfully Added / Updated</p>').fadeIn().delay(4000).fadeOut('slow');
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

function add()
    {
      $('.overlay').show();
      save_method = 'add';
      form_reset() // reset form on modals
      $('#edit_cnic_doc').hide();
      $('#edit_degree_doc').hide();
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('<?php echo ucwords(str_replace('_', ' ', 'add new qualified person')); ?>'); // Set Title to Bootstrap modal title
      $('input[name^="status"][value="1"').prop('checked',true);
      // $('input[name^="gender"][value="male"').prop('checked',true);
      $('.overlay').hide();
    }

function form_reset()
    {
      $('#formID')[0].reset(); // reset form on modals
      $('#error').html(" ");
      $('div[id=error]').html(" ");
      $('#tbl_qualification_id').val('').trigger('change');
      $('#tbl_institute_id').val('').trigger('change');
      $('#tbl_pharmacist_category_id').val('').trigger('change');
      $('#image_upload_preview').attr('src', 'http://placehold.it/100x100');
 };

// getData function for get data for editment and updating
  function getData(id)
  {
      form_reset();
      save_method = 'update';
      $('.overlay').show();


      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('pharmacist/getData/') ?>/" + id,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {


          $('[name="id"]').val(data.id);
          $('[name="name"]').val(data.name);
          $('[name="father_name"]').val(data.father_name);
          $('[name="cnic"]').val(data.cnic);

          $('#tbl_institute_id').val(data.tbl_institute_id).trigger('change');
          $('#tbl_pharmacist_category_id').val(data.tbl_pharmacist_category_id).trigger('change');
          $('#tbl_qualification_id').val(data.tbl_qualification_id).trigger('change');

          // $('input[name^="gender"][value="'+data.gender+'"').prop('checked',true);
          // $('[name="mobile_no"]').val(data.mobile_no);

          // var dob = moment(data.dob, "YYYY-MM-DD").format("DD-MM-YYYY");
          // $('[name="dob"]').val(dob);
          // var graduation_date = moment(data.graduation_date, "YYYY-MM-DD").format("DD-MM-YYYY");
          // $('[name="graduation_date"]').val(graduation_date);

          // var passing_year = moment(data.passing_year, "YYYY-MM-DD").format("DD-MM-YYYY");
          // $('[name="passing_year"]').val(passing_year);

          // $('[name="address"]').val(data.address);
          $('[name="pharmacy_reg_no"]').val(data.pharmacy_reg_no);

          $('[name="hide_picture"]').val(data.image);
          var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'pharmacist/'; ?>";
          var src = upload_path+data.image;
          $('#image_upload_preview').attr('src', src);

          // $('#edit_cnic_doc').show();
          // $('[name="hide_cnic_doc"]').val(data.cnic_doc);
          // var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'cnic_doc/'; ?>";
          // var src = upload_path+data.cnic_doc;
          // $('#edit_cnic_doc').attr('href', src);

          // $('#edit_degree_doc').show();
          // $('[name="hide_degree_doc"]').val(data.degree_doc);
          // var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'degree_doc/'; ?>";
          // var src = upload_path+data.degree_doc;
          // $('#edit_degree_doc').attr('href', src);


          $('input[name^="status"][value="'+data.status+'"').prop('checked',true);


            $('.modal-title').text('<?php echo ucwords(str_replace('_', ' ', 'edit qualified person')); ?>'); // Set Title to Bootstrap modal title
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

    function getShowData(id)
  {
      form_reset();
      $('.overlay').show();

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('pharmacist/fetchData/') ?>/" + id,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {
          $( ".qualified_person" ).html( data.name );
          $( ".father_name" ).html( data.father_name );
          $( ".cnic" ).html( data.cnic );
          $( ".tbl_institute" ).html(data.institute);
          $( ".tbl_qualification" ).html(data.qualification);
          $( ".tbl_pharmacist_category" ).html(data.pharmacist_category);

          // if(data.gender=='male'){
          //   $( ".gender" ).html('Male');
          // }else{
          //   $( ".gender" ).html('Female');
          // }
          // $( ".mobile_no" ).html( data.mobile_no );

          // var dob = moment(data.dob, "YYYY-MM-DD").format("DD-MM-YYYY");
          // $( ".dob" ).html( dob );
          // var graduation_date = moment(data.graduation_date, "YYYY-MM-DD").format("DD-MM-YYYY");
          // $( ".graduation_date" ).html( graduation_date );

          // var passing_year = moment(data.passing_year, "YYYY-MM-DD").format("DD-MM-YYYY");
          // $( ".passing_year" ).html( passing_year );

          // $( ".address" ).html( data.address );
          $( ".pharmacy_reg_no" ).html( data.pharmacy_reg_no );

          // $('[name="hide_picture"]').val(data.image);
          var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'pharmacist/'; ?>";
          var src = upload_path+data.image;
          $('#image_show').attr('src', src);

          // var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'cnic_doc/'; ?>";
          // var src = upload_path+data.cnic_doc;
          // $('#cnic_doc').attr('href', src);

          // var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'degree_doc/'; ?>";
          // var src = upload_path+data.degree_doc;
          // $('#degree_doc').attr('href', src);


          if(data.status=='1'){
            $( ".status" ).html('Active');
          }else{
            $( ".status" ).html('Inactive');
          }

            $('.modal-title').text('<?php echo ucwords(str_replace('_', ' ', 'qualified person detail')); ?>'); // Set Title to Bootstrap modal title
            $('#modal_form_show_data').modal('show'); // show bootstrap modal when complete loaded
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

      $(function () {
        $('#dob').datetimepicker({
            useCurrent: false,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });

        // $('#passing_year').datetimepicker({
        //     useCurrent: false,
        //     format:"DD-MM-YYYY",
        //     showTodayButton:true,
        //     ignoreReadonly:true
        // });

        // $('#graduation_date').datetimepicker({
        //     useCurrent: false,
        //     format:"DD-MM-YYYY",
        //     showTodayButton:true,
        //     ignoreReadonly:true
        // });

    });



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

  // type validation
  function TypeValidation(field, rules, i, options)
  {
    var RegEx = /^.*\.(jpg|jpeg|png|PNG|JPEG|JPG|PDF|pdf)$/;

    if (!RegEx.test(field.val()))
    {
      var alertText = 'Only pdf, jpg, png and jpeg files are allowed';
      return alertText;
    }

  }

  // file type validation
  function fileTypeValidation(field, rules, i, options)
  {
    var RegEx = /^.*\.(PDF|pdf)$/;

    if (!RegEx.test(field.val()))
    {
      var alertText = 'Only pdf files are allowed';
      return alertText;
    }

  }

  var imageField = document.getElementById("imageFile");
  imageField.onchange = function() {
    if(this.files[0].size > 1000000){ // 1MB = 1000000 byte
       alert("File is too big! Not exceed from 1MB");
       this.value = "";
    };
  };

  // var cnic_doc = document.getElementById("cnic_doc");
  // cnic_doc.onchange = function() {
  //   if(this.files[0].size > 1000000){ // 1MB = 1000000 byte
  //      alert("File is too big! Not exceed from 1MB");
  //      this.value = "";
  //   };
  // };

  // var degree_doc = document.getElementById("degree_doc");
  // degree_doc.onchange = function() {
  //   if(this.files[0].size > 1000000){ // 1MB = 1000000 byte
  //      alert("File is too big! Not exceed from 1MB");
  //      this.value = "";
  //   };
  // };


  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageFile").change(function () {
        readURL(this);
    });

</script>