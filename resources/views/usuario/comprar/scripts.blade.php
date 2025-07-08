<script>
    // ========================================
    // FUNCIONES PRINCIPALES DE LA APLICACIÓN
    // ========================================

    // Variable para controlar si se ha agregado algo al resumen
    let resumenAgregado = false;

    // Función para verificar si hay elementos seleccionados
    function verificarSeleccion() {
        let hayEntradas = false;
        let hayPromocion = false;

        // Verificar si hay entradas seleccionadas
        document.querySelectorAll('.cantidad-input').forEach(function(input) {
            if (parseInt(input.value) > 0) {
                hayEntradas = true;
            }
        });

        // Verificar si hay promoción seleccionada
        const promoSeleccionada = document.querySelector('input[name="promo_seleccionada"]:checked');
        if (promoSeleccionada) {
            hayPromocion = true;
        }

        // Habilitar/deshabilitar botón Agregar
        const agregarBtn = document.getElementById('agregarBtn');
        if (hayEntradas || hayPromocion) {
            agregarBtn.disabled = false;
            agregarBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            agregarBtn.classList.add('hover:bg-yellow-300');
        } else {
            agregarBtn.disabled = true;
            agregarBtn.classList.add('opacity-50', 'cursor-not-allowed');
            agregarBtn.classList.remove('hover:bg-yellow-300');
        }
    }

    // Agregar event listeners para verificar selección
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar cambios en inputs de cantidad
        document.querySelectorAll('.cantidad-input').forEach(function(input) {
            input.addEventListener('input', verificarSeleccion);
        });

        // Verificar cambios en promociones
        document.querySelectorAll('input[name="promo_seleccionada"]').forEach(function(radio) {
            radio.addEventListener('change', verificarSeleccion);
        });

        // Verificar estado inicial
        verificarSeleccion();
    });

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

        // Marcar que se ha agregado algo al resumen
        resumenAgregado = true;

        // Habilitar botón continuar
        const continuarBtn = document.getElementById('continuarBtn');
        continuarBtn.disabled = false;
        continuarBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        continuarBtn.classList.add('hover:bg-blue-600');

        // Ocultar mensaje de instrucciones
        const mensajeInstrucciones = document.getElementById('mensaje-instrucciones');
        if (mensajeInstrucciones) {
            mensajeInstrucciones.style.display = 'none';
        }

        // Mostrar mensaje de éxito flotante
        const mensajeExito = document.getElementById('mensaje-exito');
        if (mensajeExito) {
            // Mostrar el mensaje completamente
            mensajeExito.classList.remove('opacity-0', 'invisible');
            mensajeExito.classList.add('opacity-100', 'visible');
            
            // Ocultar mensaje de éxito después de 4 segundos
            setTimeout(() => {
                ocultarMensajeExito();
            }, 4000);
        }

        // Configurar botones eliminar
        configurarBotonesEliminar();
    });

    // ========================================
    // VALIDACIONES DEL FORMULARIO NIBIZ
    // ========================================

    // Función para formatear número de tarjeta (16 dígitos separados cada 4)
    function formatearNumeroTarjeta(input) {
        let valor = input.value.replace(/\D/g, ''); // Solo números
        valor = valor.replace(/(\d{4})(?=\d)/g, '$1 '); // Agregar espacios cada 4 dígitos
        input.value = valor;
    }

    // Función para formatear fecha MM/AA
    function formatearFecha(input) {
        let valor = input.value.replace(/\D/g, ''); // Solo números
        if (valor.length >= 2) {
            valor = valor.substring(0, 2) + '/' + valor.substring(2, 4);
        }
        input.value = valor;
    }

    // Función para validar solo letras en nombre y apellido
    function validarSoloLetras(input) {
        input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
    }

    // Función para validar CVV (solo 3 números)
    function validarCVV(input) {
        input.value = input.value.replace(/\D/g, '').substring(0, 3);
    }

    // Función para formatear celular YAPE (9 dígitos separados cada 3, debe empezar con 9)
    function formatearCelularYape(input) {
        let valor = input.value.replace(/\D/g, ''); // Solo números
        
        // Si el valor está vacío, permitir que se borre completamente
        if (valor.length === 0) {
            input.value = '';
            return;
        }
        
        // Verificar que empiece con 9 solo si hay contenido
        if (valor.length > 0 && valor[0] !== '9') {
            valor = '9' + valor.substring(1);
        }
        
        // Limitar a 9 dígitos
        valor = valor.substring(0, 9);
        
        // Formatear con espacios cada 3 dígitos solo si hay suficientes dígitos
        if (valor.length >= 6) {
            valor = valor.substring(0, 3) + ' ' + valor.substring(3, 6) + ' ' + valor.substring(6, 9);
        } else if (valor.length >= 3) {
            valor = valor.substring(0, 3) + ' ' + valor.substring(3, 6);
        }
        
        input.value = valor;
    }

    // Función para validar código de aprobación YAPE (solo números, máximo 10)
    function validarCodigoYape(input) {
        input.value = input.value.replace(/\D/g, '').substring(0, 10);
    }

    // Función para validar todos los campos del formulario NIBIZ
    function validarFormularioNibiz() {
        const numeroTarjeta = document.getElementById('nibiz-numero-tarjeta').value.replace(/\s/g, '');
        const fecha = document.getElementById('nibiz-fecha').value;
        const cvv = document.getElementById('nibiz-cvv').value;
        const nombre = document.getElementById('nibiz-nombre').value.trim();
        const apellido = document.getElementById('nibiz-apellido').value.trim();
        const email = document.getElementById('nibiz-email').value.trim();

        let errores = [];

        // Validar número de tarjeta (16 dígitos)
        if (numeroTarjeta.length !== 16) {
            errores.push('El número de tarjeta debe tener 16 dígitos');
        }

        // Validar fecha (formato MM/AA)
        if (!/^\d{2}\/\d{2}$/.test(fecha)) {
            errores.push('La fecha debe tener el formato MM/AA');
        } else {
            const mes = parseInt(fecha.substring(0, 2));
            const año = parseInt(fecha.substring(3, 5));
            if (mes < 1 || mes > 12) {
                errores.push('El mes debe estar entre 01 y 12');
            }
            const añoActual = new Date().getFullYear() % 100;
            if (año < añoActual) {
                errores.push('La tarjeta ha expirado');
            }
        }

        // Validar CVV (3 dígitos)
        if (cvv.length !== 3) {
            errores.push('El CVV debe tener 3 dígitos');
        }

        // Validar nombre (solo letras, mínimo 2 caracteres)
        if (nombre.length < 2) {
            errores.push('Ingrese el nombre correcto');
        }

        // Validar apellido (solo letras, mínimo 2 caracteres)
        if (apellido.length < 2) {
            errores.push('Ingrese el apellido correcto');
        }

        // Validar email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errores.push('Ingrese un email válido');
        }

        return errores;
    }

    // Función para validar todos los campos del formulario YAPE
    function validarFormularioYape() {
        const celular = document.getElementById('yape-celular').value.replace(/\s/g, '');
        const codigo = document.getElementById('yape-codigo').value.trim();

        let errores = [];

        // Validar celular (9 dígitos, debe empezar con 9)
        if (celular.length !== 9) {
            errores.push('El número de celular debe tener 9 dígitos');
        } else if (celular[0] !== '9') {
            errores.push('El número de celular debe empezar con 9');
        }

        // Validar código de aprobación (mínimo 1 dígito, máximo 10)
        if (codigo.length === 0) {
            errores.push('Ingrese el código de aprobación generado en yape');
        } else if (codigo.length > 10) {
            errores.push('El código de aprobación no puede tener más de 10 dígitos');
        }

        return errores;
    }

    // Función para mostrar errores de validación como mensaje flotante
    function mostrarErrores(errores) {
        const mensajeError = document.getElementById('mensaje-error');
        const listaErrores = document.getElementById('lista-errores');
        
        if (mensajeError && listaErrores) {
            // Crear lista de errores con números
            let erroresHtml = '';
            errores.forEach((error, index) => {
                erroresHtml += `<div class="mb-1">${index + 1}. ${error}</div>`;
            });
            
            // Insertar errores en el mensaje
            listaErrores.innerHTML = erroresHtml;
            
            // Mostrar el mensaje
            mensajeError.classList.remove('opacity-0', 'invisible');
            mensajeError.classList.add('opacity-100', 'visible');
            
            // Ocultar mensaje después de 6 segundos (más tiempo para leer errores)
            setTimeout(() => {
                ocultarMensajeError();
            }, 6000);
        }
    }

    // Función para ocultar mensaje de error
    function ocultarMensajeError() {
        const mensajeError = document.getElementById('mensaje-error');
        if (mensajeError) {
            mensajeError.classList.remove('opacity-100', 'visible');
            mensajeError.classList.add('opacity-0', 'invisible');
        }
    }

    // Event listeners para validaciones en tiempo real
    document.addEventListener('DOMContentLoaded', function() {
        // Número de tarjeta
        const numeroTarjetaInput = document.getElementById('nibiz-numero-tarjeta');
        if (numeroTarjetaInput) {
            numeroTarjetaInput.addEventListener('input', function() {
                formatearNumeroTarjeta(this);
            });
        }

        // Fecha
        const fechaInput = document.getElementById('nibiz-fecha');
        if (fechaInput) {
            fechaInput.addEventListener('input', function() {
                formatearFecha(this);
            });
        }

        // CVV
        const cvvInput = document.getElementById('nibiz-cvv');
        if (cvvInput) {
            cvvInput.addEventListener('input', function() {
                validarCVV(this);
            });
        }

        // Nombre
        const nombreInput = document.getElementById('nibiz-nombre');
        if (nombreInput) {
            nombreInput.addEventListener('input', function() {
                validarSoloLetras(this);
            });
        }

        // Apellido
        const apellidoInput = document.getElementById('nibiz-apellido');
        if (apellidoInput) {
            apellidoInput.addEventListener('input', function() {
                validarSoloLetras(this);
            });
        }

        // Número de celular YAPE
        const celularInput = document.getElementById('yape-celular');
        if (celularInput) {
            let valorAnterior = '';
            celularInput.addEventListener('input', function() {
                const valorActual = this.value;
                
                // Si el valor actual es más corto que el anterior, probablemente está borrando
                if (valorActual.length < valorAnterior.length) {
                    // Permitir el borrado sin formateo inmediato
                    valorAnterior = valorActual;
                    return;
                }
                
                formatearCelularYape(this);
                valorAnterior = this.value;
            });
        }

        // Código de aprobación YAPE
        const codigoInput = document.getElementById('yape-codigo');
        if (codigoInput) {
            codigoInput.addEventListener('input', function() {
                validarCodigoYape(this);
            });
        }
    });

    // ========================================
    // FUNCIONES DEL MENSAJE FLOTANTE
    // ========================================

    // Función para ocultar mensaje de éxito
    function ocultarMensajeExito() {
        const mensajeExito = document.getElementById('mensaje-exito');
        if (mensajeExito) {
            mensajeExito.classList.remove('opacity-100', 'visible');
            mensajeExito.classList.add('opacity-0', 'invisible');
        }
    }

    // Event listeners para cerrar mensajes manualmente
    document.addEventListener('DOMContentLoaded', function() {
        const cerrarMensajeBtn = document.getElementById('cerrar-mensaje');
        if (cerrarMensajeBtn) {
            cerrarMensajeBtn.addEventListener('click', ocultarMensajeExito);
        }

        const cerrarMensajeErrorBtn = document.getElementById('cerrar-mensaje-error');
        if (cerrarMensajeErrorBtn) {
            cerrarMensajeErrorBtn.addEventListener('click', ocultarMensajeError);
        }
    });

    // ========================================
    // NAVEGACIÓN ENTRE SECCIONES
    // ========================================

    // Pasar a datos de compra
    document.getElementById('continuarBtn').addEventListener('click', function() {
        // Verificar que se haya agregado algo al resumen
        if (!resumenAgregado) {
            alert('Debes seleccionar entradas o promociones y presionar "Agregar" antes de continuar.');
            return;
        }

        // Verificar que haya elementos en el resumen
        const elementosResumen = document.querySelectorAll('#resumen-lista li');
        if (elementosResumen.length === 0) {
            alert('Debes seleccionar entradas o promociones y presionar "Agregar" antes de continuar.');
            return;
        }

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

                // Verificar si quedan elementos en el resumen
                const elementosResumen = document.querySelectorAll('#resumen-lista li');
                if (elementosResumen.length === 0) {
                    // Si no quedan elementos, deshabilitar botón continuar
                    resumenAgregado = false;
                    const continuarBtn = document.getElementById('continuarBtn');
                    continuarBtn.disabled = true;
                    continuarBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    continuarBtn.classList.remove('hover:bg-blue-600');

                    // Mostrar mensaje de instrucciones nuevamente
                    const mensajeInstrucciones = document.getElementById('mensaje-instrucciones');
                    if (mensajeInstrucciones) {
                        mensajeInstrucciones.style.display = 'block';
                    }

                    // Ocultar mensaje de éxito
                    ocultarMensajeExito();
                }
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
        // Validar formulario antes de procesar
        const errores = validarFormularioNibiz();
        
        if (errores.length > 0) {
            mostrarErrores(errores);
            return; // No continuar si hay errores
        }

        // Si no hay errores, proceder con el pago
        document.getElementById('modal-nibiz').classList.add('hidden');
        mostrarAnimacionCarga();
        procesarCompraConAnimacion(mostrarConfirmacion);
    });

    // Botón pagar YAPE
    document.getElementById('pagarYapeBtn').addEventListener('click', function() {
        // Validar formulario antes de procesar
        const errores = validarFormularioYape();
        
        if (errores.length > 0) {
            mostrarErrores(errores);
            return; // No continuar si hay errores
        }

        // Si no hay errores, proceder con el pago
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

    // Cerrar confirmación y redirigir al dashboard
    function cerrarModal() {
        document.getElementById('seccion-confirmado').classList.add('hidden');
        // Redirigir al dashboard (página después de iniciar sesión)
        window.location.href = '/principallog';
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

        // Obtener promoción seleccionada
        const promoSeleccionada = document.querySelector('input[name="promo_seleccionada"]:checked');
        const promocionId = promoSeleccionada ? promoSeleccionada.value : null;

        // Obtener forma de entrega seleccionada
        const formaEntrega = document.querySelector('input[name="entrega"]:checked')?.value || 'correo';

        fetch('/comprar/procesar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    entradas,
                    promocion_id: promocionId,
                    forma_entrega: formaEntrega
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

        // Obtener promoción seleccionada
        const promoSeleccionada = document.querySelector('input[name="promo_seleccionada"]:checked');
        const promocionId = promoSeleccionada ? promoSeleccionada.value : null;

        // Obtener forma de entrega seleccionada
        const formaEntrega = document.querySelector('input[name="entrega"]:checked')?.value || 'correo';

        fetch('/comprar/procesar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    entradas,
                    promocion_id: promocionId,
                    forma_entrega: formaEntrega
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

        // Obtener datos adicionales para el email
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
        
        // Obtener forma de entrega
        const formaEntrega = document.querySelector('input[name="entrega"]:checked')?.value || 'correo';
        
        // Procesar entradas para el email
        let entradas = [];
        document.querySelectorAll('#resumen-lista-final li').forEach(function(item) {
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
        
        // Calcular totales
        const total = parseFloat(document.getElementById('total-monto-final').textContent);
        const subtotalEntradas = entradas.reduce((sum, entrada) => sum + entrada.subtotal, 0);
        const costoEntrega = formaEntrega === 'tienda' ? 10 : 0;

        fetch('/pago', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    compra_id: compraId,
                    metodo_pago: metodoPago,
                    datos_pago: datosPago,
                    // Datos adicionales para el email
                    nombre_cuenta: nombreCuenta,
                    dni: dni,
                    correo: correo,
                    evento: evento,
                    fecha: fecha,
                    ubicacion: ubicacion,
                    entradas: entradas,
                    subtotal_entradas: subtotalEntradas,
                    costo_entrega: costoEntrega,
                    total: total,
                    fecha_pago: fechaPago,
                    forma_entrega: formaEntrega
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
        
        // Mostrar forma de entrega
        mostrarFormaEntrega();
        
        // Mostrar desglose de costos
        mostrarDesgloseCostos();
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

    // Mostrar forma de entrega en la confirmación
    function mostrarFormaEntrega() {
        const formaEntrega = document.querySelector('input[name="entrega"]:checked')?.value || 'correo';
        let formaEntregaTexto = '';
        
        if (formaEntrega === 'correo') {
            formaEntregaTexto = 'E-Ticket por correo electrónico (S/ 0)';
        } else if (formaEntrega === 'tienda') {
            formaEntregaTexto = 'Retiro en tienda (Lima - Santa Anita - Mall Aventuras) (S/ 10)';
        }
        
        document.getElementById('forma-entrega-confirmado').textContent = formaEntregaTexto;
    }

    // Mostrar desglose de costos en la confirmación
    function mostrarDesgloseCostos() {
        // Calcular subtotal de entradas
        let subtotalEntradas = 0;
        document.querySelectorAll('#resumen-lista-confirmado li').forEach(function(item) {
            const subtotal = parseFloat(item.querySelector('span:nth-child(2)').textContent.replace('S/.', '').trim());
            subtotalEntradas += subtotal;
        });
        
        // Calcular costo de entrega
        const formaEntrega = document.querySelector('input[name="entrega"]:checked')?.value || 'correo';
        const costoEntrega = formaEntrega === 'tienda' ? 10 : 0;
        
        // Mostrar valores
        document.getElementById('subtotal-entradas-confirmado').textContent = subtotalEntradas.toFixed(2);
        document.getElementById('costo-entrega-confirmado').textContent = costoEntrega.toFixed(2);
        
        // El total ya se muestra correctamente en total-monto-confirmado
    }

    // ========================================
    // DESCARGAR BOLETA PDF
    // ========================================

    document.getElementById('descargarBoletoBtn').addEventListener('click', function(e) {
        e.preventDefault();

        // Obtener datos del servidor (más confiable)
        const nombreCuenta = "{{ Auth::user()->name }}";
        const dni = "{{ Auth::user()->dni }}";
        const correo = "{{ Auth::user()->email }}";
        const evento = "{{ strtoupper($evento->nombre) }}";
        const fecha = "{{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}";
        const ubicacion = "{{ $evento->ubicacion }}";
        
        // Obtener fecha de pago de la confirmación
        const fechaPago = document.getElementById('fecha-pago-confirmado').textContent.trim();
        
        // Obtener método de pago y datos del comprador de la confirmación
        const metodoPagoElement = document.getElementById('metodo-pago-confirmado');
        const datosCompradorElement = document.getElementById('datos-comprador-confirmado');
        
        let metodoPago = '';
        let datosPago = '';
        
        if (metodoPagoElement.innerHTML.includes('NIBIZ')) {
            metodoPago = 'NIBIZ';
            // Obtener datos de NIBIZ del servidor
            const nombre = document.getElementById('nibiz-nombre').value;
            const apellido = document.getElementById('nibiz-apellido').value;
            const email = document.getElementById('nibiz-email').value;
            datosPago = `<div><span class="label">Nombre:</span> ${nombre} ${apellido}</div>
                 <div><span class="label">Email:</span> ${email}</div>`;
        } else {
            metodoPago = 'YAPE';
            // Obtener datos de YAPE del servidor
            const celular = document.getElementById('yape-celular').value;
            datosPago = `<div><span class="label">Celular Yape:</span> ${celular}</div>`;
        }

        // Procesar entradas desde la confirmación
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

        // Obtener total y desglose de costos de la confirmación
        const total = parseFloat(document.getElementById('total-monto-confirmado').textContent);
        const subtotalEntradas = parseFloat(document.getElementById('subtotal-entradas-confirmado').textContent);
        const costoEntrega = parseFloat(document.getElementById('costo-entrega-confirmado').textContent);
        
        // Obtener forma de entrega de la confirmación
        const formaEntregaTexto = document.getElementById('forma-entrega-confirmado').textContent.trim();
        let formaEntrega = 'correo';
        if (formaEntregaTexto.includes('Retiro en tienda')) {
            formaEntrega = 'retiro';
        }

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
                    subtotal_entradas: subtotalEntradas,
                    costo_entrega: costoEntrega,
                    total: total,
                    metodo_pago: metodoPago,
                    datos_pago: datosPago,
                    fecha_pago: fechaPago,
                    forma_entrega: formaEntrega
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