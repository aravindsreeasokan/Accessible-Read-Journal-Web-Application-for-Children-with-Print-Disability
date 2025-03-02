<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Webcam View</title>
</head>
<body>
    <h1>Live Webcam Feed</h1>
    <video id="webcam" autoplay playsinline width="640" height="480"></video>
    
    <script>
        const video = document.getElementById('webcam');

        // Access webcam stream
        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
            })
            .catch(function(error) {
                console.log("Error accessing the webcam: ", error);
            });
        }
    </script>
</body>
</html>
