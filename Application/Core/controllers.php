<?php

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
