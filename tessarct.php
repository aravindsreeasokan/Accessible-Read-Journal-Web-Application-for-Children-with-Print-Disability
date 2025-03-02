<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCR with Tesseract.js and Camera Input</title>
  <script src="https://cdn.jsdelivr.net/npm/tesseract.js@4/dist/tesseract.min.js"></script>
  <style>
    #video, #canvas {
      border: 1px solid black;
      width: 400px;
      height: 300px;
    }
  </style>
</head>
<body>
  <h1>OCR using Tesseract.js from Camera</h1>
  
  <!-- Video stream for capturing image -->
  <video id="video" autoplay></video>
  <br>
  
  <!-- Button to capture image -->
  <button id="capture-button">Capture Image</button>
  <br>
  
  <!-- Canvas to display captured image -->
  <canvas id="canvas" width="400" height="300" style="display:none;"></canvas>
  <br>

  <!-- OCR result display -->
  <div id="ocr-result"></div>

  <script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture-button');
    const ocrResult = document.getElementById('ocr-result');

    // Access the camera
    navigator.mediaDevices.getUserMedia({ video: { width: 1280, height: 720 } })  // Higher resolution for better OCR
      .then(stream => {
        video.srcObject = stream;
      })
      .catch(err => {
        console.error('Error accessing camera:', err);
      });

    // Capture image from video when button is clicked
    captureButton.addEventListener('click', () => {
      const context = canvas.getContext('2d');
      
      // Capture the current frame of the video on the canvas
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
      
      // Convert canvas to image data URL (PNG format)
      const imageDataURL = canvas.toDataURL('image/png');

      // Run Tesseract OCR on the captured image
      Tesseract.recognize(
        imageDataURL,
        'eng',
        {
          logger: (m) => console.log(m),  // Logs the progress
        }
      ).then(({ data: { text } }) => {
        // Split the text into lines
        const lines = text.split('\n').map(line => line.trim()).filter(line => line);

        // Assume the title is the first line, or filter based on custom rules
        const title = lines.length > 0 ? lines[0] : 'No title found';

        // Display the title
        ocrResult.innerText = `Title: ${title}`;
      }).catch(err => {
        console.error(err);
      });
    });
  </script>
</body>
</html>
