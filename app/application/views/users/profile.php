<div class="page-container">
	<div id="profile">
		<h1><u>Daftar Kontingen: <?= $this->session->userdata("faculty_name") ?></u></h1>
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<div class="card" id="entry-number-prompt">
					<h4>Isi Entry Number</h4>
					<p>Isi formulir untuk menentukan cabang olahraga yang diikuti.</p>
					<form action="<?= base_url();?>contingent/entry/number">
						<button type="submit" class="btn btn-info btn-lg">Isi Formulir</button>
					</form>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="card" id="entry-name-prompt">
					<h4>Isi Entry Name</h4>
					<p>Isi formulir untuk mendaftarkan peserta berdasarkan nomor olahraga yang diikuti.</p>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sport-list-modal">Isi Formulir</button>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="card" id="entry-official-prompt">
					<h4>Isi Entry Name (Official)</h4>
					<p>Isi formulir untuk mendaftarkan official berdasarkan cabang olahraga yang diikuti.</p>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sport-category-modal">Isi Formulir</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Participant Modal -->
<div id="sport-list-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Pilih nomor olahraga yang diikuti:</h4>
			</div>
			<div class="modal-body">
				<?php
				foreach ($selected_sports->result() as $row) {
					echo '<div class="sport-name-link">';
					echo '<a href="'.base_url().'contingent/entry/name/'.$row->sport_name.'">'.$row->sport_name.'</a>';
					echo '</div>';
				}
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>

	</div>
</div>

<!-- Official Modal -->
<div id="sport-category-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Pilih cabang olahraga yang diikuti:</h4>
			</div>
			<div class="modal-body">
				<?php
				foreach ($sport_categories as $category) {
					echo '<div class="sport-name-link">';
					echo '<a href="'.base_url().'contingent/entry/official/'.$category.'">'.$category.'</a>';
					echo '</div>';
				}
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>

	</div>
</div>

<link href="<?= base_url();?>public/assets/css/profile.css" rel="stylesheet">