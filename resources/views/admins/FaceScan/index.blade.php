<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Camera Access</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100dvh;
            width: 100%;
            overflow: hidden;
            position: relative;
            background: black;
        }
        .video {
            width: 100%;
            height: 100%;
        }
        .button-custom {
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            bottom: 50px;
            padding: 10px 20px;
            outline: none;
            border: 1px solid #000;
            border-radius: 20px;
            background-color: white;
            font-size: 20px;
        }
    </style>
</head>
<body>
    
    <video id="video" autoplay class="video" style="transform: scaleX(-1);"></video>
    <button id="captureBtn" class="button-custom">Capture</button>
    <!-- <img id="capturedImage" style="display: none;"> -->
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // JavaScript code for camera access and capturing
        $(document).ready(function() {
            const video = document.getElementById('video');
            const captureBtn = document.getElementById('captureBtn');
            const capturedImage = document.getElementById('capturedImage');
            const locationInfo = document.getElementById('locationInfo');

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((error) => {
                    console.error('Error accessing camera: ', error);
                });

            captureBtn.addEventListener('click', () => {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                const context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                const imageUrl = canvas.toDataURL('image/png');

                // Kirim gambar ke server untuk disimpan
                $.ajax({
                    url: '/save-image',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    data: { image: imageUrl },
                    success: function(data) {
                        console.log('Image saved successfully:', data.path);
                        
                        // Implement your additional client-side logic here
                    },
                    error: function(error) {
                        console.error('Error saving image:', error);
                    }
                });

                // Tampilkan gambar yang diambil
                capturedImage.src = imageUrl;
                capturedImage.style.display = 'block';
            });
        });

    </script>

</body>
</html>
