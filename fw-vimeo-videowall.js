jQuery(document).ready( function() {
        jQuery(".fwvvw_vthumb").livequery('click',
		function() { 
			var idreq = jQuery(this).attr('id');
                         jQuery("#fwvvw_full_video").remove();
                         jQuery("#fwvvw_bg_video").remove();

			var newdiv = document.createElement("div");
                        var insidediv = document.createElement("div");
                        var vcontain = document.getElementsByTagName("body");

                       newdiv.setAttribute('id','fwvvw_bg_video');
                       insidediv.setAttribute('id','fwvvw_full_video');
                       
                       jQuery(newdiv).append(insidediv);
                       jQuery(vcontain).append(newdiv);

			var responsediv = '#fwvvw_full_video';
			
			jQuery.post( fwvvw_ajax_handler, {
				
				action: 'show_video',
				'id': idreq

				},
							
				function(response) {
					jQuery(responsediv).html(response);	
				});						
	});

        jQuery("img.closewindow").livequery('click',
		function() {
                     
                     jQuery("#fwvvw_full_video").remove();
                     jQuery("#fwvvw_bg_video").remove();
                });




}
);
