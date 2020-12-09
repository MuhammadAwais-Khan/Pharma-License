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
              <h3 class="box-title pull-left"><?php echo ucwords(str_replace('_', ' ', 'form_types detail')); ?></h3>
             <!--  <h3 class="box-title pull-right">
                <a href="<?php echo base_url(); ?>add_admin" type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-trash-o"> all </i></a></h3> -->

                <!-- <h3 class="box-title pull-right">

                  <?php if ($_SESSION['tbl_role_id'] == '1') {?>
                    <button type="button" onclick="add()" class="btn btn-block btn-success btn-sm">
                <i class="fa fa-plus"> New </i>
              </button>
              <?php }?>
              </h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="ssp_datatable" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                <tr>
                  <th width="2%"><?php echo ucwords(str_replace('_', ' ', 'Sr.')); ?></th>
                  <th width="10%"><?php echo ucwords(str_replace('_', ' ', 'form_type name')); ?></th>
                  <th width="5%"><?php echo ucwords(str_replace('_', ' ', 'status')); ?></th>
                  <th width="5%"><?php echo ucwords(str_replace('_', ' ', 'add by/date')); ?></th>
                  <th width="3%" class="no-print"><?php echo ucwords(str_replace('_', ' ', 'action')); ?></th>
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
  input{
    background: transparent;
    border: none;
    height: 40px;
  }

    .sselect{
    background: transparent;
    border: none;
    height: 40px;
    color: #000;
  }

.sselect {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: 2px 30px 2px 2px;
    border: none;
}
.tdva{
  font-weight: bold;
  vertical-align: middle !important;
}
.tdvb{
  vertical-align: middle !important;
}
</style>
<div id="modal_form_show_data" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo ucwords(str_replace('_', ' ', 'Form_type Detail')); ?></h4>

      </div>
      <p class="jquery_alert_modal"></p>


      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover table-condensed">
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'form_type_name')); ?></td>
              <td class="tdvb form_type_name"></td>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'status')); ?></td>
              <td class="tdvb status"></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'rules')); ?></td>
              <td colspan="3" class="tdvb rules"></td>
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
        <h4 class="modal-title"><?php echo ucwords(str_replace('_', ' ', 'edit form_type')); ?></h4>
      </div>
      <p class="jquery_alert_modal"></p>


        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('#', 'id="formID" class="form-horizontal"'); ?>
      <div class="modal-body">

            <div class="form-group">
                  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'form_type name')); ?>:</label>
                  <div class="col-md-8">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                  </div>
                  <input type="hidden" value="" name="id"/>
                  <input type="text" autocomplete="off" value="<?php echo set_value('name'); ?>" name="name" id="name" class="form-control validate[required,minSize[3],maxSize[25]]" placeholder="Enter <?php echo $label; ?>" />
                </div><div id="error"></div>
                </div>

            </div>

            <div class="form-group">
                  <label class="label-control col-md-4"><?php echo $label = ucwords(str_replace('_', ' ', 'form_type name')); ?>:</label>
                  <div class="col-md-8">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-gavel"></i>
                  </div>
                  <textarea name="rules" id="rules" class="form-control validate[required,minSize[1]]"></textarea>
                </div><div id="error"></div>
                </div>

            </div>

            <div class="form-group">
                  <label class="label-control col-md-4"><?php echo $label = ucwords('status') ?>:</label>
                  <div class="col-md-8">
                  <div class="input-group">
                    <input type="radio" id="status" name="status" value="1"> Active &nbsp;
                    <input type="radio" id="status" name="status" value="0"> Inactive
                  </div><div id="error"></div>
                </div>
            </div>


      </div>
          <?php echo form_close(); ?>

      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="save()" id="btnSave" name="btnSave" class="btn btn-primary  btn-sm"><i class="fa fa-plus"> </i> Save Record</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
  <!-- /.content-wrapper -->

<!-- for image / gallery -->
<script>
    baguetteBox.run('.tz-gallery');
</script>
<script type="text/javascript">
CKEDITOR.replace("rules");
CKEDITOR.instances['rules'].on('change',function(){
CKEDITOR.instances['rules'].updateElement();

});
</script>
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
            "url": "<?php echo base_url('form_type/get_form_type/'); ?>",
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
        url = "<?php echo site_url('form_type/add_form_type') ?>";
      }
      else
      {
        url = "<?php echo site_url('form_type/update_form_type') ?>";
      }

       // ajax adding data to database
       $.ajax({

                    type: "POST",
                    url: url,
                    async: false,
                    // data: formData,
                    data: $("#formID").serialize(),
                    dataType: "json",
                    success: function(data){

                        $.each(data, function(key, value) {
                          if(value==true){
                            $('#modal_form').modal('hide');
                            form_reset();
                            sspDataTable.ajax.reload(); //reload datatable ajax
                            $('.jquery_alert').html('<p class="alert alert-success">! Record has been successfully Added / Updated</p>').fadeIn().delay(4000).fadeOut('slow');
                          }
                          // else
                          else {
                            if(value==false){
                            $('.jquery_alert_modal').html('<p class="alert alert-danger"> <strong>Oops! </strong> Data already Exists or Field may only contain A-Z, a-z and 0-9 characters.</p>').fadeIn().delay(4000).fadeOut('slow');
                          }
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).parents('.form-group').find('#error').html(value);
                          }
                        });
                    }
                });
     }

function add()
    {
      save_method = 'add';
      form_reset() // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('<?php echo ucwords(str_replace('_', ' ', 'add new form_type')); ?>'); // Set Title to Bootstrap modal title

      $('input[name^="status"][value="1"').prop('checked',true);

    }

function form_reset()
    {
      $('#formID')[0].reset(); // reset form on modals
      $('#error').html(" ");
      $('div[id=error]').html(" ");

      //this is for to clear/reset ckeditor values
    //   for ( instance in CKEDITOR.instances ){
    //     CKEDITOR.instances[instance].updateElement();
    //     CKEDITOR.instances[instance].setData('');
    // }
    CKEDITOR.instances.rules.setData('');


 };

// getData function for get data for editment and updating
  function getData(id)
  {
      form_reset();
      save_method = 'update';

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('form_type/getData/') ?>/" + id,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {


          $('[name="id"]').val(data.id);
          $('[name="name"]').val(data.name);
          CKEDITOR.instances.rules.setData( data.rules );
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
        url : "<?php echo site_url('form_type/getData/') ?>/" + id,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {


          $( ".form_type_name" ).html( data.name );
          $( ".rules" ).html( data.rules );

          // CKEDITOR.instances.rules.setData( data.rules );
          if(data.status=='1'){
            $( ".status" ).html('Active');
          }else{
            $( ".status" ).html('Inactive');
          }

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