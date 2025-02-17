<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 400px;">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="{{route('loginSubmit')}}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email @error('email') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password @error('password') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3 text-center">
            <a href="{{route('register')}}">Register Here</a>
            @if (session('error'))
                <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    {!! Toastr::message() !!}
    
</body>
</html>
