<?php

/*
A1 · Corrige la vulnerabilidad

Problemas de seguridad identificados:

1. SQL Injection:
   Las variables $usuario y $clave se concatenan directamente
   dentro de la consulta SQL.

2. Manejo inseguro de contraseñas:
   La contraseña se compara directamente desde la consulta SQL.
   Debe almacenarse como hash y comprobarse con password_verify().

3. Exposición de información sensible:
   El mensaje de error muestra la consulta SQL completa.

4. Exposición del hash de contraseña:
   La función devuelve todos los campos recuperados, incluyendo clave.

5. Manejo inadecuado de errores:
   Los errores internos de base de datos no deben exponerse al usuario.
*/


function login($usuario, $clave) {
    global $conn; // conexión PDO

    try {
        $sql = "SELECT id, nombre, clave
                FROM usuarios
                WHERE usuario = :usuario";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':usuario' => $usuario
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !password_verify($clave, $row['clave'])) {
            return false;
        }

        unset($row['clave']);

        return $row;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

