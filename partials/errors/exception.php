<div class="alert alert-error">
	<h3>Uncaught Exception</h3>

	<p><strong><?=$exception->getMessage()?></strong></p>

	<p><small><?=nl2br($exception->getTraceAsString())?></small></p>
</div>