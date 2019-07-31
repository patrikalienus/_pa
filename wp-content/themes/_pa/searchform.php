<?php
/**
 * Template for displaying search forms in Twenty Eleven
 *
 * @package _pa
 * @since 0.1
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="item searchfield">
		<label>
			<span class="screen-reader-text">Search for:</span>
			<input type="search" class="search-field" placeholder="Search..." value="" name="s">
		</label>
	</div>
	<div class="item submit">
		<button>Go</button>
	</div>
</form>