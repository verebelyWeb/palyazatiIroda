<?php

function newInvoiceController()
{
    $pdo = getConnection(getConfig(CONFPATH));
    $invoice = $_POST;

    if (insertNewInvoice($pdo, $invoice))
    {
        $msg = '<span class="succ-msg">Sikeres rögzítés</span>';
        $title = 'Sikeres rögzítés';
    }
    else
    {
        $msg = '<span class="err-msg">Sikertelen rögzítés</span>';
        $title = 'Sikertelen rögzítés';
    }     

    view([
        'view'  => 'feedBack',
        'title' => $title,
        'msg'   => $msg
    ]);


}

function newInvoiceFormController()
{
    $pdo = getConnection(getConfig(CONFPATH));

    view([
        'view'              => 'newInvoiceForm',
        'title'             => 'Új számla felvétele',
        'competitionsDatas' => getCompetitions($pdo),
        'costTypes'         => getCosts($pdo)
    ]);
}

function competitionDeleteController($matches)
{
    $competitionId = $matches['competitionId'];    
    $pdo           = getConnection(getConfig(CONFPATH));


    if (deleteCompetition($pdo, $competitionId))
    {
        $msg = '<span class="succ-msg">Sikeres törlés</span>';
        $title = 'Sikeres törlés';
    }
    else
    {
        $msg = '<span class="err-msg">Sikertelen törlés</span>';
        $title = 'Sikertelen törlés';
    }

    // a feljéc írása meg kell, hogy előzze a törzs írását!
    header("refresh:2;url=/competitions");        

/* 
    ob_start(); -> puffer bekapcsolása
    ob_flush(); -> kimenetre írja a buffer tartalmát
    ob_end_flush(); -> kiír és befejezi a bufferelést
    output buffer
*/
/*
    1. státusz sor
    x. fejléc szekció

    x. http törzs -> html, json, css, js, ...
*/

    view([
        'view'  => 'feedBack',
        'title' => $title,
        'msg'   => $msg
    ]);


}

function invoicesController($matches)
{
    $config         = getConfig(CONFPATH);
    $pdo            = getConnection($config);
    $competitionId  = $matches['competitionId'];
    $costId         = isset($_POST['competitionId']) ? $_POST['competitionId'] : false;
    
    view([        
        "title"             => "Pályázatok",
        'view'              => 'invoices',
        'invoices'          => getInvoices($pdo, $competitionId, $costId),
        'costs'             => getCosts($pdo),
        'competitionId'     => $competitionId  
    ]);

}

function competitionsController()
{

    $config = getConfig(CONFPATH);
    $pdo    = getConnection($config);
    

    view([
        "competitions"      => 'active',
        "title"             => "Pályázatok",
        'view'              => 'competitions',
        'competitionsDatas' => getCompetitions($pdo)
    ]);
}

function homeController()
{    
    view([
        "home"  => 'active',
        "title" => "Home",
        'view'  => 'home'
    ]);
}

function aboutController()
{        
    view([
        "about" => 'active',
        "title" => "About",
        'view'  => 'about'
    ]);
}


function notFoundController()
{
    view([        
        "title" => "Page Not Found",
        'view'  => '_404'
    ]);   
}
