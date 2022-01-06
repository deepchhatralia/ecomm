<?php

session_start();
$user_id = $_SESSION['user_id'];
include '../database.php';
$obj = new Database();

$result = $obj->select('*', 'cart', "user_id={$user_id}");

if ($result->num_rows > 0) {
    $counter = 1;
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];

        // For quantity 
        $result3 = $obj->select('*', 'cart', "product_id='{$product_id}' AND user_id={$user_id}");
        $row3 = $result3->fetch_assoc();
        $quantity = $row3['quantity'];

        // For product information 
        $result2 = $obj->select('*', 'products', "product_id='{$product_id}'");
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $product_stock = $row2['product_stock'];
            $product_img = $row2['product_img'];
            $total = $total + $quantity * $row2['product_price'];

            if ($product_stock >= 1) {
                echo '
                <li class="py-6 flex">
                    <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                      <img src="http://localhost/ecomm/upload_img/' . $product_img . '" alt="" class="w-full h-full object-center object-cover">
                    </div>

                    <div class="ml-4 flex-1 flex flex-col">
                      <div>
                        <div class="flex justify-between text-base font-medium text-gray-900">
                          <h3>
                            <a href="#">
                              ' . $row2["product_name"] . '
                            </a>
                          </h3>
                          <p class="ml-4">
                            Rs ' . $row2["product_price"] * $quantity . '
                          </p>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 d-none">
                          ' . $product_stock . '
                        </p>
                      </div>
                      <div class="flex-1 flex items-end justify-between text-sm">
                        <p class="text-gray-500">
                            <button class="qtyCartBtn minus btn-primary px-2">-</button>
                            <span class="quantityCart">' . $quantity . '</span>
                            <button class="plus qtyCartBtn btn-primary px-2">+</button>
                        </p>

                        <div class="flex">
                          <button data-productId="' . $product_id . '" type="button" class="font-medium text-indigo-600 hover:text-indigo-500 deleteCartBtn">Remove</button>
                        </div>
                      </div>
                    </div>
                  </li>
                ';

                if ($counter == 1) {
                    echo "<script>
                        document.querySelector('.cartBuyContainer').innerHTML = 
                        `<div class=\"flex justify-between text-base font-medium text-gray-900\">
                            <p>Subtotal</p>
                            <p> Rs " . $total . "</p>
                        </div>
                        <p class=\"mt-0.5 text-sm text-gray-500\">Shipping and taxes calculated at checkout.</p>
                        <div class=\"mt-6\">
                        <a href=\"#\" class=\"flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cartBuyBtn\">Checkout</a>
                        </div>
                        `;
                    </script>";
                    $counter++;
                }
            }
        } else {
            echo '
                <div class="cartItem">
                    <h6>Cart is empty</h6>
                </div>     
                ';
        }
    }
} else {
    echo '
        <div class="cartItem">
            <h6>Cart is empty</h6>
        </div>     
        ';
}
?>

<script src="../jquery.js"></script>

<script>
    $('.cartBuyBtn').click(() => {
        let x = ['60ecf139473d860ecf139473e', '60ecf139473d860ecf139473e'];
        window.location.href = `http://localhost/ecomm/product/buyForm.php?q=1`;
    });

    function cartQuantity(quantityInCart, productId) {
        $.ajax({
            url: "http://localhost/ecomm/product/cartQuantityAjax.php",
            type: "POST",
            data: {
                quantityInCart,
                productId
            }
        });
    }

    $('.minus').click((e) => {
        let product_stock = e.currentTarget.parentElement.parentElement.previousElementSibling.childNodes[3].innerHTML;
        let quantityInCart = e.currentTarget.nextElementSibling.innerHTML;
        quantityInCart--;
        if (quantityInCart < 1) {
            quantityInCart = 1;
        }

        let productId = e.currentTarget.parentElement.nextElementSibling.childNodes[1].getAttribute("data-productId");

        const y = e.currentTarget.nextElementSibling;
        $(y).html(quantityInCart);

        cartQuantity(quantityInCart, productId);
    });

    $('.plus').click((e) => {
        let product_stock = e.currentTarget.parentElement.parentElement.previousElementSibling.childNodes[3].innerHTML;

        let quantityInCart = e.currentTarget.previousElementSibling.innerHTML;
        quantityInCart++;
        if (quantityInCart <= product_stock) {
            let productId = e.currentTarget.parentElement.nextElementSibling.childNodes[1].getAttribute("data-productId");

            const y = e.currentTarget.previousElementSibling;
            $(y).html(quantityInCart);
            cartQuantity(quantityInCart, productId);
        }

    });

    $('.deleteCartBtn').click((e) => {
        let productId = e.target.getAttribute("data-productId");

        $.ajax({
            url: "http://localhost/ecomm/product/deleteCartProductAjax.php",
            type: "POST",
            data: {
                productId
            },
            success(data) {
                location.reload();
            }
        });

    });
</script>