<form action="/invoices/<?=$competitionId?>" method="POST">
    <select name="competitionId" id="">
        <?php foreach($costs as $cost): ?>
            <option value="<?=$cost['id']?>"><?=$cost['megnevezes']?></option>
        <?php endforeach ?>
    </select>
    <input type="submit" value="Szűkít">
</form>
<table class="table">
    <tr>
        <th>Számla azonosító</th>
        <th>Számlaszám</th>
        <th>Dátum</th>
        <th>Érték</th>
        <th>Pályázat azonosító</th>
        <th>Költségtípus</th>
    </tr>    
    <?php foreach($invoices as $invoice): ?>
        <tr>
            <td><?= $invoice["id"] ?></td>
            <td><?= $invoice["szamlaszam"] ?></td>
            <td><?= $invoice["datum"] ?></td>           
            <td><?= $invoice["ertek"] ?></td> 
            <td><?= $invoice["palyazatId"] ?></td> 
            <td><?= $invoice["koltsegtipus"] ?></td> 
        </tr>        
    <?php endforeach ?>
</table>