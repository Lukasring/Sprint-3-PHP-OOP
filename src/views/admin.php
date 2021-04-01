<?php
// php create-product.php <name>
require_once "bootstrap.php";

$ACTIONS = [
  'edit' => 'page-update',
  'new' => 'page-new'
];


function validUser($username, $password)
{
  return $username == 'admin' && $password == 'admin';
}

function redirect_to_root()
{
  header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

function renderForm($title, $content, $action, $id = null)
{
  $btnName = $action === 'page-update' ? 'Update' : 'Add';
  print("<form class='page-form' method='POST' action=''>");
  print($id !== null ? "<input type='hidden' id='id' name='id' value='{$id}' " : '');
  print("
  <label for='title'>Title</label>
  <input type='text' id='title' name='title' value='{$title}'>
  <label for='content'>Content</label>
  <textarea id='content' name='content' rows='10'>{$content}</textarea>
  <div>
  <button class='btn' type='submit' name='{$action}'>{$btnName}</button>
  <button class='btn danger' type='submit' name='cancel'>Cancel</button>
  </div>
</form>");
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  unset($_SESSION['logged_in']);
  unset($_SESSION['time']);
  unset($_SESSION['username']);
  redirect_to_root();
}


if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $isValidUser = validUser($_POST['username'], $_POST['password']);
  $msg = '';
  if ($isValidUser) {
    $_SESSION['logged_in'] = true;
    // $_SESSION['timeout'] = time();
    $_SESSION['username'] = $_POST['username'];
    header("Location: {$_SESSION['root_dir']}");
  } else {
    $msg = 'Invalid username or password!';
  }
}


?>

<nav>
  <ul class='navigation-items'>
    <li class='navigation-item active'><a href='./admin'>Admin</a></li>
    <li class='navigation-item'><a href='./'>View Website</a></li>
    <?php
    if ($_SESSION['logged_in']) {
      print("<li class='navigation-item'><a href='?action=logout'>Logout</a></li>");
    }
    ?>
  </ul>
</nav>
<main>
  <?php

  if (!$_SESSION['logged_in']) {
    print("<form class='login-form' action='' method='POST'>");
    print("<h3>Log In</h3>");
    print("<label for='username'>Username</label>");
    print("<input id='username' name='username' type='text' placeholder='admin'>");
    print("<label for='password'>Password</label>");
    print("<input id='password' name='password' type='password' placeholder='admin'>");
    print("<button type='submit' class='btn login' name='login'>Log In</button>");
    print("</form>");
    print($msg);
  }

  if (
    isset($_POST['page-new']) && !empty($_POST['title'])
    && !empty($_POST['content']) && $_SESSION['logged_in']
  ) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $page = new Page();
    $page->setName($title);
    $page->setContent($content);
    $entityManager->persist($page);
    $entityManager->flush();
    redirect_to_root();
  }

  if (
    isset($_POST['page-update']) && !empty($_POST['title'])
    && !empty($_POST['content']) && $_SESSION['logged_in']
  ) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];
    $page = $entityManager->find('Page', $id);
    $page->setName($title);
    $page->setContent($content);
    $entityManager->flush();
    redirect_to_root();
  }

  if (isset($_POST['cancel'])) {
    redirect_to_root();
  }

  if (isset($_POST['delete']) && $_SESSION['logged_in']) {
    $page = $entityManager->find('Page', $_POST['delete']);
    $entityManager->remove($page);
    $entityManager->flush();
  }


  if (
    $_SERVER['REQUEST_URI'] === $rootPath . 'admin'
    && !isset($_GET['action'])
    && $_SESSION['logged_in']
  ) {
    $pages = $entityManager->getRepository("Page")->findAll();
    print('<section class=\'table\'>');
    print('<div class=\'col-name\'>Title</div><div class=\'col-name\'>Action</div>');
    foreach ($pages as $page) {
      print('<div>' . $page->getName() . '</div>');
      print('<div>');
      print("<a class='btn small' href='?action=edit&id={$page->getId()}'>Edit</a>");
      if ($page->getId() !== 1) {
        print("<form class='single'  action='' method='POST'><button class='btn small danger' type='submit' name='delete' value='{$page->getId()}'>Delete</button></form>");
      }
      print('</div>');
      // dump($page);
    }
    print('</section>');
    print('<div><a href=\'?action=new\' class=\'btn\'>Add Page</a></div>');
  }

  if (
    isset($_GET['action'])
    && $_GET['action'] === 'new'
    && $_SESSION['logged_in']
  ) {
    renderForm('', '', $ACTIONS['new']);
  }

  if (
    isset($_GET['action'])
    && $_GET['action'] === 'edit'
    && isset($_GET['id'])
    && !empty($_GET['id'])
    && $_SESSION['logged_in']
  ) {
    $page = $entityManager->find('Page', $_GET['id']);
    renderForm($page->getName(), $page->getContent(), $ACTIONS['edit'], $_GET['id']);
  }
