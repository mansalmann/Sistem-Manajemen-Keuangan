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

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link
    href="css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700 display=swap"
    rel="stylesheet">
  </link>
  <script>
    localStorage.getItem("_x_darkMode_on") === "true" &&
      document.documentElement.classList.add("dark");
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</head>
<body x-data="" class="is-header-blur" x-bind="$store.global.documentBody">
  <div id="root" class="h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak="">
    <main class="grid w-full grow grid-cols-1 place-items-center">
      <div class="max-w-2xl p-6 text-center">
        <div class="w-full max-w-md">
          <img class="w-full" x-show="!$store.global.isDarkModeEnabled" src="assets/images/illustrations/error-404.svg"
            alt="image">
          <img class="w-full" x-show="$store.global.isDarkModeEnabled"
            src="assets/images/illustrations/error-404-dark.svg" alt="image">
        </div>
        <p class="pt-4 text-xl font-semibold text-slate-800 dark:text-navy-50">
          Oops. Halaman yang Anda cari tidak ada.
        </p>

        <a class="btn mt-3 h-11 bg-primary text-base font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:hover:shadow-accent/50 dark:focus:bg-accent-focus dark:focus:shadow-accent/50 dark:active:bg-accent/90"
          href="/dashboard">
          Kembali ke Dashboard
        </a>
      </div>
    </main>