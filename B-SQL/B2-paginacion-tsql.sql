/*
B2 · Traducción entre motores

Consulta MySQL original:
SELECT `id`, `nombre` FROM `clientes`
ORDER BY `nombre`
LIMIT 20 OFFSET 40;

Equivalente en T-SQL para SQL Server:
Página 3, con 20 registros por página.
*/


SELECT
    id,
    nombre
FROM clientes
ORDER BY nombre
OFFSET 40 ROWS
FETCH NEXT 20 ROWS ONLY;

