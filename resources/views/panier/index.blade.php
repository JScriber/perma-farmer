@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Votre panier à personnaliser</h2>

            @if ($can_report == true)
                <form action={{url('panier/report')}} method="POST">
                    @csrf
                    <button type="submit" class="btn-link">
                        Reporter mon panier
                    </button>
                </form>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="form-group row">
                        <select class="form-control" id="basket-choices"></select>

                        <button id="add-basket" class="btn" type="button">Ajouter</button>
                    </div>
                </div>

                <div class="card-body">

                    <form action={{url('panier')}} method="POST">
                        @csrf

                        <div class="info">
                            <div id="total-weight">1,6kg / 7kg</div>
                            <button type="submit" class="btn-primary">Valider mon panier</button>
                        </div>

                        <ul id="list-selected-baskets">
                            <li class="template" style="list-style: none; border: 1px solid grey; padding: 10px">
                                <button type="button" class="delete btn-danger">Supprimer</button>
                                <div class="image-product">
                                    <img src="../assets/panier.png" alt="panier">
                                </div>

                                <div class="infos">
                                    <div class="name"><p></p></div>
                                    <div class="weight"><p></p></div>
                                </div>

                                <input hidden readonly class="product-id" type="number" name="products[][id]"/>

                                <div class="quantity-container">
                                    <button type="button" class="minus">-</button>
                                    <input readonly class="quantity" type="number" name="products[][quantity]"/>
                                    <button type="button" class="plus">+</button>

                                    <p>pièces/bottes</p>
                                </div>

                                <p class="available">disponible(s)</p>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
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
            const parent = this.parentNode;
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
@endsection

