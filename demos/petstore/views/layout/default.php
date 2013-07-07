<!DOCTYPE html>
<html lang="en">
    <head>
        <?php Zc::W(WidgetConst::commonMeta);?>
    </head>
    <body>
    	<div id="wrapper">
	    	<?php Zc::W(WidgetConst::commonHeader);?>
	    	<div id="contents">
	    		<section><?php echo $_content_;?></section>
	    	</div>
	    	<?php Zc::W(WidgetConst::commonFooter);?>
    	</div>
    </body>
</html>
