<!--">--> <!-- make sure we are broken out of any html tags -->

<div class="alert alert-<?=$error['class']?>">
	<h3>PHP <?=ucwords($error['level'])?></h3>

	<p><strong><?=$error['string']?></strong> in <?=$error['file']?> on line #<?=$error['line']?></p>

	<p class="hidden"><small><?php
		foreach ($error['backtrace'] as $key => $trace) {
			echo str_replace(Ares\Config::$root, '', $trace['file']) . ' : #' . $trace['line'];
			echo '<div style="margin: 4px 20px 20px">' . $trace['class'] . $trace['type'] . $trace['function'];
			echo '<br>';
			foreach ($trace['args'] as $vkey => $val) {
				echo $val;
				if ($vkey < count($trace['args']) - 1) {
					echo '<br>';
				}
			}
			echo '</div>';
		}
	?></small></p>
</div>