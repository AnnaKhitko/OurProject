<nav>
    <?php
    if (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['id'])) {
        echo '<span> |  <a href="./home.php">Home</a></span>';
        echo '<span> | <a href="./movies.php">Movies</a></span>';
        echo '<span> | <a href="./category.php">Category</a></span>';
        echo '<span> |  <a href="./add_movie.php">Add movie</a></span>';
    } ?>
</nav>
<!-- <nav>
    <ul>
        <li>
            <a href="./home.php">Home</a>
        </li>
        <li>
            <a href="./movies.php">Movies</a>
        </li>
        <li>
            <a href="./category.php">Category</a>
        </li>
        <li>
            <a href="./add_movie.php">Add movie</a>
        </li>
    </ul>
</nav> -->