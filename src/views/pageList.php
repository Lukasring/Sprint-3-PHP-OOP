<?php
include_once "bootstrap.php";
print('<div style=>All Pages</div>');

$pages = $entityManager->getRepository("Page")->findAll();

foreach ($pages as $page) {
  // print('<div>' . $page->getName() . '</div>');
  // print('<div>' . $page->getContent() . '</div>');
  dump($page);
}
