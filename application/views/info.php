<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Informasi</title>

    <link href="<?= base_url('vendor/bootstrap/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/info.css') ?>" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Navigasi</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= site_url() ?>">Ngidesehat</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= site_url('review') ?>">Review</a></li>
            <li><a href="<?= site_url('search') ?>">Rekomendasi</a></li>
            <li class="active"><a href="<?= site_url('info') ?>">Informasi</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="<?= site_url('home') ?>"><?= $mail ?></a></li>
            <li><a href="<?= site_url('auth/logout') ?>">Keluar</a></li>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div id="map-canvas" class="panel-body"></div>
				</div>
			</div>
			<div class="col-md-3">
				<h1><?= $faskes->name ?><br><small><?= $faskes->type ?></small></h1>
				<p><strong>Alamat</strong><br><?= $faskes->address ?></p>
				<h2>Kondisi Terkini</h2>
				<p><strong>Rataan pasien per bulan:</strong><br><?= $state['avg'] ?></p>
				<p><strong>Maksimal pasien per bulan:</strong><br><?= $state['max'] ?></p>
			</div>
			<div class="col-md-3">
				<h2>Pendapat pasien</h2>
				<p><strong>Nilai:</strong> <?php printf("%.2f", $faskes->score) ?>/5.00 (<?php printf("%d", $faskes->scorecount) ?> pengguna)</p>
				<h2>Review pasien terbaru</h2>
				<?php if (count($faskes->reviews) == 0) echo 'Belum ada pasien yang mengirimkan review.';
				else foreach ($faskes->reviews as $review) { ?>
				<p><?= $review->notes ?><br><i><?= $review->user ?> at <?= $review->date ?> <?=$review->time ?></i></p>
				<?php } ?>
			</div>
		</div>
    </div>
	
	<footer class="container">
		<hr>
		<p class="text-muted">&copy; 2014 Ngidesehat</p>
	</footer>

	<script type="text/javascript">
		var main_id = <?= $faskes->id ?>;
	</script>
    <script src="<?= base_url('vendor/jquery/jquery-1.11.1.js') ?>"></script>
    <script src="<?= base_url('vendor/bootstrap/js/bootstrap.js') ?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKKdHe2kfdhW4NXkLoIwFkLw0HOvKibc0"></script>
	<script src="<?= base_url('js/info.js') ?>"></script>
  </body>
</html>