<?php


function getCompetitions( PDO $pdo )
{
    $smt = $pdo->prepare("SELECT * FROM `palyazat`");

    try 
    {
        if (!$smt->execute())
        {
            throw new PDOException($smt->errorInfo()[2]);
        }

        return $smt->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (PDOException $e) 
    {
        errorLog($e->getMessage());
        return [];
    }
}


function getConnection($config)
{
    extract($config);

    try 
    {
        return new PDO(
            "mysql:host={$hostName};dbname={$database};charset=utf8;",
            $userName,
            $password
        );
    } 
    catch (PDOException $e) 
    {
        errorLog($e->getMessage());
        return false;
    }
}