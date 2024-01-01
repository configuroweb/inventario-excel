<?php
include("../conn/conn.php");

if (isset($_GET['product'])) {
    $productID = $_GET['product'];

    try {
        $stmt = $conn->prepare("DELETE FROM tbl_product WHERE tbl_product_id = :tbl_product_id");
        $stmt->bindParam('tbl_product_id', $productID, PDO::PARAM_STR);
        $stmt->execute();

        echo "
            <script>
                alert('Producto eliminado exitósamente!');
                window.location.href = 'http://localhost/inventario-excel/';
            </script>
        ";
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
