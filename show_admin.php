<?php
  
  include("config.php");

  //Singleton
  $dbInstance = Database::getInstance();
  $conn = $dbInstance->getConnection();
  
  //-----------Admins------------
  
  if (isset($_POST['admin_name'])) {
      $Db_process_obj = new admins;
      $Db_process_obj->update($_POST);
  }
  
  if (isset($_POST['add_admin'])) {
      $Db_process_obj = new admins;
      $Db_process_obj->addNew($_POST);
  }
  
  if (isset($_POST['admin_delete'])) {
      $admin_id = $_POST['admin_delete'];
      $sql2 = "DELETE FROM admins WHERE admin_ID = :admin_id";
      $result = $conn->prepare($sql2);
      $result->execute(['admin_id' => $admin_id]);
      header("Location: dash-admins.php");
  }
  
  class admins {
      // Properties
      function showRow() {
          $dbInstance = Database::getInstance();
          $conn = $dbInstance->getConnection();
  
          $sql = "SELECT * FROM admins;";
          $start = $conn->query($sql);
          if ($start) {
              $row = $start->fetchAll(PDO::FETCH_ASSOC);  
              return $row;
          } else {
              echo "0 results";
          }
      }
  
      function update($admin) {
          $dbInstance = Database::getInstance();
          $conn = $dbInstance->getConnection();
  
          $id = $admin['edit'];
          $name = $admin['admin_name'];
          $email = $admin['email'];
          $password = $admin['password'];
          $sql = "UPDATE admins SET admin_name='$name', admin_email='$email', admin_password='$password' WHERE admin_id =$id";
          $start = $conn->query($sql);
          if ($start) {
              header("Location: dash-admins.php");
          } else {
              echo "0 results";
          }
      }
  
      function addNew($admin) {
          $dbInstance = Database::getInstance();
          $conn = $dbInstance->getConnection();
  
          $name = $_POST['name'];
          $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
          $password = $_POST['password'];
          $date = date("Y/m/d h:m:s");
  
          $sql = "INSERT INTO admins (admin_name, admin_email, admin_password, created_at) VALUES ('$name', '$email', '$password', '$date')";
          if ($conn->query($sql) == true) {
              header("Location: dash-admins.php");
          } else {
              echo "Error updating record: ";
          }
      }
  }
  
//-----------Orders------------


class orders {
  // Properties
  function showOrders(){
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();
    $sql = "SELECT customers.customer_phone,orders.* FROM `customers` LEFT JOIN orders ON orders.customer_ID = customers.customer_ID;";
    $start = $conn->query($sql);
    if ($start) {
        $row = $start->fetchAll(PDO::FETCH_ASSOC);  
        return  $row;
    }else {
        echo "0 results";
   }
  }

  function showOrderItems($order){
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();
    $id = $order;
    $sql ="SELECT products.product_name, products.product_price, products.product_image, order_products.quantity, customers.customer_name, customers.customer_phone, customers.customer_address1, orders.order_total_amount, orders.order_total_amount_after,orders.created_at,orders.order_status, coupons.coupon_amount FROM products JOIN order_products ON products.product_ID = order_products.product_ID JOIN orders ON orders.order_ID = order_products.order_ID JOIN customers ON customers.customer_ID = orders.customer_ID JOIN coupons ON coupons.coupon_ID=orders.coupon_ID WHERE order_products.order_ID = $id;";
    $start = $conn->query($sql);
    if ($start) {
        $row = $start->fetchAll(PDO::FETCH_ASSOC); 
        return $row;
    }else {
        echo "0 results";
   }
  }
}


//-----------Categories------------


class categories {
  // Properties
  function showRow(){
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();

    $sql = "SELECT * FROM categories;";
    $start = $conn->query($sql);
    if ($start) {
        $row = $start->fetchAll(PDO::FETCH_ASSOC);  
        return  $row;
    }else {
        echo "0 results";
   }
  }
}

//-----------Products------------

if(isset($_POST['product_edit'])){
  $Db_process_obj = new products;
  $Db_process_obj->updateProduct($_POST);
}

if(isset($_POST['add_new_product'])){
  $Db_process_obj = new products;
  $Db_process_obj->addNewProduct($_POST);
}

if(isset($_POST['delete_product'])){
  $product_id =$_POST['delete_product'];
  $sql2 = "DELETE FROM products WHERE product_ID = :product_id";
  $result = $conn->prepare($sql2);
  $result->execute(['product_id'=>$product_id]);
  header("Location: dash-products.php");
}


// class products {
//   public $uploadDir = 'images/products/';
//   public $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
//   // Properties
//   function showRow(){
//     $dbInstance = Database::getInstance();
//     $conn = $dbInstance->getConnection();

//     $sql = "SELECT * FROM products;";
//     $start = $conn->query($sql);
//     if ($start) {
//         $row = $start->fetchAll(PDO::FETCH_ASSOC);  
//         return  $row;
//     }else {
//         echo "0 results";
//    }
//   }

//   function updateProduct($admin) {
//     $dbInstance = Database::getInstance();
//     $conn = $dbInstance->getConnection();
    
//     if (isset($_FILES['image']) && in_array($_FILES['image']['type'], $this->allowedTypes)) {

