</div>
</div>
</div>

<!-- Variable para trabajar con ajax y js -->
<script>
	var url = "<?php echo URL; ?>";
</script>

<!-- our JavaScript -->

<script src="<?php echo URL; ?>js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>js/plugins/alertify/alertify.js"></script>
<script src="<?php echo URL; ?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo URL; ?>js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo URL; ?>js/plugins/jquery.validator/jquery.validate.min.js"></script>


<?php 
if (isset($js)) {
	echo $js;
};

?>

</body>
</html>
