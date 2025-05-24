const API_URL = '/api/coches';
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const userId= document.querySelector('meta[name="user-id"]').getAttribute('content');
const id_cliente= document.querySelector('meta[name="user-id"]').getAttribute('content');
const alerta= document.getElementById('error');
const mensajeExito= document.getElementById('exito');

// Función para obtener todos los coches y mostrarlos en la vista
async function obtenerCoches() {
    try {
        alerta.style.display= "none";
        const respuesta = await fetch(API_URL + "/index", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
            body: JSON.stringify({id_cliente: userId}),
        });

        if (!respuesta.ok) {
            console.log(respuesta);
            throw new Error(`Error: ${respuesta.status} ${respuesta.statusText}`);
        }

        const coches = await respuesta.json();
        mostrarCoches(coches);
    } catch (error) {
        alerta.style.display= "block";
        alerta.textContent= 'Error al obtener los coches: ' + error;
        console.error('Error al obtener los coches:', error);
        document.getElementById('coches-contenedor').innerHTML = '<p>No se pudieron cargar los coches</p>';
    }
    irAListado();
}

// Función para mostrar los coches en el contenedor
function mostrarCoches(coches) {
    const contenedor = document.getElementById('coches-contenedor');
    contenedor.innerHTML = `
        <div class="d-flex justify-content-center my-4">
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Cargando coches...</span>
            </div>
        </div>
    `;

    if (coches.length === 0) {
        contenedor.innerHTML = '<p class="text-center">No hay coches disponibles.</p>';
        return;
    }

    /// Contenedor con clases de Bootstrap para mostrar cartas en filas
    const fila = document.createElement('div');
    fila.classList.add('row', 'g-3');

    coches.forEach(coche => {
        const columna = document.createElement('div');
        columna.classList.add('col-md-4');

        const carta = document.createElement('div');
        carta.classList.add('card', 'h-100', 'shadow-sm', 'position-relative');

        const cuerpo = document.createElement('div');
        cuerpo.classList.add('card-body');
        cuerpo.style.cursor = 'pointer';
        cuerpo.addEventListener('click', () => mostrarDetallesCoche(coche));

        const titulo = document.createElement('h5');
        titulo.classList.add('card-title');
        titulo.textContent = coche.modelo;

        const precio = document.createElement('p');
        precio.classList.add('card-text');
        precio.textContent = `Marca: ${coche.marca}`;

        const stock = document.createElement('p');
        stock.classList.add('card-text');
        stock.textContent = `Matricula: ${coche.matricula}`;

        // Icono de papelera sin botón
        const iconoEliminar = document.createElement('i');
        iconoEliminar.classList.add('bi', 'bi-trash', 'text-danger', 'position-absolute');
        iconoEliminar.style.top = '0.5rem';
        iconoEliminar.style.right = '0.5rem';
        iconoEliminar.style.cursor = 'pointer';
        iconoEliminar.title = 'Eliminar coche';

        iconoEliminar.addEventListener('click', (e) => {
            e.stopPropagation(); // Evita que se active el clic en la carta
            borrarCoche(coche.id);
        });

        cuerpo.appendChild(titulo);
        cuerpo.appendChild(precio);
        cuerpo.appendChild(stock);
        carta.appendChild(cuerpo);
        carta.appendChild(iconoEliminar);
        columna.appendChild(carta);
        fila.appendChild(columna);
    });

    contenedor.innerHTML = '';
    contenedor.appendChild(fila);

}

// Función para mostrar los detalles de un coche en el contenedor de detalles
function mostrarDetallesCoche(coche) {
    // Rellenar el formulario para actualizar y mostrar
    document.getElementById('coche-id').value = coche.id;
    document.getElementById('marca').value = coche.marca;
    document.getElementById('modelo').value = coche.modelo;
    document.getElementById('matricula').value = coche.matricula;
    irACoche();
}

// Función para manejar el envío del formulario (crear o actualizar coche)
document.getElementById('coche-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const id = document.getElementById('coche-id').value;
    console.log(id);
    const marca = document.getElementById('marca').value;
    console.log(marca);
    const matricula = document.getElementById('matricula').value;
    console.log(matricula);
    const modelo = document.getElementById('modelo').value;
    console.log(modelo);

    const datos = { id_cliente: id_cliente, marca: marca, matricula: matricula, modelo: modelo };

    try {
        alerta.style.display= "none";
        mensajeExito.style.display= "none";
        const respuesta = await fetch(id ? `${API_URL}/${id}` : API_URL, {
            method: id ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
            body: JSON.stringify(datos),
        });

        if (!respuesta.ok) {
            let r= await respuesta.json()
            if(r['errors'] != undefined) {
                throw new Error(`Error: ${respuesta.status} (${respuesta.statusText}) ` + " Fallos validación: " + r['errors']);
            }
            throw new Error(`Error: ${respuesta.status} ${respuesta.statusText}`);
        }

        const coche = await respuesta.json();
        mensajeExito.style.display= "block";
        mensajeExito.textContent= id ? 'Coche actualizado: ' + coche['matricula'] : 'Coche creado: ' + coche['matricula'];
        console.log(id ? 'Coche actualizado:' : 'Coche creado:', coche);

        // Reiniciar el formulario y recargar los coches
        document.getElementById('coche-form').reset();
        document.getElementById('coche-id').value = '';
        obtenerCoches();
    } catch (error) {
        if(id != null && !isNaN(id)) {
            alerta.style.display= "block";
            alerta.textContent= 'Error al crear el coche: ' + error;
            console.error('Error al crear el coche:', error);
        }
        else if(id == null){
            alerta.style.display= "block";
            alerta.textContent= 'Error al modificar el coche: ' + error;
            console.error('Error al modicar el coche:', error);
        }
        else {
            alerta.style.display= "block";
            alerta.textContent= 'Error al guardar el coche: ' + error;
            console.error('Error al guardar el coche:', error);
        }
    }
});

// Función para borrar un coche
async function borrarCoche(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar este coche?')) return;

    try {
        alerta.style.display= "none";
        mensajeExito.style.display= "none";
        const respuesta = await fetch(`${API_URL}/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
        });

        if (!respuesta.ok) {
            throw new Error(`Error: ${respuesta.status} ${respuesta.statusText}`);
        }
        mensajeExito.style.display= "block";
        mensajeExito.textContent= `Coche con ID ${id} eliminado.`;
        console.log(`Coche con ID ${id} eliminado.`);
        obtenerCoches();
    } catch (error) {
        alerta.style.display= "block";
        alerta.textContent= 'Error al borrar el coche: ' + error;
        console.error('Error al borrar el coche:', error);
    }
}

function irACoche() {
    const seccion = document.getElementById('detalles-coche');
    if (seccion) {
        seccion.scrollIntoView({ behavior: 'smooth' });
    }
}

function irAListado() {
    const seccion = document.getElementById('coches-contenedor');
    if (seccion) {
        seccion.scrollIntoView({ behavior: 'smooth' });
    }
}

// Llama a la función para cargar la página
document.addEventListener('DOMContentLoaded', init);

function init()
{
    obtenerCoches();
    document.getElementById('limpiar-formulario').addEventListener('click', () => {
        document.getElementById('coche-form').reset();
        alerta.style.display= "none";
        mensajeExito.style.display= "none";
        document.getElementById('coche-id').value = '';
    });
}