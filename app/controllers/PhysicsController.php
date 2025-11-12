<?php
require_once __DIR__ . '/../functions/functions.php';

class PhysicsController
{
    public function handleRequest(): array
    {
        $sit = isset($_GET['sit']) ? (int) $_GET['sit'] : 1;
        $result = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                switch ($sit) {
                    case 1:
                        $result = $this->handleSituacao1($_POST);
                        break;
                    case 2:
                        $result = $this->handleSituacao2($_POST);
                        break;
                    case 3:
                        $result = $this->handleSituacao3($_POST);
                        break;
                    case 4:
                        $result = $this->handleSituacao4($_POST);
                        break;
                    case 5:
                        $result = $this->handleSituacao5($_POST);
                        break;
                    default:
                        throw new InvalidArgumentException('Situação inválida.');
                }
            } catch (Throwable $e) {
                $result = [
                    'error' => true,
                    'output' => 'Erro: ' . htmlspecialchars($e->getMessage()),
                    'formula' => ''
                ];
            }
        }

        return ['sit' => $sit, 'result' => $result];
    }

    private function n(array $src, string $key, float $default = null): float
    {
        if (!isset($src[$key])) {
            if ($default !== null)
                return $default;
            throw new InvalidArgumentException("Campo {$key} ausente.");
        }
        $val = str_replace(',', '.', trim((string) $src[$key]));
        if (!is_numeric($val)) {
            throw new InvalidArgumentException("Campo {$key} inválido.");
        }
        return (float) $val;
    }

    private function handleSituacao1(array $d): array
    {
        $fC = calc_situacao1($this->n($d, 'fA'), $this->n($d, 'RA'), $this->n($d, 'RB'), $this->n($d, 'RBp'), $this->n($d, 'RC'));
        return ['formula' => 'fC = fA × (RA/RB) × (RB\'/RC)', 'output' => number_format($fC, 2, ',', '.') . ' Hz'];
    }

    private function handleSituacao2(array $d): array
    {
        [$T1, $T2] = calc_situacao2($this->n($d, 'M'), $this->n($d, 'g', 9.8), $this->n($d, 'theta'), $this->n($d, 'alpha'));
        return [
            'formula' => 'T₁cosθ = T₂cosα e T₁senθ + T₂senα = Mg',
            'output' => "T₁ = " . number_format($T1, 2, ',', '.') . " N<br>T₂ = " . number_format($T2, 2, ',', '.') . " N"
        ];
    }

    private function handleSituacao3(array $d): array
    {
        [$a, $T] = calc_situacao3($this->n($d, 'theta'), $this->n($d, 'm1'), $this->n($d, 'm2'), $this->n($d, 'mu'), $this->n($d, 'g', 9.8));
        return [
            'formula' => 'a = (m₂g − m₁g(senθ + μcosθ)) / (m₁ + m₂)',
            'output' => "Aceleração = " . number_format($a, 2, ',', '.') . " m/s²<br>Tensão = " . number_format($T, 2, ',', '.') . " N"
        ];
    }

    private function handleSituacao4(array $d): array
    {
        $F = calc_situacao4(
            $this->n($d, 'm'),
            $this->n($d, 'M'),
            $this->n($d, 'a'),
            $this->n($d, 'R'),
            $this->n($d, 'r'),
            $this->n($d, 'g', 9.8)
        );
        return [
            'formula' => 'F = m(g + a)(r/R) + (I·a)/(rR), com I=½MR²',
            'output' => "F = " . number_format($F, 3, ',', '.') . " N"
        ];
    }

    private function handleSituacao5(array $d): array
    {
        [$I, $L, $tau] = calc_situacao5($this->n($d, 'M'), $this->n($d, 'R'), $this->n($d, 'dt'));
        return [
            'formula' => 'I = ½MR², L = Iω, τ = L/Δt (ω de 3600 rpm)',
            'output' => "I = " . number_format($I, 2, ',', '.') . " kg·m²<br>L = " . number_format($L, 3, ',', '.') . " kg·m²/s<br>τ = " . number_format($tau, 3, ',', '.') . " N·m"
        ];
    }
}
