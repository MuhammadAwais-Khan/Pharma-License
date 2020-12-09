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
              <?php if ($_SESSION['tbl_role_id'] == '5') {?>

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

            <!-- <tr>
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
            </tr> -->


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


          // $.each(data.proprietor_name, function(key, value) {
          //   alert(value.proprietor_name);
          // // $( ".proprietor_name" ).html( value );
          // });

          // $( ".proprietor_name" ).html( data.proprietor_name );
          // $( ".proprietor_cnic_no" ).html( data.proprietor_cnic_no );
          // $( ".proprietor_mobile_no" ).html( data.proprietor_mobile_no );


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

