<?php
// php create-product.php <name>
require_once "bootstrap.php";

if (isset($_POST['page']) && !empty($_POST['title']) && !empty($_POST['content'])) {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $page = new Page();
  $page->setName($title);
  $page->setContent($content);
  $entityManager->persist($page);
  $entityManager->flush();
}

if (isset($_POST['delete'])) {
  $page = $entityManager->find('Page', $_POST['delete']);
  $entityManager->remove($page);
  $entityManager->flush();
}

$pages = $entityManager->getRepository("Page")->findAll();

print('<section class=\'table\'>');
print('<div class=\'col-name\'>Title</div><div class=\'col-name\'>Action</div>');
foreach ($pages as $page) {
  print('<div>' . $page->getName() . '</div>');
  print('<div>' . 'Edit |' . "<form action='' method='POST'><button type='submit' name='delete' value='{$page->getId()}'>Delete</button></form>" . '</div>');
  // dump($page);
}
print('</section>');


?>



<form method='POST' action=''>
  <label for='title'>Title</label>
  <input type='text' id='title' name='title'>
  <label for='content'>Content</label>
  <textarea id='content' name='content'></textarea>
  <button type='submit' name='page'>Add</button>
</form>