<?php
namespace ProcessWire;
?>

<footer class="footer">

	<div class="container grid-xl">
		<div class="columns">
			<div class="column col-xs-12 col-3">
				<p><?= $settings->site_name ?>. <?= $settings->site_tagline ?>.</p>
				<p class="love">Made with <span class="text-clrs-red"><?= feather('heart', ['width' => 16, 'height' => 16]) ?></span> by Craig in Gateshead.</p>
			</div>
			<div class="column col-xs-12 col-3">
				<?php
				echo renderSubmenu([
					'ulClass' => 'nav-footer',
					'labelAttr' => 'title',
					'items' => $pagecache->home->children()->prepend($pagecache->home),
				]);
				?>
			</div>
			<div class="column col-xs-12 col-3">
				<?php
				echo renderSubmenu([
					'ulClass' => 'nav-footer',
					'labelAttr' => 'title',
					'items' => $pagecache->about->children("include=all")->prepend($pagecache->about),
				]);
				?>
			</div>
			<div class="column col-xs-12 col-3">
				<ul class="nav nav-footer">
					<?php
					$links = [
						'social_twitter' => 'Twitter',
						'social_facebook' => 'Facebook',
					];
					foreach ($links as $key => $label) {
						$url = $settings->get($key);
						echo "<li class='nav-item'><a href='{$url}' target='_blank'>{$label}</a></li>";
					}
					?>
				</ul>
			</div>
		</div>
	</div>

</footer>
