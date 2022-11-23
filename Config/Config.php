<?php
    namespace Config;
    define("ROOT", dirname(__DIR__) . "/");
    define("FRONT_ROOT", "/PetHero/");
    define("VIEWS_PATH", "Views/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "layout/styles/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "layout/scripts/");
    define("IMG_PATH", VIEWS_PATH . "img/");
    define("DB_HOST", "localhost");
    define("DB_NAME", "pethero");
    define("DB_USER", "root");
    define("DB_PASS", "");
?>