<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Attendance</h2>
        <div class="mb-3">
            <input type="email" class="form-control" id="email" placeholder="Enter email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="password" placeholder="Enter password" required>
        </div>
        <div>
            <button type="button" class="btn btn-success me-2" onclick="markAttendance('login')">Login</button>
            <button type="button" class="btn btn-danger" onclick="markAttendance('logout')">Logout</button>
        </div>
    </div>

    <script>
       function markAttendance(type) {
    navigator.geolocation.getCurrentPosition(function(position) {
        const coords = position.coords.latitude + ',' + position.coords.longitude;
        const data = new FormData();
        data.append('email', document.getElementById('email').value);
        data.append('password', document.getElementById('password').value);
        data.append('location', coords);

        fetch('attendance/' + type, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(res => {
            if (res.status === 'success') {
                alert(res.message);
                setTimeout(() => {
                    location.reload();
                }, 100);
            } else if (res.status === 'register') {
                alert('You need to register first.');
                window.location.href = 'attendance/register';
            } else {
                alert(res.message);
            }
        });
    });
}

    </script>
</body>
</html>
