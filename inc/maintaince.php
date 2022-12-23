<?php

?>
<!DOCTYPE html>
<!-- Source: https://www.wmtips.com/html/howto-make-a-perfect-site-maintenance-page.htm -->
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>onderhoud...</title>
<style type="text/css">
* {
  box-sizing: border-box;
}
html, body {
height: 100%;
margin: 0;
background: #000;
}
main {
height: 100%;
margin: 0 auto;
max-width: 700px;
padding: 30px;
display: table;
text-align: center;
}
main > * {
display: table-cell;
vertical-align: middle;
}

body
{
font: 20px Helvetica, sans-serif; color: #fff;
}
@keyframes blink {50% { color: transparent }}
.dot { animation: 1s blink infinite }
.dot:nth-child(2) { animation-delay: 250ms }
.dot:nth-child(3) { animation-delay: 500ms }
</style>
</head>
<body>
<main>
<div>
<h1>Er is momenteel onderhoud<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1>
<p>Sorry voor het ongemak, we zijn momenteel bezig met onderhoud. Probeer het a.u.b. later nog eens. Voor nu kunt nu een grappige video kijken van het onderhoud procces.</p>
<iframe width="560" height="315" src="https://www.youtube.com/embed/insM7oUYNOE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
</main>
</body>
</html>