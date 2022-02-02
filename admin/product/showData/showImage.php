<?php

if (isset($_POST['operation']) && $_POST['operation'] == 'select') {
    include '../../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'productt');

    if ($result->num_rows > 0) {
        $output = "";
        while ($row = $result->fetch_assoc()) {

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
