
<div style="width: 500px; height: 500px; background: blue;">
<?=$first?>

<?php //$view->test(); ?>
<a href="<?=$view->name('main')?>">Перейти на главную страницу!</a>
<a href="<?=$view->name('page', [15])?>">Перейти в профиль с айди 15!</a>
</div>