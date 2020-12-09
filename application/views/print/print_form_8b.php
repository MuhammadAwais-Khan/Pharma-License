<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo (!empty($page_title)) ? ucwords(str_replace('_', ' ', $page_title)) . ' : Drug Control & Pharmacy Services Health Department KP ' : ' Drug Control & Pharmacy Services Health Department KP'; ?></title>
  <link rel="icon" href="<?php echo base_url('assets/upload/images/'); ?>favicon.ico" type="image/x-icon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url('assets/js/') ?>bootstrap.min.css">

</head>

<?php $all = $this->global->getRecordByArray('tbl_form_8b', array('id' => $id));?>
  <?php $getProprietor = $this->global->getRecordByArray('tbl_proprietor', array('id' => $all['tbl_proprietor_id']));?>
  <?php $getPharmacist = $this->global->getRecordByArray('tbl_pharmacist', array('id' => $all['tbl_pharmacist_id']));?>
  <?php $getDates = $this->global->getRecordByArray('tbl_application_renewel', array('tbl_name' => 'tbl_form_8b', 'tbl_name_id' => $id));?>


<body class="hold-transition skin-green sidebar-collapse fixed" oncontextmenu="return false;">
<div class="box" style="margin-bottom: 0px; border-radius: 0;border-top: 0; position: unset; box-shadow: unset;"> <!-- class box ending tag is in endhtml.php -->
<div class="content-wrapper" style="padding-top: 0;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"></div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table style="table-layout: fixed;" class="table table-condensed">
                    <tr>
                      <td class="tdva text-left"><br><img src="<?php echo base_url() . IMG_UPLOAD_PATH . 'pharmacist/' . $getPharmacist['image']; ?>" height="110px" width="110px" class="img-thumbnail">
                        <br>
                        Qualified Person
                        <br>
                        &nbsp;
                      </td>
                      <td class="tdvb text-center"><b><u>Form - 09</u></b></td>
                      <td class="tdvb text-right"><br>
                        <img class="img-thumbnail" height="100px" width="100px" src="<?php echo base_url() . IMG_UPLOAD_PATH . 'qr_codes/' . $all['qr_code']; ?>">
                        <br>License: <u>Retail/<?php echo $all['tracking_code']; ?></u>
                        <br> Date: <u><?php echo date('d/m/Y'); ?></u>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="tdvb text-center">{(See Rules 15(1))}</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="tdva text-center" style="white-space:normal;">LICENSE TO SELL, STOCK AND EXHIBIT FOR SALE AND DISTRIBUTE DRUGS BY WAY OF RETAIL SALE</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="tdvb text-justify">
                        <ol>
                          <li style="white-space:normal;">
                            <b><u><?php echo $getProprietor['name']; ?> S/O <?php echo $getProprietor['father_name']; ?> Prop: M/S <?php echo $getProprietor['business_name']; ?> </u></b> is hereby licensed to sell stock and exibit for sale drugs by way of retail sale on the premises situated at <b><u> <?php echo ucwords($getProprietor['business_address']); ?> </u></b> subject to conditions specified below and to the provision of Drugs Act, 1976 and the rules made there under.
                            </li>
                          <br>
                          <br>
                          <li>This License will be force for two years from the date given below:</li>
                          <br>
                          <br>
                          <li>Name(s) of Qualified Person(s) <b><u><?php echo $getPharmacist['name']; ?> S/O <?php echo $getPharmacist['father_name']; ?></u></b></li>
                          <br>
                          <br>
                          <li>Registration No <b><u><?php echo $getPharmacist['pharmacy_reg_no']; ?></u></b> with
                            <?php if ($getPharmacist['tbl_pharmacist_category_id']) {?>
                          <?php $getCategory = $this->global->getRecordByArray('tbl_pharmacist_category', array('id' => $getPharmacist['tbl_pharmacist_category_id']));?>

                            <u><b><?php echo $getCategory['name']; ?></b></u>
                          <?php } else {?>
                            <u><b><?php echo $getPharmacist['category']; ?></b></u>
                          <?php }?>
                            </li>
                          <br>
                          <br>
                          <li>Addresses of Godown/where drugs shell be store.</li>
                          <br>
                          <br>
                          <?php $issue_date = date('d-m-Y', strtotime($getDates['issue_date']));?>
                          <?php $expiry_date = date('d-m-Y', strtotime($getDates['expiry_date']));?>
                          <li>From <b><u><?php echo $issue_date; ?> / <?php echo $expiry_date; ?></u></b></li>
                          <br>
                          <br>
                          <li>Dated: <u><?php echo date('d/m/Y'); ?></u></li>
                        </ol>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="tdvb text-right">
                        <br>
                        <b><u>LICENSING AUTHORITY</u></b>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="tdvb text-center">
                        <b><u>
                        CONDITIONS OF THE LICENSE</u></b>
                        <br>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="tdvb text-justify">
                        <ol>
                          <li style="white-space:normal;">
                This license shall be displayed in a prominent place in part of the premises open to the public.</li>
                          <li style="white-space:normal;">
                The License shall comply with the provisions of Drugs Act, 1976 and the rules made there under for the time being in force.</li>
                          <li style="white-space:normal;">
                The License shall report for with to the Licensing authority any change in the qualifief staff Incharge.
                </li>
                          <li style="white-space:normal;">
                No drug requiring special storage conditions of temperature and humidity shall be sold unless the precaution necessary for preserving the proprietors of the contents have been observed throughout the period during which it has been possession of the license.
              </li>
                        </ol>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<style type="text/css">
.tdva{
/* height: 30px; */
width: 25%;
font-weight: bold;
vertical-align: middle !important;
}
.tdvb{
/* height: 30px; */
width: 25%;
vertical-align: middle !important;
}

ol {
display: block;
list-style-type: decimal;
margin-block-start: 1em;
margin-block-end: 1em;
margin-inline-start: 0px;
margin-inline-end: 0px;
padding-inline-start: 30px;
padding-right: 15px;
}
table{
  padding-right: 5px;
  padding-left: 5px;
  /* padding: 5px; */
  /* border: 8px solid #000; */
}

.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #fff;
}

.box{
border-top: 0;
}
.table-responsive{
border: 3px dashed #000;

}
li{
  white-space: normal;
}
</style>
</div>
</body></html>