        </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/jquery.dataTables.min.js"></script>
    <!-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable();
            $('.modal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
            })
        } );
    </script>
    <!-- BEGIN PLUGINS JS -->
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/pace.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/stacked-menu.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/flatpickr.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/jquery.easypiechart.min.js"></script>
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/Chart.min.js"></script>
    <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/theme.min.js"></script>
    <!-- END THEME JS -->
    <!-- <script src="<?php //echo base_url('site_link'); ?>assets/css/bootstrap/js/dashboard-demo.js"></script> -->
    <!-- BEGIN PAGE LEVEL JS -->

    <script>
      $(document).ready(function(){
        var path = window.location;
        if ( path == 'dashboard' || path == '') {
          path = './';
        }
        var target = $('ul li a[href="'+path+'"]');
        target.parent().addClass('has-active');
        target.parent().parent().parent().addClass('has-active');
        target.parent().parent().parent().parent().parent().addClass('has-active');
      })
    </script>
  </body>
</html>