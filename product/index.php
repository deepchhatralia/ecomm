<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>


    <!-- Custom styles for this template -->
    <link href="../css/index/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/index/responsive.css" rel="stylesheet" />

    <link rel="stylesheet" href="../css/productCard.css">
    <link rel="stylesheet" href="../css/headingBorder.css">
</head>

<body>
    <?php
    include '../admin/includee/cdn.php';
    include '../database.php';
    $obj = new Database();

    include '../includee/navbar1.php';
    ?>

    <div class="modal fade" id="filterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Filters</h5>
                    <button type="button" class="btn-close closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 align-items-center">
                        <label for="company" class="col-sm-2 col-form-label font-bold">Company</label>
                        <div class="col-sm-10">
                            <?php
                            $result = $obj->select('*', 'company_profile');

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<input type="checkbox" name="company" value="' . $row['company_name'] . '" class="form-conrol company">   ' . $row['company_name'] . '     ';
                                }
                            }

                            ?>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label for="priceRange" class="col-sm-4 col-form-label font-bold">Price Range</label>
                        </div>
                        <div class="col-md-9">
                            <?php
                            $result = $obj->select('MAX(product_price)', 'productt');
                            $max = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $max = $row['MAX(product_price)'];
                            }
                            ?>
                            <input type="range" id="priceRange" min="0" max="<?php echo $max; ?>">
                            <small class="font-bold h4">0 - <span id="whatRange"></span></small>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="filterRating" class="col-sm-2 font-bold">Rating</label>
                        <div class="col-md-12">
                            <select id="rating" class="form-select">
                                <option value="0" selected disabled>Select</option>
                                <option value="5">5+</option>
                                <option value="4">4+</option>
                                <option value="3">3+</option>
                                <option value="2">2+</option>
                                <option value="1">1+</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="clearFilter" class="btn btn-secondary">Clear</button>
                    <button type="button" class="btn btn-primary" id="applyFilterBtn">Apply</button>
                </div>
            </div>
        </div>
    </div>

    <section class="product_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="heading_container heading_center main_heading">
                    <h2 class="h2 m-0">Our Products</h2>
                </div>
                <div class="col-md-3 d-flex align-items-center justify-content-between">
                    <h6 class="h6">Sort by</h6> :&nbsp;&nbsp;
                    <select id="sortBy" class="form-select">
                        <option value="1" selected>Relevance</option>
                        <option value="2">Price : Low to High</option>
                        <option value="3">Price : High to Low</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" id="filters" data-bs-toggle="modal" data-bs-target="#filterModal">Filters</button>
                </div>
            </div>

            <div class="row productRow my-5">

            </div>
        </div>
    </section>

    <?php include '../includee/footer.php'; ?>

    <!-- end product section -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- jQery -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="../js/bootstrap.js"></script>

    <script>
        $(document).ready(() => {
            function loadProducts(op = "load products") {
                $.post({
                    url: "ajax/loadProducts.php",
                    data: {
                        operation: op
                    },
                    beforeSend() {
                        $('.productRow').addClass("d-flex justify-content-center")
                        $('.productRow').html('<div class="spinner-border" role="status"><span class=visually-hidden"></span></div>');
                    },
                    success(data) {
                        $('.productRow').removeClass("d-flex justify-content-center")
                        $('.productRow').html(data)
                    }
                })
            }

            loadProducts();

            $('#whatRange').text($('#priceRange').val());
            $('#priceRange').on('change', () => {
                const range = $('#priceRange').val();

                $('#whatRange').text(range);
            })

            $('#clearFilter').on('click', () => {
                window.location.reload();
            })

            $('#applyFilterBtn').on('click', () => {
                const range = $('#priceRange').val();
                const rating = $('#rating').val()
                let company = [];

                $('input[name="company"]:checked').each(function() {
                    company.push(this.value);
                });

                if (range || rating || company.length > 0) {
                    company = JSON.stringify(company)
                    $.post({
                        url: "ajax/filter.php",
                        data: {
                            range,
                            rating,
                            company,
                            operation: "getFilters"
                        },
                        success(data) {
                            if (data) {
                                $('.productRow').html(data)
                            } else {
                                $('.productRow').html('<h1 class="mt-5 h1 text-center">No products found</h1>')
                            }
                            console.log(data)
                        }
                    })
                } else {
                    loadProducts()
                }
                $('.closeModal').click();
            })

            $('#sortBy').on('change', () => {
                if ($('#sortBy').val() == 1) {
                    loadProducts()
                } else if ($('#sortBy').val() == 2) {
                    loadProducts("low to high");
                } else if ($('#sortBy').val() == 3) {
                    loadProducts("high to low");
                }
            })

            document.addEventListener('click', (e) => {
                if (e.target && e.target.id == "addToCart") {
                    const productId = e.target.getAttribute("data-id");
                }
                return () => {}
            })
        })
    </script>
</body>

</html>