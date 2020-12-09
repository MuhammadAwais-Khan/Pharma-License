<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <?php $this->load->view('templates/alerts');?>

      <h1>
        <?php echo ucwords(str_replace('_', ' ', $page_title)); ?>
        <small><?php echo ucwords(str_replace('_', ' ', $description)); ?></small>
      </h1>

    </section>

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

    <section class="content">
      <div class="row">
<div class="col-md-12">

  <!-- personal info start -->
  <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo ucwords('Detail Information'); ?></h3>
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
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_name')); ?></td>
              <td class="tdvb"><?php echo $all['name']; ?></td>

              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'father_name')); ?></td>
              <td class="tdvb"><?php echo $all['father_name']; ?></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'CNIC_no')); ?></td>
              <td class="tdvb"><?php echo $all['cnic_no']; ?></td>

              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'gender')); ?></td>
              <td class="tdvb"><?php echo $all['gender']; ?></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'business_name')); ?></td>
              <td class="tdvb"><?php echo $all['business_name']; ?></td>

              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'mobile_no')); ?></td>
              <td class="tdvb"><?php echo $all['mobile_no']; ?></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'business_address')); ?></td>
              <td class="tdvb"><?php echo $all['business_address']; ?></td>

              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'home_address')); ?></td>
              <td class="tdvb"><?php echo $all['home_address']; ?></td>
            </tr>
            <?php $getMorePropritors = $this->global->getAllRecordByArray('tbl_more_proprietor', array('tbl_proprietor_id' => $all['id']));?>
      <?php if ($getMorePropritors) {?>
            <tr>
              <td colspan="4" class="tdva">More Proprietors</td>
            </tr>
      <?php $j = 2;foreach ($getMorePropritors as $key => $getMorePropritorsInfo) {?>

            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_name')) . ' ' . $j; ?></td>
              <td class="tdvb"><?php echo $getMorePropritorsInfo['proprietor_name']; ?></td>

              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_cnic_no')) . ' ' . $j; ?></td>
              <td class="tdvb"><?php echo $getMorePropritorsInfo['proprietor_cnic_no']; ?></td>
            </tr>
            <tr>
              <td class="tdva"><?php echo ucwords(str_replace('_', ' ', 'proprietor_mobile_no')) . ' ' . $j; ?></td>
              <td colspan="3" class="tdvb"><?php echo $getMorePropritorsInfo['proprietor_mobile_no']; ?></td>
            </tr>
            <?php $j++;}?>
          <?php }?>

          </table>
    </div>
            </div>


          </div>
          <!-- /.row -->
        </div>

      </div>
  <!-- personal info end -->

</div>




  </div>



<div class="row">
         <!-- /.col -->
        <div class="col-md-12 text-right no-print">
          <button type="button" name="print" value="print" class="btn btn-success  btn-sm" onclick="window.print();"><i class="fa fa-print"> </i> Print</button>
    <a href="<?php echo base_url(dashboard); ?>" class="btn btn-danger  btn-sm" type="button"> <i class="fa fa-chevron-left"> </i> Cancel/Back</a>

        </div>
        <!-- /.col -->
      </div>

      </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">

  var i=<?php echo $j; ?>;
    $('#add_row').click(function(){
           // i++;
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
                  '<label><?php echo $label = ucwords(str_replace('_', ' ', 'CNIC_no')); ?>:</label>'+
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
                  '<label><?php echo $label = ucwords(str_replace('_', ' ', 'mobile_no')); ?>:</label>'+
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
           i++;
      });

  $(document).on("focus", ".proprietor_cnic_no", function() {
    $(".proprietor_cnic_no").mask("99999-9999999-9");
  });
   $(document).on("focus", ".proprietor_mobile_no", function() {
    $(".proprietor_mobile_no").mask("9999-9999999");
  });

      $(document).on('click', '.btn_remove', function(){
           $(".overlay").show();
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
           $(".overlay").hide();
      });

      $(document).on('click', '.btn_remove_awais', function(){
          $(".overlay").show();
           var button_id = $(this).attr("id");
           $('#awais'+button_id+'').remove();
          $(".overlay").hide();

      });

function removeRowAwais(tr_id)
  {
    $(".overlay").show();
    $("#Awaisrow"+tr_id).remove();
    $(".overlay").hide();
  }

function removeRow(tr_id)
  {
    $(".overlay").show();
    $("#dynamic_field tbody tr#row"+tr_id).remove();
    $(".overlay").hide();
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