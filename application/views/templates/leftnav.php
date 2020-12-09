<?php
if ($_SESSION['user_id']) {
	$user_detail = $this->global->getRecordById($_SESSION['user_id'], $tbl_name = 'tbl_user');
}
?>
<style type="text/css">
  .skin-blue .sidebar-menu>li.header {
    color: #ffffff;
    background: #367fa8;
    font-weight: bold;
}

.user-panel>.image>img {
    width: 100%;
    max-width: 65px;
    height: auto;
}
</style>
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="image text-center">
        <img src="<?php echo base_url('assets/upload/images/bfc.png'); ?>" class="img-circle" alt="User Image">
      </div>
      <!-- <div class="pull-left info">
        <p><?php echo $user_detail['name']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div> -->
    </div>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Main Menu</li>
      <?php if (!empty($_SESSION['tbl_role_id'])) {?>
        <li class="treeview">
        <a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>
      <li class="treeview">

        <!-- <a href="<?php echo base_url('user/edit_user/' . safe_encode(safe_encode($user_detail['id']))); ?>"><i class="fa fa-user"></i> Your Profile</a> -->

        <a href="<?php echo base_url('user/edit_user/' . safe_encode($user_detail['id'])); ?>"><i class="fa fa-user"></i> Your Profile</a>
      </li>
      <?php if ($_SESSION['tbl_role_id'] == 1) {?>

      <li class="treeview">
        <a href="#"><i class="fa fa-users"></i> <span>Users</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('add_user'); ?>"><i class="fa fa-plus"></i> Add</a></li>
          <li><a href="<?php echo base_url('view_user'); ?>"><i class="fa fa-circle-o"></i> View </a></li>
        <li>
        <a href="<?php echo base_url('view_role'); ?>"><i class="fa fa-user"></i> <span>Role</span></a>
      </li>
        </ul>
      </li>

      <?php }?>
      <?php }?>
      <?php if ($_SESSION['tbl_role_id'] == 1) {?>

        <li class="treeview">
        <a href="#"><i class="fa fa-info-circle"></i> <span>Miscellaneous</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
      <li class="">
        <a href="<?php echo base_url('view_province'); ?>"><i class="fa fa-map"></i> <span>Province</span></a>
      </li>
      <li class="">
        <a href="<?php echo base_url('view_district'); ?>"><i class="fa fa-building-o"></i> <span>District</span></a>
      </li>
      <li class="">
        <a href="<?php echo base_url('view_tehsil'); ?>"><i class="fa fa-building-o"></i> <span>Tehsil</span></a>
      </li>
      <li class="">
        <a href="<?php echo base_url('view_form_type'); ?>"><i class="fa fa-book"></i> <span>Form Type</span></a>
      </li>
      <li class="">
        <a href="<?php echo base_url('view_form_type_docs'); ?>"><i class="fa fa-book"></i> <span>Form Type Docs</span></a>
      </li>
    </ul>
  </li>

  <li class="treeview">
        <a href="#"><i class="fa fa-bank"></i> <span>Banks</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
           <li class="">
        <a href="<?php echo base_url('view_banks'); ?>"><i class="fa fa-bank"></i> <span>Banks</span></a>
      </li>

      <li class="">
        <a href="<?php echo base_url('view_bank_branch'); ?>"><i class="fa fa-bank"></i> <span>Banks Branches</span></a>
      </li>

        </ul>
      </li>
<?php }?>


      <?php if ($_SESSION['tbl_role_id'] == 1 || $_SESSION['tbl_role_id'] == 5 || $_SESSION['tbl_role_id'] == 2) {?>

        <li class="treeview">
        <a href="<?php echo base_url('view_proprietor'); ?>"><i class="fa fa-money"></i> <span>Proprietor</span></a>
      </li>

      <?php if ($_SESSION['tbl_role_id'] == 5) {?>

      <li class="treeview">
        <a href="<?php echo base_url('view_other_pharmacist'); ?>"><i class="fa fa-certificate"></i> <span>Non KP Qualified Person</span></a>
      </li>
    <?php }?>

  <li class="treeview">
        <a href="#"><i class="fa fa-info-circle"></i> <span>License Applications</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
      <li class="">
        <a href="<?php echo base_url('view_form_8a'); ?>"><i class="fa fa-id-card"></i> <span>Form 8A - Pharmacy</span></a>
      </li>

      <li class="">
        <a href="<?php echo base_url('view_form_8b'); ?>"><i class="fa fa-id-card"></i> <span>Form 8B - Retail Store</span></a>
      </li>

      <li class="">
        <a href="<?php echo base_url('view_form_8c'); ?>"><i class="fa fa-id-card"></i> <span>Form 8C - Whole Sale</span></a>
      </li>

      <li class="">
        <a href="<?php echo base_url('view_form_8d'); ?>"><i class="fa fa-id-card"></i> <span>Form 8D - Narcotics</span></a>
      </li>

    </ul>
  </li>

  <?php if ($_SESSION['tbl_role_id'] == 1 || $_SESSION['tbl_role_id'] == 2) {?>

    <li class="treeview">
        <a href="#"><i class="fa fa-info-circle"></i> <span>License Reports</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
      <li class="">
        <a href="<?php echo base_url('form_reports'); ?>"><i class="fa fa-id-card"></i> <span>Forms Reports</span></a>
      </li>

      <li class="">
        <a href="<?php echo base_url('pendency_report'); ?>"><i class="fa fa-id-card"></i> <span>Pendency Report</span></a>
      </li>

    </ul>
  </li>


    <?php }?>

    <?php }?>

    <?php if ($_SESSION['tbl_role_id'] == 3 || $_SESSION['tbl_role_id'] == 3) {?>

      <li class="treeview">
        <a href="<?php echo base_url('view_inspection'); ?>"><i class="fa fa-info-circle"></i> <span>Inspection</span></a>
      </li>

    <?php }?>

    <?php if ($_SESSION['tbl_role_id'] == 4) {?>

        <li class="treeview">
        <a href="#"><i class="fa fa-medkit"></i> <span>Pharma Council</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
      <li class="">
        <a href="<?php echo base_url('view_institute'); ?>"><i class="fa fa-university"></i> <span>Institute</span></a>
      </li>
      <li class="">
        <a href="<?php echo base_url('view_pharmacist_category'); ?>"><i class="fa fa-medkit"></i> <span>Category</span></a>
      </li>
      <li class="">
        <a href="<?php echo base_url('view_qualification'); ?>"><i class="fa fa-graduation-cap"></i> <span>Qualification</span></a>
      </li>
      <li class="">
        <a href="<?php echo base_url('view_pharmacist'); ?>"><i class="fa fa-certificate"></i> <span>Qualified Person</span></a>
      </li>

    </ul>
  </li>

    <?php }?>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

<script type="text/javascript">
  $(document).ready(function(e){
var url=window.location
$('.treeview-menu a').each(function(e){
    var link = $(this).attr('href');
    if(link==url){
        $(this).parent('li').addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
});

$('.treeview a').each(function(e){
    var link = $(this).attr('href');
    if(link==url){
        $(this).parent('li').addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
});
});
</script>