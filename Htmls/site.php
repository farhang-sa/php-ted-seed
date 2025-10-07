<!DOCTYPE html>
<html>
	<head>
		<?php print $this->RenderHead(); ?>
	</head>
	<body class="container p-0">

		<?php $Html->Call( 'Site' , 'Navigation' ); ?>

		<div class="row pt-5 pb-5">

			<div class="col-12 col-sm-1 col-md-2"></div>

			<div class="col-12 col-sm-10 col-md-8">
				
				<?php print $Site->RenderComponent(); ?>
				
			</div>

		</div>
	
		<?php print $this->RenderBody(); ?>
	
	</body>
</html>