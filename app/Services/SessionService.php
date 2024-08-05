<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Services {
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\Session;
    use ProgrammerSalman\SistemManajemenKeuangan\Domain\User;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\SessionRepository;
    use ProgrammerSalman\SistemManajemenKeuangan\Repository\UserRepository;

    // layer session service untuk menghandle logic program untuk simpan identitas user yang sedang login ke halaman web
    class SessionService
    {

        // menyimpan data login user di browser menggunakan cookie dengan nilai cookie nya adalah id dari user yang sedang login saat ini
        public static string $COOKIE_NAME = "manajemen_keuangan_login";

        private SessionRepository $SessionRespository;
        private UserRepository $UserRepository;

        public function __construct(SessionRepository $SessionRepository, UserRepository $UserRepository)
        {
            $this->SessionRespository = $SessionRepository;
            $this->UserRepository = $UserRepository;
        }

        // untuk membuat session baru yang akan dipanggil oleh controller
        public function createSession(string $userId): Session
        {
            $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@#$%^&*";
            $session = new Session();
            $session->id = uniqid() . substr(str_shuffle($string), 0, 10); // membuat session id yang unik
            $session->userId = $userId; // menggunakan id user saat ini

            $this->SessionRespository->save($session);

            // buat cookie dengan data cookie nya dari id session 
            setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), "/");
            return $session;
        }

        // untuk menghapus data session dari database dan cookie dari browser
        public function destroySession()
        {
            // mendeteksi cookie saat ini
            $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";
            $this->SessionRespository->deleteById($sessionId);
            // hapus cookie 
            setcookie(self::$COOKIE_NAME, null, 1, "/");
        }

        // untuk mengecek session saat ini yang berkaitan dengan hak akses user
        public function currentSession(): ?User
        {
            $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";
            $session = $this->SessionRespository->findById($sessionId);

            if ($session == null) {
                return null;
            }

            // dapatkan informasi user yang sedang login berdasarkan hasil dari data session yang telah ditemukan
            return $this->UserRepository->findById($session->userId);
        }
    }
}