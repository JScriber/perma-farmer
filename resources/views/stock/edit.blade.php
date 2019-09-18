<html>
  <head>
    <title>Modifier un produit</title>
  </head>
  <body>
    <h1>Modifier un produit</h1>

    <form action="{{ route('validStockEdit')}}" method="get" class="form-example">
        
            <label for="nom">Nom</label>
            <input type="text" value="{{ $product->name }}" name="nom" id="nom" required>
            <br />
            <label for="quantite">Quantité</label>
            <input type="number" value="{{ $product->quantity }}" name="quantite" id="quantite"  min="0" required>
            <br />
            <label for="poids">Poids à l'unité</label>
            <input type="number" value="{{ $product->weight }}" name="poids" id="poids"  min="0" required>

            <input type="hidden" value="{{ $product->id }}" name="id" id="id" required>

            <br />        
            <input type="submit" value="Modifier">
        </div>
    </form>
  </body>
</html>