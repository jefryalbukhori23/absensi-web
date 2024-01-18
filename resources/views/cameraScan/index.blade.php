<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            padding: 0;
            margin: 0;
            background-color: black;
            overflow: hidden;
        }
        .camera {
            width: auto;
            height: 100dvh;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>

    <video class="camera" id="preview"></video>
    <!-- <div id="resultText"></div> -->

    <!-- Add this in your Blade view file -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });

        // Function to update the result text
        function updateResultText(content) {
            $('#resultText').text('Scanned Result: ' + content);
        }

        scanner.addListener('scan', function(content) {
            console.log(content);
            updateResultText(content); // Call the function to update the result text
            $.ajax({
                url: '/addscan/'+content,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if(response.msg == 'Berhasil')
                    {
                      Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Scan',
                        text: response.text,
                      });
                    }else if(response.msg == 'Gagal'){
                      Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.text,
                    });
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi Kesalahan, Coba Lagi',
                      });
                    }
                },
                error: function(error) {
                    console.log(error);
                    var errorText = 'Terjadi kesalahan';
                    // Tampilkan pesan error jika ada
                    if (error.responseJSON && error
                        .responseJSON.errors) {
                        var errorMessages = error
                            .responseJSON.errors;
                        for (var key in errorMessages) {
                            if (errorMessages
                                .hasOwnProperty(key)) {
                                errorText = errorMessages[
                                    key][0];
                                break;
                            }
                        }
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorText,
                    });
                }
            });
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });
    </script>


</body>

</html>
