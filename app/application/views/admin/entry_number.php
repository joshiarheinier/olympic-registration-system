<div class="page-container">
	<div id="entry-number">
		<h1><u>Entry Number: <?= $this->input->post("faculty") ?></u></h1>
		<div id="error-msg" style="text-align: center;"><p>
			<?php
			if (isset($_SESSION['err_msg'])) {
				echo $_SESSION['err_msg'];
				unset($_SESSION['err_msg']);
			}
			?>
		</p></div>
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
			echo '<p>'.$row->name.'</p>';
		}
		echo "</div>";
		?>
		<form action="<?= base_url();?>admin/official/pdf/download/entry/number" method="post">
			<input type="hidden" name="faculty" value="<?= $this->input->post("faculty"); ?>">
			<div class="card entry-submit">
				<input type="submit" value="Download sebagai PDF">
			</div>
		</form>
	</div>
</div>
<link href="<?= base_url();?>public/assets/css/entry.css" rel="stylesheet">