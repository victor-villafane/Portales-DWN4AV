<?php

?>

<x-layout>
    <x-slot:title>Confirmar compra</x-slot:title>

    <h1 class="mb-3" >Comprar</h1>

    <p>Por favor, verifica que la informacion sea correcta </p>

    <table class="table table-bordered table-striped" >
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $cartItems as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->price }}</td>
                    <td>1</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" ><b>Total</b></td>
                <td>${{ $cartItems->sum("price") }}</td>
            </tr>
        </tbody>
    </table>
    <div id=checkout >

    </div>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("APP_USR-46ff2638-745c-4217-8dcc-2c8fc602d21e");
        mp.bricks().create(
            "wallet",
            "checkout", //donde se va a mostrar el boton
            {
                initialization: {
                    preferenceId: '{{ $preference->id }}'
                }
            }
        );
    </script>
</x-layout>
