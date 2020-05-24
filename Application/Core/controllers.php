<?php

function competitionDeleteController($matches)
{
    $competitionId = $matches['competitionId'];    
    $pdo           = getConnection(getConfig(CONFPATH));


    if (true/*deleteCompetition($pdo, $competitionId)*/)
    {
        $msg = '<span class="succ-msg">Sikeres törlés</span>';
        $title = 'Sikeres törlés';
    }
    else
    {
        $msg = '<span class="err-msg">Sikertelen törlés</span>';
        $title = 'Sikertelen törlés';
    }
    ob_end_flush();
echo 'almafa';
    // a feljéc írása meg kell, hogy előzze a törzs írását!
    header("refresh:2;url=/competitions");
/*
    1. státusz sor
    x. fejléc szekció

    x. http törzs -> html, json, css, js, ....
*/

die;

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
