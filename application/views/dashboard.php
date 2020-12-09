<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <?php $this->load->view('templates/alerts');?>

    <h1>
      <?php echo $page_title; ?>
      <small><?php echo $description; ?></small>
      <i><small style="float: right;"><?php echo $rightDescription; ?></small></i>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <?php if ($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2') {?>
      <?php $countForm8A = $this->global->count('tbl_form_8a', null);?>
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $countForm8A; ?></h3>

              <p>Form 8A - Pharmacy</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card"></i>
            </div>
            <a href="<?php echo base_url('view_form_8a'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php }?>

      <?php if ($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2') {?>

        <?php $countForm8B = $this->global->count('tbl_form_8b', null);?>
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $countForm8B; ?></h3>

              <p>Form 8B - Retail Store</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card"></i>
            </div>
            <a href="<?php echo base_url('view_form_8b'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php }?>
      <?php if ($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2') {?>

        <?php $countForm8c = $this->global->count('tbl_form_8c', null);?>
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $countForm8c; ?></h3>

              <p>Form 8C - Whole Sale</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card"></i>
            </div>
            <a href="<?php echo base_url('view_form_8c'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php }?>
      <?php if ($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2') {?>

        <?php $countForm8d = $this->global->count('tbl_form_8d', null);?>
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $countForm8d; ?></h3>
              <p>Form 8D - Narcotics</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card"></i>
            </div>
            <a href="<?php echo base_url('view_form_8d'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php }?>
      <?php if ($_SESSION['tbl_role_id'] == '3') {?>

        <?php $countInspection = $this->global->count('tbl_inspection', null);?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $countInspection; ?></h3>

              <p>Total Inspection</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php }?>

      <?php if ($_SESSION['tbl_role_id'] == '3') {?>

        <?php $countInspection1 = $this->global->count('tbl_inspection', array('inspection_status' => '2'));?>
        <?php $countInspection2 = $this->global->count('tbl_inspection', array('inspection_status' => '4'));?>
        <?php $countInspection = $countInspection1 + $countInspection2;?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $countInspection; ?></h3>

              <p>Pending Inspection</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <?php $countInspection = $this->global->count('tbl_inspection', array('inspection_status' => '1'));?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countInspection; ?></h3>

              <p>Approved Inspection</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php }?>

      <?php if ($_SESSION['tbl_role_id'] == '5') {?>

        <?php $countProp = $this->global->count('tbl_proprietor', array('record_add_by' => $_SESSION['user_id']));?>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $countProp; ?></h3>

              <p>Proprietors Details</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url('view_proprietor'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
        <?php $userLicenseApproved = $this->global->count('tbl_inspection', array('inspection_status' => '1'));?>

          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $userLicenseApproved; ?></h3>

              <p>License Approved</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php }?>

      <?php if ($_SESSION['tbl_role_id'] == '4') {?>

        <?php $countPharmacist = $this->global->count('tbl_pharmacist', null);?>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Qualified Person</span>
              <span class="info-box-number"><?php echo $countPharmacist; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <?php $countQualification = $this->global->count('tbl_qualification', null);?>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Qualification</span>
              <span class="info-box-number"><?php echo $countQualification; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <?php $countCategory = $this->global->count('tbl_pharmacist_category', null);?>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-medkit"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Category</span>
              <span class="info-box-number"><?php echo $countCategory; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <?php $countInstitute = $this->global->count('tbl_institute', null);?>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bank"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Institute</span>
              <span class="info-box-number"><?php echo $countInstitute; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      <?php }?>

        </div>

        <!-- charts -->
<?php if ($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2') {?>

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div id="month_wise"></div>
  </div>



  <div class="col-md-6 col-sm-6 col-xs-12">
    <div id="detail_application"></div>
  </div>


</div>
<br>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div id="district_wise"></div>
  </div>
</div>
<?php }?>

      </section>
      <!-- /.content -->
    </div>
<?php if ($_SESSION['tbl_role_id'] == '1' || $_SESSION['tbl_role_id'] == '2') {?>

<script type="text/javascript">

$(function () {

    var data_detail_application_form_8a = <?php echo $detail_application_form_8a; ?>;
    var data_detail_application_form_8b = <?php echo $detail_application_form_8b; ?>;
    var data_detail_application_form_8c = <?php echo $detail_application_form_8c; ?>;
    var data_detail_application_form_8d = <?php echo $detail_application_form_8d; ?>;

Highcharts.chart('detail_application', {
    chart: {
        type: 'column'
    },
     //   chart: {
      //   type: 'column',
      //   options3d: {
      //       enabled: true,
      //       alpha: 10,
      //       beta: 5,
      //       depth: 90
      //   }
      // },
    title: {
        text: 'Detail of Applications'
    },
    xAxis: {
        categories: ['Total<br>Application', 'Approved', 'Inspection<br>Approved<br>(DG Drug)', 'Pending<br>(DG Drug)', 'Reject<br>(DG Drug)','Accept<br>(Inspector)','Pending<br>(Inspector)','Reject<br>(Inspector)']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No. of Applications'
        }
    },
    // legend: {
    //     reversed: true
    // },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'Form 8A',
        data: data_detail_application_form_8a
    }, {
        name: 'Form 8B',
        data: data_detail_application_form_8b
    }, {
        name: 'Form 8C',
        data: data_detail_application_form_8c
    }, {
        name: 'Form 8D',
        data: data_detail_application_form_8d
    }]
});

});

</script>

<script type="text/javascript">

$(function () {

    var data_district_form_8a = <?php echo $district_form_8a; ?>;
    var data_district_form_8b = <?php echo $district_form_8b; ?>;
    var data_district_form_8c = <?php echo $district_form_8c; ?>;
    var data_district_form_8d = <?php echo $district_form_8d; ?>;
    var data_district_form = <?php echo $district_form; ?>;

    $('#district_wise').highcharts({
        chart: {
            type: 'column'
        },

      //   chart: {
      //   type: 'column',
      //   options3d: {
      //       enabled: true,
      //       alpha: 10,
      //       beta: 5,
      //       depth: 90
      //   }
      // },
        title: {
            text: 'District Wise Application'
        },
        xAxis: {
            categories: data_district_form
        },
        yAxis: {
            title: {
                text: 'No. of Application'
            }
        },
        series: [{
            name: 'Form 8A',
            data: data_district_form_8a
            // data: [0,1,2,3]
        }, {
            name: 'Form 8B',
            // data: [0,4,5,6]
            data: data_district_form_8b
        },
        {
            name: 'Form 8C',
            // data: [0,1,1,2]
            data: data_district_form_8c
        }, {
            name: 'Form 8D',
            data: data_district_form_8d
            // data: [0,3,4,6]
        }]
    });
});

</script>
<script type="text/javascript">

$(function () {

    var data_form_8a = <?php echo $form_8a; ?>;
    var data_form_8b = <?php echo $form_8b; ?>;
    var data_form_8c = <?php echo $form_8c; ?>;
    var data_form_8d = <?php echo $form_8d; ?>;
    var data_form_years = <?php echo $form_years; ?>;

    $('#month_wise').highcharts({
        chart: {
            type: 'bar'
        },
      //   chart: {
      //   type: 'column',
      //   options3d: {
      //       enabled: true,
      //       alpha: 10,
      //       beta: 5,
      //       depth: 70
      //   }
      // },
        title: {
            text: 'Monthly Received Applications'
        },
        xAxis: {
            categories: data_form_years
        },
        yAxis: {
            title: {
                text: 'No. of Application'
            }
        },
        series: [{
            name: 'Form 8A',
            data: data_form_8a
        },{
            name: 'Form 8B',
            data: data_form_8b
        },{
            name: 'Form 8C',
            data: data_form_8c
        },{
            name: 'Form 8D',
            data: data_form_8d
        }]
    });
});

</script>
<?php }?>
