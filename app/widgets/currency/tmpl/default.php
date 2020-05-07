<option value="" class="label"><?= $this->currency['title']; ?>:</option>
<?php foreach ($this->currencies as $k => $curr): ?>
	<?php if ($k != $this->currency['code']): ?>
        <option value="<?= $k ?>"><?= $curr['title'] ?></option>
	<?php endif; ?>
<?php endforeach; ?>

// Для отработки виджета создаём контроллер CurrencyController
//подключаем свой скрипт в файле app/views/layouts/watches.php
// Который называется change_currency.js
