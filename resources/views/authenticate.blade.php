<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authenticate</title>
    <style>
        #loading {
            display: none;
        }
        #orderButton {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Authenticate</h1>
    <form id="authForm">
        @csrf
        <button type="button" onclick="generateToken()">Generate Order Token</button>
    </form>
    <div id="loading">
        <p>Loading...</p>
    </div>
    <div id="orderButton">
        <p>Order Token: <span id="orderToken"></span></p>
        <a href="{{ route('order.page') }}"><button>Go to Order Page</button></a>
    </div>

    <script>
        function generateToken() {
            document.getElementById('loading').style.display = 'block';
            fetch('{{ route('generate.token') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('orderToken').innerText = data.orderToken;
                document.getElementById('orderButton').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
