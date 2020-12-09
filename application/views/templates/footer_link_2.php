
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<!-- bootstrap time picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->

<!-- bootstrap date time picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<!-- iCheck 1.0.1 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<!-- Page script -->
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script> -->

<!-- <script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
 -->

<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>


<!-- InputMask -->
<script src="<?php echo base_url('assets/js/masking/') ?>jquery.maskedinput.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url('assets/js/masking/') ?>jquery.maskedinput.min.js" type="text/javascript"></script>
  <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
<!-- <script src="https://code.highcharts.com/highcharts-3d.js"></script> -->
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- <script src="https://code.highcharts.com/modules/export-data.js"></script> -->
<!-- <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->

<!-- <script src="../../bower_components/chart.js/Chart.js"></script> -->

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/inputmask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/bindings/inputmask.binding.min.js"></script> -->

<!-- for image/ gallery  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<!-- <script>
    baguetteBox.run('.tz-gallery');
</script> -->

<script>
  $(document).ready(function() {
    $('#awais').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

  $(document).ready(function() {
    $('#full_table_print').DataTable({

      "paging": false,
    //"pageLength": 5,
    //"pagingType": "simple",
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true,

            dom: 'lBfrtip',
            buttons: [{
                extend: 'print',
                footer: true,
                messageBottom: '<br><br>DG Drug <br> Peshawar',

                customize: function ( win ) {

          $(win.document.body)
                        .css( 'font-size', '11pt' )
                        .css( 'font-weight', 'bold' )
                        .css( 'text-align', 'right' );

          $(win.document.body).find('h1')
                        .css( 'font-size', '12pt' )
                        .css( 'font-weight', 'bold' )
                        .css( 'text-align', 'center' );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', '10pt' );
                }
            }
            ]

    });
});

  $(function () {

  $("#full_table").DataTable();
  $('#half_table').DataTable({
      "paging": false,
    //"pageLength": 5,
    //"pagingType": "simple",
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });

    //Initialize Select2 Elements
    $(".select2").select2();

    $("#cnic").mask("99999-9999999-9");
    $("#cnic_no").mask("99999-9999999-9");
    $("#mobile_no").mask("9999-9999999");

  });



  </script>

