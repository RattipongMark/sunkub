<!DOCTYPE html>
<html>
<head>
    <title>Deposit Page</title>
    <!-- Include CSS and JS here -->
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
            <select name="paymentmethod_id" id="payment_method">
                @foreach($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->paymentmethod_id }}">{{ $paymentMethod->paymentmethod_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Deposit</button>
    </form>
</body>
</html>