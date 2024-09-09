@extends('real_components/sidebar_admin')

@section('css')
    <link rel="stylesheet" href="/css/user.css">
    @vite('resources/css/app.css')
    <style>
        .popup-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
        }

        .popup-background.hidden {
            display: none;
        }
    </style>
@endsection


@section('title')
    portfolio
@endsection

@section('contentnav')
    ตลาดหุ้น
@endsection

@section('content')
    <div class="flex flex-col h-screen w-full" id="loaditem">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="pagecontent" class="content fadecontent h-full">
        <div class="container">
            <h2>Add Broker, Sector and Stock</h2>
    
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    
            <form method="POST" action="{{route('admin.store')}}" id="form">
                @csrf
            
                <div class="form-group">
                    <label for="broker_name">Broker Name:</label>
                    <input type="text" class="form-control" id="broker_name" name="broker_name" required>
                </div>
            
                <div class="form-group">
                    <label for="broker_mail">Broker Email:</label>
                    <input type="email" class="form-control" id="broker_mail" name="broker_mail" required>
                </div>
            
                <div class="form-group">
                    <label for="broker_contact">Broker Contact:</label>
                    <input type="text" class="form-control" id="broker_contact" name="broker_contact" required>
                </div>
            
                <div id="stock_selection" class="form-group">
                    <label>Select Stock:</label>
                    @foreach($stocks as $stock)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="selected_stocks[]" id="{{ $stock->stock_symbol }}" value="{{ $stock->stock_symbol }}">
                        <label class="form-check-label" for="{{ $stock->stock_symbol }}">
                            {{ $stock->stock_symbol }} - {{ $stock->stock_name }}
                        </label>
                    </div>
                @endforeach
                </div>
                
                <button id="add_stock_button" type="button" class="btn btn-primary">Add Stock</button>
                
                <div id="new_stocks" style="display:none;"></div>
                
                <script>
                    document.getElementById('add_stock_button').addEventListener('click', function () {
                        var newStockDiv = document.getElementById('new_stocks');
                        var newStockSet = document.createElement('div');
                        newStockSet.className = 'stock-set';
                        newStockSet.innerHTML = `
                            <div class="form-group">
                                <h4>New Stock Set</h4>
                                <label for="stock_symbol">Stock Symbol:</label>
                                <input type="text" class="form-control" name="stock_symbol[]">
                                
                                <label for="stock_name">Stock Name:</label>
                                <input type="text" class="form-control" name="stock_name[]">
                                
                                <label for="stock_current_price">Stock Current Price:</label>
                                <input type="number" step="0.01" class="form-control" name="stock_current_price[]">
                                
                                <label for="stock_sector_id">Stock Sector:</label>
                                <select class="form-control" name="stock_sector_id[]">
                                    @foreach($sectors as $sector)
                                        <option value="{{ $sector->sector_id }}">{{ $sector->sector_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-danger remove-stock" type="button">Remove Stock</button>
                        `;
                        newStockDiv.appendChild(newStockSet);
                        newStockDiv.style.display = 'block';
                    });
                
                    // ลบฟอร์ม stock
                    document.getElementById('new_stocks').addEventListener('click', function(event) {
                        if (event.target.classList.contains('remove-stock')) {
                            event.target.parentNode.remove();
                        }
                    });
                </script>
                <button type="submit">submit</button>
            </form>
    </div>
@endsection
