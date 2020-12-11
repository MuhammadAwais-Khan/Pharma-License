<?php
// $admin_detail = $this->admin->getRecordById($_SESSION['admin_id'], $tbl_name = 'tbl_admin');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <?php $this->load->view('templates/alerts');?>

      <h1>
        <?php echo ucwords(str_replace('_', ' ', $page_title)); ?>
        <small><?php echo ucwords(str_replace('_', ' ', $description)); ?></small>
      </h1>

    </section>

<section class="content" style="min-height: 0;">
      <div class="box box-success">
        <div class="box-body">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-3">

                <div class="form-group">
                  <label><?php echo $label = ucwords('form type'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                  </div>
                  <select name="tbl_form_type_id" id="tbl_form_type_id" class="form-control select2 validate[required]">
                    <option value="">Select Form Type</option>

                    <?php foreach ($form_type as $form_typeInfo): ?>
                      <option value="<?php echo $form_typeInfo['id']; ?>"><?php echo $form_typeInfo['name']; ?></option>
                    <?php endforeach;?>
                  </select>
                </div><?php echo form_error('tbl_form_type_id'); ?>
                </div>

            </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label><?php echo $label = ucwords('from Date'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" readonly autocomplete="off" value="" name="from_date" id="from_date" class="form-control validate[required,minSize[1]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('from_date'); ?>
                </div>

            </div>

            <div class="col-md-3">
              <div class="form-group">
                  <label><?php echo $label = ucwords('to Date'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" readonly autocomplete="off" value="" name="to_date" id="to_date" class="form-control validate[required,minSize[1]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('to_date'); ?>
                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">
                  <label><?php echo $label = ucwords('district'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <select name="tbl_district_id" id="tbl_district_id" class="form-control select2 validate[required]">
                    <option value="">Select district</option>

                    <?php foreach ($district as $districtInfo): ?>
                      <option value="<?php echo $districtInfo['id']; ?>"><?php echo $districtInfo['name']; ?></option>
                    <?php endforeach;?>
                  </select>
                </div><?php echo form_error('tbl_district_id'); ?>
                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">
                  <label><?php echo $label = ucwords('status'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>

                  <select name="status" id="status" class="form-control select2 validate[required]">
                    <option value="">Select Status</option>
                    <option value="4">Approved</option>
                    <option value="1">Approve for Inspection</option>
                    <option value="2">Pending/ Inprocess</option>
                    <option value="0">Rejected / Not Approved</option>
                  </select>
                </div><?php echo form_error('status'); ?>
                </div>

            </div>

            <div class="col-md-3">
              <div class="form-group">
                  <label><?php echo $label = ucwords('tracking code'); ?>:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-code-fork"></i>
                  </div>

                  <input type="text" autocomplete="off" value="" name="tracking_code" id="tracking_code" class="form-control validate[required,minSize[1]" placeholder="Enter <?php echo $label; ?>" />
                </div><?php echo form_error('tracking_code'); ?>
                </div>

            </div>

          </div>
          <!-- /.row -->
        </div>

          </div>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title pull-left"><?php echo ucwords(str_replace('_', ' ', 'All forms Licenses Detail report')); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="ssp_datatable" class="table table-bordered table-striped table-hover table-condensed display dataTable">
                <thead>
                <tr>
                  <th width="2%"><?php echo ucwords(str_replace('_', ' ', 'Sr.')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'From type')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'Proprietor')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'Business name')); ?></th>
                  <th width="5%"><?php echo ucwords(str_replace('_', ' ', 'district')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'Application Date')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'approval date')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'assigned inspector')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'inspection date')); ?></th>
                  <th width="8%"><?php echo ucwords(str_replace('_', ' ', 'tracking_code')); ?></th>
                  <th width="5%"><?php echo ucwords(str_replace('_', ' ', 'status')); ?></th>
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



  <!-- /.content-wrapper -->

<!-- for image / gallery -->
<script>
    baguetteBox.run('.tz-gallery');
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
        "serverMethod": "post",

        // Initial no order.
        "order": [],
        "filter": false,
        "searching": false,

        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('common/get_form_report/'); ?>",
            // "type": "POST"
            'data': function(data){
                data.tbl_form_type_id = $('#tbl_form_type_id').val();
                data.tbl_district_id = $('#tbl_district_id').val();
                data.from_date = $('#from_date').val();
                data.to_date = $('#to_date').val();
                data.status = $('#status').val();
                data.tracking_code = $('#tracking_code').val();
            }
        },
        //Set column definition initialisation properties
        // "columnDefs": [{
        //     "targets": [0,5,6],
        //     "orderable": false
        // }]
        'columns': [
            { data: 'no' },
            { data: 'formType' },
            { data: 'proprietor' },
            { data: 'businessName' },
            { data: 'district' },
            { data: 'applicationDate' },
            { data: 'approvalDate' },
            { data: 'inspector' },
            { data: 'inspectionDate' },
            { data: 'trackingCode' },
            { data: 'status' },
          ],
          //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,1,2,3,4,5,6,7,8],
            "orderable": false
        }]
    });


    $('#tbl_district_id,#status,#tbl_form_type_id').change(function(){
        sspDataTable.draw();
      });

      $('#from_date').focusout(function(){
        sspDataTable.draw();
      });

      $('#to_date').focusout(function(){
        sspDataTable.draw();
      });

      $('#tracking_code').keyup(function(){
        sspDataTable.draw();
      });

        });

function reload_table()
    {
      ssp_datatable.ajax.reload(null,false); //reload datatable ajax
    }
  </script>

  <script type="text/javascript">
  $(function () {
        $('#from_date').datetimepicker({
            useCurrent: false,
            // defaultDate: null,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });
    });

  $(function () {
        $('#to_date').datetimepicker({
            useCurrent: false,
            format:"DD-MM-YYYY",
            showTodayButton:true,
            ignoreReadonly:true
        });
        // $('#to_date').val("");


    });
</script>
