<?php
session_start();

if(!isset($_SESSION['password'])){
    header('Location: ./index.php');
}

include_once __DIR__ . '/partials/head.php';
?>



<body>

    <div class="wrapper">

        <div class="container mb-3 pt-3">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="text-white">La password generata è:</h2>
                    <div class="alert alert-info" role="alert">
                        <?php echo $_SESSION['password'] ?>
                    </div>
                </div>

                <div class="col-12">
                    <a href="./index.php" class="btn btn-info">Torna alla homepage</a>
                </div>

            </div>
        </div>

    </div>

</body>

</html>