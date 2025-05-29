<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff8f0;
            color: #4b2e2e;
            font-family: 'Montserrat', sans-serif;
            padding: 2rem;
            background-image: url('https://images.unsplash.com/photo-1556742031-b77a2c3dc5b2');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 1rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .welcome {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        .btn-order {
            background-color: #d35400;
            color: #fff;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 8px;
            border: none;
        }
        .btn-order:hover {
            background-color: #e67e22;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 16px;
            color: #4b2e2e;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            margin-bottom: 1.5rem;
        }
        .product-img {
            border-radius: 12px;
            max-height: 180px;
            object-fit: cover;
            width: 100%;
        }
        .product-name {
            font-size: 1.25rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar d-flex justify-content-between align-items-center">
    <h4>Restaurant Dashboard</h4>
    <a href="logout.php" class="btn btn-order">Logout</a>
</nav>

<div class="welcome">
    🍽️ Welcome to the Food Palace!
</div>

<div class="row">
    <!-- Sample Product Card -->
    <div class="col-md-4">
        <div class="card">
            <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092" class="product-img" alt="Burger">
            <div class="mt-3">
                <div class="product-name">Classic Burger</div>
                <p>Juicy grilled beef patty with cheese, lettuce, and tomato.</p>
                <button class="btn btn-order">Order</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <img src="https://images.unsplash.com/photo-1600628422019-90d7cc3c3a01" class="product-img" alt="Pizza">
            <div class="mt-3">
                <div class="product-name">Pepperoni Pizza</div>
                <p>Hot and cheesy pepperoni pizza with fresh tomato sauce.</p>
                <button class="btn btn-order">Order</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <img src="https://images.unsplash.com/photo-1606755962777-d324e0a8c4d7" class="product-img" alt="Pasta">
            <div class="mt-3">
                <div class="product-name">Creamy Alfredo Pasta</div>
                <p>Fettuccine pasta tossed in creamy Alfredo sauce.</p>
                <button class="btn btn-order">Order</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
