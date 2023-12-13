<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LunasLokal</title>

    <link rel="stylesheet" href="common-style.css">
    <link rel="stylesheet" href="index-style.css">

    <link rel="icon" href="assets/LL-favicon.png" type="image/x-icon">

    <script src="functions.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
    <nav class="public-side">
        <div class="nav-content">
            <div class="brand">
                <img class="nav-logo" src="assets/LL-logo.svg" alt="LunasLokal Logo">
                <h1 class="wordtype"><a href="index.php">LunasLokal</a></h1>
            </div>
            <div class="searchxfilter">
                <div class="search-bar">
                    <form action="">
                        <input type="text" name="search" placeholder="Search Products">
                        <button type="submit" class="search-button"></button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="catalog">
        <div class="catalog-left">
            <div class="filter">
                <div class="filter-top">
                    <div class="crumb">
                        All Products
                    </div>
                    <div class="filter-toggles">
                        <button class="std-button btn-ol-blue" onclick="toggleFilters()">toggle filters</button>
                    </div>
                </div>
                <div class="filter-btm">
                    filters

                </div>
            </div>

            <div class="products">
            <?php
                include "_php/config.php"; // Include your database connection file

                // Query to fetch data from both 'product_details' and 'store_accounts' using a JOIN statement
                $sql = "SELECT pt.*, pa.pharm_name , pa.pharm_loc FROM prod_table pt
                        LEFT JOIN pharm_accounts pa ON pt.pharm_id = pa.pharm_id";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    // Fetch and store all results in an array
                    $combinedResults = [];
                    while ($row = $result->fetch_assoc()) {
                        $combinedResults[] = $row;
                    }

                    // Shuffle the array to randomize the order
                    shuffle($combinedResults);

                    foreach ($combinedResults as $row) {
                        echo "<div class='card' onclick='showRightDiv(" . $row["prod_id"] .", " .$row["pharm_id"] .")'>
                            <div class='card-image'>
                                <img src='assets/Black Aesthetic Night Songs Insomnia Playlist Cover.png' alt='test pic'>
                            </div>
                            <div class='card-text'>
                                <div class='text-prodName'>
                                    <h4 id='prodName'>" . $row['prod_name'] . "</h4>
                                </div>
                                <div class='text-pharm-loc'>
                                    <p id='pharm'>" . $row["pharm_name"] . ",</p>
                                    <p id='loc'>" . $row["pharm_loc"] . "</p>
                                </div>
                                <div class='text-price'>
                                    <p id='price' class='std-tag'>Php " . $row["prod_price"] . "</p>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "No products found.";
                }

                // Close the database connection
                $link->close();
            ?> 
            </div>
        </div>

        <div class="catalog-right">
            
         </div>
    </div>
</body>
</html>