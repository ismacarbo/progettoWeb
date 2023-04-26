<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="bot.css">
</head>
<body>
    <button class="btn1" onclick="history.back()"><i class="fa fa-home"></i>Indietro</button>
        <style>
            .btn1 {
                
                margin-left: 30px;
                margin-top: 30px;
                background-color: #01146d;
                border: none;
                color: white;
                padding: 12px 16px;
                font-size: 16px;
                cursor: pointer;
            }

            .btn1:hover {
                background-color: RoyalBlue;
            }
        </style>
    <div id="container">
        
        <div id="display">
            <div id="header">CHATBOT CENTRO RECLAMI</div>
            <div id="messaggi">
        </div>
            <div id="inputUtente">
                <input type="text" name="messages" id="messaggi1" autocomplete="OFF" placeholder="Scrivi qui" required>
                <input type="submit" value="Invia" id="invia" name="send">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function(){
            $("#messaggi1").on("keyup",function(){

                if($("#messaggi1").val()){
                    $("#invia").css("display","block");
                }else{
                    $("#invia").css("display","none");
                }
            });
        });
        //bottone invia cliccato
        $("#invia").on("click",function(e){
            $userMessage = $("#messaggi1").val();
            $appendUserMessage = '<div class="chat messaggiUtente">'+ $userMessage +'</div>';
            $("#messaggi").append($appendUserMessage);

            // inizio ajax
            $.ajax({
                url: "MainBot.php",
                type: "POST",
                //invio dati al mainBot
                data: {messageValue: $userMessage},
                // response text
                success: function(data){
                    //visualizzazione risposta
                    
                    $appendBotResponse = '<div id="contenitoreMessaggi"><div class="chat messaggiBot">'+data+'</div></div>';
                    $("#messaggi").append($appendBotResponse);
                }
            });
            $("#messaggi1").val("");
            $("#invia").css("display","none");
        });
    </script>
</body>
</html>