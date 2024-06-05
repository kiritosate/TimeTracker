<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Tracker</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
</head>
<body>
    <div class="panel">
        <br>
        <img src="logo.jpg" width="150px">
        <h1>Time Tracker</h1>
        <h3>Attendance Checker</h3>

        <input type="button" id="scan-now" value="Scan Now">
    </div>

    <script>
        var start = document.getElementById("scan-now");
        start.addEventListener("click", ()=>{
            location.href="scanner.php";
        });
    </script>

</body>
</html>