<!DOCTYPE html>
<html>
	<head>
		<?php print $this->RenderHead(); ?>
	</head>
	<body>

		<?php $Html->Call( 'Site' , 'Navigation' ); ?>

		<div class="col-xs-12" style='margin-top: 60px;'>

			<div class="col-xs-12 col-sm-1"></div>

			<div class="col-xs-12 col-sm-10">
				
				<?php print $Site->RenderComponent(); ?>
				
			</div>

		</div>
	
		<?php print $this->RenderBody(); ?>
	
	</body>
</html>