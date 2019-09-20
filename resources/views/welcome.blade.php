@extends('layouts.app')

@section('content')
            <div class="main-content">
                <div class="block" id="block-1">
                    <div class="title-container">
                        <div class="logo-container">
                            <div class="logo-welcome"></div>
                            <div class="text-logo-welcome">Vente à la ferme de légumes issus d'une agriculture paysanne et biologique</div>
                            <hr>
                        </div>
                        <div class="title-welcome">Qui sommes-nous ?</div>
                    </div>
                </div>
                <div class="block" id="block-2">
                    <div class="card-container">
                        <div class="card-top">
                            <div class="card-image"></div>
                            <div class="card-text-container">
                                <div class="card-text">
                                    <div class="card-paragraph-1">La ferme Perma-Farmer propose une culture biologique de fruits et légumes cultivés en permaculture.</div>
                                    <div class="card-paragraph-2">La ferme ne possède pas de label bio mais cultive ses productions sans produits phytosanitaires (désherbants, insecticides, engrais chimiques...).</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-bottom">
                            <div class="card-text-container">
                                <div class="card-text">
                                    <div class="card-paragraph-1">Les produits proposés par la ferme sont de saison et récoltés dans un soucis d'anti-gaspillage.</div>
                                    <div class="card-paragraph-2">Les paniers personnalisables peuvent être composés: de fruits et légumes de saison (pommes de terre, carottes, divers salades, ail, oignons, courgettes...), des oeufs frais de poules, canards et d'oies</div>
                                </div>
                            </div>
                            <div class="card-image"></div>
                        </div>
                    </div>
                </div>
                <div class="block" id="block-3">
                    <div class="offer-product">
                        <div class="offer">
                            <div class="title">Nos offres</div>
                            <div class="offer-liste">
                                <div class="card">
                                    <div class="offer-image" id="smallBasket"></div>
                                    <div class="offer-text">Formule petit panier 2.5kg au prix de 12,50€/panier (soit 48,40€/mois)</div>
                                </div>
                                <div class="card">
                                    <div class="offer-image" id="bigBasket"></div>
                                    <div class="offer-text">Formule petit panier 7kg au prix de 24,90€/panier (soit 111,60€/mois)</div>
                                </div>

                            </div>
                        </div>
                        <div class="product">
                            <div class="title">Produits du moment</div>
                            <div class="card">
                                <div class="unit-product" id="1">
                                    <div class="img-product" id="img-1"></div>
                                    <div class="text">Tomates</div>
                                </div>
                                <div class="unit-product" id="2">
                                    <div class="img-product" id="img-2"></div>
                                    <div class="text">Radis</div>
                                </div>
                                <div class="unit-product" id="3">
                                    <div class="img-product" id="img-3"></div>
                                    <div class="text">Abricot</div>
                                </div>
                                <div class="unit-product" id="4">
                                    <div class="img-product" id="img-4"></div>
                                    <div class="text">Carottes</div>
                                </div>
                                <div class="unit-product" id="5">
                                    <div class="img-product" id="img-5"></div>
                                    <div class="text">Salades</div>
                                </div>
                                <div class="unit-product" id="6">
                                    <div class="img-product" id="img-6"></div>
                                    <div class="text">Framboises</div>
                                </div>
                                <div class="unit-product" id="7">
                                    <div class="img-product" id="img-7"></div>
                                    <div class="text">Pommes de terre</div>
                                </div>
                                <div class="unit-product" id="8">
                                    <div class="img-product" id="img-8"></div>
                                    <div class="text">Fraises</div>
                                </div>
                                <div class="unit-product" id="9">
                                    <div class="img-product" id="img-9"></div>
                                    <div class="text">Haricots verts</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
