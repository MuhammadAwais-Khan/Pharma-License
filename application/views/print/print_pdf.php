<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo (!empty($page_title)) ? ucwords(str_replace('_', ' ', $page_title)) . ' : Drug Control & Pharmacy Services Health Department KP ' : ' Drug Control & Pharmacy Services Health Department KP'; ?></title>

  <link rel="icon" href="<?php echo base_url('assets/upload/images/'); ?>favicon.ico" type="image/x-icon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url('assets/js/') ?>bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/AdminLTE.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/skins/skin-green.min.css"> -->
</head>
<body class="hold-transition skin-green sidebar-collapse fixed" oncontextmenu="return false;">
<div class="box" style="margin-bottom: 0px; border-radius: 0;border-top: 0; position: unset; box-shadow: unset;"> <!-- class box ending tag is in endhtml.php -->

<style type="text/css">
  .box .overlay, .overlay-wrapper .overlay {
    z-index: 1051;
    background: rgba(255,255,255,0.7);
    border-radius: 3px;
}
</style>
<div class="row">
  <div class="col-md-12 text-center">
    <img width="140px" height="140px" src="<?php echo base_url('assets/upload/images/bfc.png'); ?>" class="img-circle" />
    <?php $getFormType = $this->global->getRecordById($all['tbl_form_type_id'], 'tbl_form_type');?>
            <h3 class="box-title">
            Drug Control & Pharmacy Services Health Department KP<br>
              <?php echo ucwords('Applicant Detail'); ?> - <?php echo $getFormType['name']; ?>
              </h3>
  </div>
</div>
<div class="content-wrapper" style="padding-top: 0;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <?php $getFormType = $this->global->getRecordById($all['tbl_form_type_id'], 'tbl_form_type');?>
            <h3 class="box-title"><?php echo ucwords('Applicant Detail'); ?> - <?php echo $getFormType['name']; ?></h3> -->
          </div>
          <!--           <?php
$path = base_url('assets/upload/images/bfc.png');
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>
          <img src="<?php echo $base64 ?>" width="150" height="150"/> -->
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
                      <!-- <td class="tdvb"><?php echo wordwrap($getProprietor['name'], 22, "<br>\n"); ?></td> -->
                      <td class="tdvb" style="white-space:normal;"><?php echo $getProprietor['name']; ?></td>
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
                      <td class="tdva">Business Name</td>
                      <td colspan="2" class="tdvb"><?php echo $getProprietor['business_name']; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">Business Address</td>

                      <!-- <td colspan="2" class="tdvb"><?php echo wordwrap($getProprietor['business_address'], 70, "<br>\n"); ?></td> -->
                      <td colspan="2" class="tdvb" style="white-space:normal;"><?php echo $getProprietor['business_address']; ?></td>
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
                      <td class="tdva">Name </td>

                      <!-- <td class="tdvb"><?php echo wordwrap($getPharmacist['name'], 22, "<br>\n"); ?></td> -->
                      <td class="tdvb" style="white-space:normal;"><?php echo $getPharmacist['name']; ?></td>
                      <td class="tdva">CNIC No </td>
                      <td class="tdvb"><?php echo $getPharmacist['cnic']; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">Father Name </td>

                      <!-- <td class="tdvb"><?php echo wordwrap($getPharmacist['father_name'], 22, "<br>\n"); ?></td> -->
                      <td class="tdvb" style="white-space:normal;"><?php echo $getPharmacist['father_name']; ?></td>
                      <?php if ($getPharmacist['tbl_qualification_id']) {?>
                      <?php $get = $this->global->getRecordById($getPharmacist['tbl_qualification_id'], 'tbl_qualification');?>
                      <td class="tdva">Qualification </td>
                      <td class="tdvb"><?php echo $get['name']; ?></td>
                      <?php } else {?>
                      <td class="tdva">Qualification </td>
                      <td class="tdvb"><?php echo $getPharmacist['qualification']; ?></td>
                      <?php }?>
                    </tr>
                    <tr>
                      <?php if ($getPharmacist['tbl_institute_id']) {?>
                      <td class="tdva">Institute </td>
                      <?php $get = $this->global->getRecordById($getPharmacist['tbl_institute_id'], 'tbl_institute');?>
                      <td class="tdvb"><?php echo $get['name']; ?></td>
                      <?php } else {?>
                      <td class="tdva">Institute </td>
                      <td class="tdvb"><?php echo $getPharmacist['institute']; ?></td>
                      <?php }?>
                      <?php if ($getPharmacist['tbl_pharmacist_category_id']) {?>
                      <?php $get = $this->global->getRecordById($getPharmacist['tbl_pharmacist_category_id'], 'tbl_pharmacist_category');?>
                      <td class="tdva">Category </td>
                      <td class="tdvb"><?php echo $get['name']; ?></td>
                      <?php } else {?>
                      <td class="tdva">Category </td>
                      <td class="tdvb"><?php echo $getPharmacist['category']; ?></td>
                      <?php }?>
                    </tr>
                    <tr>
                      <td class="tdva">Country </td>
                      <td class="tdvb"><?php echo $getPharmacist['country']; ?></td>
                      <td class="tdva">Province </td>
                      <td class="tdvb"><?php echo $getPharmacist['province']; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">Registration No </td>
                      <td class="tdvb"><?php echo $getPharmacist['pharmacy_reg_no']; ?></td>
                      <td class="tdva">Is Verified?</td>
                      <?php
