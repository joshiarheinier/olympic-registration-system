<div class="page-container">
	<div id="entry-name">
		<h1><u>Entry Official: <?= $category ?></u></h1>
		<div class="card entry-form" id="entry-name-form">
			<h4> <?= $this->input->post("faculty") ?></h4>
			<hr>
			<div id="participant-container">
				<div id="participant-detail">
					<?php
					foreach ($participant->result() as $row) {
						$html = '<div class="row"><div class="col-lg-9 col-md-9"><div class="row"><div class="col-lg-4 col-md-4"><h4>NPM</h4></div><div class="col-lg-8 col-md-8"><h5>'.$row->npm.'</h5></div></div><div class="row"><div class="col-lg-4 col-md-4"><h4>Nama Lengkap</h4></div><div class="col-lg-8 col-md-8"><h5>'.$row->full_name.'</h5></div></div><div class="row"><div class="col-lg-4 col-md-4"><h4>Jurusan</h4></div><div class="col-lg-8 col-md-8"><h5>'.$row->major.'</h5></div></div><div class="row"><div class="col-lg-4 col-md-4"><form action="'.base_url().'entry/name/delete/process" method="post"><input type="hidden" name="category" value="'.$category.'"><input type="hidden" name="participant_id" value="'.$row->npm.'"><input class="btn btn-danger" type="submit" value="Hapus"></form></div><div class="col-lg-4 col-md-4"><button class="btn btn-info" data-toggle="modal" data-target="#'.$row->npm.'-idcard-modal">Lihat KTM</button></div><div class="col-lg-4 col-md-4"><button class="btn btn-info" data-toggle="modal" data-target="#'.$row->npm.'-ss-modal">Lihat Screenshot</button></div></div></div><div class="col-lg-3 col-md-3"><img src="'.$row->image_link.'" height="175" width="135"></div></div><hr>';
						$photo_popup = '<div id="'.$row->npm.'-idcard-modal" class="modal fade pic-modal" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><img src="'.$row->id_card_link.'"></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button></div></div></div></div>';
						$ss_popup = '<div id="'.$row->npm.'-ss-modal" class="modal fade pic-modal" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><img src="'.$row->screenshot_link.'"></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button></div></div></div></div>';
						echo $html;
						echo $photo_popup;
						echo $ss_popup;
					}
					?>
				</div>
			</div>
		</div>
		<form action="<?= base_url();?>admin/official/pdf/download/entry/official" method="post">
			<input type="hidden" name="faculty" value="<?= $this->input->post("faculty"); ?>">
			<input type="hidden" name="category" value="<?= $this->input->post("category"); ?>">
			<div class="card entry-submit">
				<input type="submit" value="Download sebagai PDF">
			</div>
		</form>
	</div>
</div>
<link href="<?= base_url();?>public/assets/css/entry.css" rel="stylesheet">
<script type="text/javascript" src="<?= base_url();?>public/assets/js/form_submission.js"></script>