# B3 · Rendimiento

Una consulta que filtra pagos por `fecha_pago` se volvió lenta
al crecer la tabla a varios millones de filas.

Revisaría y actuaría en el siguiente orden:

## 1. Revisar la consulta y medir el problema

Primero revisaría la consulta real y mediría su comportamiento antes
de realizar cambios.

En SQL Server comprobaría, entre otros datos:

- Tiempo de ejecución.
- Lecturas lógicas.
- Cantidad de filas procesadas.
- Plan de ejecución real.

El objetivo es identificar dónde está el costo antes de modificar
índices o la consulta.

## 2. Revisar el plan de ejecución

Analizaría el plan de ejecución para comprobar cómo SQL Server está
accediendo a la tabla `pagos`.

Revisaría especialmente si existe un `Table Scan` o `Index Scan`
sobre una gran cantidad de filas cuando el filtro por `fecha_pago`
podría beneficiarse de un acceso más selectivo.

También revisaría las estimaciones de filas frente a las filas reales.

## 3. Revisar los índices existentes

Comprobaría si existe un índice adecuado sobre la columna
`fecha_pago`.

Si no existe y la consulta filtra frecuentemente por esta columna,
evaluaría crear un índice como:

```sql
CREATE INDEX IX_pagos_fecha_pago
ON pagos(fecha_pago);