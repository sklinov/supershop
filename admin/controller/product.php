<?php
require 'db.php';
// Заголовок

echo '<h1 class="title">Товары</h1>';
// Текущая категория
echo '<form>
	  <label for="catdropdown" class="label">Текущая категория</label>
	  <select class="catdropdown" id="catdropdown" name="catdropdown">';
		while($category = $cats->fetch_assoc()) {
		echo "<option value=".$category["id"].">".$category["name"]."</option>";
		}
echo '</select>
<input type="button" value="Выбрать категорию" id="selectcat">
</form>
<div id="results">
</div>';

?>