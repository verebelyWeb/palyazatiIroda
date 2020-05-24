<?php

function insertNewInvoice( PDO $pdo, $invoice)
{
    extract($invoice);

    $smt = $pdo->prepare(
        "INSERT INTO `szamla` VALUES (
            (SELECT MAX(id) + 1 FROM (SELECT * FROM `szamla`) T),
            :szamlaszam, 
            current_date, 
            :ertek, 
            :palyazatId, 
            :koltsegtipusId
        )"
    );

    $smt->bindParam(":szamlaszam",      $szamlaszam);
    $smt->bindParam(":ertek",           $ertek);
    $smt->bindParam(":palyazatId",      $palyazatId);
    $smt->bindParam(":koltsegtipusId",  $koltsegtipusId);

    try 
    {
        if (!$smt->execute())
        {
            throw new PDOException($smt->errorInfo()[2]);
        }

        return true;
    } 
    catch (PDOException $e) 
    {
        errorLog($e->getMessage());
        return false;
    }
}

function deleteCompetition( PDO $pdo, $competitionId)
{
    $smt = $pdo->prepare("DELETE FROM `_palyazat` WHERE `id` = :competitionId");

    $smt->bindParam(":competitionId", $competitionId);

    try 
    {
        if (!$smt->execute())
        {
            throw new PDOException($smt->errorInfo()[2]);
        }

        return true;
    } 
    catch (PDOException $e) 
    {
        errorLog($e->getMessage());
        return false;
    }
}

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