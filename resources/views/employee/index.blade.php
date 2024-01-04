<x-app-layout>
    <x-slot name="header" class="flex justify-between">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Employee') }}
            </h2>
        </div>
        <div>
            <a href="{{ route('employee.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-gray-700 hover:text-white  focus:bg-gray-700  active:bg-gray-900  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150">{{ __('Create Employee') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 shadow-md sm:rounded-lg">
                    <div id="table_data" class="relative overflow-x-auto ">
                        @include('employee.partials.data-load')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            getCurrentPageData();
        });
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                event.preventDefault();

                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];

                getData(page);
            });
        });

        function deleteRecord(button) {
            event.preventDefault();
            console.log();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "employee/" + button.id,
                        data: $('#deleteForm').serialize(),
                        method: 'DELETE',
                        dataType: 'JSON',
                        success: function(result) {
                            Swal.fire({
                                title: "Deleted!",
                                text: result.message,
                                icon: "success"
                            });
                            getCurrentPageData();
                        }
                    });
                }
            });
        }

        function getCurrentPageData() {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                getData(1);
            } else {
                getData(page);
            }
        }

        function getData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    datatype: "html",
                })
                .done(function(data) {
                    $("#table_data").empty().html(data);
                    location.hash = page;
                });
        }
    </script>
</x-app-layout>
