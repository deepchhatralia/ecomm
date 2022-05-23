<?php

if (isset($_POST['operation'])) {
    include '../../database.php';
    $obj = new Database();

    $output = "";

    if ($_POST['operation'] == "getFilters") {
        $rating = $_POST['rating'];
        $range = $_POST['range'];
        $company = $_POST['company'];
        $company = json_decode($company);

        if ($range != 0) {
            if ($rating && $range && count($company) > 0) {
                $wheree = "";
                for ($i = 0; $i < count($company); $i++) {
                    if ($i != count($company) - 1) {
                        $wheree .= "company_name='" . $company[$i] . "' OR ";
                    } else {
                        $wheree .= "company_name='" . $company[$i] . "'";
                    }
                }
                $result2 = $obj->select('*', 'company_profile', $wheree);

                if ($result2->num_rows > 0) {
                    $output = "";
                    while ($row2 = $result2->fetch_assoc()) {
                        $companyId = $row2['idcompany_profile'];

                        $ratingResult = $obj->select('DISTINCT `product_id`', 'rating', "rating_star>=" . $rating);

                        if ($ratingResult->num_rows > 0) {
                            while ($ratingRow = $ratingResult->fetch_assoc()) {
                                $result = $obj->select('*', 'productt', "product_price>0 AND product_price<=" . $range . " AND company_profile_idcompany_profile=" . $companyId . " AND product_id=" . $ratingRow['product_id']);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $productId = $row["product_id"];
                                        $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                                        $row2 = $row2->fetch_assoc();

                                        $offerId = $row['offer_idoffer'];
                                        $price = $row['product_price'];
                                        if ($offerId != 0) {
                                            $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                                            $roww = $resultt->fetch_assoc();

                                            $price = round($row['product_price'] - ($row['product_price'] * $roww['offer_discount'] / 100));
                                        }

                                        $output .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                                                <div class="product_list">
                                                    <div class="product_img">
                                                        <img class="img-responsive" src="../admin/product/uploads/' . $row2['img_path'] . '" alt="">
                                                    </div>
                                                    <div class="product_detail_btm">
                                                        <div class="center">
                                                            <h4 class="h4">
                                                                <a href="http://localhost/ecomm/product/product.php?id=' . $productId . '">' . $row['product_name'] . '</a>
                                                            </h4>
                                                        </div>
                                                        <div class="product_price">
                                                            <p><span class="new_price">₹' . $price . '</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                            }
                        }
                    }
                    echo $output;
                }
            } else if (count($company) > 0 && $rating) {
                // remaining
            } else if ($range && count($company) > 0) {
                $wheree = "";
                for ($i = 0; $i < count($company); $i++) {
                    if ($i != count($company) - 1) {
                        $wheree .= "company_name='" . $company[$i] . "' OR ";
                    } else {
                        $wheree .= "company_name='" . $company[$i] . "'";
                    }
                }
                $result2 = $obj->select('*', 'company_profile', $wheree);

                if ($result2->num_rows > 0) {
                    $output = "";
                    while ($row2 = $result2->fetch_assoc()) {
                        $companyId = $row2['idcompany_profile'];
                        $result = $obj->select('*', 'productt', "product_price>0 AND product_price<=" . $range . " AND company_profile_idcompany_profile=" . $companyId);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $productId = $row["product_id"];
                                $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                                if ($row2->num_rows > 0) {
                                    $row2 = $row2->fetch_assoc();
                                    $offerId = $row['offer_idoffer'];
                                    $price = $row['product_price'];
                                    if ($offerId != 0) {
                                        $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                                        $roww = $resultt->fetch_assoc();

                                        $price = round($row['product_price'] - ($row['product_price'] * $roww['offer_discount'] / 100));
                                    }

                                    $output .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                                        <div class="product_list">
                                            <div class="product_img">
                                                <img class="img-responsive" src="../admin/product/uploads/' . $row2['img_path'] . '" alt="">
                                            </div>
                                            <div class="product_detail_btm">
                                                <div class="center">
                                                    <h4 class="h4">
                                                        <a href="http://localhost/ecomm/product/product.php?id=' . $productId . '">' . $row['product_name'] . '</a>
                                                    </h4>
                                                </div>
                                                <div class="product_price">
                                                    <p><span class="new_price">₹' . $price . '</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        }
                    }
                    echo $output;
                }
            } else if ($range) {
                $result = $obj->select('*', 'productt', "product_price>0 AND product_price<=" . $range);

                if ($result->num_rows > 0) {
                    $output = "";
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row["product_id"];
                        $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                        $row2 = $row2->fetch_assoc();

                        $offerId = $row['offer_idoffer'];
                        $price = $row['product_price'];
                        if ($offerId != 0) {
                            $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                            $roww = $resultt->fetch_assoc();

                            $price = round($row['product_price'] - ($row['product_price'] * $roww['offer_discount'] / 100));
                        }

                        $output .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                                    <div class="product_list">
                                        <div class="product_img">
                                            <img class="img-responsive" src="../admin/product/uploads/' . $row2['img_path'] . '" alt="">
                                        </div>
                                        <div class="product_detail_btm">
                                            <div class="center">
                                                <h4 class="h4">
                                                    <a href="http://localhost/ecomm/product/product.php?id=' . $productId . '">' . $row['product_name'] . '</a>
                                                </h4>
                                            </div>
                                            <div class="product_price">
                                                <p><span class="new_price">₹' . $price . '</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    }
                    echo $output;
                }
            } else if ($rating) {
                $result = $obj->select('DISTINCT `product_id`', 'rating', "rating_star>=" . $rating);

                if ($result->num_rows > 0) {
                    $output = "";
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row['product_id'];

                        $product = $obj->select('*', 'productt', 'product_id=' . $productId);
                        $productRow = $product->fetch_assoc();


                        $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                        $row2 = $row2->fetch_assoc();

                        $offerId = $productRow['offer_idoffer'];
                        $price = $productRow['product_price'];
                        if ($offerId != 0) {
                            $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                            $roww = $resultt->fetch_assoc();

                            $price = round($productRow['product_price'] - ($productRow['product_price'] * $roww['offer_discount'] / 100));
                        }

                        $output .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                                    <div class="product_list">
                                        <div class="product_img">
                                            <img class="img-responsive" src="../admin/product/uploads/' . $row2['img_path'] . '" alt="">
                                        </div>
                                        <div class="product_detail_btm">
                                            <div class="center">
                                                <h4 class="h4">
                                                    <a href="http://localhost/ecomm/product/product.php?id=' . $productId . '">' . $productRow['product_name'] . '</a>
                                                </h4>
                                            </div>
                                            <div class="product_price">
                                                <p><span class="new_price">₹' . $price . '</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    }
                    echo $output;
                }
            } else if (count($company) > 0) {
                $wheree = "";
                for ($i = 0; $i < count($company); $i++) {
                    if ($i != count($company) - 1) {
                        $wheree .= "company_name='" . $company[$i] . "' OR ";
                    } else {
                        $wheree .= "company_name='" . $company[$i] . "'";
                    }
                }
                $result2 = $obj->select('*', 'company_profile', $wheree);

                if ($result2->num_rows > 0) {
                    $output = "";
                    while ($row2 = $result2->fetch_assoc()) {
                        $companyId = $row2['idcompany_profile'];

                        $result = $obj->select('*', 'productt', "company_profile_idcompany_profile=" . $companyId);

                        if ($result->num_rows > 0) {
                            $output = "";
                            while ($row = $result->fetch_assoc()) {
                                $productId = $row["product_id"];
                                $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                                $row2 = $row2->fetch_assoc();

                                $offerId = $row['offer_idoffer'];
                                $price = $row['product_price'];
                                if ($offerId != 0) {
                                    $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                                    $roww = $resultt->fetch_assoc();

                                    $price = round($row['product_price'] - ($row['product_price'] * $roww['offer_discount'] / 100));
                                }

                                $output .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                                        <div class="product_list">
                                            <div class="product_img">
                                                <img class="img-responsive" src="../admin/product/uploads/' . $row2['img_path'] . '" alt="">
                                            </div>
                                            <div class="product_detail_btm">
                                                <div class="center">
                                                    <h4 class="h4">
                                                        <a href="http://localhost/ecomm/product/product.php?id=' . $productId . '">' . $row['product_name'] . '</a>
                                                    </h4>
                                                </div>
                                                <div class="product_price">
                                                    <p><span class="new_price">₹' . $price . '</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        }
                        echo $output;
                    }
                }
            }
        } else {
            echo '<h1 class="h1 text-center mt-5">No products found</h1>';
        }
    }
}
