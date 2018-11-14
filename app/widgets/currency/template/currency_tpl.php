<option value="" class="label"><?= $this->currency['title']; ?>:</option>
<?php foreach ($this->currencies as $k => $curr): ?>
	<?php if ($k != $this->currency['code']): ?>
        <option value="<?= $k ?>"><?= $curr['title'] ?></option>
	<?php endif; ?>
<?php endforeach; ?>
