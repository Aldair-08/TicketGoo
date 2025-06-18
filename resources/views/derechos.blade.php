@extends('layouts.plantilla')

@section('title', 'Derechos ARCO | TicketGO')

@section('contenido')
<div class="min-h-screen flex justify-center px-4 container py-5 mb-10">
    <div class="text-left max-w-3xl px-4">
        <h2 class="text-center text-blue-700 text-2xl font-bold mb-6">DERECHOS ARCO</h2>

        <p class="mb-6">
            En TicketGO valoramos tu privacidad y el control que tienes sobre tu información personal. 
            Por ello, te informamos sobre tus Derechos ARCO, establecidos en la Ley N.° 29733 – Ley de Protección de Datos Personales, 
            los cuales te permiten acceder, modificar, cancelar u oponerte al tratamiento de tus datos personales de forma libre y sencilla.
        </p>

        <div class="space-y-8">

            <section>
                <h3 class="text-blue-700 font-semibold text-lg">¿Qué significan las siglas ARCO?</h3>
                <p>
                    ARCO hace referencia a los siguientes derechos: 
                    <strong>Acceso</strong>, <strong>Rectificación</strong>, <strong>Cancelación</strong> y <strong>Oposición</strong>. 
                    Son herramientas legales que te empoderan para proteger tu información personal frente al uso indebido o no autorizado.
                </p>
            </section>

            <section>
                <h3 class="text-blue-700 font-semibold text-lg">1. Derecho de Acceso</h3>
                <p>
                    Tienes derecho a saber si en TicketGO estamos tratando tus datos personales y, en ese caso, conocer qué datos tuyos tenemos, 
                    para qué los usamos, con qué finalidad fueron recogidos y si han sido compartidos con terceros.
                </p>
                <p>
                    Este derecho te brinda transparencia sobre el uso de tu información personal, y puedes solicitar un reporte completo cuando lo desees.
                </p>
                <p class="italic">Plazo de atención: hasta 10 días hábiles desde que se recibe tu solicitud.</p>
            </section>

            <section>
                <h3 class="text-blue-700 font-semibold text-lg">2. Derecho de Rectificación</h3>
                <p>
                    Si tus datos personales que tenemos registrados son incorrectos, inexactos o han cambiado, puedes pedir que los actualicemos o corrijamos. 
                    Es importante mantener tu información al día para evitar problemas en la entrega de entradas o notificaciones importantes.
                </p>
                <p>
                    Por ejemplo, si cambiaste de correo electrónico o detectas un error en tu nombre o DNI, puedes ejercer este derecho para rectificar esos datos.
                </p>
                <p class="italic">Plazo de atención: hasta 10 días hábiles.</p>
            </section>

            <section>
                <h3 class="text-blue-700 font-semibold text-lg">3. Derecho de Cancelación</h3>
                <p>
                    Puedes solicitar que eliminemos tus datos personales de nuestros registros cuando ya no sean necesarios para la finalidad con la que fueron recogidos, 
                    o si ya no deseas que sigan siendo tratados por TicketGO.
                </p>
                <p>
                    Esto aplica cuando, por ejemplo, ya no usas nuestra plataforma y quieres que eliminemos toda tu información. 
                    Sin embargo, existen casos en los que estamos legalmente obligados a conservar ciertos datos, como por temas tributarios o de seguridad.
                </p>
                <p class="italic">Plazo de atención: hasta 10 días hábiles.</p>
            </section>

            <section>
                <h3 class="text-blue-700 font-semibold text-lg">4. Derecho de Oposición</h3>
                <p>
                    Tienes derecho a oponerte al tratamiento de tus datos personales cuando consideres que están siendo usados para finalidades no autorizadas o 
                    que vulneran tus derechos.
                </p>
                <p>
                    Esto incluye, por ejemplo, si no deseas recibir comunicaciones promocionales, o si deseas evitar que tus datos sean compartidos con terceros para ciertas actividades.
                    Para ejercer este derecho, deberás presentar una justificación legítima.
                </p>
                <p class="italic">Plazo de atención: hasta 10 días hábiles.</p>
            </section>

            <section>
                <h3 class="text-blue-700 font-semibold text-lg">¿Cómo puedo ejercer mis derechos?</h3>
                <p>
                    En TicketGO queremos que este proceso sea claro y accesible. Si deseas ejercer alguno de tus derechos ARCO, 
                    solo necesitas enviarnos tu solicitud por nuestros medios de contacto oficiales, indicando tu nombre completo, 
                    el correo con el que estás registrado en nuestra plataforma y el derecho que deseas ejercer.
                </p>
                <p>
                    No necesitas justificar el motivo si se trata de un derecho de acceso, rectificación o cancelación, 
                    aunque en el caso de oposición sí debes explicar por qué deseas limitar el uso de tus datos.
                </p>
            </section>

            <section>
                <h3 class="text-blue-700 font-semibold text-lg">Vigencia</h3>
                <p>Esta información ha sido actualizada por última vez el <strong>7 de mayo de 2025</strong>. Revisa esta página periódicamente para estar al tanto de cualquier cambio.</p>
            </section>

        </div>
    </div>
</div>
@endsection
