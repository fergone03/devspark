// app.js - Lógica AJAX y DOM para DevSpark
$(document).ready(function () {
  const rol = $('body').data('user-role');
  cargarProyectos();
  cargarTrabajadores();

  // Logout
  $('#logoutBtn').click(function () {
    $.post('logout.php', function () {
      mostrarAlerta('Sesión cerrada correctamente', 'success');
      setTimeout(function() {
        window.location = 'index.html';
      }, 700);
    });
  });

  // Crear o editar proyecto
  $('#proyectoForm').submit(function (e) {
    e.preventDefault();
    const id = $('#proyectoId').val();
    const nombre = $('#nombre').val().trim();
    const descripcion = $('#descripcion').val().trim();
    const trabajador_id = $('#trabajador').val();
    if (!nombre || !descripcion || !trabajador_id) {
      mostrarAlerta('Completa todos los campos', 'danger');
      return;
    }
    const data = { nombre, descripcion, trabajador_id };
    if (id) data.id = id;
    const method = id ? 'PUT' : 'POST';
    $.ajax({
      url: 'proyectos.php',
      method: method,
      contentType: 'application/json',
      data: JSON.stringify(data),
      success: function () {
        $('#proyectoModal').modal('hide');
        cargarProyectos();
        mostrarAlerta('Proyecto guardado correctamente', 'success');
      },
      error: function (xhr) {
        mostrarAlerta(xhr.responseJSON?.error || 'Error al guardar', 'danger');
      }
    });
  });

  // Editar proyecto
  $('#proyectosTable').on('click', '.btn-editar', function () {
    const id = $(this).data('id');
    const nombre = $(this).data('nombre');
    const descripcion = $(this).data('descripcion');
    const trabajador_id = $(this).data('trabajador_id');
    $('#proyectoId').val(id);
    $('#nombre').val(nombre);
    $('#descripcion').val(descripcion);
    $('#trabajador').val(trabajador_id);
    $('#proyectoModalLabel').text('Editar proyecto');
    $('#proyectoModal').modal('show');
  });

  // Eliminar proyecto
  $('#proyectosTable').on('click', '.btn-eliminar', function () {
    if (!confirm('¿Seguro que deseas eliminar este proyecto?')) return;
    const id = $(this).data('id');
    $.ajax({
      url: 'proyectos.php',
      method: 'DELETE',
      contentType: 'application/json',
      data: JSON.stringify({ id }),
      success: function () {
        cargarProyectos();
        mostrarAlerta('Proyecto eliminado', 'success');
      },
      error: function (xhr) {
        mostrarAlerta(xhr.responseJSON?.error || 'Error al eliminar', 'danger');
      }
    });
  });

  // Limpiar modal al abrir para crear
  $('#proyectoModal').on('show.bs.modal', function (e) {
    if (!$('#proyectoId').val()) {
      $('#proyectoForm')[0].reset();
      $('#proyectoModalLabel').text('Nuevo proyecto');
    }
  });

  // Funciones auxiliares
  function cargarProyectos() {
    $('#spinner').show();
    $.get('proyectos.php', function (proyectos) {
      $('#spinner').hide();
      const tbody = $('#proyectosTable tbody').empty();
      if (!proyectos.length) {
        tbody.append('<tr><td colspan="5" class="text-center">Sin proyectos</td></tr>');
        return;
      }
      proyectos.forEach(p => {
        let acciones = '';
        if (rol === 'admin') {
          acciones = `
            <button class="btn btn-sm btn-warning btn-editar me-1" data-id="${p.id}" data-nombre="${p.nombre}" data-descripcion="${p.descripcion}" data-trabajador_id="${p.trabajador_id}">Editar</button>
            <button class="btn btn-sm btn-danger btn-eliminar" data-id="${p.id}">Eliminar</button>
          `;
        }
        tbody.append(`
          <tr>
            <td>${p.id}</td>
            <td>${p.nombre}</td>
            <td>${p.descripcion}</td>
            <td>${p.trabajador || '-'}</td>
            ${rol === 'admin' ? `<td>${acciones}</td>` : ''}
          </tr>
        `);
      });
    }).fail(function (xhr) {
      $('#spinner').hide();
      mostrarAlerta(xhr.responseJSON?.error || 'Error al cargar proyectos', 'danger');
    });
  }

  function cargarTrabajadores() {
    if (rol !== 'admin') return;
    $.get('usuarios.php?rol=trabajador', function (usuarios) {
      const select = $('#trabajador').empty();
      if (!usuarios.length) {
        select.append('<option value="">Sin trabajadores disponibles</option>');
      } else {
        usuarios.forEach(u => {
          select.append(`<option value="${u.id}">${u.nombre}</option>`);
        });
      }
    });
  }

  function mostrarAlerta(msg, tipo) {
    $('#alertContainer').html(`<div class="alert alert-${tipo} alert-dismissible fade show" role="alert">
      ${msg}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>`);
  }
});
