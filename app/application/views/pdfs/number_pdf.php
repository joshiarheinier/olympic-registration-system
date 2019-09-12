<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Olimpiade UI 2018</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="<?= base_url();?>public/assets/css/main.css" rel="stylesheet">
</head>
<body>
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
					$tmp_category = $row->category;
					echo '<h4>'.$tmp_category.'</h4>';
				}
				echo '<p>'.$row->name.'</p>';
			}
			?>
		</div>
	</div>
	<link href="<?= base_url();?>public/assets/css/entry.css" rel="stylesheet">
</body>