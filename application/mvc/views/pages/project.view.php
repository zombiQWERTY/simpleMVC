					<div class="work">
						<h1 class="pageTitle"><?=$project->title?></h1>
						<div id="photoSlider" class="photoSlider">
<?foreach ($pictures as $picture):?>
							<div class="showcase-slide">
								<div class="showcase-content">
									<img src="<?=$picture->path?>" alt="" />
								</div>
							</div>
<?endforeach;?>
						</div>
						<div class="section clr">
							<div class="title left">
								<h2>Описание проекта</h2>
							</div>
							<div class="descr left">
								<?=$project->description?>
							</div>
							<div class="descr left"></div>
						</div>
						<div class="section clr">
							<div class="title left">
								<h2>Информация о проекте</h2>
							</div>
							<div class="descr left aboutProject">
								<span>Год:</span> <?=$project->year?><br />
								<span>Клиент:</span> <?=$project->client?><br />
								<span>Категория:</span> <?=$project->category?><br />
<?if ($project->link):?>
								<span>Ссылка:</span> <a href="<?=$project->link?>" target="_blank"><?=$project->link?></a>
<?endif;?>
							</div>
							<div class="descr left"></div>
						</div>
					</div>
