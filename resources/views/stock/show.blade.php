<html>
  <head>
    <title>Stock</title>
  </head>
  <body>

  <h1>Gestion des produits</h1>

  <a class="btn btn-primary" href="{{ route('stockAdd')}}">Ajouter</a>

    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Quantite</th>
          <th>Poids (g)</th>
          <th>Action</th>
        </tr>
      </thead>
    <tbody>

        @foreach($stock as $product)

    <!-- id 'name', 'weight', 'quantity', 'reserved_quantity' -->
        <!-- $html += "<tr><td>".$line['nom']."</td>";
            //     // $html +="<td>"+$line['quantite']+"</td>";
            //     // $html +="<td>"+$line['poids']+"</td></tr>"; -->
          <tr>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['quantity'] }}</td>
            <td>{{ $product['weight'] }}</td>
            <td> 
              
            <a class="btn btn-primary" href="{{ route('stockEdit',['id' => $product->id]) }}">Modifier</a>
            <a class="btn btn-primary" href="{{ route('stockDelete',['id' => $product->id]) }}">Supprimer</a>
            
              
              <!-- <form method="POST" action="/admin/stock/modifier" > -->
              
              <!-- <input type="submit" value=""> -->
              <!-- </form> -->
              <!-- <form action="" method="get"> -->
                <!-- <input type="submit" value="supprimer"> -->
            </form>
              
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

    
    <?php 
      // var_dump($stock);
      // var_dump($stock);
        // $content = '[{"id":"1","nom":"carotte","quantite":"120","poids":"54"},{"id":"2","nom":"navet","quantite":"50","poids":"60"}]';
        // $content = json_decode($content,true);

        // var_dump($content[0]);

        // $html = '<table><thead><tr><th>Nom</th><th>Quantite</th><th>Poids (g)</th><th>Action</th></tr></thead><tbody>';
        //     '<tr>
        //         <td>The table body</td>
        //         <td>with two columns</td>
        //     </tr>';

        // '</tbody></table>';

        // foreach($content as $line){
        //     $html += "<tr><td>".$line['nom']."</td>";
        //     // $html +="<td>"+$line['quantite']+"</td>";
        //     // $html +="<td>"+$line['poids']+"</td></tr>";
        // }

        // echo $html;
    ?>
    
 
  </body>
</html>