<?php

function getCosts( PDO $pdo )
{
    $smt = $pdo->prepare("SELECT * FROM `koltsegtipus`");

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

function getInvoices( PDO $pdo, $competitionId, $costId)
{    

    if ($costId)
    {
        $smt = $pdo->prepare("SELECT 
                                    `s`.`id`,
                                    `s`.`szamlaszam`,
                                    `s`.`datum`,
                                    `s`.`ertek`,
                                    `s`.`palyazatId`,
                                    `k`.`megnevezes` 'koltsegtipus'
                            FROM 
                                `szamla` s JOIN 
                                `koltsegtipus` k ON
                                `s`.`koltsegtipusId` = `k`.`id`
                            WHERE 
                                `s`.`palyazatId` = :competitionId AND
                                `s`.`koltsegtipusId` = :costId
                            ORDER BY `s`.`datum` DESC
                            ");
                
        $smt->bindParam(':costId', $costId);

    }
    else
    {
        $smt = $pdo->prepare("SELECT 
                                `s`.`id`,
                                `s`.`szamlaszam`,
                                `s`.`datum`,
                                `s`.`ertek`,
                                `s`.`palyazatId`,
                                `k`.`megnevezes` 'koltsegtipus'
                        FROM 
                            `szamla` s JOIN 
                            `koltsegtipus` k ON
                            `s`.`koltsegtipusId` = `k`.`id`
                        WHERE `s`.`palyazatId` = :competitionId
                        ORDER BY `s`.`datum` DESC
                        ");
    
    }
                



    $smt->bindParam(':competitionId', $competitionId);

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