//         $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
//         $targetFile = $this->uploadDir . $fileName;

//         if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
//           $product_image = 'images/products/'.$fileName;
//         } else {
//           echo "حدث خطأ أثناء تحميل الصورة.";
//       }
//       // echo 1;
//     } else {
//       // header("Location: dash-pr.php");
//       $product_image =  $admin['image'];
//       // var_dump($admin);
//     }
//     // echo $product_image;
//             $id = $admin['product_edit'];
//             $name = $admin['product_name'];
//             $category = $admin['category'];
//             $description = $admin['description'];
//             $product_price = $admin['price'];
//             $product_quantity = $admin['quantity'];

//             $sql = "UPDATE products SET product_name = '$name', category_ID = '$category', product_description = '$description', product_price = '$product_price', product_quantity = '$product_quantity', product_image = '$product_image' WHERE product_ID = $id";

//             $stmt = $conn->prepare($sql);

//             if ($stmt->execute()) {
//                 header("Location: dash-products.php");
//                 exit(); // Exit after header redirect to avoid further processing
//             } else {
//                 echo "Database update failed.";
//             }
        
//   }

//   function addNewProduct($admin){
//     if (isset($_FILES['image']) && in_array($_FILES['image']['type'], $this->allowedTypes)) {

//       $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
//       $targetFile = $this->uploadDir . $fileName;

//       if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
//         $product_image = 'images/products/'.$fileName;
//           $productName = $_POST['name'];
//           $productDesc = $_POST['description'];
//           $productPrice = $_POST['price'];
//           $productQty = $_POST['quantity'];
//           $categoryID = $_POST['category'];
//           // var_dump($targetFile);
          
  
//           // الاتصال بقاعدة البيانات
//           $pdo = new PDO('mysql:host=localhost;dbname=cake_project', 'root', '');
//           $sql = "INSERT INTO products (product_name, product_description, product_price, product_quantity, category_ID, product_image) 
//                   VALUES ('$productName', '$productDesc', '$productPrice', '$productQty', '$categoryID', '$product_image')";
//           $stmt = $pdo->prepare($sql);
//           $pdo->query($sql);
//           // $stmt->execute([$productName, $productDesc, $productPrice, $productQty, $categoryID, $targetFile]);
  
//           header("Location: dash-products.php");
//         } else {
//           echo "حدث خطأ أثناء تحميل الصورة.";
//       }
//   } else {
//       echo "نوع الملف غير مدعوم.";
//   }
//   }
// }



//-----------Total Sales------------

class sales{

  function totalSales(){
      $dbInstance = Database::getInstance();
      $conn = $dbInstance->getConnection();
      $sql = "SELECT SUM(order_total_amount_after) AS total FROM orders WHERE order_total_amount_after <= DATE_SUB(CURDATE(), INTERVAL 30 DAY);";
      $start = $conn->query($sql);
      if ($start) {
          $row = $start->fetchAll(PDO::FETCH_ASSOC);  
          return  $row;
      }else {
          echo "0 results";
     }
  }

}

//-----------Coupons------------

if(isset($_POST['coupon_amount_new'])){
  $Db_process_obj = new addCoupons;
  $Db_process_obj->addCoupons($_POST);
}

if(isset($_POST['coupon_edit'])){
  $Db_process_obj = new coupons;
  $Db_process_obj->updateCoupons($_POST);
}

if(isset($_POST['delete_coupon'])){
  $coupon_id =$_POST['delete_coupon'];
  $sql2 = "DELETE FROM coupons WHERE coupon_ID = :product_id";
  $result = $conn->prepare($sql2);
  $result->execute(['product_id'=>$coupon_id]);
  header("Location: dash-coupons.php");
}

class coupons {
  // Properties
  function showCoupons(){
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();
    $sql = "SELECT * FROM Coupons;";
    $start = $conn->query($sql);
    if ($start) {
        $row = $start->fetchAll(PDO::FETCH_ASSOC);  
        return  $row;
    }else {
        echo "0 results";
   }
  }

  function updateCoupons($admin){
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();
    $id = $admin['coupon_edit'];
    $name = $admin['coupon_amount'];
    $coupon_expire = $admin['coupon_expire'];
    $sql = "UPDATE coupons SET coupon_amount='$name', coupon_expire='$coupon_expire' WHERE coupon_ID =$id";
    $stmt = $conn->prepare($sql);
      if ($stmt->execute()) {
        header("Location: dash-coupons.php");
        exit(); // Exit after header redirect to avoid further processing
      } else {
                echo "Database update failed.";
      }
  }
}



class addCoupons {
  // Properties
  
  function addCoupons($admin){
    $dbInstance = Database::getInstance();
    $conn = $dbInstance->getConnection();
    $name = $admin['coupon_amount_new'];
    $email = $admin['coupon_expire'];
    $date = date("Y/m/d h:m:s");
    $sql = "INSERT INTO coupons ( coupon_amount , coupon_expire , created_at) VALUES ('$name' , '$email','$date');";
  
    $start = $conn->query($sql);
    if ($start) {
        $row = $start->fetchAll(PDO::FETCH_ASSOC);  
        header("Location: dash-coupons.php");
    }else {
        echo "0 results";
   }
  }
}
?>
