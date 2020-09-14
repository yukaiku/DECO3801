<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>WhoLostRoger</title>
        <script src="Build/UnityLoader.js"></script>
        <style>
        	html, body {
        		margin: 0;
        		padding: 0;
                width: 100%;
                height: 100%;
                box-sizing: border-box;
                background: rgba(255,255,255,1);
                background: ;
        	}

            .webgl-content {
                position: absolute;
                top: 50%;
                left: 50%;
                border: 0;
                transform: translate(-50%, -50%);
                -webkit-transform: translate(-50%, -50%);
            }

        	.webgl-content .onfullscreen {
        		position: fixed;
        		right: 0%;
        		bottom: 0%;
        		background: transparent center no-repeat;
                background-image: url('./TemplateData/fullscreen.png');
        		width: 38px;
        		height: 38px;
        	}
        </style>
    </head>

    <body>
        <div class="webgl-content">
            <div id="unityContainer" style="width: 1280px; height: 800px;"></div>
            <div class="onfullscreen" onclick="unityInstance.SetFullscreen(1)"></div>
        </div>

        <script type="application/javascript">
            var unityInstance = UnityLoader.instantiate("unityContainer", "Build/GameExecutables.json");

            function onResizeUnity() {
                unityInstance.SendMessage("DataStorage", "setScreenWidth", window.innerWidth);
                unityInstance.SendMessage("DataStorage", "setScreenHeight", window.innerHeight);
                unityInstance.SendMessage("DataSystem", "onResize");
            }

            function onResizeCanvas() {
                var canvas = unityInstance.Module.canvas;
                var container = unityInstance.container;
                var width = window.innerWidth;
                var height = window.innerHeight;
                var ratio = 1280 / 800;

                if (height * ratio > width) {
                    height = Math.min(height, Math.ceil(width / ratio));
                }
                width = Math.floor(height * ratio);

                canvas.style.width = width + "px";
                canvas.style.height = height + "px";
                container.style.width = width + "px";
                container.style.height = height + "px";
            }

            window.addEventListener("resize", onResizeCanvas);
            onResizeCanvas();
        </script>
    </body>
</html>