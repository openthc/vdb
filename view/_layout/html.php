<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="initial-scale=1, user-scalable=yes">
<meta name="application-name" content="OpenTHC">
<meta name="apple-mobile-web-app-title" content="OpenTHC">
<meta name="msapplication-TileColor" content="#003100">
<meta name="theme-color" content="#069420">
<link rel="stylesheet" href="/vendor/fontawesome/css/all.min.css" integrity="sha256-CTSx/A06dm1B063156EVh15m6Y67pAjZZaQc89LLSrU=" crossorigin="anonymous">
<link rel="stylesheet" href="/css/main.css" crossorigin="anonymous">
<title><?= __h($data['Page']['title']) ?> || OpenTHC</title>
<script>
// On page load or when changing themes, best to add inline in `head` to avoid FOUC
// if (localStorage.theme === 'dark'
// 	|| (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
// 	document.documentElement.classList.add('dark')
// } else {
// 	document.documentElement.classList.remove('dark')
// }
// Whenever the user explicitly chooses light mode
// localStorage.theme = 'light'

// Whenever the user explicitly chooses dark mode
// localStorage.theme = 'dark'

// Whenever the user explicitly chooses to respect the OS preference
// localStorage.removeItem('theme')
</script>
</head>
<body>
<div class="navbar bg-base-100">
	<a class="btn btn-ghost normal-case text-xl" href="https://openthc.org">OpenTHC</a>
	<a class="btn btn-ghost normal-case text-xl" href="/">Variety Database</a>
</div>
<?php
// Not Working
// echo $this->block('theme-toggle.php');
?>

<?= $this->body ?>

<footer class="footer footer-center p-10 bg-base-200 text-base-content">

	<div class="grid grid-flow-col gap-4">
		<a class="link link-hover" href="https://openthc.org/">OpenTHC.org</a>
		<a class="link link-hover" href="https://api.openthc.org">API</a>
		<a class="link link-hover" href="https://github.com/openthc"><i class="fab fa-github"></i> GitHub</a>
	</div>

	<div class="grid grid-flow-col gap-4">
		<a href="https://openthc.com/about/privacy">Privacy</a>
		<a href="https://openthc.com/about/tos">Terms</a>
	</div>

</footer>

<script src="/vendor/jquery/jquery.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<?= $this->foot_script ?>

</body>
</html>
