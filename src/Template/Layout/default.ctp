<?php

use Cake\Routing\Router;

$siteTitle = 'Kevin Masson';
$currentUrl = Router::normalize($this->request->here);
$this->append('meta');
echo $this->Html->meta(
	'author',
	'Kevin Masson'
);
if($this->fetch('noindex') || $this->request->param('prefix') === 'admin')
	echo $this->Html->meta(
		'robots',
		'none'
	);
else
	echo $this->Html->meta(
		'robots',
		'all'
	);
$this->end();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?= $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $siteTitle ?> - <?= $this->fetch('title') ?></title>
    <?= $this->Html->css("app.css"); ?>
    <?= $this->Html->meta('icon', 'favicon.png') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>
      <?= $this->fetch('topContent') ?>
<?php
if (isset($userDetails) && !is_null($userDetails) && $userDetails['role'] === 'admin')
   echo $this->Element('admin_nav');
?>
	<nav>
        <ul>
        <li class="<?= $currentUrl === '/' ? 'active' : ''; ?>">
            <a href="<?= Router::url(['_name' => 'home']) ?>">
                Accueil
            </a>
			</li>
			<li class="<?= substr($currentUrl, 0, strlen('/portfolio')) === '/portfolio' ? 'active' : ''; ?>">
				<a href="<?= Router::url(['_name' => 'portfolio']); ?>">Portfolio</a>
			</li>
			<li class="<?= $currentUrl === '/contact' ? 'active' : ''; ?>">
				<a href="<?= Router::url(['_name' => 'contact']); ?>">Contact</a>
			</li>
		</ul>
    </nav>
      <?= $this->Flash->render() ?>
    <div class="wrap">
      <?= $this->fetch('content') ?>
    </div>
      <?= $this->fetch('contentNoWrap') ?>
    <footer>
	<nav class="navbar navbar-fixed-bottom navbar-light navbar-full bg-faded">
		<span class="navbar-text float-xs-left">
			2016 &#169; Tout droits reservés
		</span>
		<span class="navbar-text float-xs-right">
			<a href="https://www.facebook.com/kmassonstudio/">facebook</a>,
			<a href="https://github.com/kevinmasson/">github</a>,
			<a href="https://fr.linkedin.com/in/kevin-masson-968a35113">linkedin</a>,
			<a href="https://twitter.com/mindlessocto">twitter</a>,
			<a href="https://www.flickr.com/photos/kevinmasson/">flickr</a> <span class="text-muted"> -
			<a class="text-muted" href="https://github.com/kevinmasson/website">v0.1</a></span>
		</span>
	</nav>
    </footer>
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?> <?= $this->Html->script('tinymce/tinymce.min.js') ?>
    <?= $this->fetch('script') ?>
</body>
</html>
