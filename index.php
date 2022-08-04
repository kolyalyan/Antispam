<html>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        .w3-btn{
			background-color: #2B5797!important;
			border-radius: 5px;
			color: white;
			font-size: 22px;
		}
    </style>

    <title>Antispam</title>

    <body class="w3-light-grey">
        <div class="w3-display-topmiddle">
            <br><br>

            <h3 style="text-align: center;">Введите сообщение для проверки</h3>
            <textarea id="text" style="height: 400px; width: 700px; display: inline;"></textarea>
            <div id="Spam" class="w3-container w3-red w3-round-large" style="position: absolute; display: none; margin-left: 30px; margin-top: 5px;">
                <h3>Spam</h3>
            </div>
            <div id="Ok" class="w3-container w3-green w3-round-large" style="position: absolute; display: none; margin-left: 30px; margin-top: 5px;">
                <h3>Ok</h3>
            </div>
            <br><br>

            <button class="w3-btn" onclick="check()" style="width: 300px; margin: auto; display: block;">Проверить</button>
        </div>
    </body>

    <script>
        function postData(url, data, func, ...args){
			var xhr = new XMLHttpRequest();
			xhr.open("POST", url);

			xhr.setRequestHeader('Accept', "text/plain");
			xhr.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
			xhr.timeout = 5000;

			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {;
					if(typeof func !== "undefined"){
						func(xhr.responseText, ...args);
					}

					return xhr.responseText;
				}
			};

			xhr.send(data);
		}

        function showResult(result){
            if(result === "Ok"){
                document.getElementById("Spam").style.display = "none";
                document.getElementById("Ok").style.display = "inline";
            }else{
                document.getElementById("Ok").style.display = "none";
                document.getElementById("Spam").style.display = "inline";
            }
        }

        function check(){
            text = document.getElementById("text").value;
            postData("main", "text=" + text, showResult);
        }
    </script>
</html>