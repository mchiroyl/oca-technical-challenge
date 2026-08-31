/*
B1 · Consulta en SQL Server

Devuelve los 5 clientes que más han pagado
en los últimos 90 días, ordenados de mayor a menor.
*/

SELECT TOP (5)
    c.id,
    c.nombre,
    c.nit,
    SUM(p.monto) AS total_pagado
FROM clientes AS c
INNER JOIN pagos AS p
    ON p.cliente_id = c.id
WHERE p.fecha_pago >= DATEADD(DAY, -90, GETDATE())
GROUP BY
    c.id,
    c.nombre,
    c.nit
ORDER BY
    total_pagado DESC,
    c.id ASC;
