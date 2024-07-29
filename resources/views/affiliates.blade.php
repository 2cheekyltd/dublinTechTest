<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Invitations</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Invite Affiliates for an Event</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Affiliate ID</th>
                    <th>Name</th>
                    <th>Distance (km)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($affiliates as $affiliate)
                <tr>
                    <td>{{ $affiliate['affiliate_id'] }}</td>
                    <td>{{ $affiliate['name'] }}</td>
                    <td>{{ $affiliate['distance'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>