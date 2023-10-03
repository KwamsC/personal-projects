<x-layout>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product
                </th>
                <th scope="col" class="px-6 py-3">
                    Compensatie
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compensations as $compensation)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $compensation['product_name'] }}</td>
                    <td class="px-6 py-4">{{ $compensation['price'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (count($compensations) == 0)
        <p>no listings found</p>
    @endif
</x-layout>
