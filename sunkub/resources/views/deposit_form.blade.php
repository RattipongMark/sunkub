<!DOCTYPE html>
<html>
<head>
    <title>Deposit Page</title>
    <!-- Include your CSS and JS here -->
    <style>
        .hidden {
            display: none;
        }
        .card-input {
            margin-top: 20px;
        }
    </style>
    <script>
        function togglePaymentMethod() {
            var selectedMethod = document.getElementById('payment_method').value;
            var newMethodDiv = document.getElementById('new_payment_method_div');
            var cardNumberInput = document.getElementById('card_number_hidden');

            if (selectedMethod === 'new') {
                newMethodDiv.classList.remove('hidden');
                cardNumberInput.value = 'new';
            } else {
                newMethodDiv.classList.add('hidden');
                cardNumberInput.value = selectedMethod;
            }
        }
    </script>
</head>
<body>
    <form action="{{ route('process.deposit') }}" method="POST">
        @csrf

        <!-- Payment Method Selection -->
        <div>
            <label for="payment_method">Select Payment Method:</label>
            <select name="card_number" id="payment_method" onchange="togglePaymentMethod()">
                <option value="">Select...</option>
                @foreach($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->card_number }}">{{ $paymentMethod->card_number }}</option>
                @endforeach
                <option value="new">Add New Payment Method</option>
            </select>
        </div>

        <!-- Hidden Input for Card Number -->
        <input type="hidden" name="card_number" id="card_number_hidden">

        <!-- New Payment Method Inputs -->
        <div id="new_payment_method_div" class="hidden card-input">
            <label for="card_number_new">Card Number:</label>
            <input type="text" name="card_number_new" id="card_number_new" placeholder="xxxx xxxx xxxx xxxx">

            <label for="first_name">Card Holder First Name:</label>
            <input type="text" name="first_name" id="first_name" placeholder="First Name">

            <label for="last_name">Card Holder Last Name:</label>
            <input type="text" name="last_name" id="last_name" placeholder="Last Name">

            <label for="expiry_month">Expiry Month:</label>
            <input type="number" name="expiry_month" id="expiry_month" placeholder="MM" min="1" max="12">

            <label for="expiry_year">Expiry Year:</label>
            <input type="number" name="expiry_year" id="expiry_year" placeholder="YYYY" min="{{ date('Y') }}" max="{{ date('Y') + 10 }}">

            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" id="cvv" placeholder="CVV">
        </div>

        <!-- Port Selection with Amount Input -->
        <div>
            <label>Select Your Portfolio:</label>
            @foreach($ports as $port)
                <div>
                    <label for="port_{{ $port->port_id }}">{{ $port->port_id }} - {{ $port->user_broker }} (Balance: {{ $port->balance }})</label>
                    <input type="number" name="port_amounts[{{ $port->port_id }}]" id="port_{{ $port->port_id }}" placeholder="Amount to Deposit">
                    <input type="hidden" name="port_ids[]" value="{{ $port->port_id }}">
                </div>
            @endforeach
        </div>

        <button type="submit">Deposit</button>
    </form>
</body>
</html>