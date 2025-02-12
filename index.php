<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Home of The Plug.</title>
</head>
<body>

<h1></h1>
<ul>
    <?php
    $products = [
        'Nike SB Dunk Low Paris',
        'Travis Scott x Air Jordan 4 (F&F)',
        'Air Jordan 3 Interscope Records',
        'Louis Vuitton x Nike Air Force 1',
        'Nike Air Max 95',
    ];

    for ($i = 0; $i < count($products) && $i < 5; $i++) {
        echo "<li>$products[$i]</li>";
    }
    ?>
</ul>

<hr>

<h2>Search Page</h2>
<form action="" method="get">
    <input type="text" name="search" placeholder="Search for products here.
    <button type="submit"></button>
</form>

<hr>

<h2>Product Description Page</h2>
<h3></h3>
<p>
    Nike SB Dunk Low Paris.It's a piece of history – the fusion of urban culture and art, as well as an investment whose value continues to climb. For collectors and enthusiasts, this is a unique opportunity to own a piece of this legendary history and complete the City Pack.
</p>

</body>
</html>
