<p class="jquery_alert"></p>
<?php

if ($this->session->flashdata('custom')) {
	echo '<p class="alert alert-success">' . $this->session->flashdata('custom') . '
  </p>';
}

if ($this->session->flashdata('error_custom')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('error_custom') . '
  </p>';
}

if ($this->session->flashdata('add')) {
	echo '<p class="alert alert-success">' . $this->session->flashdata('add') . '
    Record has been successfully added. </p>';
}

if ($this->session->flashdata('updated')) {
	echo '<p class="alert alert-success">' . $this->session->flashdata('updated') . '
    Record has been successfully updated. </p>';
}

if ($this->session->flashdata('pwd')) {
	echo '<p class="alert alert-success">' . $this->session->flashdata('pwd') . '
    Password has been successfully Changed. </p>';
}

if ($this->session->flashdata('pwd_error')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('pwd_error') . '
    <strong>Oops! </strong>Current Password not matched</p>';
}

if ($this->session->flashdata('deleted')) {
	echo '<p class="alert alert-success">' . $this->session->flashdata('deleted') . '
    Record has been successfully deleted. </p>';
}

if ($this->session->flashdata('duplication')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('duplication') . '
    Data duplication is not allowed, Your selected selection is already exist in data base. Please amend or edit that data. </p>';
}

if ($this->session->flashdata('request')) {
	echo '<p class="alert alert-success">' . $this->session->flashdata('request') . '
    Request has been successfully Send. </p>';
}

if ($this->session->flashdata('db_exist_error')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('db_exist_error') . '
    <strong>Oops! </strong>Record is not deleted. Because some data related to your request is already present in Database. So first Resolve / Remove that data. </p>';
}

if ($this->session->flashdata('no_profile')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('no_profile') . '
    <strong>Oops! </strong>There is an error in updating your profile. </p>';
}

if ($this->session->flashdata('already')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('already') . '
    <strong>Oops! </strong>The data/name You Enter is already in database, Select another unique data/name. </p>';
}

if ($this->session->flashdata('img_upload_error')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('img_upload_error') . '</p>';
}

if ($this->session->flashdata('error_msg')) {
	echo '<p class="alert alert-danger">' . $this->session->flashdata('error_msg') . '</p>';
}

?>

