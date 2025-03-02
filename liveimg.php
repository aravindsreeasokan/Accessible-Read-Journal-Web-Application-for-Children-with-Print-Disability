<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="rentstylesheet.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Rent Book</title>
    <style>
        /* Spinner animation styling */
        #loading {
            display: none;
            width: 50px;
            height: 50px;
            margin-left: 10px;
        }

        .custom-spinner {
            width: 50px;
            height: 50px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #loading p {
            margin-top: 10px;
            font-size: 1rem;
            color: #3498db;
        }

        .search {
            display: flex;
            align-items: center;
        }

        /* Styling for the captured image display */
        #capturedImage {
            display: none;
            max-width: 100%;
            margin-top: 10px;
        }

        #video {
            max-width: 100%;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include('usernav.php');
    include("connection.php");
    include_once 'readgrid.php';
    ?>
    <div class="search">
        <form name="searchform" action="" method="POST">
            <input type="text" name="searchbar" id="searchinput" placeholder="Search">
            <input type="submit" name="searchbutton" id="searchsubmit" value="Search">
            <input type="file" name="image" id="imageupload" accept="image/*" style="display:none;">
            <input type="button" id="imagesubmit" value="Upload Image" onclick="document.getElementById('imageupload').click();">

            <!-- Button for capturing live camera -->
            <input type="button" id="captureLive" value="Capture Live" data-bs-toggle="modal" data-bs-target="#cameraModal">

            <!-- Loading message with spinner -->
            <div id="loading">
                <div class="custom-spinner"></div>
            </div>
        </form>
    </div>

    <!-- Bootstrap Modal for live camera view -->
    <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cameraModalLabel">Live Camera View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- Video stream from the camera -->
                    <video id="video" width="100%" autoplay></video>
                    <!-- Image placeholder for captured image -->
                    <img id="capturedImage" src="" alt="Captured Image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="captureBtn">Capture Image</button>
                    <button type="button" class="btn btn-success" id="sendImage">Send Image</button>
                </div>
            </div>
        </div>
    </div>

    <div class="gridgallery">
        <?php
        // Your existing PHP code for search and recommendations...
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        let video = document.getElementById('video');
        let canvas = document.createElement('canvas');
        let context = canvas.getContext('2d');
        let capturedImageElement = document.getElementById('capturedImage');
        let capturedImage = null;

        // Access the camera and display the live video stream
        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((error) => {
                    alert('Error accessing camera: ' + error.message);
                });
        }

        // Capture image from the video stream
        document.getElementById('captureBtn').addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
            capturedImage = canvas.toDataURL('image/png');  // Capture image data

            // Hide video and show the captured image
            video.style.display = 'none';
            capturedImageElement.src = capturedImage;
            capturedImageElement.style.display = 'block';
            console.log("Image captured: ", capturedImage);
        });

        // Send the captured image to the server via AJAX
        document.getElementById('sendImage').addEventListener('click', () => {
            if (capturedImage) {
                $('#loading').show(); // Show the spinner
                $.ajax({
                    url: 'liveimg_res.php',
                    type: 'POST',
                    data: { imageData: capturedImage },
                    success: function(response) {
                        console.log("Response received: ", response);
                        $('#loading').hide(); // Hide the spinner
                        $('#searchinput').val(response.trim());
                        alert('Image successfully processed: ' + response);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: ", error);
                        console.log("Response text: ", xhr.responseText);
                        $('#loading').hide(); // Hide the spinner
                        alert('Error sending image: ' + xhr.responseText);
                    }
                });
            } else {
                alert('No image captured');
            }
        });

        // Start camera when modal is opened
        $('#cameraModal').on('shown.bs.modal', startCamera);
    </script>
</body>

</html>
