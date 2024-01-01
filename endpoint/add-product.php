<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_name'], $_POST['product_code'], $_POST['quantity'], $_POST['price'])) {
        $productName = $_POST['product_name'];
        $productCode = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $date = date("Y-m-d H:i:s");

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_product (product_name, product_code, quantity, price,  date) VALUES (:product_name, :product_code, :quantity, :price,  :date)");

            $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
            $stmt->bindParam(":product_code", $productCode, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":date", $date, PDO::PARAM_STR);

            $stmt->execute();

            echo "
                <script>
                    alert('Producto Agregado Exitósamente!');
                    window.location.href = 'http://localhost/inventario-excel/';
                </script>
            ";

            exit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
    } else {
        echo "
            <script>
                alert('¡Por favor rellena todos los campos!');
                window.location.href = 'http://localhost/inventario-excel/';
            </script>
        ";
    }
}
