<?php
// php create-product.php <name>
require_once "bootstrap.php";

$newPageName = $argv[1];
$newPageContent = "
<h3>Welcome to the home page</h3>
<p>You can check other pages through navigation bar!</p>";

$page = new Page();
$page->setName($newPageName);
$page->setContent($newPageContent);

$entityManager->persist($page);
$entityManager->flush();

echo "Created Page with ID " . $page->getId() . "\n";
