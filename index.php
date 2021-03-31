<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/styles/home.css">
  <title>Super Awesome Blogs!</title>
</head>

<?php
$request = $_SERVER['REQUEST_URI'];
$rootPath = '/sprint-3-OOP/';
// $rootPath = '/';
?>

<body>
  <header>
    <h2>Awesome Blogs!</h2>
    <nav>
      <ul class='navigation-items'>
        <li class='navigation-item'><a href='./'>Home</a></li>
        <li class='navigation-item'><a href='#'>About</a></li>
        <li class='navigation-item'><a href='#'>Something</a></li>
        <li class='navigation-item'><a href='#'>Something Else</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <?php
    $url = $_SERVER['REQUEST_URI'];

    switch ($url) {
      case $rootPath:
        require __DIR__ . '/src/views/pageList.php';
        break;
      case '':
        require __DIR__ . '/src/views/pageList.php';
        break;
      case $rootPath . 'admin':
        require __DIR__ . '/src/views/admin.php';
        break;
      default:
        http_response_code(404);
        require __DIR__ . '/src/views/404.php';
        break;
    }
    ?>
  </main>
</body>

</html>