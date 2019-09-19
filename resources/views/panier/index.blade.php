@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Votre panier à personnaliser</h2>

            <div class="card">
                <div class="card-header">
                    <div class="weight">1,6kg / 7kg</div>
                    <input type="submit" value="Valider mon panier">
                    <button class="report">Reporter mon panier</button>

                    <div class="add-item">
                        <select id="basket-choices"></select>

                        <button id="add-basket" type="button">Ajouter</button>
                    </div>
                </div>

                <div class="card-body">

                    <form action={{url('panier')}} method="POST">

                        <ul id="list-selected-baskets">
                            <li class="template" style="list-style: none; border: 1px solid grey; padding: 10px">
                                <button type="button" class="delete">Supprimer</button>
                                <div class="image-product">
                                    <img src="../assets/panier.png" alt="panier">
                                </div>

                                <div class="infos">
                                    <div class="name"><p></p></div>
                                    <div class="weight"><p></p></div>
                                </div>

                                <div class="quantity-container">
                                    <button type="button" class="minus">-</button>
                                    <input class="quantity" type="text" value="0" name="quantity"/>
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
    const allProducts = {!! $products !!};

    const maxWeight = {!! $maxWeight !!}

    // IDs of the selected baskets.
    let selectedProducts = [];

    // Basket template.
    let templateCopy;

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

    function updateWeight() {
        const weight = totalWeight();

        console.log(weight);
    }

    /** Injects a basket in the list. */
    function injectBasket(product) {
        const template = templateCopy.cloneNode(true);

        const totalAvailable = product.quantity - product.reserved_quantity;

        // Feed the data.
        template.setAttribute('data-id', product.id);
        template.querySelector('.name p').innerHTML = product.name;
        template.querySelector('.weight p').innerHTML = product.weight + 'g';
        template.querySelector('.available').innerHTML =  totalAvailable + ' disponibles.';

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
        const updateAvailable = () => {
            const selected = findProductFromTemplate();
            const available = selected.quantity - selected.reserved_quantity;

            template.querySelector('.available').innerHTML =  available + ' disponibles.';
        };

        // Delete behaviour.
        template.querySelector('.delete').addEventListener('click', function () {
            const parent = this.parentNode;
            const id = Number.parseInt(parent.getAttribute('data-id'));

            selectedProducts = selectedProducts.filter(p => p.id !== id);
            parent.parentNode.removeChild(parent);

            feedChoices();
        });


        // Minus button.
        template.querySelector('.minus').addEventListener('click', () => {

            const selectedProduct = findProductFromTemplate();

            if (selectedProduct.selectedQuantity > 0) {
                selectedProduct.selectedQuantity --;
                selectedProduct.reserved_quantity --;
            }

            updateQuantity(selectedProduct.selectedQuantity);
            updateAvailable();
            updateWeight();
        });


        // Plus button.
        template.querySelector('.plus').addEventListener('click', () => {

            const selectedProduct = findProductFromTemplate();

            if (selectedProduct.quantity - selectedProduct.reserved_quantity > 0) {
                selectedProduct.selectedQuantity ++;
                selectedProduct.reserved_quantity ++;
            }

            updateQuantity(selectedProduct.selectedQuantity);
            updateAvailable();
            updateWeight();
        });

        document.getElementById('list-selected-baskets').appendChild(template);
    }

    window.addEventListener('load', () => {
        loadTemplate();
        feedChoices();

        // Event triggered when the user selects a product in his basket.
        document.getElementById('add-basket').addEventListener('click', () => {
            const selectedID = document.getElementById('basket-choices').value;

            if (selectedID !== undefined) {
                let selected = allProducts.find(p => p.id === Number.parseInt(selectedID));
                selected = JSON.parse(JSON.stringify(selected));
                selected.selectedQuantity = 0;

                selectedProducts.push(selected);

                feedChoices();
                injectBasket(selected);
            }
        });
    });
</script>
@endsection

