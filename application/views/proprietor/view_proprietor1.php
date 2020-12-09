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
              <h3 class="box-title pull-left"><?php echo ucwords(str_replace('_', ' ', 'proprietor detail')); ?></h3>

              <h3 class="box-title pull-right">
              <?php if ($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '5') {?>

                <a href="<?php echo base_url(); ?>add_proprietor" type="button" class="btn btn-block btn-success btn-sm"><i class="fa fa-plus"> New </i></a><?php }?>
              </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="ssp_datatable" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                <tr>
                  <th width="2%"><?php echo ucwords(str_replace('_', ' ', 'Sr.')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'business_name')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'proprietor_name')); ?></th>
                  <th width="5%"><?php echo ucwords(str_replace('_', ' ', 'CNIC')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'business_address')); ?></th>
                  <th width="5%"><?php echo ucwords(str_replace('_', ' ', 'add by/date')); ?></th>
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
        <h4 class="modal-title"><?php echo ucwords(str_replace('_', ' ', 'proprietor Detail')); ?></h4>

      </div>
      <p class="jquery_alert_modal"></p>


      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover table-condensed">
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_name')); ?></td>
              <td class="tdvb full_name"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'business_name')); ?></td>
              <td class="tdvb business_name"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'father_name')); ?></td>
              <td class="tdvb father_name"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'business_address')); ?></td>
              <td class="tdvb business_address"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'cnic_no')); ?></td>
              <td class="tdvb cnic_no"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'gender')); ?></td>
              <td class="tdvb gender"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'mobile_no')); ?></td>
              <td class="tdvb mobile_no"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'home_address')); ?></td>
              <td class="tdvb home_address"></td>
            </tr>

            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_name')); ?></td>
              <td class="tdvb proprietor_name"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_cnic_no')); ?></td>
              <td class="tdvb proprietor_cnic_no"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_mobile_no')); ?></td>
              <td class="tdvb proprietor_mobile_no"></td>
            </tr>


            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'status')); ?></td>
              <td colspan="3" class="tdvb status"></td>
            </tr>


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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo ucwords(str_replace('_', ' ', 'edit proprietor')); ?></h4>

      </div>
      <p class="jquery_alert_modal"></p>


        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('#', 'id="formID" class="form-horizontal"'); ?>
      <div class="modal-body">
        <div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'business_name')); ?>:</label>
    <div class="col-md-8">
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-industry"></i>
        </div>
        <input type="hidden" value="" id="id" name="id" />
        <input type="hidden" value="" id="hide_picture" name="hide_picture" />
        <!-- <div id="error"></div> -->
        <input type="text" autocomplete="off" value="<?php echo set_value('business_name'); ?>" name="business_name" id="business_name" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
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
          </div><div id="error"></div>
        </div>
      </div>
      <div class="form-group">
        <label class="label-control col-md-4"><?php echo $label = ucwords('gender') ?>:</label>
        <div class="col-md-8">
          <div class="input-group">
            <input type="radio" id="gender" name="gender" value="male"> Male
            <input type="radio" id="gender" name="gender" value="female"> Female
            </div><div id="error"></div>
          </div>
        </div>
<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'businessaddress')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-address-card"></i>
      </div>
      <textarea rows="5" name="business_address" id="business_address" class="form-control validate[required,minSize[3]]" placeholder="Enter <?php echo $label; ?>"><?php echo set_value('business_address'); ?></textarea>
      </div><div id="error"></div>
    </div>
  </div>

  <div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'address')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-address-card"></i>
      </div>
      <textarea rows="5" name="address" id="address" class="form-control validate[required,minSize[3]]" placeholder="Enter <?php echo $label; ?>"><?php echo set_value('address'); ?></textarea>
      </div><div id="error"></div>
    </div>
  </div>
        </div>

<div class="col-md-6">
<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'full name')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-user"></i>
      </div>
      <!-- <div id="error"></div> -->
      <input type="text" autocomplete="off" value="<?php echo set_value('name'); ?>" name="name" id="name" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
</div>
<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'CNIC_no')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-id-card"></i>
      </div>
      <!-- <div id="error"></div> -->
      <input data-inputmask='"mask": "99999-9999999-9"' data-mask type="text" autocomplete="off" value="<?php echo set_value('cnic_no'); ?>" name="cnic_no" id="cnic_no" class="form-control validate[required,minSize[13],maxSize[13],custom[number]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
