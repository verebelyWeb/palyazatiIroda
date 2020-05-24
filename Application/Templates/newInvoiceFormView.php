<h2>Az új számla felvételéhez, kérjük töltse ki az alábbi űrlapot!</h2>
<form action="/newInvoice" method="POST" class="form">
    <div>
        <label for="">Pályázatok</label>
        <select name="palyazatId" id="">
        <?php foreach($competitionsDatas as $competition): ?>
            <option value="<?=$competition['id']?>"><?= $competition['id'] ?></option>
        <?php endforeach ?>
        </select>
    </div>

    <div>
        <label for="">Költségtipusok</label>
        <select name="koltsegtipusId" id="">
        <?php foreach($costTypes as $costType): ?>
            <option value="<?=$costType['id']?>"><?= $costType['megnevezes'] ?></option>
        <?php endforeach ?>
        </select>
    </div>    

    <label for="">Számlaszam</label>
    <input type="text" name="szamlaszam">
    
    <label for="">Érték</label>
    <input type="number" min="0" step="1" name="ertek">

    <br>
    <input type="submit" value="Rögzít" class="btn btn-grn">
</form>