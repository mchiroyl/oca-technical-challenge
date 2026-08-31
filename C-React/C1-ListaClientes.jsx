/*
C1 · El listado no se actualiza

Causa:
El useEffect tiene un arreglo de dependencias vacío ([]),
por lo que la petición solamente se ejecuta cuando el
componente se monta.

Corrección:
Agregar filtro al arreglo de dependencias para que el efecto
vuelva a ejecutarse cada vez que cambie esa prop.
*/

import { useEffect, useState } from 'react';
import axios from 'axios';

function ListaClientes({ filtro }) {
  const [clientes, setClientes] = useState([]);

  useEffect(() => {
    axios.get(`/api/clientes?filtro=${filtro}`).then((res) => {
      setClientes(res.data);
    });
  }, [filtro]);

  return (
    <ul>
      {clientes.map((c) => (
        <li key={c.id}>{c.nombre}</li>
      ))}
    </ul>
  );
}

export default ListaClientes;