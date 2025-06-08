<?php

// Interface para cálculo de imposto
interface TaxCalculator {
    public function calculate(float $amount): float;
}

// Calculadora básica que retorna zero imposto (componente base do decorator)
class BasicTaxCalculator implements TaxCalculator {
    public function calculate(float $amount): float {
        // Retorna zero pois é o componente base, sem imposto adicional
        return 0.0;
    }
}

// Decorator abstrato que implementa TaxCalculator
abstract class TaxDecorator implements TaxCalculator {
    protected TaxCalculator $calculator;

    public function __construct(TaxCalculator $calculator) {
        $this->calculator = $calculator;
    }

    abstract public function calculate(float $amount): float;
}

// Decorator para ICMS (Imposto sobre Circulação de Mercadorias e Serviços)
class ICMSDecorator extends TaxDecorator {
    public function calculate(float $amount): float {
        $baseTax = $this->calculator->calculate($amount);
        $icms = $amount * 0.18; // 18% ICMS
        echo "ICMS: R$ " . number_format($icms, 2, ',', '.') . "\n";
        return $baseTax + $icms;
    }
}

// Decorator para ISS (Imposto sobre Serviços)
class ISSDecorator extends TaxDecorator {
    public function calculate(float $amount): float {
        $baseTax = $this->calculator->calculate($amount);
        $iss = $amount * 0.05; // 5% ISS
        echo "ISS: R$ " . number_format($iss, 2, ',', '.') . "\n";
        return $baseTax + $iss;
    }
}

// Decorator para IPI (Imposto sobre Produtos Industrializados)
class IPIDecorator extends TaxDecorator {
    public function calculate(float $amount): float {
        $baseTax = $this->calculator->calculate($amount);
        $ipi = $amount * 0.10; // 10% IPI
        echo "IPI: R$ " . number_format($ipi, 2, ',', '.') . "\n";
        return $baseTax + $ipi;
    }
}

// Código cliente
$amount = 1000.0;

$basicCalculator = new BasicTaxCalculator();

$icmsCalculator = new ICMSDecorator($basicCalculator);
$issCalculator = new ISSDecorator($icmsCalculator);
$ipiCalculator = new IPIDecorator($issCalculator);

$totalTax = $ipiCalculator->calculate($amount);

echo "Valor base: R$ " . number_format($amount, 2, ',', '.') . "\n";
echo "Imposto total calculado (ICMS + ISS + IPI): R$ " . number_format($totalTax, 2, ',', '.') . "\n";

?>
