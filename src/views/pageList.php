<?php

use Doctrine\ORM\EntityManager;

include_once "bootstrap.php";
if (!$entityManager) return;

function renderPage($title, $content)
{
  print("<div>");
  print("<h2 class='title'>{$title}</h2>");
  print("<div>");
  print($content);
  print("</div>");
}

$pages = $entityManager->getRepository("Page")->findAll();

print("<nav>");
print("<ul class='navigation-items'>");
foreach ($pages as $page) {
  $query = $page->getId() == 1 ? './' : "?page={$page->getName()}&id={$page->getId()}";
  print("<li class='navigation-item'><a href='{$query}'>{$page->getName()}</a></li>");
}
print("</nav>");
print("</ul>");
print("<main>");


// puslapis su id = 1, yra homepage. Jo content galima pakeisti, bet negalima istrinti
if ($_SERVER['REQUEST_URI'] === $rootPath && !$_GET['page']) {
  $page = $entityManager->find('Page', 1);
  if ($page != null) {
    renderPage($page->getName(), $page->getContent());
  } else {
    print("Something went wrong, try again later");
  }
}

if (
  isset($_GET['page']) && isset($_GET['id'])
  && !empty($_GET['page']) && !empty($_GET['id'])
) {
  $page = $entityManager->find('Page', $_GET['id']);
  if ($page != null) {
    renderPage($page->getName(), $page->getContent());
  } else {
    print("Something went wrong, try again later");
  }
}
