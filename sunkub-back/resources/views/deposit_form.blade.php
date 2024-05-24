<!DOCTYPE html>
<html>
<head>
    <title>Deposit Page</title>
    <!-- Include CSS and JS here -->
    <script>
        function toggleNewPaymentMethod() {
            var newPaymentMethodDiv = document.getElementById('new_payment_method_div');
            var selectPaymentMethod = document.getElementById('payment_method');
            if (selectPaymentMethod.value === 'new') {
                newPaymentMethodDiv.style.display = 'block';
            } else {
                newPaymentMethodDiv.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <form action="{{ route('process.deposit') }}" method="POST">
        @csrf

        <!-- Port Selection with Amount Input -->
        @foreach($ports as $port)
            <div>
                <label for="port_{{ $port->port_id }}">{{ $port->port_id }} - {{ $port->user_broker }} (Balance: {{ $port->balance }})</label>
                <input type="number" name="port_amounts[{{ $port->port_id }}]" id="port_{{ $port->port_id }}" placeholder="Amount to Deposit">
                <input type="hidden" name="port_ids[]" value="{{ $port->port_id }}">
            </div>
        @endforeach

        <!-- Payment Method Selection -->
        <div>
            <label for="payment_method">Select Payment Method:</label>
            <select name="paymentmethod_id" id="payment_method" onchange="toggleNewPaymentMethod()">
                @foreach($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->paymentmethod_id }}">{{ $paymentMethod->paymentmethod_name }}</option>
                @endforeach
                <option value="new">Add New Payment Method</option>
            </select>
        </div>

        <!-- New Payment Method Inputs -->
        <div id="new_payment_method_div" style="display: none;">
            <label for="new_payment_method_name">New Payment Method Name:</label>
            <input type="text" name="new_payment_method_name" id="new_payment_method_name">
        </div>

        <button type="submit">Deposit</button>
    </form>
</body>
</html>