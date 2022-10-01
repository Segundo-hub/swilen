<?php

use Swilen\Arthropod\Bootable\BootEnviromment;
use Swilen\Arthropod\Env;

/* ============================================================= */
/*  Load custom eviromment instance
/* ============================================================= */

BootEnviromment::factory(function () {
    return (new Env())
        ->createFrom(dirname(__DIR__))
        ->load();
});

/* ============================================================= */
/*  Create the Swilen Application
/* ============================================================= */

$app = new Swilen\Arthropod\Application(
    $_ENV['SWILEN_BASE_URL'] ?? dirname(__DIR__)
);

/* ============================================================= */
/*  Return Swilen Application instance
/* ============================================================= */

return $app;
