<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Einkaufszettel #<?php echo($_GET['id']) ?></title>

    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
            integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body style="background-color: #27AE60">

<!-- Navigation bar -->
<nav class="navbar shadow-sm p-3 mb-5" style="background-color: white">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Einkaufszettel #<?php echo($_GET['id']) ?></span>
        <button class="btn btn-outline-success" onclick="location.href='index.php'">Zurück</button>
    </div>
</nav>

<div class="show-div">
    <!-- Card to list all information from the shopping list -->
    <div class="card mb-3" style="max-width: 1000px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="assets/cart.png" class="img-fluid rounded-start" style="padding: 10px">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <?php
                    require "backend/includes/db.inc.php";
                    global $db;

                    /**
                     * Reading all data from the database
                     */

                    $query = "SELECT * FROM shopping_lists WHERE id = ?;";

                    $statement = $db->prepare($query);
                    $statement->bind_param("s", $_GET['id']);
                    $statement->execute();
                    $result = $statement->get_result();

                    while ($row = $result->fetch_row()) {
                        echo '<h5 class="card-title">' . $row[1] . '</h5>
                                <p class="card-text">' . nl2br($row[2]) . '</p>
                                <p class="card-text"><small class="text-muted">Erstellt: ' . date('d/m/y H:i', $row[3]) . '</small></p>
                                <button class="btn btn-warning" id="delete">Löschen</button>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    /*
    * Post request to delete.inc.php to execute the create method from ShoppingList.php
    */
    $('#delete').click(function () {
        $.ajax({
            type: 'POST',
            url: 'backend/includes/delete.inc.php',
            data: {
                id: <?php echo $_GET['id']; ?>
            }
        }).done(function () {
            location.href = 'index.php'
        })
    });
</script>

<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>