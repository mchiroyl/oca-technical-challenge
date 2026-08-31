/*
D1 · Notificación por sala

Cada socket se conecta indicando su clienteId.
El socket se une a una sala identificada por ese clienteId.

Cuando se registra un pago, pago:registrado se emite
únicamente a los sockets pertenecientes a la sala
del cliente correspondiente.
*/

const { Server } = require('socket.io');

const io = new Server(3001);

io.on('connection', (socket) => {
  const clienteId = socket.handshake.auth.clienteId;

  if (!clienteId) {
    socket.disconnect(true);
    return;
  }

  const sala = String(clienteId);

  socket.join(sala);

  console.log(
    `Socket ${socket.id} unido a la sala del cliente ${clienteId}`
  );
});

function notificarPagoRegistrado(clienteId, pago) {
  const sala = String(clienteId);

  io.to(sala).emit('pago:registrado', pago);
}

console.log('Servidor Socket.IO escuchando en el puerto 3001');

module.exports = {
  io,
  notificarPagoRegistrado
};