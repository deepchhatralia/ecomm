<?php

if (isset($_POST['operation']) && $_POST['operation'] == 'select') {
    include '../../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'productt');

    if ($result->num_rows > 0) {
        $output = "";
        while ($row = $result->fetch_assoc()) {
            // $product = $row['product_product_id'];
            // $result2 = $obj->select('*', 'product', "product_id = " . $product);
            // $result2 = $result2->fetch_assoc();
            // <td>' . $row["idimage"] . '</td>
            // $result4 = $obj->select('*', 'productt');

            $id = $row['product_id'];
            $result2 = $obj->select('*', 'image', "product_product_id=" . $id);
            $output .= '<tr>';
            if ($result2->num_rows > 0) {
                $output .= '<td><div class="imgs-container">';
                while ($row2 = $result2->fetch_assoc()) {
                    $output .= '
                        <div class="my-container">
                            <img src="uploads/' . $row2["img_path"] . '" class="product-img my-image" alt="">
                            <div class="middle">
                                <button id="delete-img-btn" class="text btn btn-danger" data-id="' . $row2["idimage"] . '">Delete</button>
                            </div>
                        </div>';
                }
                $output .= '</div></td>
                <td>' . $row['product_name'] . '</td>';
            }
            $output .= "</tr>";
        }
        echo $output;
    }
}


//  <td style="font-size: 13px; text-align: center;">
//     <button id="fa-edit" class="my-btn bg-success edit-btn mb-1"><i class="far fa-edit mx-1"></i> Edit</button> 
//     <button id="fa-trash-alt" class="my-btn bg-danger delete-btn"><i class="fas fa-trash-alt mx-1"></i> Delete</button>
// </td>