<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

$navbar = new \Faxity\Navbar\Navbar();
$navbar->setDI($di);

echo "<span class=\"menu-icon\"></span>";
echo $navbar->createMenuWithSubMenus($navbarConfig);
