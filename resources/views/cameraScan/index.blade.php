<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <video id="preview"></video>
    <div id="resultText"></div>

    <!-- Add this in your Blade view file -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      
      // Function to update the result text
      function updateResultText(content) {
        $('#resultText').text('Scanned Result: ' + content);
      }

      scanner.addListener('scan', function (content) {
        console.log(content);
        updateResultText(content); // Call the function to update the result text
      });

      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

    </script>

    
</body>
</html>