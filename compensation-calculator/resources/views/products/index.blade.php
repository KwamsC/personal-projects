<x-layout>
    <div>
        <a href="/compensation">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-4">Calculate
                compensation</button>
        </a>

        @include('partials._search')
    </div>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product
                </th>
                <th scope="col" class="px-6 py-3">
                    Group
                </th>
                <th scope="col" class="px-6 py-3">
                    Prijs
                </th>
                <th scope="col" class="px-6 py-3">
                    BTW
                </th>
                <th scope="col" class="px-6 py-3">
                    Ingangsdatum
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="/product/{{ $product['id'] }}">{{ $product['product'] }}</a>
                    </th>

                    <td class="px-6 py-4"><a href="/?group={{ $product['group'] }}">{{ $product['group'] }}</a></td>
                    <td class="px-6 py-4">{{ $product['price'] }}</td>
                    <td class="px-6 py-4">{{ $product['btw'] }}</td>
                    <td class="px-6 py-4">{{ $product['startDate'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (count($products) == 0)
        <p>no listings found</p>
    @endif
</x-layout>
