/*
C2 · Slice de Redux Toolkit

Se crea pagosSlice con un thunk asíncrono fetchPagos(clienteId).

El thunk consulta:
GET /pagos?cliente_id=

Se manejan los estados:
- carga
- éxito
- error
*/

import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import axios from 'axios';

export const fetchPagos = createAsyncThunk(
  'pagos/fetchPagos',
  async (clienteId, { rejectWithValue }) => {
    try {
      const response = await axios.get(
        `/pagos?cliente_id=${encodeURIComponent(clienteId)}`
      );

      return response.data;
    } catch (error) {
      return rejectWithValue(
        error.response?.data?.message || 'Error al obtener los pagos.'
      );
    }
  }
);

const initialState = {
  pagos: [],
  loading: false,
  error: null
};

const pagosSlice = createSlice({
  name: 'pagos',

  initialState,

  reducers: {},

  extraReducers: (builder) => {
    builder

      .addCase(fetchPagos.pending, (state) => {
        state.loading = true;
        state.error = null;
      })

      .addCase(fetchPagos.fulfilled, (state, action) => {
        state.loading = false;
        state.pagos = action.payload;
        state.error = null;
      })

      .addCase(fetchPagos.rejected, (state, action) => {
        state.loading = false;
        state.error = action.payload || action.error.message;
      });
  }
});

export default pagosSlice.reducer;

