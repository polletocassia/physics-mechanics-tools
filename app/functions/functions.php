<?php declare(strict_types=1);

// Situação 1 : polias
function calc_situacao1(float $fA, float $RA, float $RB, float $RBp, float $RC): float {
    if ($RB == 0.0 || $RC == 0.0) {
        throw new DomainException('RB e RC devem ser diferentes de zero.');
    }
    return $fA * ($RA / $RB) * ($RBp / $RC);
}

// Situação 2: duas cordas, bloco em equilíbrio
function calc_situacao2(float $M, float $g, float $theta, float $alpha): array {
    $th = deg2rad($theta);
    $al = deg2rad($alpha);

    $den = cos($al) * tan($th) + sin($al);
    if (abs($den) < 1e-12) {
        throw new DomainException('Combinação de ângulos inválida (denominador ~ 0).');
    }
    if (abs(cos($th)) < 1e-12) {
        throw new DomainException('θ inválido (cosθ ~ 0).');
    }

    $T2 = ($M * $g) / $den;
    $T1 = $T2 * (cos($al) / cos($th));
    return [$T1, $T2];
}

// Situação 3 : bloco no plano inclinado + bloco pendurado
function calc_situacao3(float $theta, float $m1, float $m2, float $mu, float $g = 9.8): array {
    if (($m1 + $m2) == 0.0) {
        throw new DomainException('m1 + m2 deve ser > 0.');
    }
    $rad = deg2rad($theta);
    $num = $m2 * $g - $m1 * $g * (sin($rad) + $mu * cos($rad));
    $den = $m1 + $m2;
    $a = $num / $den;
    $T = $m2 * $g - $m2 * $a;
    return [$a, $T];
}

// Situação 4: mecanismo com roda e cubo
function calc_situacao4(float $m, float $M, float $a, float $R, float $r, float $g = 9.8): float {
    if ($R == 0.0 || $r == 0.0) {
        throw new DomainException('R e r devem ser diferentes de zero.');
    }
    $I = 0.5 * $M * $R * $R; 
    return $m * ($g + $a) * ($r / $R) + ($I * $a) / ($r * $R);
}

// Situação 5: polia acelerando até 3600 rpm
function calc_situacao5(float $M, float $R, float $dt): array {
    if ($dt <= 0.0) {
        throw new DomainException('Δt deve ser > 0.');
    }
    $f = 3600.0 / 60.0;          
    $omega_max = 2 * M_PI * $f;  
    $I = 0.5 * $M * $R * $R;
    $L = $I * $omega_max;
    $tau = $L / $dt;
    return [$I, $L, $tau];
}
