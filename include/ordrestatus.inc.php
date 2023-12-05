<?php
$query = "SELECT * FROM Bestilling WHERE isPickedUp = 0";
$statement = $pdo->prepare($query);
$statement->execute();
$bestillinger = $statement->fetchAll(PDO::FETCH_ASSOC);

$ferdigBestillinger = [];
$ikkeFerdigBestillinger = [];

foreach ($bestillinger as $bestilling) {
    if ($bestilling['IsReady']) {
        $ferdigBestillinger[] = $bestilling;
    } else {
        $ikkeFerdigBestillinger[] = $bestilling;
    }
}

?>


    <div class="container mt-5">
        <h2 class="text-center mb-4">Bestillinger</h2>

        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center mb-3">Ferdige</h3>
                <?php foreach ($ferdigBestillinger as $ferdigBestilling): ?>
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <?= $ferdigBestilling['Bestillingsnummer'] ?>
                            </h5>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="col-md-6">
                <h3 class="text-center mb-3">Ikke ferdige</h3>
                <?php foreach ($ikkeFerdigBestillinger as $ikkeFerdigBestilling): ?>
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <?= $ikkeFerdigBestilling['Bestillingsnummer'] ?>
                            </h5>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>