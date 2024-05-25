@extends('real_components/sidebar_admin')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
    <!-- Include Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <!-- Include Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection


@section('title')
    Add Broker
@endsection

@section('contentnav')
    จัดการตลาดหลักทรัพย์
@endsection

@section('content')

    <div class="bg-neutral-700 mx-5 mt-5 rounded-t-xl h-full min-h-dvh">
        <div class="pt-3 ml-4 ">
            <a href="/admin/managebroker"><img src="{{ url('images/backArrow.svg') }}" class="size-6"></a>
        </div>
        <div class="grid grid-row-2 mx-5 ">
            <div class="ml-3">
                <div class=" text-3xl text-white">
                    เพิ่มตลาดหลักทรัพย์
                </div>
                <div class="text-base mt-2 text-thin text-gray-200 opacity-75">
                    กรุณากรอกข้อมูลของตลาดหลักทรัพย์ที่ต้องการเพิ่มเข้าระบบ
                </div>
            </div>
            <div class="bg-zinc-800 mt-3 rounded-t-xl flex flex-col px-48 py-16  min-h-dvh">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.addbroker') }}" id="form">
                    @csrf
                    <div class="form-group mt-4">
                        <label for="broker_name" class="block mb-2 text-sm font-medium text-white">Broker Name:</label>
                        <input type="text"
                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="broker_name" name="broker_name" required>
                    </div>

                    <div class="flex gap-2 w-full">
                        <div class="form-group mt-4 flex-1">
                            <label for="broker_mail" class="block mb-2 text-sm font-medium text-white">Broker Email:</label>
                            <input type="email"
                                class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="broker_mail" name="broker_mail" required>
                        </div>

                        <div class="form-group mt-4 flex-none w-48">
                            <label for="broker_contact" class="block mb-2 text-sm font-medium text-white">Broker
                                Contact:</label>
                            <input type="text"
                                class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="broker_contact" name="broker_contact" required>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full">
                        <div id="stock_selection" class="form-group mt-4 flex-1">
                            <label class="block mb-2 text-sm font-medium text-white">Select Stock:</label>
                            <select
                                class="form-multiselect block rounded-lg bg-gray-50 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="stock-select" name="selected_stocks[]" multiple>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->stock_symbol }}">{{ $stock->stock_symbol }} -
                                        {{ $stock->stock_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-none w-16  place-self-end">
                            <button id="add_stock_button" type="button" class="btn  btn-neutral"><img
                                    src="{{ url('/images/PlusCircle.svg') }}" width="100%"></button>
                        </div>
                    </div>


                    <div id="new_stocks" style="display:none;"
                        class="mt-4 py-4 border-dashed border-2 rounded-lg px-4  border-zinc-400">
                        <div class="block mb-8 text-sm font-medium text-green-400 text-center">New Stock Set</div>
                    </div>

                    <div class="mt-16 flex justify-center">
                        <button class="btn bg-green-400 hover:bg-green-600 w-full border-0 rounde-lg text-white"
                            type="submit">submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add stock form
            document.getElementById('add_stock_button').addEventListener('click', function() {
                var newStockDiv = document.getElementById('new_stocks');
                var newStockSet = document.createElement('div');
                newStockSet.className = 'stock-set';
                newStockSet.innerHTML = `
                <div class="form-group mt-4">
                    <div class="flex gap-2 w-full mt-4">
                        <div class="w-full">
                            <label for="stock_symbol" class="block mb-2 text-sm font-medium text-white">Stock Symbol:</label>
                            <input type="text" class="form-control" name="stock_symbol[]">
                        </div>
                        <div class="w-full">
                            <label for="stock_name" class="block mb-2 text-sm font-medium text-white">Stock Name:</label>
                            <input type="text" class="form-control" name="stock_name[]">
                        </div>
                    </div>
                    <div class="flex gap-2 w-full mt-4">
                        <div class="flex-none w-32">
                            <label for="stock_current_price" class="block mb-2 text-sm font-medium text-white">Current Price:</label>
                            <input type="number" step="0.01" class="form-control h-12" name="stock_current_price[]">
                        </div>
                        <div class="pl-8 flex-1 w-full">
                            <label for="stock_sector" class="block ml-2 mb-2 text-sm font-medium text-white">Stock Sector:</label>
                            <div class="mt-1 flex justœfy-item-center gap-2.5">
                                <input type="checkbox" class="checkbox checkbox-success" id="existing_sector" name="sector_choice[]" value="existing" checked>
                                <label for="existing_sector" class="text-white">Existing Sector</label>
                            </div>
                            <div class="mt-1 flex justify-item-center gap-2.5">
                                <input type="checkbox" class="checkbox checkbox-success" id="new_sector" name="sector_choice[]" value="new">
                                <label for="new_sector" class="text-white">New Sector</label>
                            </div>
                        </div>
                        <div class="flex-1 w-40">
                            <div id="stock_sector_form">
                                <label for="sector_name" class="block mb-2 text-sm font-medium text-white">Select Sector:</label>
                                <select class="select select-bordered w-full max-w-base" name="stock_sector_id[]" id="stock_sector_id">
                                    @foreach ($sectors as $sector)
                                        <option value="{{ $sector->sector_id }}">{{ $sector->sector_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="new_sector_form" style="display: none;">
                                <div class="form-group">
                                    <label for="new_sector_name" class="block mb-2 text-sm font-medium text-white">New Sector Name:</label>
                                    <input type="text" class="h-12 form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="new_sector_name" name="new_sector_name[]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                    <button class="mt-4 btn btn-error remove-stock w-14" type="button"><img src="{{ url('/images/Trash.svg') }}" alt="" width="100%"></button>
                `;
                newStockDiv.appendChild(newStockSet);
                newStockDiv.style.display = 'block';

                // Attach event listeners for the radio buttons
                // attachRadioListeners(newStockSet);
                // Get all checkboxes with name "sector_choice[]"
                attachCheckboxListeners(newStockSet);
            });



            document.getElementById('new_stocks').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-stock')) {
                    event.target.parentNode.remove();
                    // Check if there are any child elements left inside new_stocks
                    var childElements = this.querySelectorAll('.stock-set');
                    if (childElements.length === 0) {
                        // If no child elements left, hide the new_stocks element
                        this.style.display = 'none';
                    }
                }


            });

            const stockSelect = document.getElementById('stock-select');
            const choices = new Choices(stockSelect, {
                removeItemButton: true,
                searchEnabled: true,
                placeholder: true,
                placeholderValue: 'Select one or more stocks',
            });

            function attachRadioListeners(stockSet) {
                var existingSectorRadio = stockSet.querySelector('#existing_sector');
                var newSectorRadio = stockSet.querySelector('#new_sector');
                var newSectorForm = stockSet.querySelector('#new_sector_form');
                var stockSectorSelect = stockSet.querySelector('#stock_sector_form');

                existingSectorRadio.addEventListener('change', function() {
                    if (existingSectorRadio.checked) {
                        newSectorForm.style.display = 'none';
                        stockSectorSelect.style.display = 'block';
                    }
                });

                newSectorRadio.addEventListener('change', function() {
                    if (newSectorRadio.checked) {
                        newSectorForm.style.display = 'block';
                        stockSectorSelect.style.display = 'none';
                    }
                });
            }


        });

        function handleCheckboxChange(checkbox) {
            var checkboxes = checkbox.closest('.stock-set').querySelectorAll('input[name="sector_choice[]"]');
            checkboxes.forEach(function(cb) {
                if (cb !== checkbox && cb.value !== 'existing') {
                    cb.checked = false;
                } // If other checkbox is checked, uncheck "New Sector" checkbox
                else if (cb !== 'new' && cb !== checkbox) {
                    cb.checked = false;
                }

            });

            // Check if "New Sector" checkbox is checked
            if (checkbox.value === 'new' && checkbox.checked) {
                // Your logic for handling "New Sector" checkbox checked state
                var newSectorForm = checkbox.closest('.stock-set').querySelector('#new_sector_form');
                var existingSectorForm = checkbox.closest('.stock-set').querySelector('#stock_sector_form');
                if (newSectorForm && existingSectorForm) {
                    newSectorForm.style.display = 'block';
                    existingSectorForm.style.display = 'none';
                }
            } else if (checkbox.value === 'existing' && checkbox.checked) {
                // Your logic for handling "Existing Sector" checkbox checked state
                var newSectorForm = checkbox.closest('.stock-set').querySelector('#new_sector_form');
                var existingSectorForm = checkbox.closest('.stock-set').querySelector('#stock_sector_form');
                if (newSectorForm && existingSectorForm) {
                    newSectorForm.style.display = 'none';
                    existingSectorForm.style.display = 'block';
                }
            }
        }

        function attachCheckboxListeners(stockSet) {
            var checkboxes = stockSet.querySelectorAll('input[name="sector_choice[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {

                    handleCheckboxChange(checkbox);
                });
            });
        }
    </script>
@endsection
