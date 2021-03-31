<?php
// php create-product.php <name>
require_once "bootstrap.php";

$newPageName = $argv[1];
$newPageContent = "
<h1>Just a rendering test lol </h1>
  <p>Wow it works!</p>";

$page = new Page();
$page->setName($newPageName);
$page->setContent($newPageContent);

$entityManager->persist($page);
$entityManager->flush();

echo "Created Page with ID " . $page->getId() . "\n";
