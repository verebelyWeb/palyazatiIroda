<?php

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
