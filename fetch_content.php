<?php
include "_php/config.php"; // Include your database connection file

if(isset($_GET['prodId']) && isset($_GET['pharmId'])) {
    $prodId = $_GET['prodId'];
    $pharmId = $_GET['pharmId'];

    // Query to fetch data from prod_table based on prodId
    $prod_sql = "SELECT * FROM prod_table WHERE prod_id = $prodId";
    $prod_result = $link->query($prod_sql);

    if ($prod_result->num_rows > 0) {
        $selected_prod = $prod_result->fetch_assoc();

        // Assign column values to variables
        $prod_generic_name = $selected_prod['prod_generic_name'];
        $prod_name = $selected_prod['prod_name'];
        $prod_price = $selected_prod['prod_price'];
        $prod_brand = $selected_prod['prod_brand'];
        $prod_form = $selected_prod['prod_form'];
        $prod_quantity = $selected_prod['prod_quantity'];
        $prod_desc = $selected_prod['prod_desc'];
        
        // Handle HTML output
        echo '<button class="close-btn" onclick="hideRightDiv()"><box-icon color="white" name="x"></box-icon></button>
        <div class="selected"><div class="selected-prod">
            <div class="selected-image">
                <img src="assets/Black Aesthetic Night Songs Insomnia Playlist Cover.png" alt="">
            </div>
            <div class="selected-text">
                <div class="text-prodName">
                    <h2 id="genericName">' . $prod_generic_name . '</h2>
                    <h2 id="prodName">' . $prod_name . '</h2>
                </div>
                <div class="text-price">
                    <p id="price" class="std-tag">Php ' . $prod_price . '</p>
                </div>
                <div class="text-tags">
                    <p class="std-tag">' . $prod_brand . '</p>
                    <p class="std-tag">' . $prod_form . '</p>
                    <p class="std-tag">' . $prod_quantity . '</p>
                </div>
                <div class="text-desc">
                    <p>' . $prod_desc . '</p>
                </div>
            </div>
        </div>';

    } else {
        echo "Product not found";
    }

    // Query to fetch data from pharm_accounts based on pharmId
    $pharm_sql = "SELECT * FROM pharm_accounts WHERE pharm_id = $pharmId";
    $pharm_result = $link->query($pharm_sql);
    
    if ($pharm_result->num_rows > 0) {
        $selected_pharm = $pharm_result->fetch_assoc();
        
        // Assign column values to variables
        $pharm_name = $selected_pharm['pharm_name'];
        $pharm_loc = $selected_pharm['pharm_loc'];
        $pharm_store_hours = $selected_pharm['pharm_store_hours'];
        $pharm_contact = $selected_pharm['pharm_contact'];
        $pharm_email = $selected_pharm['pharm_email'];
        $pharm_url_location = $selected_pharm['pharm_url_location'];
        
        // Handle HTML output
        echo '<div class="selected-pharm">
            <div class="selected-text">
                <h3 id="pharm-name">' . $pharm_name . '</h3>
                <h5 id="pharm-loc">' . $pharm_loc . '</h5>
                <div class="text-tags">
                    <p class="std-tag" id="pharm-hours">' . $pharm_store_hours . '</p>
                    <p class="std-tag" id="pharm-contact">' . $pharm_contact . '</p>
                    <p class="std-tag" id="pharm-email">' . $pharm_email . '</p>
                </div>
            </div>
            <div class="pharm-gmap">
                ' . $pharm_url_location . '
            </div>
        </div></div>';
    } else {
        echo "Pharmacy not found";
    }

    // Close the database connection
    $link->close();
} else {
    echo "Invalid parameters";
}
?>
