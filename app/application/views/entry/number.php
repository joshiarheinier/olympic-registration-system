<div class="page-container">
	<div id="entry-number">
		<h1><u>Isi Entry Number</u></h1>
		<div id="error-msg" style="text-align: center;"><p>
			<?php
			if (isset($_SESSION['err_msg'])) {
				echo $_SESSION['err_msg'];
				unset($_SESSION['err_msg']);
			}
			?>
		</p></div>
		<form action="<?= base_url();?>contingent/entry/number/process" method="post">
			<?php
			$tmp_category = "";
			foreach ($sports->result() as $row) {
				if ($tmp_category != $row->category) {
					if ($tmp_category != "") {
						echo "</div>";
					}
					$tmp_category = $row->category;
					echo '<div class="card entry-form" id="entry-number-form">';
					echo '<h4>'.$tmp_category.'</h4>';
				}
				$tmp_name = strtolower($row->name);
				$tmp_name = str_replace(" ", "-", $tmp_name);
				echo '<div class="row">';
				echo '<div class="col-lg-6 col-md-6"><p>'.$row->name.'</p></div>';
				$checked = "";
				if (in_array($row->name, $participate_list)) {
					$checked = " checked";
				}
				echo '<div class="switch-container col-lg-6 col-md-6"><label class="switch"><input type="checkbox" name="'.$tmp_name.'" '.$checked.'><span class="slider round"></span></label></div>';
				echo '</div>';
			}
			echo "</div>";
			?>
			<div class="card entry-submit">
				<input type="submit" value="Daftar">
			</div>
		</form>
	</div>
</div>
<link href="<?= base_url();?>public/assets/css/entry.css" rel="stylesheet">