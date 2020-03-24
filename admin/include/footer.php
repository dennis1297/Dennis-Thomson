  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">&copy; <?php echo date('Y')." ".NAME?></a></div>
    <div class="site-footer-right">
     Developed by <a href="http://airavath.com/" target="_blank">Airavath</a>
    </div>
  </footer>
  <!-- Core  -->
  
  <script src="<?php echo ADMINURL?>global/vendor/animsition/animsition.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>
 
  <script src="https://uxsolutions.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script>
  	$('#start_date').datepicker({ format: 'yyyy-mm-dd' });
	$('#end_date').datepicker({ format: 'yyyy-mm-dd' });
  </script>

  <!-- Plugins -->
  <script src="<?php echo ADMINURL?>global/vendor/switchery/switchery.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/intro-js/intro.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/screenfull/screenfull.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

   
  <!-- Plugins For This Page -->
  <script src="<?php echo ADMINURL?>global/vendor/skycons/skycons.js"></script>
  <!--script src="<?php echo ADMINURL?>global/vendor/chartist-js/chartist.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script-->
  <script src="<?php echo ADMINURL?>global/vendor/aspieprogress/jquery-asPieProgress.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/jvectormap/jquery.jvectormap.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <!-- select2 -->
  <script src="<?php echo ADMINURL?>global/vendor/select2/select2.full.js"></script>
  <!-- dataTables -->
  <script src="<?php echo ADMINURL?>global/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo ADMINURL?>global/vendor/datatables/dataTables.bootstrap.min.js"></script>
  
  <!-- Scripts -->
  <script src="<?php echo ADMINURL?>global/js/core.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/site.min.js"></script>

  <script src="<?php echo ADMINURL?>assets/js/sections/menu.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/sections/menubar.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/sections/gridmenu.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/sections/sidebar.min.js"></script>
  
  <!-- form validation -->
  <script src="<?php echo ADMINURL?>global/vendor/formvalidation/formValidation.min.js"></script>
   <script src="<?php echo ADMINURL?>global/vendor/formvalidation/framework/bootstrap.min.js"></script>
  
  <script src="<?php echo ADMINURL?>global/js/configs/config-colors.min.js"></script>
  <script src="<?php echo ADMINURL?>assets/js/configs/config-tour.min.js"></script>

  <script src="<?php echo ADMINURL?>global/js/components/asscrollable.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/animsition.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/slidepanel.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/switchery.min.js"></script>

  <script src="<?php echo ADMINURL?>global/js/components/matchheight.min.js"></script>
  <script src="<?php echo ADMINURL?>global/js/components/jvectormap.min.js"></script>


  <!--script src="<?php echo ADMINURL?>assets/examples/js/dashboard/v1.min.js"></script-->
   <script src="<?php echo ADMINURL?>global/vendor/dropify/dropify.min.js"></script>
   <script src="<?php echo ADMINURL?>global/js/components/dropify.min.js"></script>
   
   <!-- summernote -->
   <script src="<?php echo ADMINURL?>global/vendor/summernote/summernote.js"></script>

   <script src="<?php echo ADMINURL?>global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

  <script src="<?php echo ADMINURL?>assets/examples/js/forms/validation.min.js"></script>
  
  <script>
	$(document).ready(function() {
	  $('#datatable').DataTable();	
	  $(".select2").select2();	
	  $('#summernote').summernote({
		  height:250,
		  toolbar: [
			// [groupName, [list of button]]
			['style', ['italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript','fontname']],	
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['codeview', ['codeview']]
		  ]
	  });
	});
  </script>
  <script>
	$(function () {
		$('.site-menu a[href]').on('click', function() {
			sessionStorage.setItem('site-menu', $(this).attr('href'));
		});
		if (!sessionStorage.getItem('site-menu')) {
			$('.site-menu #dashboard').addClass('open');
		} else {
			$('.site-menu a[href=\'' + sessionStorage.getItem('site-menu') + '\']').parents('li').addClass('open');
		}
	});
	</script>
  
</body>
</html>