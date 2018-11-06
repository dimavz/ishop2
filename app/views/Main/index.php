<h1>Файл вида Index</h1>
<p><?=$name;?></p>
<p><?=$age;?></p>
<?php debug($workers);?>
<?php foreach ($posts as $post):?>
    <h3><?=$post->title;?></h3>
<?php endforeach;?>
<!--<p>--><?//= $post_one->title;?><!--</p>-->
<?php debug($logs->grep('SELECT'));?>