@extends('layouts.app')

@section('content')
<div class="container">

    @if ($can_modify == true)

        <div class="row justify-content-center">
            <div class="head">
                <div class="logo-container">
                    <div class="logo-welcome"></div>
                </div>
                <div class="title-welcome">Choisissez vos produits</div>
            </div>
            <div class="card card-basket">
                <div class="info info-weight">
                    <div id="total-weight">1,6kg / 7kg</div>
                </div>
                <div class="card-header">
                    <div class="form-group row choose-product">
                        <select class="form-control" id="basket-choices"></select>
                        <button id="add-basket" class="btn" type="button">Ajouter</button>
                        @if ($can_report == true)
                        <form action={{url('panier/report')}} method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-report">
                                Reporter mon panier
                            </button>
                        </form>
                    @endif
                    </div>
                </div>


                <div class="card-body">

                    <form action={{url('panier')}} method="POST">
                        @csrf



                        <ul id="list-selected-baskets">
                            <li class="template basket-product">

                                <div class="info-product">
                                    <button type="button" class="delete"><i class="material-icons">cancel</i></button>
                                    <div class="image-product">
                                        <div class="image-basket"></div>
                                    </div>

                                    <div class="infos">
                                        <div class="name"><p></p></div>
                                        <div class="weight"><p></p></div>
                                    </div>

                                    <input hidden readonly class="product-id" type="number" name="products[][id]"/>
                                    <p class="available">disponible(s)</p>

                                </div>

                                <div class="quantity-container">
                                    <button type="button" class="minus">-</button>
                                    <input readonly class="quantity" type="number" name="products[][quantity]"/>
                                    <button type="button" class="plus">+</button>

                                    <p>pièces/bottes</p>
                                </div>

                            </li>
                        </ul>
                        <div class="info info-submit btn-ok">
                            <button type="submit" class="btn btn-outline-success">Valider mon panier</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script>
            // All known products.
            let allProducts = {!! $products_available !!};

            const oldSelected = {!! $old_selection !!};

            // Max weight in gramme.
            const maxWeight = {!! $max_weight !!};

            // IDs of the selected baskets.
            let selectedProducts = [];

            // Basket template.
            let templateCopy;

            /** Treats the old data. */
            function treatOld() {
                if (oldSelected) {
                    oldSelected.forEach(old => {
                        const product = allProducts.find(p => p.id === old.id);
                        product.quantity += old.quantity;

                        const selected = JSON.parse(JSON.stringify(product));
                        selected.selectedQuantity = old.quantity;

                        selectedProducts.push(selected);
                        injectBasket(selected);
                    });

                    console.log(oldSelected);
                }
            }

            /** Loads the template. */
            function loadTemplate() {
                const templateRef = document.getElementsByClassName('template')[0];
                templateCopy = templateRef.cloneNode(true);
                templateRef.parentNode.removeChild(templateRef);
            }

            /** Feed the choices select. */
            function feedChoices() {
                const select = document.getElementById('basket-choices');

                // Remove initial options.
                while (select.firstChild) {
                    select.removeChild(select.firstChild);
                }

                // Products available.
                const availableProducts = allProducts.filter(p => selectedProducts
                    .find(selected => selected.id === p.id) === undefined);

                // Add the options.
                availableProducts.forEach(product => {
                    const option = document.createElement('OPTION');
                    option.setAttribute('value', product.id);
                    option.innerHTML = product.name;

                    select.appendChild(option);
                });
            }

            /** Calculates the total weight. */
            function totalWeight() {

                return selectedProducts.reduce((accumulator, current) => {
                    return accumulator + (current.selectedQuantity * current.weight);
                }, 0);
            }

            /** Updates the weight. */
            function updateWeight() {
                const weight = totalWeight() / 1000;

                document.getElementById('total-weight').innerHTML = weight + 'kg / ' + maxWeight / 1000 + 'kg';
            }

            /** Injects a basket in the list. */
            function injectBasket(product) {
                const template = templateCopy.cloneNode(true);

                const totalAvailable = product.quantity;

                // Feed the data.
                template.setAttribute('data-id', product.id);
                template.querySelector('.name p').innerHTML = product.name;
                template.querySelector('.weight p').innerHTML = product.weight + 'g';
                template.querySelector('.available').innerHTML =  totalAvailable + ' disponibles.';
                template.querySelector('.product-id').value = product.id;

                // Hack for laravel post submit.
                template.querySelector('.product-id').setAttribute('name', 'products[' + product.id + '][id]');
                template.querySelector('.quantity').setAttribute('name', 'products[' + product.id + '][quantity]');

                /** Update the quantity of the template. */
                const updateQuantity = quantity => {
                    template.querySelector('.quantity').value = quantity;
                };

                /**
                 * Finds a product with the template. Auto-resolve.
                 * @param el
                 * @returns the selected product.
                 */
                const findProductFromTemplate = () => {
                    const id = Number.parseInt(template.getAttribute('data-id'));

                    return selectedProducts.find(p => p.id === id);
                };

                /** Updates the available count. */
                const updateAvailable = (quantity) => {
                    const selected = findProductFromTemplate();
                    const available = selected.quantity - quantity;

                    template.querySelector('.available').innerHTML =  available + ' disponibles.';
                };

                // Initial call.
                updateQuantity(product.selectedQuantity);
                updateAvailable(product.selectedQuantity);
                updateWeight();

                // Delete behaviour.
                template.querySelector('.delete').addEventListener('click', function () {
                    const parent = this.parentNode.parentNode;
                    const id = Number.parseInt(parent.getAttribute('data-id'));

                    selectedProducts = selectedProducts.filter(p => p.id !== id);
                    parent.parentNode.removeChild(parent);

                    feedChoices();
                    updateWeight();
                });


                // Minus button.
                template.querySelector('.minus').addEventListener('click', () => {

                    const selectedProduct = findProductFromTemplate();

                    if (selectedProduct.selectedQuantity > 1) {
                        selectedProduct.selectedQuantity --;
                    }

                    updateQuantity(selectedProduct.selectedQuantity);
                    updateAvailable(selectedProduct.selectedQuantity);
                    updateWeight();
                });


                // Plus button.
                template.querySelector('.plus').addEventListener('click', () => {

                    const selectedProduct = findProductFromTemplate();

                    if (selectedProduct.quantity - selectedProduct.selectedQuantity > 0 &&
                        totalWeight() + selectedProduct.weight < maxWeight) {
                        selectedProduct.selectedQuantity ++;
                    }

                    updateQuantity(selectedProduct.selectedQuantity);
                    updateAvailable(selectedProduct.selectedQuantity);
                    updateWeight();
                });

                document.getElementById('list-selected-baskets').appendChild(template);
            }

            window.addEventListener('load', () => {
                loadTemplate();
                treatOld();

                allProducts = allProducts.filter(p => p.quantity > 0);
                feedChoices();


                updateWeight();

                // Event triggered when the user selects a product in his basket.
                document.getElementById('add-basket').addEventListener('click', () => {
                    const selectedID = document.getElementById('basket-choices').value;

                    if (selectedID !== undefined) {
                        let selected = allProducts.find(p => p.id === Number.parseInt(selectedID));
                        selected = JSON.parse(JSON.stringify(selected));
                        selected.selectedQuantity = 1;

                        if (totalWeight() + selected.weight < maxWeight) {
                            selectedProducts.push(selected);

                            feedChoices();
                            injectBasket(selected);
                        }
                    }
                });
            });
        </script>
    @else
        <h1>Votre panier a été validé !</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Produit</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($old_basket->basketProducts as $product)
                    <tr>
                        <td colspan="2">{{ $product->product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

