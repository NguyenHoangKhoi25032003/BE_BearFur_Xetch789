<?php
try {
    // Kết nối database bằng PDO
    $pdo = new PDO("mysql:host=localhost;dbname=kholanh1", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cập nhật sản phẩm ID 1, 2, 3, 4 thành khuyến mãi
    $sql = "UPDATE shops SET
            is_promo = 1,
            product_sales_price = 1000000,
            product_discount_percent = 20
            WHERE id IN (1, 2, 3, 4)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "Đã cập nhật " . $stmt->rowCount() . " sản phẩm thành khuyến mãi thành công!";

} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
