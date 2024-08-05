<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\App {

    class Router
    {

        // file router digunakan untuk melakukan registrasi url mapping dan menjalankan routing
        // array untuk menyimpan data registrasi url mapping
        public static array $routes = [];


        // function registrasi url mapping
        public static function add(string $http_method, string $path, string $controller, string $controller_function, array $middlewares = [])
        {
            self::$routes[] = [
                "method" => $http_method,
                "path" => $path,
                "controller" => $controller,
                "function" => $controller_function,
                "middlewares" => $middlewares
            ];
        }

        public static function run()
        {
            // menjalankan routing

            // menentukan path default (jika tidak ada path_info yang diterima dari url)
            $request_path = "/";
            // cek apakah ada path_info di dalam request url
            if (isset($_SERVER["PATH_INFO"])) {
                $request_path = $_SERVER["PATH_INFO"];
            }

            // dapatkan method dari request url
            $method = $_SERVER["REQUEST_METHOD"];
            // melakukan perulangan pada data registrasi url mapping dan menjalakan controller sesuai dengan reu$request_path nya
            foreach (self::$routes as $route) {

                // jadikan path pada data registrasi url mapping nya sebagai regex
                $pattern = "#^" . $route["path"] . "$#";

                if ($method == $route["method"] && preg_match($pattern, $request_path, $data)) {

                    // sebelum ke controller, jalankan dulu middleware yang tersedia
                    foreach ($route["middlewares"] as $middleware) {
                        $Middleware = new $middleware;
                        $Middleware->beforeController(); // menjalankan function beforeController sebelum diproses ke controller
                    }

                    // buat object controller
                    $controller = new $route["controller"];
                    // buat variable function pada controller
                    $function = $route["function"];

                    // hilangkan data pertama pada hasil pola regex
                    array_shift($data);

                    // jalankan semua
                    call_user_func_array([$controller, $function], $data);
                    return;
                }
            }
            View::renderPage("Error/404",[
                "title" => "Halaman tidak ditemukan"
            ]);
        }

    }
}