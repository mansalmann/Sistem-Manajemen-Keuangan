<!DOCTYPE html>
<html lang="en">
<!-- Meta tags  -->

<head>
  <!-- Meta tags  -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title><?= $model["title"] ?? "Sistem Manajemen Keuangan" ?></title>
  <link rel="icon" type="image/png" href="/assets/images/favicon.png">

  <!-- CSS Assets -->
  <link rel="stylesheet" href="assets/css/app.css">

  <!-- Javascript Assets -->
  <script src="assets/js/app.js" defer=""></script>
  <script src="assets/js/app2.js" defer=""></script>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link
    href="css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700 display=swap"
    rel="stylesheet">
  </link>

  <!-- styling bootstrap css hanya untuk halaman home, login, register, update profile dan password -->
  <?php if (str_contains($model["title"], "Halaman")) { ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <?php } ?>
  <script>
    // dark mode
    localStorage.getItem("_x_darkMode_on") === "true" &&
      document.documentElement.classList.add("dark");
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>