<?php

require_once __DIR__ . '/data/functions.php';

// verifico che la lunghezza sia impostata
if(isset($_POST['length'])){
    $characters = !isset($_POST['characters']) ? ['L', 'N', 'S'] : $_POST['characters'];
    $response = generatePassword($_POST['length'], $_POST['allow-duplicates'], $characters);
}


include_once __DIR__ . '/partials/head.php';
?>

<body>

    <div class="wrapper">

        <div class="container mb-3 pt-3">

            <div class="row justify-content-center">

                <div class="col-12 text-center">
                    <h1 class="text-white-50">Strong Password Generator</h1>
                    <h2 class="text-white">Genera una password sicura</h2>
                </div>

                <?php if(isset($response)): ?>
                    <div class="col-7">
                        <div class="alert alert-info" role="alert">
                            <?php echo $response ?>
                        </div>
                    </div>
                <?php endif; ?>
        

                <div class="col-7">
                    <form class="p-3 border border-1 rounded-2 bg-light" action="index.php" method="POST">
                        <div class="row mb-3">
                            <label for="length" class="col-sm-7 col-form-label">Lunghezza password:</label>
                            <div class="col-sm-3">
                                <input type="number" name="length" id="length" class="form-control">
                            </div>
                        </div>
                        <fieldset class="row mb-3">

                            <legend class="col-form-label col-sm-7 pt-0">Consenti ripetizioni di uno o più caratteri:</legend>
                            <div class="col-sm-5">

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="allow-duplicates" id="allow-duplicates" checked value="1">
                                    <label class="form-check-label" for="allow-duplicates">
                                        Sì
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="allow-duplicates" id="allow-duplicates" value="0">
                                    <label class="form-check-label" for="allow-duplicates">
                                        No
                                    </label>
                                </div>

                            </div>
                        </fieldset>
                        <div class="row mb-3">
                            <div class="col-sm-5 offset-sm-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="characters[]" id="characters1" value="L">
                                    <label class="form-check-label" for="characters1">
                                        Lettere
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="characters[]" id="characters2" value="N">
                                    <label class="form-check-label" for="characters2">
                                        Numeri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="characters[]" id="characters3" value="S">
                                    <label class="form-check-label" for="characters3">
                                        Simboli
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Invia</button>
                            <button type="reset" class="btn btn-secondary">Annulla</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

</body>

</html>