if ($getPharmacist['is_verify'] == 'no') {
	$is_verify = 'No';
} else if ($getPharmacist['is_verify'] == 'yes') {
	$is_verify = 'Yes';
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
                      <!-- </tr> -->
                      <?php $get = $this->global->getRecordById($all['tbl_province_id'], 'tbl_province');?>
                      <!-- <tr> -->
                      <td class="tdva">Province</td>
                      <td class="tdvb"><?php echo $get['name']; ?></td>
                    </tr>
                    <?php $get = $this->global->getRecordById($all['tbl_district_id'], 'tbl_district');?>
                    <tr>
                      <td class="tdva">District</td>
                      <td class="tdvb"><?php echo $get['name']; ?></td>
                      <!-- </tr> -->
                      <?php $get = $this->global->getRecordById($all['tbl_tehsil_id'], 'tbl_tehsil');?>
                      <!-- <tr> -->
                      <td class="tdva">Tehsil</td>
                      <td class="tdvb"><?php echo $get['name']; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">Godaam Address</td>

                      <!-- <td colspan="3" class="tdvb"><?php echo wordwrap($all['godaam_address'], 75, "<br>\n"); ?></td> -->
                      <td colspan="3" class="tdvb" style="white-space:normal;"><?php echo $all['godaam_address']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table style="table-layout: fixed;" class="table table-bordered table-striped table-hover table-condensed">
                    <tr>
                      <td style="width: 100%;" colspan="4" class="tdva"><span style="color: green;">Dg Drug Details</span></td>
                    </tr>
                    <tr>
                      <td style="width: 25%;" class="tdva">Status</td>
                      <?php if ($all['status'] == 0) {$status = 'Rejected / Not Approved';} else if ($all['status'] == 1) {$status = 'Approve for Inspection';} else if ($all['status'] == 2) {$status = 'Pending / Inprocess';} else if ($all['status'] == 4) {$status = 'Approved';}?>
                      <td style="width: 25%;" class="tdvb"><?php echo $status; ?></td>
                      <td style="width: 25%;" class="tdva">Dg Approval Date</td>
                      <?php if ($all['dg_approval_date']) {
	$dgApprovalDate = date('d-m-Y', strtotime($all['dg_approval_date']));}?>
                      <td style="width: 25%;" class="tdvb"><?php echo $dgApprovalDate; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 25%;" class="tdva">Dg Remarks</td>

                      <!-- <td style="width: 75%;" colspan="3" class="tdvb"><?php echo wordwrap($all['remarks'], 75, "<br>\n"); ?></td> -->
                      <td style="width: 75%; white-space: normal;" colspan="3" class="tdvb"><?php echo $all['remarks']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <?php $getInspection = $this->global->getRecordByArray('tbl_inspection', array('tbl_name' => $getFormType['db_tbl_name'], 'tbl_name_id' => $all['id']));?>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover table-condensed">
                    <tr>
                      <td colspan="4" class="tdva"><span style="color: green;">Inspection Details</span></td>
                    </tr>
                    <?php if (!empty($getInspection['inspection_date'])) {?>
                    <?php // if ($getInspection['inspection_status'] != '4') {?>
                    <tr>
                      <td class="tdva">Inspection Date</td>
                      <?php $inspectionDate = date('d-m-Y', strtotime($getInspection['inspection_date']));?>
                      <td class="tdvb"><?php echo $inspectionDate; ?></td>
                      <td class="tdva">Inspection Status</td>
                      <?php if ($getInspection['inspection_status'] == 2) {$status = 'Pending/ Inprocess';} else if ($getInspection['inspection_status'] == 1) {$status = 'Approved/Inspected';} else if ($getInspection['inspection_status'] == 0) {$status = 'Rejected';} else if ($getInspection['inspection_status'] == 4) {$status = 'Not Inspected';}?>
                      <td class="tdvb"><?php echo $status; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">License Type</td>
                      <td class="tdvb"><?php echo $getInspection['license_type']; ?></td>
                      <td class="tdva">Inspect By</td>
                      <?php $getInspector = $this->global->getRecordById($getInspection['inspector_id'], 'tbl_user');?>
                      <td class="tdvb"><?php echo $getInspector['name']; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">Inspection Remarks</td>

                      <!-- <td colspan="3" class="tdvb"><?php echo wordwrap($getInspection['inspection_remarks'], 75, "<br>\n"); ?></td> -->
                      <td colspan="3" class="tdvb" style="white-space:normal;"><?php echo $getInspection['inspection_remarks']; ?></td>
                    </tr>
                    <?php //}?>
                    <?php } else {?>
                    <tr><td colspan="4" class="tdva">Not Inspected</td></tr>
                    <?php }?>
                  </table>
                </div>
              </div>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover table-condensed">
                    <tr>
                      <td colspan="4" class="tdva"><span style="color: green;">Application Fees</span></td>
                    </tr>
                    <?php if (!empty($all['tbl_bank_id'])) {?>
                    <tr>
                      <td class="tdva">Bank</td>
                      <?php $getBank = $this->global->getRecordById($all['tbl_bank_id'], 'tbl_banks');?>
                      <td class="tdvb"><?php echo $getBank['name']; ?></td>
                      <td class="tdva">Bank Branch</td>
                      <?php $getBankBranch = $this->global->getRecordById($all['tbl_bank_branch_id'], 'tbl_bank_branch');?>
                      <td class="tdvb"><?php echo $getBankBranch['name']; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">Amount</td>
                      <td class="tdvb"><?php echo $all['amount']; ?></td>
                      <td class="tdva">Challan Number</td>
                      <td class="tdvb"><?php echo $all['challan_no']; ?></td>
                    </tr>
                    <tr>
                      <td class="tdva">Challan Date</td>
                      <td colspan="3" class="tdvb"><?php echo $all['challan_date']; ?></td>
                    </tr>
                    <?php } else {?>
                    <tr><td colspan="4" class="tdva">Not Paid</td></tr>
                    <?php }?>
                  </table>
                </div>
              </div>
              <!-- /.col -->
              <?php $getApplicationValidity = $this->global->getRecordByArray('tbl_application_renewel', array('tbl_name' => $getFormType['db_tbl_name'], 'tbl_name_id' => $all['id']));?>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover table-condensed">
                    <tr>
                      <td colspan="4" class="tdva"><span style="color: green;">Application Validity</span></td>
                    </tr>
                    <?php if (!empty($getApplicationValidity['issue_date'])) {?>
                    <tr>
                      <td class="tdva">License Issue Date</td>
                      <?php $issueDate = date('d-m-Y', strtotime($getApplicationValidity['issue_date']));?>
                      <td class="tdvb"><?php echo $issueDate; ?></td>
                      <td class="tdva">License Expiry Date</td>
                      <?php $expiryDate = date('d-m-Y', strtotime($getApplicationValidity['expiry_date']));?>
                      <td class="tdvb"><?php echo $expiryDate; ?></td>
                    </tr>
                    <?php } else {?>
                    <tr><td colspan="4" class="tdva">Not Issued</td></tr>
                    <?php }?>
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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
</div>
</body></html>