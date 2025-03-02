#!/bin/bash

# Replace with your actual API key
API_KEY=""

# Path to the image file you want to upload
IMAGE_FILE="C:\Users\aravi\Downloads\81D3fg+n7RL._SY522_.jpg"

# MIME type of the image
MIME_TYPE="image/jpeg"

# Step 1: Upload the image to get the file URI
NUM_BYTES=$(wc -c < "${IMAGE_FILE}")

UPLOAD_RESPONSE=$(curl -s "https://generativelanguage.googleapis.com/upload/v1beta/files?key=${API_KEY}" \
  -H "X-Goog-Upload-Command: start, upload, finalize" \
  -H "X-Goog-Upload-Header-Content-Length: ${NUM_BYTES}" \
  -H "X-Goog-Upload-Header-Content-Type: ${MIME_TYPE}" \
  -H "Content-Type: ${MIME_TYPE}" \
  --data-binary "@${IMAGE_FILE}")

# Extract the file URI from the upload response
FILE_URI=$(echo $UPLOAD_RESPONSE | jq -r '.file.uri')

# Check if FILE_URI was successfully extracted
if [ -z "$FILE_URI" ]; then
  echo "Error: Could not retrieve file URI from upload response"
  exit 1
fi

echo "Uploaded File URI: $FILE_URI"

# Step 2: Use the file URI to extract the book title
curl -X POST "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=${API_KEY}" \
  -H 'Content-Type: application/json' \
  -d @<(echo '{
  "contents": [
    {
      "role": "user",
      "parts": [
        {
          "fileData": {
            "fileUri": "'"${FILE_URI}"'",
            "mimeType": "image/jpeg"
          }
        },
        {
          "text": "Provide the name of the book title from this image."
        }
      ]
    }
  ],
  "generationConfig": {
    "temperature": 0.7,
    "topK": 40,
    "topP": 0.9,
    "maxOutputTokens": 500,
    "responseMimeType": "text/plain"
  }
}')
