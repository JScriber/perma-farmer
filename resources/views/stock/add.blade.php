<html>
  <head>
    <title>Ajouter un produit</title>
  </head>
  <body>
    <h1>Ajouter un produit</h1>

    <form action="{{ route('validStockAdd')}}" method="get" class="form-example">
        
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>
            <br />
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" min="0"  required>
            <br />
            <label for="poids">Poids à l'unité</label>
            <input type="number" name="poids" id="poids"  min="0" required>
            <br />        
            <input type="submit" value="Ajouter">
        </div>
    </form>
  </body>
</html>