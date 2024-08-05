<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\App {

    class View
    {

        // function untuk merender halaman web
        public static function renderPage(string $view, $model)
        {
            // parameter $view untuk menghandle nama halaman mana yang mau dibuka pada file halaman web di folder View sesuai dengan request url nya
            // parameter $data untuk mengirim semua response data ke halaman web

            // tampilkan tiga halaman utama
            if (str_contains($view, "Error/404")) {
                require __DIR__ . "/../../public/assets/Error/404.php";
            } else {
                require __DIR__ . "/../../public/assets/header.php";
                if (str_contains($view, "User/")) {
                    require __DIR__ . "/../../public/assets/" . $view . ".php";
                } else {
                    require __DIR__ . "/../../public/assets/body.php";
                    require __DIR__ . "/../../public/assets/" . $view . ".php";
                }
            }
            require __DIR__ . "/../../public/assets/footer.php";
        }

        // function untuk redirect ke halaman tertentu berdasarkan request url di parameter
        public static function redirect(string $url)
        {
            header("Location: $url");
            if (getenv("mode") != "test") {
                exit();
            }
        }
    }
}