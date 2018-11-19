<?php $parent = isset($category['childs']); ?>
<li>
	<a href="category/<?=$category['alias'];?>"><?=$category['title'];?></a>
	<?php if($parent): ?>
		<ul>
			<?= $this->getMenuHtml($category['childs']);?>
		</ul>
	<?php endif; ?>
</li>