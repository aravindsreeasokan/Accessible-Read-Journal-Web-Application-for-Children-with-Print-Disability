<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OCR with Google Vision API and Camera</title>
  <style>
    #video, #canvas {
      border: 1px solid black;
      width: 400px;
      height: 300px;
    }
  </style>
</head>
<body>
  <h1>OCR using Google Vision API and Camera</h1>
  
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

    const apiKey = ;  // Replace with your Google Vision API Key

    // Access the camera
    navigator.mediaDevices.getUserMedia({ video: { width: 1280, height: 720 } })
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
      
      // Convert canvas to Base64 image data
      const imageBase64 = canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, '');

      // Prepare request payload
      const requestPayload = {
        requests: [
          {
            image: {
              content: imageBase64
            },
            features: [
              {
                type: 'TEXT_DETECTION'
              }
            ]
          }
        ]
      };

      // Call the Google Cloud Vision API
      fetch(`https://vision.googleapis.com/v1/images:annotate?key=${apiKey}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestPayload)
      })
      .then(response => response.json())
      .then(data => {
        const annotations = data.responses[0].textAnnotations;

        if (annotations && annotations.length > 0) {
          const title = annotations[0].description.split('\n')[0]; // Get the first line of text as the title
          ocrResult.innerText = `Title: ${title}`;
        } else {
          ocrResult.innerText = 'No text found';
        }
      })
      .catch(err => {
        console.error('Error during OCR:', err);
        ocrResult.innerText = 'Error during OCR';
      });
    });
  </script>
</body>
</html>
