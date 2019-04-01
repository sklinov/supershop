<?php
require 'db.php';
// Заголовок

echo '<h1 class="title">Товары</h1>';
// Текущая категория
echo '<form>
	  <label for="catdropdown" class="label">Текущая категория</label>
	  <select class="catdropdown" id="catdropdown" name="catdropdown">';
	    echo "<option value='TRUE' selected>Все категории</option>";
	    while($category = $cats->fetch_assoc()) {
		echo "<option value=".$category["id"].">".$category["name"]."</option>";
		}
echo '</select>
</form>
<div id="results">
</div>';

?>