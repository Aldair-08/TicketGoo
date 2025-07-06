<script>
    // ========================================
    // FUNCIONES PRINCIPALES DE LA APLICACIÓN
    // ========================================

    // Agregar tickets y promoción al resumen
    document.getElementById('agregarBtn').addEventListener('click', function() {
        const resumenLista = document.getElementById('resumen-lista');
        resumenLista.innerHTML = '';
        let total = 0;

        // Procesar entradas
        document.querySelectorAll('.entrada-item').forEach(function(item) {
            const tipo = item.getAttribute('data-tipo');
            const precio = parseFloat(item.getAttribute('data-precio'));
            const cantidadInput = item.querySelector('.cantidad-input');
            const cantidad = parseInt(cantidadInput.value) || 0;

            if (cantidad > 0) {
                const subtotal = cantidad * precio;
                total += subtotal;
                const li = document.createElement('li');
                li.className = "flex justify-between items-center border-b py-1 text-sm gap-2";
                li.innerHTML = `<span>${cantidad} TICKET ${tipo}</span><span>S/. ${subtotal.toFixed(2)}</span>
                    <button type="button" class="text-red-500 hover:underline eliminar-resumen">Eliminar</button>`;
                li.inputRef = cantidadInput;
                resumenLista.appendChild(li);
            }
        });

        // Procesar promoción seleccionada
        const promoSeleccionada = document.querySelector('input[name="promo_seleccionada"]:checked');
        if (promoSeleccionada) {
            const promoItem = promoSeleccionada.closest('.promo-item');
            const promoNombre = promoItem.getAttribute('data-nombre');
            const promoPrecio = parseFloat(promoItem.getAttribute('data-precio')) || 0;
            if (promoPrecio > 0) {
                total += promoPrecio;
                const li = document.createElement('li');
                li.className = "flex justify-between items-center border-b py-1 text-sm gap-2";
                li.innerHTML = `<span>PROMOCIÓN: ${promoNombre}</span><span>S/. ${promoPrecio.toFixed(2)}</span>
                    <button type="button" class="text-red-500 hover:underline eliminar-resumen">Eliminar</button>`;
                resumenLista.appendChild(li);
            }
        }

        document.getElementById('total-monto').textContent = total.toFixed(2);

        // Configurar botones eliminar
        configurarBotonesEliminar();
    });

    // ========================================
    // NAVEGACIÓN ENTRE SECCIONES
    // ========================================

    // Pasar a datos de compra
    document.getElementById('continuarBtn').addEventListener('click', function() {
        document.getElementById('seccion-tickets').classList.add('hidden');
        document.getElementById('seccion-datos-compra').classList.remove('hidden');
        document.getElementById('resumen-lista-final').innerHTML = document.getElementById('resumen-lista').innerHTML;
        actualizarResumenFinal();

        // Configurar botones eliminar en resumen final
        document.querySelectorAll('#resumen-lista-final .eliminar-resumen').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const li = this.closest('li');
                li.remove();
                actualizarResumenFinal();
            });
        });
    });

    // Botón volver: regresa a la página anterior
    document.getElementById('volverBtn').addEventListener('click', function() {
        window.history.back();
    });

    // Botón volver en sección de datos de compra: regresa a selección de tickets
    document.getElementById('volverDatosBtn').addEventListener('click', function() {
        document.getElementById('seccion-datos-compra').classList.add('hidden');
        document.getElementById('seccion-tickets').classList.remove('hidden');
    });

    // ========================================
    // CÁLCULOS Y ACTUALIZACIONES
    // ========================================

    // Actualizar total si cambia el tipo de entrega
    document.querySelectorAll('input[name="entrega"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            actualizarResumenFinal();
        });
    });

    // Actualizar resumen final y total
    function actualizarResumenFinal() {
        let total = 0;
        document.querySelectorAll('#resumen-lista-final li').forEach(function(item) {
            const monto = item.querySelector('span:nth-child(2)');
            if (monto) {
                total += parseFloat(monto.textContent.replace('S/.', '').trim());
            }
        });
        const retiroTienda = document.querySelector('input[name="entrega"]:checked')?.value === 'tienda';
        if (retiroTienda) {
            total += 10;
        }
        document.getElementById('total-monto-final').textContent = total.toFixed(2);
    }

    // Configurar botones eliminar
    function configurarBotonesEliminar() {
        document.querySelectorAll('.eliminar-resumen').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const li = this.closest('li');
                if (li.inputRef) {
                    li.inputRef.value = 0;
                }
                li.remove();
                // Recalcular el total después de eliminar
                let nuevoTotal = 0;
                document.querySelectorAll('#resumen-lista li').forEach(function(item) {
                    const monto = item.querySelector('span:nth-child(2)');
                    if (monto) {
                        nuevoTotal += parseFloat(monto.textContent.replace('S/.', '').trim());
                    }
                });
                document.getElementById('total-monto').textContent = nuevoTotal.toFixed(2);
            });
        });
    }

    // ========================================
    // MODALES DE PAGO
    // ========================================

    // Mostrar modal de pago según método
    document.getElementById('continuarconfirmadoBtn').addEventListener('click', function(event) {
        const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
        if (metodo === 'nibiz') {
            event.preventDefault();
            document.getElementById('modal-nibiz').classList.remove('hidden');
            document.getElementById('monto-nibiz').textContent = document.getElementById('total-monto-final').textContent;
        } else if (metodo === 'yape') {
            event.preventDefault();
            document.getElementById('modal-yape').classList.remove('hidden');
            document.getElementById('monto-yape').textContent = document.getElementById('total-monto-final').textContent;
        }
    });

    // Botón pagar NIBIZ
    document.getElementById('pagarNibizBtn').addEventListener('click', function() {
        document.getElementById('modal-nibiz').classList.add('hidden');
        mostrarAnimacionCarga();
        procesarCompraConAnimacion(mostrarConfirmacion);
    });

    // Botón pagar YAPE
    document.getElementById('pagarYapeBtn').addEventListener('click', function() {
        document.getElementById('modal-yape').classList.add('hidden');
        mostrarAnimacionCarga();
        procesarCompraConAnimacion(mostrarConfirmacion);
    });

    // ========================================
    // FUNCIONES DE CIERRE DE MODALES
    // ========================================

    // Cerrar modal NIBIZ
    function cerrarModalNibiz() {
        document.getElementById('modal-nibiz').classList.add('hidden');
    }

    // Cerrar modal YAPE
    function cerrarModalYape() {
        document.getElementById('modal-yape').classList.add('hidden');
    }

    // Cerrar confirmación (opcional)
    function cerrarModal() {
        document.getElementById('seccion-confirmado').classList.add('hidden');
    }

    // ========================================
    // PROCESAMIENTO DE COMPRA
    // ========================================

    // Función para procesar la compra en el backend
    function procesarCompra(callback) {
        // Construir objeto de entradas seleccionadas
        let entradas = {};
        document.querySelectorAll('.entrada-item').forEach(function(item) {
            const id = item.getAttribute('data-id');
            const cantidad = parseInt(item.querySelector('.cantidad-input').value) || 0;
            if (cantidad > 0) {
                entradas[id] = cantidad;
            }
        });

        fetch('/comprar/procesar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    entradas
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Marcar la compra como pagada
                    marcarComoPagado(data.compra_id, callback);
                } else {
                    alert(data.message || 'Error al procesar la compra');
                }
            })
            .catch(() => alert('Error al conectar con el servidor'));
    }

    // Función para marcar la compra como pagada
    function marcarComoPagado(compraId, callback) {
        // Obtener método de pago seleccionado
        const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
        let metodoPago = metodo === 'nibiz' ? 'NIBIZ' : 'YAPE';
        let datosPago = {};
        
        if (metodo === 'nibiz') {
            const nombre = document.getElementById('nibiz-nombre').value;
            const apellido = document.getElementById('nibiz-apellido').value;
            const email = document.getElementById('nibiz-email').value;
            datosPago = {
                nombre: nombre,
                apellido: apellido,
                email: email
            };
        } else {
            const celular = document.getElementById('yape-celular').value;
            datosPago = {
                celular: celular
            };
        }

        fetch('/pago', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    compra_id: compraId,
                    metodo_pago: metodoPago,
                    datos_pago: datosPago
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    callback();
                } else {
                    alert('Error al confirmar el pago');
                }
            })
            .catch(() => {
                ocultarAnimacionCarga();
                alert('Error al conectar con el servidor');
            });
    }

    // ========================================
    // ANIMACIÓN DE CARGA
    // ========================================

    // Mostrar animación de carga
    function mostrarAnimacionCarga() {
        document.getElementById('modal-carga').classList.remove('hidden');
        iniciarProgreso();
    }

    // Ocultar animación de carga
    function ocultarAnimacionCarga() {
        document.getElementById('modal-carga').classList.add('hidden');
        resetearProgreso();
        
        // Limpiar mensaje de éxito si existe
        const mensajeExito = document.getElementById('mensaje-exito');
        if (mensajeExito) {
            mensajeExito.remove();
        }
        
        // Resetear barra de progreso
        const barra = document.getElementById('barra-progreso');
        barra.classList.remove('bg-green-600');
    }

    // Iniciar progreso de la animación
    function iniciarProgreso() {
        const barra = document.getElementById('barra-progreso');
        const mensajes = ['mensaje-1', 'mensaje-2', 'mensaje-3', 'mensaje-4'];
        let paso = 0;

        // Función para actualizar progreso
        function actualizarProgreso() {
            if (paso < 4) {
                // Actualizar barra de progreso
                const porcentaje = ((paso + 1) / 4) * 100;
                barra.style.width = porcentaje + '%';

                // Actualizar mensajes
                mensajes.forEach((mensajeId, index) => {
                    const mensaje = document.getElementById(mensajeId);
                    if (index <= paso) {
                        mensaje.classList.remove('opacity-50');
                        mensaje.classList.add('opacity-100');
                        
                        if (index < paso) {
                            // Completado
                            mensaje.innerHTML = mensaje.innerHTML.replace('⏳', '✓');
                            mensaje.classList.add('completado');
                            mensaje.classList.remove('activo');
                        } else if (index === paso) {
                            // Activo
                            mensaje.classList.add('activo');
                            mensaje.classList.remove('completado');
                        }
                    }
                });

                paso++;
                
                // Continuar con el siguiente paso después de un delay
                setTimeout(actualizarProgreso, 800);
            }
        }

        // Iniciar progreso
        setTimeout(actualizarProgreso, 500);
    }

    // Resetear progreso
    function resetearProgreso() {
        const barra = document.getElementById('barra-progreso');
        const mensajes = ['mensaje-1', 'mensaje-2', 'mensaje-3', 'mensaje-4'];
        
        barra.style.width = '0%';
        
        mensajes.forEach((mensajeId, index) => {
            const mensaje = document.getElementById(mensajeId);
            mensaje.classList.remove('opacity-100', 'completado', 'activo');
            mensaje.classList.add('opacity-50');
            
            // Resetear iconos
            if (index === 0) {
                mensaje.innerHTML = '✓ Validando datos de pago';
            } else {
                mensaje.innerHTML = mensaje.innerHTML.replace('✓', '⏳');
            }
        });
    }

    // Mostrar mensaje de éxito
    function mostrarMensajeExito() {
        const mensajesProgreso = document.getElementById('mensajes-progreso');
        const mensajeExito = document.createElement('div');
        mensajeExito.id = 'mensaje-exito';
        mensajeExito.className = 'progreso-mensaje completado animate-fade-in';
        mensajeExito.innerHTML = '🎉 ¡Pago exitoso! Tu boleta ha sido enviada a tu correo';
        mensajeExito.style.fontWeight = 'bold';
        mensajeExito.style.fontSize = '14px';
        mensajeExito.style.marginTop = '10px';
        
        mensajesProgreso.appendChild(mensajeExito);
        
        // Completar la barra de progreso
        const barra = document.getElementById('barra-progreso');
        barra.style.width = '100%';
        barra.classList.add('bg-green-600');
    }

    // Procesar compra con animación
    function procesarCompraConAnimacion(callback) {
        // Construir objeto de entradas seleccionadas
        let entradas = {};
        document.querySelectorAll('.entrada-item').forEach(function(item) {
            const id = item.getAttribute('data-id');
            const cantidad = parseInt(item.querySelector('.cantidad-input').value) || 0;
            if (cantidad > 0) {
                entradas[id] = cantidad;
            }
        });

        fetch('/comprar/procesar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    entradas
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Marcar la compra como pagada con animación
                    marcarComoPagadoConAnimacion(data.compra_id, callback);
                } else {
                    ocultarAnimacionCarga();
                    alert(data.message || 'Error al procesar la compra');
                }
            })
            .catch(() => {
                ocultarAnimacionCarga();
                alert('Error al conectar con el servidor');
            });
    }

    // Marcar como pagado con animación
    function marcarComoPagadoConAnimacion(compraId, callback) {
        // Obtener método de pago seleccionado
        const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
        let metodoPago = metodo === 'nibiz' ? 'NIBIZ' : 'YAPE';
        let datosPago = {};
        
        if (metodo === 'nibiz') {
            const nombre = document.getElementById('nibiz-nombre').value;
            const apellido = document.getElementById('nibiz-apellido').value;
            const email = document.getElementById('nibiz-email').value;
            datosPago = {
                nombre: nombre,
                apellido: apellido,
                email: email
            };
        } else {
            const celular = document.getElementById('yape-celular').value;
            datosPago = {
                celular: celular
            };
        }

        fetch('/pago', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    compra_id: compraId,
                    metodo_pago: metodoPago,
                    datos_pago: datosPago
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de éxito
                    mostrarMensajeExito();
                    
                    // Completar animación antes de mostrar confirmación
                    setTimeout(() => {
                        ocultarAnimacionCarga();
                        callback();
                    }, 2000);
                } else {
                    ocultarAnimacionCarga();
                    alert('Error al confirmar el pago');
                }
            })
            .catch(() => {
                ocultarAnimacionCarga();
                alert('Error al conectar con el servidor');
            });
    }

    // ========================================
    // CONFIRMACIÓN Y BOLETA
    // ========================================

    // Mostrar sección de confirmación
    function mostrarConfirmacion() {
        document.getElementById('seccion-datos-compra').classList.add('hidden');
        document.getElementById('seccion-confirmado').classList.remove('hidden');
        
        // Quitar los botones "Eliminar" del resumen antes de mostrarlo en la boleta
        let resumenHtml = document.getElementById('resumen-lista-final').innerHTML;
        resumenHtml = resumenHtml.replace(/<button[^>]*eliminar-resumen[^>]*>.*?<\/button>/gi, '');
        document.getElementById('resumen-lista-confirmado').innerHTML = resumenHtml;
        document.getElementById('total-monto-confirmado').textContent = document.getElementById('total-monto-final').textContent;

        // Mostrar método de pago seleccionado y datos del comprador
        mostrarDatosPago();
        
        // Mostrar detalles del evento
        mostrarDetallesEvento();
        
        // Mostrar fecha de pago
        mostrarFechaPago();
    }

    // Mostrar datos de pago según método seleccionado
    function mostrarDatosPago() {
        const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
        let metodoHtml = '';
        let datosCompradorHtml = '';

        if (metodo === 'nibiz') {
            metodoHtml = `<img src="{{ asset('images/nibiz.png') }}" alt="NIBIZ" class="h-6 inline"> <span class="font-semibold">NIBIZ</span>`;
            const nombre = document.getElementById('nibiz-nombre').value;
            const apellido = document.getElementById('nibiz-apellido').value;
            const email = document.getElementById('nibiz-email').value;
            datosCompradorHtml = `
                <div class="mb-2"><span class="font-semibold">Nombre:</span> ${nombre} ${apellido}</div>
                <div class="mb-2"><span class="font-semibold">Email:</span> ${email}</div>`;
        } else if (metodo === 'yape') {
            metodoHtml = `<img src="{{ asset('images/yape.png') }}" alt="Yape" class="h-6 inline"> <span class="font-semibold">Yape</span>`;
            const celular = document.getElementById('yape-celular').value;
            datosCompradorHtml = `<div class="mb-2"><span class="font-semibold">Celular Yape:</span> ${celular}</div>`;
        }
        
        document.getElementById('metodo-pago-confirmado').innerHTML = metodoHtml;
        document.getElementById('datos-comprador-confirmado').innerHTML = datosCompradorHtml;
    }

    // Mostrar detalles del evento en la confirmación
    function mostrarDetallesEvento() {
        document.getElementById('detalles-evento-confirmado').innerHTML = `
            <div class="mb-2"><span class="font-semibold">Nombre de cuenta:</span> {{ Auth::user()->name }}</div>
            <div class="mb-2"><span class="font-semibold">DNI:</span> {{ Auth::user()->dni }}</div>
            <div class="mb-2"><span class="font-semibold">Correo:</span> {{ Auth::user()->email }}</div>
            <div class="mb-2"><span class="font-semibold">Evento:</span> {{ strtoupper($evento->nombre) }}</div>
            <div class="mb-2"><span class="font-semibold">Fecha:</span> {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}</div>
            <div class="mb-2"><span class="font-semibold">Ubicación:</span> {{ $evento->ubicacion }}</div>`;
    }

    // Mostrar fecha de pago en la confirmación
    function mostrarFechaPago() {
        const ahora = new Date();
        const opciones = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit',
            timeZone: 'America/Lima'
        };
        const fechaPago = ahora.toLocaleDateString('es-ES', opciones);
        document.getElementById('fecha-pago-confirmado').textContent = fechaPago;
    }

    // ========================================
    // DESCARGAR BOLETA PDF
    // ========================================

    document.getElementById('descargarBoletoBtn').addEventListener('click', function(e) {
        e.preventDefault();

        // Prepara los datos para el PDF
        const nombreCuenta = "{{ Auth::user()->name }}";
        const dni = "{{ Auth::user()->dni }}";
        const correo = "{{ Auth::user()->email }}";
        const evento = "{{ strtoupper($evento->nombre) }}";
        const fecha = "{{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}";
        const ubicacion = "{{ $evento->ubicacion }}";
        
        // Obtener fecha de pago actual
        const ahora = new Date();
        const opciones = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit',
            timeZone: 'America/Lima'
        };
        const fechaPago = ahora.toLocaleDateString('es-ES', opciones);
        const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
        let metodoPago = metodo === 'nibiz' ? 'NIBIZ' : 'YAPE';
        let datosPago = '';
        
        if (metodo === 'nibiz') {
            const nombre = document.getElementById('nibiz-nombre').value;
            const apellido = document.getElementById('nibiz-apellido').value;
            const email = document.getElementById('nibiz-email').value;
            datosPago = `<div><span class="label">Nombre:</span> ${nombre} ${apellido}</div>
                 <div><span class="label">Email:</span> ${email}</div>`;
        } else {
            const celular = document.getElementById('yape-celular').value;
            datosPago = `<div><span class="label">Celular Yape:</span> ${celular}</div>`;
        }

        // Procesar entradas
        let entradas = [];
        document.querySelectorAll('#resumen-lista-confirmado li').forEach(function(item) {
            const texto = item.querySelector('span:first-child').textContent;
            const cantidad = parseInt(texto);
            const tipo = texto.replace(/^\d+\s/, '');
            const subtotal = parseFloat(item.querySelector('span:nth-child(2)').textContent.replace('S/.', '').trim());
            entradas.push({
                cantidad,
                tipo,
                subtotal
            });
        });

        const total = parseFloat(document.getElementById('total-monto-confirmado').textContent);

        // Enviar datos al backend y descargar PDF
        fetch('/comprar/boleta', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    nombre_cuenta: nombreCuenta,
                    dni: dni,
                    correo: correo,
                    evento: evento,
                    fecha: fecha,
                    ubicacion: ubicacion,
                    entradas: entradas,
                    total: total,
                    metodo_pago: metodoPago,
                    datos_pago: datosPago,
                    fecha_pago: fechaPago
                })
            })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'boleta_ticketgo.pdf';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            });
    });
</script> 