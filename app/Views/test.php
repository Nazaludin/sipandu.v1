<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Preview</title>
    <style>
        #previewContainer {
            width: 300px;
            height: 200px;
            border: 1px solid #ccc;
            margin-top: 20px;
            display: none;
        }

        #previewContainer img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css">
</head>

<body>
    <form action="http://localhost:8080/service/test" method="post">
        <input type="file" id="fileInput">
        <div id="previewContainer">
            <img id="previewImage" src="#" alt="Preview">
        </div>
        <div>
            <button type="button" id="cropButton">Crop</button>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.js"></script>
<script>
    var csrfName = '<?= csrf_token() ?>';
    var csrfHash = '<?= csrf_hash() ?>';
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');

    const previewImage = document.getElementById('previewImage');
    const cropButton = document.getElementById('cropButton');

    let cropper;

    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.innerHTML = '';
                previewContainer.appendChild(previewImage);
                previewContainer.style.display = 'block';

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(previewImage, {
                    aspectRatio: 1, // Mengatur rasio aspek yang diinginkan
                    viewMode: 2, // Mengaktifkan mode pemandangan kanvas
                });
            };

            reader.readAsDataURL(file);
        }
    });


    cropButton.addEventListener('click', function() {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData();

                // Pass the image file name as the third parameter if necessary.
                formData.append('croppedImage', blob /*, 'example.png' */ );
                formData.append([csrfName], csrfHash);

                // Use `jQuery.ajax` method for example
                $.ajax('/service/test', {
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success(data) {
                        console.log(data);
                        console.log('Upload success');
                    },
                    error() {
                        console.log('Upload error');
                    },
                });
            }, 'image/png');

        }
    });
</script>

</html>