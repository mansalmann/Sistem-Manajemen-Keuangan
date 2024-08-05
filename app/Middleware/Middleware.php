<?php

namespace ProgrammerSalman\SistemManajemenKeuangan\Middleware {

    interface Middleware
    {
        function beforeController(): void;
    }
}