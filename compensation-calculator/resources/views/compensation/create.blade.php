<x-layout>
    <div class="w-full max-w-sm">
        <form method="post" action="{{ url('compensation/create') }}"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            {{-- PRODUCT --}}
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product">
                    Products
                </label>
                <input
                    class="shadow appearance-none @error('product') border-red-500 @enderror border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="product" name="product" type="text" placeholder="Products" value={{ old('product') }}>
                @error('product')
                    <span class="text-red-700 text-sm block mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- DATES --}}
            <div class="flex gap-3">
                {{-- Start date --}}
                <div class="mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="start-date">
                        Start date
                    </label>
                    <input type="date" id="start_date" name="start_date" value={{ old('start_date') }} />
                    @error('start_date')
                        <span class="text-red-700 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- End date --}}
                <div class="mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="end-date">
                        End date
                    </label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" />
                    @error('end_date')
                        <span class="text-red-700 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- WHOLE MONTH CALCULATION --}}
            <div>
                <input type="checkbox" id="whole_month_calculation" name="whole_month_calculation" value="1" />
                <label for="whole_month_calculation">Whole month calculation</label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Calculate
                </button>
            </div>
        </form>
    </div>
</x-layout>
