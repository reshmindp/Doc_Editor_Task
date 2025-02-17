<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 400px;">
        <h2 class="text-center">Register</h2>
        <form method="POST" action="{{route('new.register')}}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name @error('name') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                <input type="text" class="form-control" value="{{old('name')}}" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email @error('email') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                <input type="email" class="form-control" value="{{old('email')}}" name="email" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password @error('password') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                <input type="password" class="form-control" value="{{old('password')}}" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password @error('password_confirmation') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation">
            </div>
            <div class="mb-3 text-center">
                <a href="{{route('login')}}">Login Here</a>
                </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</body>
</html>