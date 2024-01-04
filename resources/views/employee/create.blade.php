<x-app-layout>
    <x-slot name="header" class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Employee') }}
        </h2>
        <div>
            <a href="{{ route('employee.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-gray-700 hover:text-white  focus:bg-gray-700  active:bg-gray-900  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150">{{ __('Back to List') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Create Employee') }}
                        </h2>
                    </header>
                    {{-- action="{{ route('employee.store') }}" --}}
                    <form action="javascript:void(0)" id="saveForm" method="POST" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        @include('employee.partials.form')
                        <div class="flex items-center gap-4">
                            <x-primary-button onclick="submitData()">{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function submitData() {
            $('#error_first_name').text('');
            $('#error_last_name').text('');
            $('#error_companies_id').text('');
            $('#error_email').text('');
            $('#error_phone_no').text('');
            $('#error_profile_image').text('');
            var options = {
                url: "{{ route('employee.store') }}",
                method: 'POST',
                dataType: 'JSON',
                success: function(result) {
                    Swal.fire({
                        title: "Success!",
                        text: result.message,
                        icon: "success"
                    });
                    $('#saveForm').trigger("reset");
                },
                error: function(result) {
                    var errors = result.responseJSON.errors;
                    if (typeof(result.status) != "undefined" && result.status !== null && result.status ===
                        422) {
                        $('#error_first_name').text(errors.first_name[0]);
                        $('#error_last_name').text(errors.last_name[0]);
                        $('#error_companies_id').text(errors.companies_id[0]);
                        $('#error_email').text(errors.email[0]);
                        $('#error_phone_no').text(errors.phone_no[0]);
                        if (typeof(errors.profile_image) != "undefined" && errors.profile_image !== null) {
                            $('#error_profile_image').text(errors.profile_image[0]);
                        }
                    }
                }
            };
            $('#saveForm').ajaxForm(options);
        }
    </script>
</x-app-layout>
