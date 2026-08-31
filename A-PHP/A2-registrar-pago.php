<?php

/*
A2 · Registrar un pago con transacción

Requisitos:
- Validar que el monto sea mayor a cero.
- Iniciar una transacción.
- Insertar el pago usando una consulta preparada.
- Obtener y devolver el ID generado.
- Confirmar la transacción si todo sale bien.
- Revertir la transacción si ocurre un error.

Se utiliza $conn como wrapper/conexión PDO.
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

        $stmt->execute([
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