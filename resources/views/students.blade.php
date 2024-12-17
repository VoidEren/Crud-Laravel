<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estudiantes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h3 {
            text-align: center;
            color: #343a40;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .btn-warning {
            color: #212529;
            border: none;
        }
        .btn-warning:hover {
            background-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Estudiantes</h1>

        <h3 class="mb-3">Crear Estudiante</h3>
        <form method="POST" action="/students" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="grupo" class="form-label">Grupo:</label>
                <input type="text" class="form-control" id="grupo" name="grupo" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Crear</button>
        </form>

        <hr>

        <h3 class="mb-3">Lista de Estudiantes</h3>
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->grupo }}</td>
                    <td class="text-center">
                        <form method="POST" action="/students/{{ $student->id }}" style="display: inline-block;" class="me-2">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-sm">
                                <input type="text" name="name" value="{{ $student->name }}" class="form-control" required>
                                <input type="text" name="grupo" value="{{ $student->grupo }}" class="form-control" required>
                                <button type="submit" class="btn btn-warning">Actualizar</button>
                            </div>
                        </form>

                        <form method="POST" action="/students/{{ $student->id }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
