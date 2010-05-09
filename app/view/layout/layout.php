<html>
	<head>
		<title>Hello!</title>
		<link rel="stylesheet" href="/public/css/basic.css" type="text/css" media="screen" />
		
		<script src="/public/js/jq.min.js" type="text/javascript"></script>
		<script src="/public/js/jqui.min.js" type="text/javascript"></script>
		
		<?php echo $c->css_print(); ?>
            
		<script type="text/javascript">
		//<![CDATA[
			function show_form(){
				$('#form_block').show("blind", { direction: "vertical" }, 500);
				$('#form_block_hide_link').show("blind", { direction: "vertical" }, 500);
				$('#form_block_show_link').hide("blind", { direction: "vertical" }, 500);
			}
			function hide_form(){
				$('#form_block').hide("blind", { direction: "vertical" }, 500);
				$('#form_block_hide_link').hide("blind", { direction: "vertical" }, 500);
				$('#form_block_show_link').show("blind", { direction: "vertical" }, 500);
			}

			function ajax_send(){
				jQuery.ajax({
				   type: "POST",
				   url: "/ajax/ajax_processor.php",
				   data: "name=Test&surname=Testovitch",
				   success: function(html){
					 $("#ajax_result").html(html);
				   }
				 });
			}
		//]]>
		</script>
	</head>
	
	<body>
        <?
            flash($data['flash']);
            echo $stdout['content'];
                if($fw->current_page('users', 'signup')){
                echo render('_login_form', $c);
            }
        ?>
	</body>
</html>