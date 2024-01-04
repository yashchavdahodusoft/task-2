<table id="dataTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-center">
        <tr>
            <th scope="col" class="px-6 py-3">
                Full Name
            </th>
            <th scope="col" class="px-6 py-3">
                Company Name
            </th>
            <th scope="col" class="px-6 py-3">
                Email
            </th>
            <th scope="col" class="px-6 py-3">
                Phone
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
    </thead>
    <tbody id="table_data">
        @foreach ($data as $value)
            <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $value->first_name . ' ' . $value->last_name }}
                </th>
                <td class="px-6 py-4">
                    {{ $value->companies->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $value->email }}
                </td>
                <td class="px-6 py-4">
                    {{ $value->phone_no }}
                </td>
                <td class="px-6 py-4 text-right flex items-center">
                    <a href="{{ route('employee.edit', $value) }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    {{-- <x-danger-button onclick="deleteRecord({{$value}})" class="ms-3">
                                                {{ __('Delete') }}
                                            </x-danger-button> --}}
                    <form id="deleteForm" action="{{ route('employee.destroy', $value) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button onclick="deleteRecord(this)" id="{{ $value->id }}" class="ms-3">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4 pagination">
    {{ $data->links() }}
</div>
