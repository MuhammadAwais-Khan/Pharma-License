<script type="text/javascript">

  function overlay() {

      // alert('Please Wait the file will automatically download.');
      // $('.alert').slideDown();
      $(".overlay").show().delay(6000).fadeOut();

}


</script>

<style type="text/css">

  /* .dropdown-menu {
  top: -10px !important;
  left: -160% !important;
} */

.dropdown-menu {
  left:auto;
  right:100%;
  top:0;
  box-shadow: 0 6px 12px rgba(0,0,0);
  text-align: center;
  min-width: 140px;
}

.bg-little-red{
background-color: #ECCCCC;
color: #333;
}
.bg-little-red:hover{
background-color: #f2dede !important;
color: #333;
}
div.dataTables_wrapper div.dataTables_info {

    color: #07A559;
}

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #07a559;
    border-color: #07a559;
}

.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
    border: 1px solid #d2d6de !important;
    border-radius: 0 !important;
    padding: 6px 12px;
    height: 34px !important;
}
</style>
<script>
$(function(){

        setTimeout(function() {
            $('.alert').slideUp();
            // $('.alert').hide('fast');
        }, 5000); // 4sec
      });
</script>

<script type="text/javascript">
  $(document).ready(function(){
// formErrorContent
    // $('.btnProcess').hide();
    $('.overlay').hide();
    $('#formID').submit(function() {
    if ($('.formError:visible').length){

    $('.overlay').hide();}
else
   {
    // $(":submit").attr("disabled", true);
    // $(':input[type="submit"]').prop('disabled', true);
    // $('button[type="submit"]').prop('disabled', true);
      // $('#btnSubmit').hide();
      // $('.btnProcess').show();

    // $( 'i' ).addClass( "fa-refresh fa-spin");

      $('.overlay').show();
   }
      return true;
    });
});
</script>
</div>  <!-- ending tag of class box -->
</body>
</html>