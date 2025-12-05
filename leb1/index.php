<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>โปรแกรมคำนวณเงินทอน</title>
    <style>
        body { font-family: 'Sarabun', sans-serif; margin: 20px; }
        .container { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }
        input[type="number"] { width: 100%; padding: 8px; margin: 5px 0 15px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;}
        button:hover { background-color: #218838; }
        .result { margin-top: 20px; padding: 15px; background-color: #e2e3e5; border-radius: 5px; }
        .alert { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">ระบบคำนวณเงินทอน</h2>
    
    <form method="post" action="">
        <label>ราคาสินค้า (บาท):</label>
        <input type="number" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : ''; ?>" required min="0">
        
        <label>จำนวนเงินที่ลูกค้าจ่าย (บาท):</label>
        <input type="number" name="money" value="<?php echo isset($_POST['money']) ? $_POST['money'] : ''; ?>" required min="0">
        
        <button type="submit" name="calculate">คำนวณเงินทอน</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $price = intval($_POST['price']); 
        $money = intval($_POST['money']); 

        $change = $money - $price; 

        echo "<div class='result'>";
        
        if ($change < 0) {
            echo "<p class='alert'>จำนวนเงินไม่พอจ่าย (ขาดอีก " . abs($change) . " บาท)</p>";

        } elseif ($change == 0) {
            echo "<b>จ่ายเงินพอดี ไม่ต้องทอน</b>";

        } else {
            echo "<b>สรุปรายการ:</b><br>";
            echo "ราคาสินค้า: " . number_format($price) . " บาท<br>";
            echo "รับเงินมา: " . number_format($money) . " บาท<br>";
            echo "<hr>";
            echo "<b>เงินทอนสุทธิ: " . number_format($change) . " บาท</b><br><br>";
            echo "<u>รายละเอียดเหรียญ:</u><br>";

    
            $coin10 = floor($change / 10);
            $remaining = $change % 10;

     
            $coin5 = floor($remaining / 5);
            $remaining = $remaining % 5;
       
            $coin1 = $remaining;
            
            echo "เหรียญ 10 บาท : " . $coin10 . " เหรียญ<br>";
            echo "เหรียญ 5 บาท : " . $coin5 . " เหรียญ<br>";
            echo "เหรียญ 1 บาท : " . $coin1 . " เหรียญ<br>";
        }
        echo "</div>";
    }
    ?>
</div>

</body>
</html>