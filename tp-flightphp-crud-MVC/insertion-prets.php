<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inseration de prets</title>
</head>
<body>
    <form action="" method="post">
        <p>Montant prets : <input type="number" name="montant_prets" id=""></p>
        <p>Date debut : <input type="Date" name="mois_debut" id=""></p>
        <p>Date fin : <input type="Date" name="mois_fin" id="">

        <p>Client : 
            <select name="idclient">
                <option value="">Client</option>
                <?php foreach ($client as $clientelle) { ?>
                    <option value="<?= $clientelle->id ?>"><?= $clientelle->nom ?></option>
                <?php } ?>
            </select>
        </p>

        <p>Type de prets :
            <select name="idtypepret" >
                <option value="">Type de prets</option>
                <?php foreach ($prets as $prette) { ?>
                    <option value="<?= $prette->id ?>"><?= $prette->nom ?></option>
                <?php } ?>
            </select>
        </p>
        <p><button type="submit">Valider</button></p>
    </form>
</body>
</html>