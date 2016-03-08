    var editor = CKEDITOR.replace('editor1',{
        filebrowserBrowseUrl: '/foctopus/public/ckeditor/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/foctopus/public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    });
    CKFinder.setupCKEditor( editor );
    $(document).ready(function () {
    	$(".tmpFelicitacion").click(function() {
    		cargarTemplates("tmpFelicitacion")
    	});
    	$(".tmpAdvertencia").click(function() {
    		cargarTemplates("tmpAdvertencia")
    	});
    	$(".tmpGeneral").click(function() {
    		cargarTemplates("tmpGeneral")
    	});
    	$(".tmpPersonalizado").click(function() {
    		cargarTemplates("tmpPersonalizado")
    	});
    });

    function cargarTemplates(template) {
    	$.ajax({
    		url: '/foctopus/cargarTemplates/'+template,
    		type: 'POST',
    		dataType: 'html'
    	})
    	.done(function(response) {
    		console.log(response);
    		CKEDITOR.instances['editor1'].setData(response);
    	})
    	.fail(function(response) {
    		console.log(response);
    	});
    }
