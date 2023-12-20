<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Marlou Vinta</title>
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Junior Web Developer Exam</h4>
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        Add Product
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Expiry Date</th>
                                    <th>Available Inventory</th>
                                    <th>Inventory Cost</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        require 'database.php';

                        $query = "SELECT * FROM product";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $product) {
                                ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><?= $product['productname'] ?></td>
                                    <td><?= $product['unit'] ?></td>
                                    <td><?= $product['price'] ?></td>
                                    <td><?= $product['expiry'] ?></td>
                                    <td><?= $product['availinv'] ?></td>
                                    <td><?= $product['invcost'] ?></td>
                                    <td><img src="uploads/<?= $product['image'] ?>" alt="Product Image" width="50"></td>

                                    <td>
                                        <button type="button" value="<?= $product['id'] ?>" class="editProductBtn btn btn-success">EDIT</button>
                                        <button type="button" value="<?= $product['id'] ?>" class="deleteProductBtn btn btn-danger">DELETE</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <tr>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateProduct" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="productname" id="productname" class="form-control">
                    </div>
                     <div class="mb-3">
            <label for="">Unit</label>
            <input type="text" name="unit" id="unit" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Price</label>
            <input type="text" name="price" id="price" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Expiry Date</label>
            <input type="date" name="expiry" id="expiry" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Available Inventory</label>
            <input type="text" name="availinv" id="availinv" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Image</label>
            
            <input type="file" name="image" id="image" class="form-control">
        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveProduct" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="productname" class="form-control">
                    </div>
                   <div class="mb-3">
            <label for="">Unit</label>
            <input type="text" name="unit" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Price</label>
            <input type="text" name="price" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Expiry Date</label>
            <input type="date" name="expiry" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Available Inventory</label>
            <input type="text" name="availinv" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on("submit", "#saveProduct", function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_product", true);

            $.ajax({
                type: "POST",
                url: "product.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response){

                    var res = jQuery.parseJSON(response);
                    if(res.status == 422){
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    }else if(res.status == 200){
                        
                        $('#errorMessage').addClass('d-none');
                        $('#addProductModal').modal('hide');
                        $('#saveProduct')[0].reset();

                      
                        $('#myTable').load(location.href + " #myTable");
                    }
                }
            });
        });

   $(document).on('click', '.editProductBtn', function (){
    var product_id = $(this).val();

    $.ajax({
      type: "GET",
      url: "product.php?product_id=" + product_id,
      success: function(response){
        alert("Success! Response: " + response);
    console.log(response);
        var res = jQuery.parseJSON(response);

        if(res.status == 422) {
          alert(res.message);
        } else if(res.status == 200){
          
          $('#product_id').val(res.data.id);
          $('#productname').val(res.data.productname);
          $('#unit').val(res.data.unit);
          $('#price').val(res.data.price);
          $('#expiry').val(res.data.expiry);
          $('#availinv').val(res.data.availinv);
          
          // Set the product image source
          //$('#product_image').attr('src', 'uploads/' + res.data.image);
          $('#editProductModal').modal('show');
        }
      }
    });
  });

  $(document).on('click', '.deleteProductBtn', function(e){
      e.preventDefault();

      if(confirm("Are you sure you want to delete this product?")){
        var product_id = $(this).val();

        console.log('Product ID to be deleted:', product_id);
        $.ajax({
          type: "POST",
          url: "product.php",
          data: {
            'delete_product': true,
            'product_id': product_id
          },
          success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 500) {
              alert (res.message);
            }else{
              alert (res.message);

              $('#myTable').load(location.href + " #myTable");
            }
          }
        });
      }
  });

  $(document).on("submit", "#updateProduct", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_product", true);

    $.ajax({
        type: "POST",
        url: "product.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);
            } else if (res.status == 200) {
                $('#errorMessageUpdate').addClass('d-none');
                $('#editProductModal').modal('hide');
                $('#updateProduct')[0].reset();
                $('#myTable').load(location.href + " #myTable");
                    }
                }
            });
        });
</script>

</body>
</html>
