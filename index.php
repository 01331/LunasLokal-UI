<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LunasLokal</title>

    <link rel="stylesheet" href="common-style.css">
    <link rel="stylesheet" href="index-style.css">

    <link rel="icon" href="assets/LL-favicon.png" type="image/x-icon">

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
        <div class="filter">
            <div class="crumb">
                All Products
            </div>
            <div class="filter-toggles">
                filter
            </div>
        </div>

        <div class="products">
            
            <div class="card">
                <div class="card-image">
                    <img src="assets/Black Aesthetic Night Songs Insomnia Playlist Cover.png" alt="test pic">
                </div>
                <div class="card-text">
                    <div class="text-prodName">
                        <h3 id="prodName">Product Name</h3>
                    </div>
                    <div class="text-pharm-loc">
                        <p id="pharm">Pharmacy</p>
                        <p id="loc">Location</p>
                    </div>
                    <div class="text-price">
                        <p id="price">Php 00.00</p>
                    </div>
                </div>
            </div>

        </div>

        <script>
            // Select the products container
            const productsContainer = document.querySelector('.products');
    
            // Select the card element to duplicate
            const cardToDuplicate = document.querySelector('.products .card');
    
            // Duplicate the card content 5 times
            for (let i = 0; i < 8; i++) {
                // Create a clone of the card element
                const clonedCard = cardToDuplicate.cloneNode(true);
    
                // Append the cloned card to the products container
                productsContainer.appendChild(clonedCard);
            }
        </script>

    </div>
</body>
</html>