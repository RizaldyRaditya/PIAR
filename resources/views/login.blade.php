<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        #loading {
            display: none;
        }
    </style>
</head>
<body>
    <div>
        <p>Token: {{ $token }}</p>
        <form id="authForm" action="{{ route('authenticate') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit">Authenticate</button>
        </form>
        <div id="loading">
            <p>Loading...</p>
        </div>
    </div>
    <script>
        document.getElementById('authForm').addEventListener('submit', function() {
            document.getElementById('loading').style.display = 'block';
        });
    </script>
</body>
</html>
