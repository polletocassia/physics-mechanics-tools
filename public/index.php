<?php
require_once __DIR__ . '/../app/controllers/PhysicsController.php';

$controller = new PhysicsController();
$data = $controller->handleRequest();

$inputs = $_POST ?? [];
$sit = $data['sit'];
$result = $data['result'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Physics Mechanics Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container py-4 py-md-5">
        <header class="text-center mb-4">
            <h1 class="h3 h2-md mb-3">Física do Movimento</h1>

            <nav class="d-flex justify-content-center gap-2 mt-4 mb-4 flex-column flex-sm-row">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <a href="?sit=<?= $i ?>" class="btn btn-outline-primary <?= $sit === $i ? 'active' : '' ?> w-sm-auto">
                        Situação <?= $i ?>
                    </a>
                <?php endfor; ?>
            </nav>
        </header>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xxl-6">
                <div class="card border-primary">
                    <div class="card-body p-3 p-md-4 p-lg-5">

                        <?php if ($sit === 1): ?>
                            <h5 class="mb-4 fw-bold text-center text-md-start">Polias</h5>
                            <form method="post" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label for="fA" class="form-label">fA (Hz)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="fA" name="fA"
                                            class="form-control" placeholder="Ex: 10.5" required
                                            value="<?= isset($inputs['fA']) ? htmlspecialchars($inputs['fA']) : '' ?>">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="RA" class="form-label">RA (m)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="RA" name="RA"
                                            class="form-control" placeholder="Ex: 0.15" required
                                            value="<?= isset($inputs['RA']) ? htmlspecialchars($inputs['RA']) : '' ?>">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="RB" class="form-label">RB (m)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="RB" name="RB"
                                            class="form-control" placeholder="Ex: 0.10" required
                                            value="<?= isset($inputs['RB']) ? htmlspecialchars($inputs['RB']) : '' ?>">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="RBp" class="form-label">RB' (m)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="RBp" name="RBp"
                                            class="form-control" placeholder="Ex: 0.08" required
                                            value="<?= isset($inputs['RBp']) ? htmlspecialchars($inputs['RBp']) : '' ?>">
                                    </div>

                                    <div class="col-12">
                                        <label for="RC" class="form-label">RC (m)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="RC" name="RC"
                                            class="form-control" placeholder="Ex: 0.12" required
                                            value="<?= isset($inputs['RC']) ? htmlspecialchars($inputs['RC']) : '' ?>">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-4 w-100">Calcular</button>
                            </form>

                        <?php elseif ($sit === 2): ?>
                            <h5 class="mb-4 fw-bold text-center text-md-start">Duas cordas (bloco em equilíbrio)</h5>
                            <form method="post" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label for="M" class="form-label">Massa M (kg)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="M" name="M"
                                            class="form-control" placeholder="Ex: 2.5" required
                                            value="<?= isset($inputs['M']) ? htmlspecialchars($inputs['M']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="g" class="form-label">Aceleração da gravidade g (m/s²)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="g" name="g"
                                            class="form-control" placeholder="Ex: 9.8"
                                            value="<?= isset($inputs['g']) ? htmlspecialchars($inputs['g']) : '9.8' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="theta" class="form-label">Ângulo θ (graus)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="theta" name="theta"
                                            class="form-control" placeholder="Ex: 30" required
                                            value="<?= isset($inputs['theta']) ? htmlspecialchars($inputs['theta']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="alpha" class="form-label">Ângulo α (graus)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="alpha" name="alpha"
                                            class="form-control" placeholder="Ex: 45" required
                                            value="<?= isset($inputs['alpha']) ? htmlspecialchars($inputs['alpha']) : '' ?>">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-4 w-100">Calcular</button>
                            </form>

                        <?php elseif ($sit === 3): ?>
                            <h5 class="mb-4 fw-bold text-center text-md-start">Plano inclinado + bloco pendurado</h5>
                            <form method="post" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label for="theta3" class="form-label">Ângulo θ (graus)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="theta3" name="theta"
                                            class="form-control" placeholder="Ex: 25" required
                                            value="<?= isset($inputs['theta']) ? htmlspecialchars($inputs['theta']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="m1" class="form-label">Massa m₁ (kg)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="m1" name="m1"
                                            class="form-control" placeholder="Ex: 1.2" required
                                            value="<?= isset($inputs['m1']) ? htmlspecialchars($inputs['m1']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="m2" class="form-label">Massa m₂ (kg)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="m2" name="m2"
                                            class="form-control" placeholder="Ex: 2.0" required
                                            value="<?= isset($inputs['m2']) ? htmlspecialchars($inputs['m2']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="mu" class="form-label">Coeficiente de atrito μ</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="mu" name="mu"
                                            class="form-control" placeholder="Ex: 0.3" required
                                            value="<?= isset($inputs['mu']) ? htmlspecialchars($inputs['mu']) : '' ?>">
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-12">
                                        <label for="g3" class="form-label">Aceleração da gravidade g (m/s²)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="g3" name="g"
                                            class="form-control" placeholder="Ex: 9.8"
                                            value="<?= isset($inputs['g']) ? htmlspecialchars($inputs['g']) : '9.8' ?>">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-4 w-100">Calcular</button>
                            </form>

                        <?php elseif ($sit === 4): ?>
                            <h5 class="mb-4 fw-bold text-center text-md-start">Roda e cubo (sistema rotacional)</h5>
                            <form method="post" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label for="m4" class="form-label">m (kg)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="m4" name="m"
                                            class="form-control" placeholder="Ex: 1.0" required
                                            value="<?= isset($inputs['m']) ? htmlspecialchars($inputs['m']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="M4" class="form-label">M (kg)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="M4" name="M"
                                            class="form-control" placeholder="Ex: 3.0" required
                                            value="<?= isset($inputs['M']) ? htmlspecialchars($inputs['M']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="a4" class="form-label">Aceleração a (m/s²)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="a4" name="a"
                                            class="form-control" placeholder="Ex: 0.5" required
                                            value="<?= isset($inputs['a']) ? htmlspecialchars($inputs['a']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="R4" class="form-label">Raio R (m)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="R4" name="R"
                                            class="form-control" placeholder="Ex: 0.15" required
                                            value="<?= isset($inputs['R']) ? htmlspecialchars($inputs['R']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="r4" class="form-label">Raio r (m)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="r4" name="r"
                                            class="form-control" placeholder="Ex: 0.05" required
                                            value="<?= isset($inputs['r']) ? htmlspecialchars($inputs['r']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="g4" class="form-label">Aceleração da gravidade g (m/s²)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="g4" name="g"
                                            class="form-control" placeholder="Ex: 9.8"
                                            value="<?= isset($inputs['g']) ? htmlspecialchars($inputs['g']) : '9.8' ?>">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-4 w-100">Calcular</button>
                            </form>

                        <?php elseif ($sit === 5): ?>
                            <h5 class="mb-4 fw-bold text-center text-md-start">Polia acelerando até 3600 rpm</h5>
                            <form method="post" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label for="M5" class="form-label">Massa M (kg)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="M5" name="M"
                                            class="form-control" placeholder="Ex: 2.0" required
                                            value="<?= isset($inputs['M']) ? htmlspecialchars($inputs['M']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="R5" class="form-label">Raio R (m)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="R5" name="R"
                                            class="form-control" placeholder="Ex: 0.1" required
                                            value="<?= isset($inputs['R']) ? htmlspecialchars($inputs['R']) : '' ?>">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="dt5" class="form-label">Tempo Δt (s)</label>
                                        <input type="number" step="0.001" inputmode="decimal" id="dt5" name="dt"
                                            class="form-control" placeholder="Ex: 5" required
                                            value="<?= isset($inputs['dt']) ? htmlspecialchars($inputs['dt']) : '' ?>">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-4 w-100">Calcular</button>
                            </form>
                        <?php endif; ?>

                        <?php if ($result): ?>
                            <div class="alert text-primary mt-4 text-center" role="alert">
                                <p class="fw-bold fs-5 mb-1"><?= !empty($result['error']) ? 'Ops!' : 'Resultado:' ?></p>
                                <p class="fs-5 mb-0"><?= $result['output'] ?></p>
                                <?php if (!empty($result['formula'])): ?>
                                    <div class="mt-3">
                                        <span class="text-muted"><em><?= $result['formula'] ?></em></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>