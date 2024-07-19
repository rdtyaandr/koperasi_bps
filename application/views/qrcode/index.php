<!--

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR Code dan Barcode</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-sHmNv26b+QSyhqj/Hqj/dZX6jDhTcGZQ97ZnVuDC0TtyStxE8VUj+xXoGf2X/Fv1Gye0uW7tZanRjg+1yLzqgQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .scanner-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .scanner-box {
            width: 80%;
            max-width: 600px;
            height: 500px;
            position: relative;
            border: 2px solid #007bff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .scanner-overlay {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1;
        }

        .scan-button,
        .close-button,
        .file-input-button {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin: 0 5px;
        }

        .scan-button {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .scan-button:hover {
            background-color: #0056b3;
        }

        .close-button {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .close-button:hover {
            background-color: #bd2130;
        }

        .file-input-button {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .file-input-button:hover {
            background-color: #218838;
        }

        .camera-switch {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
        }

        .camera-icon {
            margin-right: 5px;
            font-size: 18px;
        }

        .result-container {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
            text-align: center;
            display: none;
        }

        .result-text {
            font-size: 16px;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Scanner QR Code dan Barcode</h4>
                    </div>
                    <div class="card-body">
                        <div class="scanner-container">
                            <div class="scanner-box">
                                <div class="camera-switch">
                                    <i class="camera-icon fas fa-camera"></i>
                                    <select id="camera-select" class="form-control" onchange="switchCamera(this.value)">
                                        <option value="environment">Belakang</option>
                                        <option value="user">Depan</option>
                                    </select>
                                </div>
                                <video id="scanner-video" playsinline></video>

                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="scan-button mr-2" onclick="startScanner()">Scan QR dan Barcode</button>
                            <button class="close-button" onclick="closeScanner()">Close</button>
                            <input type="file" accept="image/*" id="file-input" style="display: none;"
                            onchange="handleFileInputChange(event)">
                        <label for="file-input" class="file-input-button">Pilih File</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="result-container" id="result-container">
        <p class="result-text" id="result-text">Hasil scan akan muncul di sini.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"
        integrity="sha384-mFMqf90eE6Dk6fy6jZFKtF8VqFvHnp4oV1kT/45HtMF3uQlUnYdFqcCkhC6jKfF1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh/FeNlNBuSQUQOfFwt/yA6dsXvBXWI1T2Ope"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
    <script>
        let videoStream;
        let currentFacingMode = 'environment'; // Mode kamera saat ini

        // Function untuk memulai scanner
        function startScanner() {
            const scannerBox = document.querySelector('.scanner-box');
            const video = document.createElement('video');
            video.id = 'scanner-video';
            video.className = 'scanner-video';
            video.autoplay = true;

            navigator.mediaDevices.getUserMedia({ video: { facingMode: currentFacingMode } })
                .then(stream => {
                    videoStream = stream;
                    video.srcObject = stream;
                    scannerBox.appendChild(video);

                    Quagga.init({
                        inputStream: {
                            type: 'LiveStream',
                            constraints: {
                                width: 600,
                                height: 500,
                                facingMode: currentFacingMode // Menggunakan mode kamera yang dipilih
                            },
                            target: document.querySelector('#scanner-video')
                        },
                        decoder: {
                            // Include all supported barcode types
                            readers: ['code_128_reader',
                                'ean_reader', 'ean_8_reader',
                                'code_39_reader', 'code_39_vin_reader',
                                'codabar_reader', 'upc_reader', 'upc_e_reader',
                                'i2of5_reader', '2of5_reader', 'code_93_reader']
                        }
                    }, function (err) {
                        if (err) {
                            console.error(err);
                            return;
                        }
                        Quagga.start();

                        // Event listener untuk hasil scan
                        Quagga.onDetected(data => {
                            const code = data.codeResult.code;
                            showResult(code);
                        });
                    });

                    video.play();
                })
                .catch(err => console.error('Error accessing camera:', err));
        }

        // Function untuk menampilkan hasil scan
        function showResult(code) {
            const resultText = document.getElementById('result-text');
            resultText.textContent = `Hasil scan: ${code}`;
            document.getElementById('result-container').style.display = 'block';

        // Optional: Add logic to handle the scanned