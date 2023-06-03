<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Deine Einkaufszettel</title>

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
        <span class="navbar-brand mb-0 h1">Einkaufszettel</span>
    </div>
</nav>

<div class="content">
    <!-- Table for all shopping lists -->
    <table class="table table-success table-striped table-hover">
        <thead class="table-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Schnellnotiz</th>
            <th scope="col">Erstellt</th>
            <th scope="col">Aktion</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /**
         * Reads all existing shopping lists from the database
         */

        require "backend/includes/db.inc.php";
        global $db;

        $query = "SELECT * FROM shopping_lists;";

        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["note"] . "</td><td>" . date('d/m/y H:i', $row["created_at"]) . "</td><td> 
                <form type='GET' action='show.php'><input type='hidden' name='id' value='" . $row["id"] . "'</input><button type='submit' class='btn btn-success' id='show-button'>Ansehen</button></form>
                </td></tr>";
            }
        }

        ?>
        </tbody>
    </table>
</div>

<!-- Pop-Up/Modal for shopping list creation -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-modal-label">Neuer Einkaufszettel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation">
                    <div class="mb-3">
                        <label for="note" class="col-form-label">Schnellnotiz:</label>
                        <input type="text" class="form-control" id="note" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Looks not good!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="list" class="col-form-label">Dein Einkauf:</label>
                        <textarea class="form-control" id="list" required></textarea>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <button type="submit" id="create-list" class="btn btn-primary">Hinzufügen</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

<!-- Notification after creation -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Einkaufszettel</strong>
            <small>Jetzt</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Dein Einkaufszettel wurde erfolgreich erstellt!
        </div>
    </div>
</div>

<!-- Button to open the modal/pop-up -->
<div class="addButton">
    <button type="button" class="btn btn-lg btn-light" data-bs-toggle="modal" data-bs-target="#create-modal"><span
            class="bi-plus"></span></button>
</div>

<script type="module">
    const successToastElement = document.getElementById('successToast')
    const successToast = new bootstrap.Toast(successToastElement)

    /*
     * Post request to create.inc.php to execute the create method from ShoppingList.php
    */
    $('#create-list').click(function () {
        $.ajax({
            type: 'POST',
            url: 'backend/includes/create.inc.php',
            data: {
                note: $('#note').val(),
                list: $('#list').val()
            }
        }).done(function () {
            successToast.show();
        })
    });

</script>

<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>