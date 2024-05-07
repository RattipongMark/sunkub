<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Result</title>
</head>
<body>
    @if ($success)
        <h1>ขายหุ้น {{ $stock_symbol }} เรียบร้อยแล้ว</h1>
        <p>จำนวน {{ $volume }} หุ้น</p>
    @else
        <h1>การขายหุ้น {{ $stock_symbol }} ไม่สำเร็จ</h1>
        <p>จำนวน {{ $volume }} หุ้น</p>
        @if ($insufficient_funds)
            <p>จำนวนหุ้นไม่เพียงพอสำหรับการขายหุ้น</p>
        @endif
        @if ($stock_not_found)
            <p>ไม่พบข้อมูลราคาหุ้นสำหรับสัญลักษณ์ที่กำหนด</p>
        @endif
    @endif
</body>
</html>
