@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Votre panier à personnaliser</h2>
            <form action={{url('panier')}} method="POST"></form>
            <div class="card">
                <div class="card-header">
                    <div class="weight">1,6kg / 7kg</div>
                    <input type="submit" value="Valider mon panier">
                    <button class="report">Reporter mon panier</button>
                </div>
                <div class="card-body">
                    @if(count($products) >1)

                    @foreach ($products as $product)

                    @if($product->quantity > 0)
                        @if($product->weight > 0)
                        <div class="list" style="display:inline-block">
                            <ul>
                                <li style="list-style: none; border: 1px solid grey; padding: 10px">
                                    <div class="imgproduct">
                                       <img src="../assets/panier.png" alt="panier">
                                    </div>
                                <div class="libelle">
                                    <p>{{$product->name}}</p>
                                </div>
                                <div class="poids">
                                    <p>{{$product->weight}} g</p>
                                </div>
                                <div class="quantity" >
                                    <input id="minus" type="button" value="-">
                                    <input id="quantity" type="text" value="0" name="quantity">
                                    <input id="plus" type="button" value="+">
                                    <p>pièces/bottes</p>
                                    <p>{{$product->quantity}} disponible(s)</p>
                                </div>
                                </li>
                            </ul>
                        </div>
                        @endif
                    @endif

                    @endforeach
                    @else
                    <p>Nous sommes désolés, aucun produits n'est disponible à la vente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="../resources/js/jquery.min.js"></script>
<script>
$('#plus').click(function add() {
  var $qtde = $("#quantity");
  var a = $qtde.val();

  a++;
  $("#minus").attr("disabled", !a);
  $qtde.val(a);
});
$("#minus").attr("disabled", !$("#quantity").val());

$('#minus').click(function less() {
  var $qtde = $("#quantity");
  var b = $qtde.val();
  if (b >= 1) {
    b--;
    $qtde.val(b);
  } else {
    $("#minus").attr("disabled", true);
  }
});</script>