</div>
<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'mobile_no')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-mobile"></i>
      </div>
      <input type="text" autocomplete="off" value="<?php echo set_value('mobile_no'); ?>" name="mobile_no" id="mobile_no" class="form-control validate[required,minSize[3],maxSize[25],custom[number]]" placeholder="Enter <?php echo $label; ?>" />
      </div><div id="error"></div>
    </div>
</div>

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords('status') ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <input type="radio" id="status" name="status" value="1"> Active
      <input type="radio" id="status" name="status" value="0"> Inactive
      </div><div id="error"></div>
    </div>
</div>

<div class="form-group">
  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'proprietor_image')); ?>:</label>
  <div class="col-md-8">
    <div class="input-group">
      <input type="file" class="validate[required,funcCall[imageTypeValidation]]" name="imageFile" id="imageFile" />
      <p>For best resolution width and height Should be same </p>
      <?php echo form_error('imageFile'); ?>
      <span><img src="http://placehold.it/100x100" height="100" width="100" id="image_upload_preview" class="img-thumbnail"></span>
      </div><div id="error"></div>
    </div>
  </div>
          </div>
        </div>

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
            "url": "<?php echo base_url('proprietor/get_proprietor/'); ?>",
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
        url = "<?php echo site_url('proprietor/add_proprietor') ?>";
      }
      else
      {
        url = "<?php echo site_url('proprietor/update_proprietor') ?>";
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
          // beforeSend: function() {
          //   $('#btn-submit').prop('disabled', true);
          // },
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
          // complete: function() {
          //   $('#btn-submit').prop('disabled', false);
          // },
          cache: false,
          contentType: false,
          processData: false

                });
     }

function add()
    {
      save_method = 'add';
      form_reset() // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('<?php echo ucwords(str_replace('_', ' ', 'add new proprietor')); ?>'); // Set Title to Bootstrap modal title
      $('input[name^="status"][value="1"').prop('checked',true);
      $('input[name^="gender"][value="male"').prop('checked',true);
    }

function form_reset()
    {
      $('#formID')[0].reset(); // reset form on modals
      $('#error').html(" ");
      $('div[id=error]').html(" ");
      $('#image_upload_preview').attr('src', 'http://placehold.it/100x100');

 };

// getData function for get data for editment and updating
  function getData(id)
  {
      form_reset();
      save_method = 'update';

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('proprietor/getData/') ?>/" + id,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {


          $('[name="id"]').val(data.id);
          $('[name="business_name"]').val(data.business_name);
          $('[name="name"]').val(data.name);
          $('[name="father_name"]').val(data.father_name);
          $('[name="cnic_no"]').val(data.cnic_no);

          $('input[name^="gender"][value="'+data.gender+'"').prop('checked',true);
          $('[name="mobile_no"]').val(data.mobile_no);
          $('[name="address"]').val(data.address);

          $('[name="hide_picture"]').val(data.image);
          var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'proprietor/'; ?>";
          var src = upload_path+data.image;
          $('#image_upload_preview').attr('src', src);


          $('input[name^="status"][value="'+data.status+'"').prop('checked',true);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('#error').html(" ");

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
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('proprietor/getShowData/') ?>/" + id,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {
          $( ".full_name" ).html( data.name );
          $( ".business_name" ).html( data.business_name );
          $( ".father_name" ).html( data.father_name );
          $( ".cnic_no" ).html( data.cnic_no );

          if(data.gender=='male'){
            $( ".gender" ).html('Male');
          }else{
            $( ".gender" ).html('Female');
          }
          $( ".mobile_no" ).html( data.mobile_no );

          $( ".home_address" ).html( data.home_address );
          $( ".business_address" ).html( data.business_address );

          // var upload_path = "<?php echo base_url() . IMG_UPLOAD_PATH . 'proprietor/'; ?>";
          // var src = upload_path+data.image;
          // $('#image_show').attr('src', src);

          if(data.status=='1'){
            $( ".status" ).html('Active');
          }else{
            $( ".status" ).html('Inactive');
          }

          alert(data.proprietor_name[]);

          // $.each(data.proprietor_name, function(key, value) {
          //   alert(value.proprietor_name);
          // // $( ".proprietor_name" ).html( value );
          // });

          // $( ".proprietor_name" ).html( data.proprietor_name );
          $( ".proprietor_cnic_no" ).html( data.proprietor_cnic_no );
          $( ".proprietor_mobile_no" ).html( data.proprietor_mobile_no );


            $('#modal_form_show_data').modal('show'); // show bootstrap modal when complete loaded
            $('#error').html(" ");

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from database');
          }
        });
      // $('#modalEdit').modal('show');
      // $('#formID')[0].reset();
    }

</script>

