<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Ajouter dans le fonds</h2>

    <form method="POST" action="/ajout-fond">
        <label>Montant :</label>
        <input type="number" name="montant" step="0.01" required><br>

        <label>Type d'opération :</label>
        <select name="type_operation">
            <option value="entree">Entrée</option>
            <option value="sortie">Sortie</option>
        </select><br>

        <label>Date :</label>
        <input type="date" name="date_operation"><br>

        <label>Description :</label>
        <input type="text" name="descri"><br>

        <button type="submit">Ajouter</button>
    </form>

</body>
</html>