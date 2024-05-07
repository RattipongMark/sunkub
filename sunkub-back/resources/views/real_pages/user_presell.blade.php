<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Stock</title>
</head>
<body>
    <h1>ซื้อหุ้น</h1>
    <form action="{{ route('sell', ['stock_symbol' => $stock->stock_symbol]) }}" method="POST">
        @csrf
        <input type="hidden" name="stock_symbol" value="{{ $stock->stock_symbol }}">
        
        
        <label for="volume">จำนวนหุ้นที่ต้องการขาย:</label>
        <input type="text" id="volume" name="volume" required><br><br>
        
        <button type="submit">ขาย</button>
    </form>
</body>
</html>
