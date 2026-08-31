<?php

/*
A2 · Registrar un pago con transacción

El enunciado indica que se utiliza un wrapper de PDO con:
prepare, execute, beginTransaction, commit, rollBack y lastInsertId.

Como no se proporciona la firma concreta de execute(),
se asume para este ejercicio:
execute($statement, $params).
*/

function registrarPago($clienteId, $monto, $formaPago, $fechaPago)
{
    global $conn;

    if (!is_numeric($monto) || $monto <= 0) {
        throw new InvalidArgumentException(
            'El monto debe ser mayor a cero.'
        );
    }

    $transaccionIniciada = false;

    try {
        $conn->beginTransaction();
        $transaccionIniciada = true;

        $sql = "INSERT INTO pagos
                    (cliente_id, monto, forma_pago, fecha_pago)
                VALUES
                    (:cliente_id, :monto, :forma_pago, :fecha_pago)";

        $stmt = $conn->prepare($sql);

        $conn->execute($stmt, [
            ':cliente_id' => $clienteId,
            ':monto' => $monto,
            ':forma_pago' => $formaPago,
            ':fecha_pago' => $fechaPago
        ]);

        $id = $conn->lastInsertId();

        $conn->commit();
        $transaccionIniciada = false;

        return $id;

    } catch (Throwable $e) {
        if ($transaccionIniciada) {
            $conn->rollBack();
        }

        throw $e;
    }
}