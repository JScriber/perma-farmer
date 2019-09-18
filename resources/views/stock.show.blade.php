<html>
  <head>
    <title>Stock</title>
  </head>
  <body>
    <?php 
        $content = '[{"id":"1","nom":"carotte","quantite":"120","poids":"54"},{"id":"2","nom":"navet","quantite":"50","poids":"60"}]';
        $content = json_decode($content,true);

        var_dump($content[0]);

        $html = '<table><thead><tr><th>Nom</th><th>Quantite</th><th>Poids (g)</th><th>Action</th></tr></thead><tbody>';
            '<tr>
                <td>The table body</td>
                <td>with two columns</td>
            </tr>';

        '</tbody></table>';

        foreach($content as $line){
            $html += "<tr><td>".$line['nom']."</td>";
            // $html +="<td>"+$line['quantite']+"</td>";
            // $html +="<td>"+$line['poids']+"</td></tr>";
        }

        echo $html;
    ?>
    
 
  </body>
</html>