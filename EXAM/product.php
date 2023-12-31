<?php
require 'database.php';


if(isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    
    $get_image_query = "SELECT image FROM product WHERE id='$product_id'";
    $get_image_result = mysqli_query($con, $get_image_query);

    if ($get_image_result && mysqli_num_rows($get_image_result) > 0) {
        $row = mysqli_fetch_assoc($get_image_result);
        $image_path = $row['image'];

        // Path kung saan nakatago ang larawan sa server
        $upload_directory = 'uploads/';
        $full_image_path = $upload_directory . $image_path;
        // Siguraduhing mayroon talagang larawan na dapat burahin
        if (file_exists($full_image_path)) {
            // Para mabura laman sa server
            unlink($full_image_path);
        }
    }

    // Pagkatapos ng pagtanggal ng larawan sa uploads folder, magproceed sa pag-delete ng entry sa database
    $query = "DELETE FROM product WHERE id='$product_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $res = [
            'status' => 200,
            'message' => "Product Deleted Successfully!"
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => "Something Went Wrong"
        ];
        echo json_encode($res);
        return false;
    }
}


if(isset($_POST['update_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $productname = mysqli_real_escape_string($con, $_POST['productname']);
    $unit = mysqli_real_escape_string($con, $_POST['unit']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $expiry = mysqli_real_escape_string($con, $_POST['expiry']);
    $availinc = mysqli_real_escape_string($con, $_POST['availinv']);
    
    $check_query = "SELECT * FROM product WHERE productname='$productname' AND id != '$product_id'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // If the product name already exists for a different product, return an error response
        $res = [
            'status' => 409,
            'message' => "Product name already exists for another product!"
        ];
        echo json_encode($res);
        return false;
    }


    // Check if image file is selected
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $query = "SELECT image FROM product WHERE id='$product_id'";
        $result = mysqli_query($con, $query);

        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $old_image = $row['image'];

            if($old_image !== '') {
                $old_image_path = "uploads/" . $old_image;
                if(file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete the old image
                }
            }
        }

        // Get new image details
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Move the new image to the folder
        move_uploaded_file($image_tmp, "uploads/" . $image);
    } else {
        $image = ''; // Set default image if no new image is uploaded
    }

    if($productname == NULL || $unit == NULL || $price == NULL || $expiry == NULL || $availinc == NULL) {
        $res = [
            'status' => 422,
            'message' => "Please input all fields!"
        ];
        echo json_encode($res);
        return false;
    }
    $invcost = $price * $availinc;

    $query = "UPDATE product SET productname='$productname', unit='$unit', price='$price', expiry='$expiry', availinv='$availinc', invcost='$invcost', image='$image' WHERE id='$product_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $res = [
            'status' => 200,
            'message' => "Product Updated Successfully!"
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => "Something Went Wrong"
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_GET['product_id']))
{
    $product_id = mysqli_real_escape_string($con, $_GET['product_id']);

    $query = "SELECT id, productname, unit, price, expiry, availinv, image
          FROM product
          WHERE id='$product_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run && mysqli_num_rows($query_run) == 1) {
        $product = mysqli_fetch_assoc($query_run);
        $res = [
            'status' => 200,
            'message' => "Product Found Successfully",
            'data' => $product
        ];
        echo json_encode($res);
        return false;
    }

    else {
        $res = [
            'status' => 404,
            'message' => "Product not Found"
        ];
        echo json_encode($res);
        return false;
    }
}


if(isset($_POST['save_product']))
{
    $productname = mysqli_real_escape_string($con, $_POST['productname']);
    $unit = mysqli_real_escape_string($con, $_POST['unit']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $expiry = mysqli_real_escape_string($con, $_POST['expiry']);
    $availinc = mysqli_real_escape_string($con, $_POST['availinv']);
    //$invcost = mysqli_real_escape_string($con, $_POST['invcost']);
    //$image = mysqli_real_escape_string($con, $_POST['image']);

    $check_query = "SELECT * FROM product WHERE productname='$productname'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // If the product name already exists, return an error response
        $res = [
            'status' => 409,
            'message' => "Product name already exists!"
        ];
        echo json_encode($res);
        return false;
    }
    // Check if image file is selected
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name']; // Get image name
        $image_tmp = $_FILES['image']['tmp_name']; // Get image temporary path

        // Move image to folder
        move_uploaded_file($image_tmp, "uploads/" . $image);
    } else {
        $image = ''; // Set default image if no image is uploaded
    }

    if($productname == NULL || $unit == NULL || $price == NULL || $expiry == NULL || $availinc == NULL){
        $res = [
            'status' => 422,
            'message' => "Please input all fields!"
        ];
        echo json_encode($res);
        return false;
    }
    $invcost = $price * $availinc;

    $query = "INSERT INTO product (productname, unit, price, expiry, availinv, invcost, image) VALUES ('$productname', '$unit', '$price', '$expiry', '$availinc', '$invcost', '$image')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $res = [
            'status' => 200,
            'message' => "Product Added Successfully!"
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => "Something Went Wrong"
        ];
        echo json_encode($res);
        return false;
    }
}

?>
