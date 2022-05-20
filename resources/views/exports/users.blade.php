<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}"/>
</head>
<body>
<table class="table table-striped">
    <thead>
    <tr style="background-color: #0c3253; color: white;">
        <th>ID</th>
        <th>NOMBRES</th>
        <th>APELLIDOS</th>
        <th>USUARIO</th>
        <th>CORREO</th>
        <th>CELULAR</th>
        <th>UNIDO</th>
        <th>ACTVO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->user_firstname }}</td>
            <td>{{ $user->user_lastname }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ (int)$user->user_activated ? 'SI' : 'NO' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
