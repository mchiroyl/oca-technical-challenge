<?php

/*
A3 · Encuentra el bug de negocio

Defectos identificados:

1. La función puede devolver días de mora negativos cuando
   la fecha de pago es anterior a la fecha de vencimiento.
   En ese caso, los días de mora deben ser cero.

2. No se valida el resultado de strtotime().
   Si una fecha no puede interpretarse, strtotime() devuelve false
   y el cálculo puede producir un resultado incorrecto.

3. Dividir la diferencia de timestamps entre 86400 supone que
   calcular días de mora equivale a contar bloques de 24 horas.
   Además, si las fechas incluyen horas, puede producir valores
   fraccionarios. Para días calendario es más apropiado utilizar
   DateTime y diff().
*/

function diasMora($fechaVencimiento, $fechaPago)
{
    $timestampVencimiento = strtotime($fechaVencimiento);
    $timestampPago = strtotime($fechaPago);

    if ($timestampVencimiento === false || $timestampPago === false) {
        throw new InvalidArgumentException(
            'La fecha de vencimiento o la fecha de pago no es válida.'
        );
    }

    $vencimiento = (new DateTimeImmutable())
        ->setTimestamp($timestampVencimiento)
        ->setTime(0, 0, 0);

    $pago = (new DateTimeImmutable())
        ->setTimestamp($timestampPago)
        ->setTime(0, 0, 0);

    if ($pago <= $vencimiento) {
        return 0;
    }

    return $vencimiento->diff($pago)->days;
}