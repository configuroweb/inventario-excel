<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_name'], $_POST['product_code'], $_POST['quantity'], $_POST['price'])) {
        $productID = $_POST['tbl_product_id'];
        $productName = $_POST['product_name'];
        $productCode = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $date = date("Y-m-d H:i:s");

        try {

            $stmt = $conn->prepare("UPDATE tbl_product SET product_name = :product_name, product_code = :product_code, quantity = :quantity, price = :price, date = :date WHERE tbl_product_id = :tbl_product_id");

            $stmt->bindParam(":tbl_product_id", $productID, PDO::PARAM_STR);
            $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
            $stmt->bindParam(":product_code", $productCode, PDO::PARAM_STR);
            $stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            $stmt->bindParam(":date", $date, PDO::PARAM_STR);

            $stmt->execute();

            echo "
                <script>
                    alert('Producto actualizado correctamente');
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
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/inventario-excel/';
            </script>
        ";
    }
}
