# Reto Técnico OCA

Solución de los ejercicios correspondientes al Reto Técnico del proceso de selección de OCA.

## Estructura

### A · PHP / Backend — 35 pts

- `A-PHP/A1-login-seguro.php`
  - Corrección de vulnerabilidades de seguridad en login.
  - Consulta parametrizada.
  - Verificación segura de contraseña.
  - Manejo seguro de errores.

- `A-PHP/A2-registrar-pago.php`
  - Registro de pagos utilizando transacción.
  - Validación de monto mayor a cero.
  - `prepare`, `execute`, `beginTransaction`, `commit`, `rollBack` y `lastInsertId`.

- `A-PHP/A3-dias-mora.php`
  - Corrección del cálculo de días de mora.
  - Validación de fechas.
  - Manejo de pagos realizados antes o el mismo día del vencimiento.

### B · Bases de datos — 25 pts

- `B-SQL/B1-top-clientes.sql`
  - Consulta T-SQL para obtener los 5 clientes con mayor total pagado en los últimos 90 días.

- `B-SQL/B2-paginacion-tsql.sql`
  - Traducción de paginación MySQL a T-SQL para SQL Server.

- `B-SQL/B3-rendimiento.md`
  - Estrategia ordenada para diagnosticar y optimizar una consulta lenta sobre `fecha_pago`.

### C · Frontend / React — 30 pts

- `C-React/C1-ListaClientes.jsx`
  - Corrección del `useEffect` para actualizar el listado cuando cambia `filtro`.

- `C-React/C2-pagosSlice.js`
  - `pagosSlice` con `fetchPagos(clienteId)`.
  - Estados de carga, éxito y error.

- `C-React/C3-axiosInterceptors.js`
  - Interceptor para agregar JWT.
  - Manejo de respuestas HTTP 401.

### D · Bonus — Node.js / Socket.IO — 10 pts

- `D-SocketIO/server.js`
  - Servidor Socket.IO.
  - Una sala por `clienteId`.
  - Evento `pago:registrado` enviado únicamente a la sala correspondiente.

## Validaciones realizadas

- Sintaxis PHP verificada con `php -l`.
- Consultas B1 y B2 ejecutadas en SQL Server.
- Cálculo de días de mora probado con diferentes fechas.
- Servidor Socket.IO ejecutado correctamente.
- Aislamiento de salas Socket.IO probado con dos clientes diferentes.

## Puntaje cubierto

- A · PHP / Backend: 35 pts
- B · Bases de datos: 25 pts
- C · Frontend / React: 30 pts
- D · Bonus Socket.IO: 10 pts

**Total disponible cubierto: 100 pts**