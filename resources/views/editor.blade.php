<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .drawing-area {
            position: absolute;
            top: 60px;
            left: 122px;
            z-index: 10;
            width: 200px;
            height: 400px;
            border: 1px solid #ccc;
        }

        .canvas-container {
            width: 200px;
            height: 400px;
            position: relative;
            user-select: none;
        }

        #tshirt-div {
            width: 452px;
            height: 548px;
            position: relative;
            background-color: #fff;
        }

        #canvas {
            position: absolute;
            width: 200px;
            height: 400px;
            left: 0px;
            top: 0px;
            user-select: none;
            cursor: default;
        }
    </style>
</head>

<body>

    <!-- Create the container of the tool -->
    <div id="tshirt-div">
        <!--
            Initially, the image will have the background tshirt that has transparency
            So we can simply update the color with CSS or JavaScript dinamically
        -->
        <img id="tshirt-backgroundpicture"
            src="https://ourcodeworld.com/public-media/gallery/gallery-5d5afd3f1c7d6.png" />

        <div id="drawingArea" class="drawing-area">
            <div class="canvas-container">
                <canvas id="tshirt-canvas" width="200" height="400"></canvas>
            </div>
        </div>
    </div>

    <p>To remove a loaded picture on the T-Shirt select it and press the <kbd>DEL</kbd> key.</p>
    <!-- The select that will allow the user to pick one of the static designs -->
    <br>
    <label for="tshirt-design">T-Shirt Design:</label>
    <select id="tshirt-design">
        <option value="">Select one of our designs ...</option>
        <option value="https://ourcodeworld.com/public-media/gallery/gallery-5d5b0e95d294c.png">Batman</option>
    </select>

    <!-- The Select that allows the user to change the color of the T-Shirt -->
    <br><br>
    <label for="tshirt-color">T-Shirt Color:</label>
    <select id="tshirt-color">
        <!-- You can add any color with a new option and definings its hex code -->
        <option value="#fff">White</option>
        <option value="#000">Black</option>
        <option value="#f00">Red</option>
        <option value="#008000">Green</option>
        <option value="#ff0">Yellow</option>
    </select>

    <br><br>
    <label for="tshirt-custompicture">Upload your own design:</label>
    <input type="file" id="tshirt-custompicture" />



    <script>
        let canvas = new fabric.Canvas('tshirt-canvas');

        function updateTshirtImage(imageURL) {
            fabric.Image.fromURL(imageURL, function(img) {
                img.scaleToHeight(300);
                img.scaleToWidth(300);
                canvas.centerObject(img);
                canvas.add(img);
                canvas.renderAll();
            });
        }

        // Update the TShirt color according to the selected color by the user
        document.getElementById("tshirt-color").addEventListener("change", function() {
            document.getElementById("tshirt-div").style.backgroundColor = this.value;
        }, false);

        // Update the TShirt color according to the selected color by the user
        document.getElementById("tshirt-design").addEventListener("change", function() {

            // Call the updateTshirtImage method providing as first argument the URL
            // of the image provided by the select
            updateTshirtImage(this.value);
        }, false);

        // When the user clicks on upload a custom picture
        document.getElementById('tshirt-custompicture').addEventListener("change", function(e) {
            var reader = new FileReader();

            reader.onload = function(event) {
                var imgObj = new Image();
                imgObj.src = event.target.result;

                // When the picture loads, create the image in Fabric.js
                imgObj.onload = function() {
                    var img = new fabric.Image(imgObj);

                    img.scaleToHeight(300);
                    img.scaleToWidth(300);
                    canvas.centerObject(img);
                    canvas.add(img);
                    canvas.renderAll();
                };
            };

            // If the user selected a picture, load it
            if (e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        }, false);

        // When the user selects a picture that has been added and press the DEL key
        // The object will be removed !
        document.addEventListener("keydown", function(e) {
            var keyCode = e.keyCode;

            if (keyCode == 46) {
                console.log("Removing selected element on Fabric.js on DELETE key !");
                canvas.remove(canvas.getActiveObject());
            }
        }, false);

        // Define as node the T-Shirt Div
        var node = document.getElementById('tshirt-div');

        domtoimage.toPng(node).then(function(dataUrl) {
            // Print the data URL of the picture in the Console
            console.log(dataUrl);

            // You can for example to test, add the image at the end of the document
            var img = new Image();
            img.src = dataUrl;
            document.body.appendChild(img);
        }).catch(function(error) {
            console.error('oops, something went wrong!', error);
        });
    </script>

</body>

</html>
