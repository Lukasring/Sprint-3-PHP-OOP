<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/styles/home.css">
  <title>Super Awesome Pages!</title>
</head>

<?php
function startsWith($string, $startString)
{
  $len = strlen($startString);
  return (substr($string, 0, $len) === $startString);
}

$request = $_SERVER['REQUEST_URI'];
$rootPath = '/sprint-3-OOP/';

// $rootPath = '/';
?>

<body>
  <header>
    <h2><a href='./'>Awesome Pages!</a></h2>
  </header>
  <?php
  $url = $_SERVER['REQUEST_URI'];

  switch ($url) {

    case startsWith($url, $rootPath . 'admin'):
      require __DIR__ . '/src/views/admin.php';
      break;
    case startsWith($url, $rootPath):
      require __DIR__ . '/src/views/pageList.php';
      break;
    default:

      http_response_code(404);
      require __DIR__ . '/src/views/404.php';
      break;
  }
  ?>
  </main>
  <footer>© My Epic Pages 2021</footer>
</body>

</html>