					<div class="portfolio">
						<h1 class="pageTitle">Портфолио работ</h1>
						<div class="previews">
<?foreach ($projects as $project):?>
							<a href="/portfolio/<?=$project->id?>" class="preview linkToWork">
								<div class="image">
	<?foreach ($pictures as $picture):?>
		<?if ($picture->project_id == $project->id):?>
									<img src="<?=$picture->path?>" alt="">
		<?endif;?>
	<?endforeach;?>
									<i></i>
								</div>
								<hgroup>
									<h2><?=$project->title?></h2>
									<h3><?=$project->category?></h3>
								</hgroup>
							</a>
<?endforeach;?>
						</div>
					</div>
