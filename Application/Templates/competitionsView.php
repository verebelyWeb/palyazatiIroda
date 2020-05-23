<table class="table">
    <tr>
        <th>Pályázat azonosító</th>
        <th>Tervezet (A)</th>
        <th>Tervezet (C)</th>
        <th>Számlák lekérése</th>
        <th>Pályázat tőrlése</th>
    </tr>    
    <?php foreach($competitionsDatas as $competition): ?>
        <tr>
            <td><?= $competition["id"] ?></td>
            <td><?= $competition["tevezetA"] ?></td>
            <td><?= $competition["tervezetC"] ?></td>
            <td><a href="/invoices/<?= $competition["id"] ?>" class="btn btn-grn">lekér</a></td>
            <td><a href="/competitionDelete" class="btn btn-rd">Tőrlés</a></td>
        </tr>        
    <?php endforeach ?>
</table>