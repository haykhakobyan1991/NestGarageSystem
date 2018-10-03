<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css" />
	<script src="<?=base_url()?>assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<?
$page = $this->router->fetch_method();
?>
<header>

	<nav class="navbar  navbar-expand-lg navbar-light bg-light " style="width: 100%;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
		<a class="navbar-brand" href="#">Admin Panel</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="navbar-nav">
					<a class="nav-item nav-link <?= ($page == 'web' ? 'active' : '') ?>" href="<?= base_url() ?>admin/web">Web</a>
					<a class="nav-item nav-link <?= ($page == 'main' ? 'active' : '') ?>" href="<?= base_url() ?>admin/main">Main</a>
					<a class="nav-item nav-link <?= ($page == 'solution_challenge' ? 'active' : '') ?>" href="<?= base_url() ?>admin/solution_challenge">Solution Challenge</a>
					<a class="nav-item nav-link <?= ($page == 'functional' ? 'active' : '') ?>" href="<?= base_url() ?>admin/functional">Functional 1</a>
					<a class="nav-item nav-link <?= ($page == 'functional_2' ? 'active' : '') ?>" href="<?= base_url() ?>admin/functional_2">Functional 2</a>
					<a class="nav-item nav-link <?= ($page == 'faq' ? 'active' : '') ?>" href="<?= base_url() ?>admin/faq">FAQ</a>
					<a class="nav-item nav-link <?= ($page == 'footer_section' ? 'active' : '') ?>" href="<?= base_url() ?>admin/footer_section">Footer</a>
					<a class="nav-item nav-link <?= ($page == 'subscribe' ? 'active' : '') ?>" href="<?= base_url() ?>admin/subscribe">Subscribers</a>


				</div>

				<a class="ml-auto" href="<?= base_url() ?>" target="_blank" >Website</a>
				<a class="navbar-nav ml-auto" href="./logout"><img width="30" height="30"
																   src="<?= base_url() ?>/assets/img/logout.png"></a>
			</div>
	</nav>
</header>
