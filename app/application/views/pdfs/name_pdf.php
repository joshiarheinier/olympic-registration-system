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
		<div>
			<h1>Entry Name: <?= $this->input->post("faculty") ?></h1>
			<h4><?= $this->input->post("sport_name") ?></h4>
			<div>
				<?php
				foreach ($participant->result() as $row) {
					$html = '<div class="row"><div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"><div class="row"><div class="col-lg-4 col-md-4"><h4>NPM</h4></div><div class="col-lg-8 col-md-8"><h5>'.$row->npm.'</h5></div></div><div class="row"><div class="col-lg-4 col-md-4"><h4>Nama Lengkap</h4></div><div class="col-lg-8 col-md-8"><h5>'.$row->full_name.'</h5></div></div><div class="row"><div class="col-lg-4 col-md-4"><h4>Jurusan</h4></div><div class="col-lg-8 col-md-8"><h5>'.$row->major.'</h5></div></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><img src="'.$row->image_link.'" height="175" width="135"></div></div><hr>';
					echo $html;
				}
				?>
			</div>
			<div id="id-card">
				<?php
				foreach ($participant->result() as $row) {
					$html = '<img src="'.$row->id_card_link.'" width="300">';
					echo $html;
				}
				?>
			</div>
			<div id="ss-card">
				<?php
				foreach ($participant->result() as $row) {
					$html = '<img src="'.$row->screenshot_link.'" width="300">';
					echo $html;
				}
				?>
			</div>
		</div>
	</div>
	<link href="<?= base_url();?>public/assets/css/entry.css" rel="stylesheet">
</body>