<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center mb-4">Cart Items</h1>
                    <table class="w-full border-collapse mb-4">
                        <thead>
                            <tr>
                                <th class="p-2 border-b text-left">Product Name</th>
                                <th class="p-2 border-b text-left">Quantity</th>
                                <th class="p-2 border-b text-left">Price</th>
                                <th class="p-2 border-b text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalPrice = 0; ?>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="p-2 border-b">{{ $item->product->name }}</td>
                                    <td class="p-2 border-b">{{ $item->quantity }}</td>
                                    <td class="p-2 border-b">USD{{ $item->product->price }}</td>
                                    <td class="p-2 border-b">USD{{ $item->quantity * $item->product->price }}</td>
                                    <?php $totalPrice += $item->quantity * $item->product->price; ?>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="total">
                                <td colspan="3" class="p-2 border-b text-right font-bold">Total:</td>
                                <td class="p-2 border-b font-bold">USD: {{ $totalPrice }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <form action="{{ route('paypal.payment') }}" method="POST">
                        @csrf
                        <button type="submit" class="checkout-btn bg-green-500 text-white p-2 rounded hover:bg-green-600 transition-colors duration-300 inline-block text-center">
                            Proceed to Checkout
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <x-flash-message />
</x-app-layout>