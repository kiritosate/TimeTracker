<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Tracker</title>
    <link rel="stylesheet" href="style2.css">
    <script src="html5-qrcode.min.js"></script>
    <script src="jquery.min.js"></script>
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
</head>
<body>
    <div class="panel">
        <div id="qr-reader"></div>
        <br>
        <div class="results-data">
            <form action="upload_info.php" method="post">
            Student ID: <input value="undefined" type="text" id="student_id" name="student_id" readonly><br>
            Name: <input value="undefined" type="text" id="name" name="name" readonly><br>
            Course: <input value="undefined" type="text" id="course" name="course" readonly><br>
            Year Level: <input value="undefined" type="text" id="year_level" name="year_level" readonly><br>
            <br>
            <div class="btn-pane">
                <span>
                    <input type="button" id="stop" value="Stop">
                </span>
                <span>
                    <input type="submit" id="accept" value="Accept">
                </span>
             </div>
            </form>
        </div>
        
    </div>

    <script>
        var stop = document.getElementById("stop");
        var accept = document.getElementById("accept");
        const qrReader = new Html5Qrcode("qr-reader");

        stop.addEventListener("click", ()=>{
            location.href="index.php";
            qrReader.stop();
        });
        
        window.addEventListener("load", ()=>{

            function onScanSuccess(decodedText, decodedResult) {
            //console.log(`Code matched = ${decodedText}`, decodedResult);

            // Fetch the student information from the database
            fetch(`fetch_student_info.php?student_id=${decodedText}`)
                .then(response => response.json())
                .then(data => {
                    // Update the student information in the HTML
                    document.getElementById('student_id').value = data.StudentNumber;
                    document.getElementById('name').value = data.FirstName+" "+data.MiddleName +" "+data.LastName;
                    document.getElementById('course').value = data.College;
                    document.getElementById('year_level').value = data.YearLevel;
                })
                .catch(error => {
                    console.error('Error fetching student information:', error);
                });
        }

            function onScanFailure(error) {
                console.warn(`QR Code scan error = ${error}`);
            }

            const config = { fps: 20, qrbox: 800 };

            qrReader.start({ facingMode: "environment" }, config, onScanSuccess, onScanFailure)
                .catch(err => {
                    console.error("Unable to start scanning.", err);
                });
        });
    </script>

</body>
</html>