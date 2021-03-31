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
?>



<form method='POST' action=''>
  <label for='title'>Title</label>
  <input type='text' id='title' name='title'>
  <label for='content'>Content</label>
  <textarea id='content' name='content'></textarea>
  <button type='submit' name='page'>Add</button>
</form>