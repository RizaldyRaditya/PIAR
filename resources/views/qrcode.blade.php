<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
</head>
<body>
    <div>
        {!! $qrCode !!}
    </div>
    <p>URL for debugging: <a href="{{ $url }}">{{ $url }}</a></p>
</body>
</html>
