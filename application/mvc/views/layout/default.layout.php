<!DOCTYPE html>
<html lang="ru">
	<head>
		<title><?=$title?></title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="<?=BASE_URL?>/assets/styles/style.css" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="viewport" content="maximum-scale=1, user-scalable=yes" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		<meta name="HandheldFriendly" content="true" />
		<!--[if lt IE 9]>
			<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<![endif]-->
		<!--[if lt IE 8]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
		<![endif]-->
		<script src="<?=BASE_URL?>/assets/scripts/libraries/head.load.min.js" data-headjs-load="<?=BASE_URL?>/assets/scripts/scripts.js"></script>
	</head>
	<body>
<?if(date('m') == '12' or date('m') == '01'):?>
		<canvas width="100%" height="100%" class="snow"></canvas>
<?endif;?>
		<section class="wrapper">
			<header class="clr">
				<div class="left logo">
					<a href="/"><img src="/assets/images/logo.png" alt=""></a>
				</div>
				<menu class="right mainMenu">
					<ul>
<?foreach ($menu as $value):?>
						<li>
							<a href="<?=$value->link?>"<?=('/'.Router::getUriSegment(0) == $value->link) ? ' class="active"' : ''?>><?=$value->title?></a>
						</li>
<?endforeach;?>
					</ul>
				</menu>
			</header>
			<main>
				<div class="loader"></div>
				<div class="contentWrapper">
					<div class="breadcrumbs">
<?foreach ($menu as $value):?>
	<?if($controller == ''):?>
						<span>Главная</span>
		<?break;?>
	<?elseif($value->link == '/'.$controller):?>
						<a href="/">Главная</a>
		<?if(stripos($_SERVER['REQUEST_URI'], 'portfolio') !== false and stripos($_SERVER['REQUEST_URI'], $projectId) !== false and !is_null($projectId)):?>
						<a href="<?=$value->link?>"><?=$value->title?></a>
						<span><?=$title?></span>
		<?else:?>
						<span><?=$value->title?></span>
		<?endif;?>
	<?endif;?>
<?endforeach;?>
						
					</div>
					<?=$content?>

				</div>
			</main>
			<footer>
				&copy; <?=date('Y')?> Зиновьев Павел <span></span> <a href="mailto:zombiqwerty@yandex.ru">zombiqwerty@yandex.ru</a>
			</footer>
		</section>
	</body>
</html>
