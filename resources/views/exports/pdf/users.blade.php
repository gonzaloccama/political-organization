<!DOCTYPE html>
<html lang="es">
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}"/>
</head>
<body>
<div class="container-fluid">

    <h1>{{ $title }}</h1>
    <hr>

    <table class="table" style="font-size: 10px">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">DNI</th>
            <th scope="col">NOMBRES</th>
            <th scope="col">USUARIO</th>
            <th scope="col">CELULAR</th>
            <th scope="col">UNIDO</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th class="align-middle" scope="row">{{ $user->id }}</th>
                <th class="align-middle" scope="row">{{ $user->user_dni }}</th>
                <td class="align-middle">{{ $user->fullname }}</td>
                <td class="align-middle">{{ $user->username }}</td>

                <td class="align-middle"><a
                        href="tel:+51{{ $user->phone }}">{{ $user->phone }}</a>
                </td>
                <td class="align-middle">{{ $user->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
