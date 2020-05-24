<?php       
    define('APPPATH', 'Application/');


    // Logolás szintje -> error level
    error_reporting(E_ALL);    
    //hibaüzenetek kimenetre írásának ki/be kapcsolása.
    ini_set('display_errors', "1");
    // Logolás be/ki kapcsolása
    ini_set("log_errors", "1");
    // Logfájl útvonala
    ini_set("error_log", APPPATH."Log/sys.log");

    /**
     * Az APPROOT szükséges ahhoz, hogy amennyiben nem nem a webszerver
     * győkérmappájában lakik az alkalmazásunk, a routing helyesen működjön.
     * 
     * Pl.: winsql.vereb.dc/diakXX/feladat/index.php
     *    ekkor:              --> /feladat
     */
    define('APPROOT', '');       

    /**
     * Az adatbázis kacsolódásho szükséges adatokat tartalmazó json fájl.
     */
    define('CONFPATH', 'config.json');
   
    // Könyvtárak behúzása
    require_once APPPATH.'Core/functions.php';
    require_once APPPATH.'Core/controllers.php';
    require_once APPPATH.'Database/database.php';
    
    /**
     * A core.php-ban megyünk tovább.
     */
    require_once APPPATH.'Core/core.php';