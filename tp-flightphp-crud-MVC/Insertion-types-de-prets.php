
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des types de prêt</title>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    input, button { margin: 5px; padding: 5px; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
  </style>
</head>
<body>

  <h1>Gestion des types de prêt</h1>

  <div>
    <input type="hidden" id="id">
    <input type="text" id="nom" placeholder="Nom du prêt">
    <input type="number" id="taux_mois" placeholder="Taux par mois">
    <button onclick="ajouterOuModifier()">Ajouter / Modifier</button>
  </div>

  <table id="table-typepret">
    <thead>
      <tr>
        <th>ID</th><th>Nom</th><th>Taux/mois</th><th>Actions</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    const apiBase = "http://localhost:8888/ws";

    function ajax(method, url, data, callback) {
      const xhr = new XMLHttpRequest();
      xhr.open(method, apiBase + url, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
          callback(JSON.parse(xhr.responseText));
        }
      };
      xhr.send(data);
    }

    function chargerTypePret() {
      ajax("GET", "/typepret", null, (data) => {
        const tbody = document.querySelector("#table-typepret tbody");
        tbody.innerHTML = "";
        data.forEach(tp => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${tp.id}</td>
            <td>${tp.nom}</td>
            <td>${tp.taux_mois}</td>
            <td>
              <button onclick='remplirFormulaire(${JSON.stringify(tp)})'>✏️</button>
              <button onclick='supprimer(${tp.id})'>🗑️</button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      });
    }

    function ajouterOuModifier() {
      const id = document.getElementById("id").value;
      const nom = document.getElementById("nom").value;
      const taux = document.getElementById("taux_mois").value;

      const data = `nom=${encodeURIComponent(nom)}&taux_mois=${taux}`;

      if (id) {
        ajax("PUT", `/typepret/${id}`, data, () => {
          resetForm();
          chargerTypePret();
        });
      } else {
        ajax("POST", "/typepret", data, () => {
          resetForm();
          chargerTypePret();
        });
      }
    }

    function remplirFormulaire(tp) {
      document.getElementById("id").value = tp.id;
      document.getElementById("nom").value = tp.nom;
      document.getElementById("taux_mois").value = tp.taux_mois;
    }

    function supprimer(id) {
      if (confirm("Supprimer ce type de prêt ?")) {
        ajax("DELETE", `/typepret/${id}`, null, () => {
          chargerTypePret();
        });
      }
    }

    function resetForm() {
      document.getElementById("id").value = "";
      document.getElementById("nom").value = "";
      document.getElementById("taux_mois").value = "";
    }

    chargerTypePret();
  </script>

</body>
</html>
