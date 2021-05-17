<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Kółko i krzyżyk</title>
    <meta name="author" content="Dorian Kiewro" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif; 
            margin: 0;
            padding: 0;
            height: 100%;
        }
        h1{
            padding-top: 10px;
            text-align: center;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        #pionek{
            padding: 5px;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
        }
        #square{
            width: 80px;
            height: 80px;
        }
        main{
            margin: 0 auto;
            width: 300px;
            min-height: 100%;
		    position: relative;
        }
        table{
            margin: 0 auto;
            border: 2px solid #008000;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px 5px #aaa;
            z-index: 0;
        }
        table td{
            border: 3px solid #008000;
            width: 80px;
            height: 80px;
            text-align: center;
            font-size: 40px;
            cursor: pointer;
            transition-duration: 0.1s;
        }
        #alert{
            display: none;
            border: 5px double green;
            width: 160px;
            padding: 10px;
            font-size: 20px;
            text-align: center;
            margin: 0 auto;
            position: absolute;
            left: 59px;
            top: 100px;
            z-index: 1;
            text-transform: uppercase;
            font-weight: bold;
            background-color: lightgreen;
        }
        #plansza{
            opacity: 0;
        }
        #plansza td:hover{
            background-color: #ddd;
            transition-duration: 0.1s;
        }
        #buttons{
            padding: 20px;
            width: 250px;
            margin: 0 auto;
        }
        #switch td{
            transition-duration: 0.2s;
        }
        #switch td:hover{
            background-color: #ddd;
            transition-duration: 0.2s;
        }
        #reset{
            display: none;
            margin: 0 auto;
            padding: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 5px;
            font-weight: 900;
            cursor: pointer;
        }
        footer{
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 45px;
            opacity: 0.7;
        }
        noscript{
            width: 300px;
            color: red;
            text-align: center;
        }
        @media screen and (max-width:1000px){
            h1{
                font-size: 20px;
            }
            table td{
                width: 70px;
                height: 70px;
            }
            #alert{
                position: absolute;
                left: 59px;
                top: 85px;
            }
        }
    </style>
    <script>
        var zaznacz = "";
        var ruchy = "8";

        /* animacje przejścia */
        function animacje(){
            $("#reset").css({ opacity: "0" });
            $("#alert").css({ opacity: "0" });
            $("td").css("pointer-events", "none");
            $("body").off('keydown');
            $("#alert").show();
            $("#alert").animate({ opacity: "1" }, 500);
            $("#reset").css({ display: "block" });
            $("#reset").animate({ opacity: "1" }, 1000);
            $("#plansza").css({ opacity: "0.7", filter: "blur(2px)" });
            $("#pionek").css({ opacity: "0.7", filter: "blur(2px)" });
        }

        /* zanzaczanie pól za pomocą klawiatury numpad */
        function selectboard(){
            $("body").keydown(function(e){
                if(zaznacz != ""){
                    switch(e.keyCode){
                        /* numpad code */
                        case 103:
                            var klawisz = "#1";
                            numpadclick(klawisz);
                        break;
                        case 104:
                            var klawisz = "#2";
                            numpadclick(klawisz);
                        break;
                        case 105:
                            var klawisz = "#3";
                            numpadclick(klawisz);
                        break;
                        case 100:
                            var klawisz = "#4";
                            numpadclick(klawisz);
                        break;
                        case 101:
                            var klawisz = "#5";
                            numpadclick(klawisz);
                        break;
                        case 102:
                            var klawisz = "#6";
                            numpadclick(klawisz);
                        break;
                        case 97:
                            var klawisz = "#7";
                            numpadclick(klawisz);
                        break;
                        case 98:
                            var klawisz = "#8";
                            numpadclick(klawisz);
                        break;
                        case 99:
                            var klawisz = "#9";
                            numpadclick(klawisz);
                        break;
                    };
                }
            });
        }

        function numpadclick(pole){
            var zawartosc = $(pole).html();
            if(zaznacz == "O"){
                if(zawartosc != ""){}
                else{
                    if(ruchy == 0){
                        $(pole).html('<b>X</b>');
                        gameover();
                    }
                    else{
                        $("#pionek").html("Obecny ruch ma: "+zaznacz);
                        zaznacz = "X";
                        $(pole).html('<b>X</b>');
                        $(pole).css({ cursor: "no-drop" });
                        sprawdz(zaznacz);
                        ruchy--;
                    }
                }
            }
            else{
                if(zawartosc != ""){}
                else{
                    if(ruchy == 0){
                        $(pole).html('<b>O</b>');
                        gameover();
                    }
                    else{
                        $("#pionek").html("Obecny ruch ma: "+zaznacz);
                        zaznacz = "O";
                        $(pole).html('<b>O</b>');
                        $(pole).css({ cursor: "no-drop" });
                        sprawdz(zaznacz);
                        ruchy--;
                    }
                }
            }
            zawartosc = "";
        };

        /* kolorwanie, zaznaczanie pól */
        function gameover(){
            $("#alert").html("Remis!");
            animacje();
            $(document).keyup(function(reset){
                if((reset.keyCode == 32)||(reset.keyCode == 13)){
                    location.reload();
                }
            });
        }
        function win(pionek){
            $("#alert").html('Wygrywa "'+pionek+'"');
            animacje();
            $(document).keyup(function(reset){
                if((reset.keyCode == 32)||(reset.keyCode == 13)){
                    location.reload();
                }
            });
        }
        function color(color1, color2, color3){
            var colorwin = "#81c784";
            document.getElementById(color1).style.background= colorwin;
            document.getElementById(color2).style.background= colorwin;
            document.getElementById(color3).style.background= colorwin;
        }

        /* sprawdzanie czy gracz wygrał swoją rundę */
        function sprawdz(pionek){
            /* pobieranie zawartości pól */
            var znak = "<b>"+pionek+"</b>";
            var pole1 = document.getElementById("1").innerHTML;
            var pole2 = document.getElementById("2").innerHTML;
            var pole3 = document.getElementById("3").innerHTML;
            var pole4 = document.getElementById("4").innerHTML;
            var pole5 = document.getElementById("5").innerHTML;
            var pole6 = document.getElementById("6").innerHTML;
            var pole7 = document.getElementById("7").innerHTML;
            var pole8 = document.getElementById("8").innerHTML;
            var pole9 = document.getElementById("9").innerHTML;

            /* sprawdzanie możliwych sposobów na wygranie gry */
            if((pole1 == znak)&&(pole2 == znak)&&(pole3 == znak)){
                var p1 = "1";
                var p2 = "2";
                var p3 = "3";
                color(p1, p2, p3);
                win(pionek);
            }
            if((pole4 == znak)&&(pole5 == znak)&&(pole6 == znak)){
                var p1 = "4";
                var p2 = "5";
                var p3 = "6";
                color(p1, p2, p3);
                win(pionek);
            }
            if((pole7 == znak)&&(pole8 == znak)&&(pole9 == znak)){
                var p1 = "7";
                var p2 = "8";
                var p3 = "9";
                color(p1, p2, p3);
                win(pionek);
            }
            if((pole1 == znak)&&(pole4 == znak)&&(pole7 == znak)){
                var p1 = "1";
                var p2 = "4";
                var p3 = "7";
                color(p1, p2, p3);
                win(pionek);
            }
            if((pole2 == znak)&&(pole5 == znak)&&(pole8 == znak)){
                var p1 = "2";
                var p2 = "5";
                var p3 = "8";
                color(p1, p2, p3);
                win(pionek);
            }
            if((pole3 == znak)&&(pole6 == znak)&&(pole9 == znak)){
                var p1 = "3";
                var p2 = "6";
                var p3 = "9";
                color(p1, p2, p3);
                win(pionek);
            }
            if((pole1 == znak)&&(pole5 == znak)&&(pole9 == znak)){
                var p1 = "1";
                var p2 = "5";
                var p3 = "9";
                color(p1, p2, p3);
                win(pionek);
            }
            if((pole3 == znak)&&(pole5 == znak)&&(pole7 == znak)){
                var p1 = "3";
                var p2 = "5";
                var p3 = "7";
                color(p1, p2, p3);
                win(pionek);
            }
        }
        
        $(document).ready(function(){
            $("*").css({ opacity: "0" });
            $("*").animate({ opacity: "1" }, 600);

            /* system przydzielania pionków dla graczy rozgrywki */
            if(zaznacz != ""){
                $("main").show();
            }
            else if(zaznacz == ""){
                $("main").hide();
                $("#pionek").html('Kto pierwszy zaczyna?<br/><br/><table id="switch"><tr><td id="x">X</td><td style="pointer-events: none; background-color: lightgreen;"></td><td id="o">O</td></tr></table>');
                $("body").keyup(function(pionek){
                    if((pionek.keyCode == 79)||(pionek.keyCode == 102)){
                        $("main").css({ opacity: "0" });
                        zaznacz = "X";
                        $("main").show();
                        $("main").animate({opacity: "1"}, 600);
                        $("#pionek").html("Obecny ruch ma: O");
                        $("body").unbind('keyup');
                        $("body").bind('keydown');
                    }
                    else if((pionek.keyCode == 88)||(pionek.keyCode == 100)){
                        $("main").css({ opacity: "0" });
                        zaznacz = "O";
                        $("main").show();
                        $("main").animate({opacity: "1"}, 600);
                        $("#pionek").html("Obecny ruch ma: X");
                        $("body").unbind('keyup');
                        $("body").bind('keydown');
                    }
                });
            };
            $("#o").click(function(){
                $("main").css({ opacity: "0" });
                $("#plansza").css({ opacity: "1" });
                zaznacz = "X";
                $("main").show();
                $("main").animate({opacity: "1"}, 600);
                $("#pionek").html("Obecny ruch ma: O");
            });
            $("#x").click(function(){
                $("main").css({ opacity: "0" });
                $("#plansza").css({ opacity: "1" });
                zaznacz = "O";
                $("main").show();
                $("main").animate({opacity: "1"}, 600);
                $("#pionek").html("Obecny ruch ma: X");
            });

            /* zanzaczanie pól planszy za pomocą numpada */
            selectboard();

            /* funkcja zaznaczjąca pole wybrane przez użytkownika oraz weryfikacja ciągłości gry */
            $("td").click(function(){
                var zawartosc = $(this).html();
                if(zaznacz == "O"){
                    if(zawartosc != ""){}
                    else{
                        if(ruchy == 0){
                            $(this).html('<b>X</b>');
                            gameover();
                        }
                        else{
                            $("#pionek").html("Obecny ruch ma: "+zaznacz);
                            zaznacz = "X";
                            $(this).html('<b>X</b>');
                            $(this).css({ cursor: "no-drop" });
                            sprawdz(zaznacz);
                            ruchy--;
                        }
                    }
                }
                else{
                    if(zawartosc != ""){}
                    else{
                        if(ruchy == 0){
                            $(this).html('<b>O</b>');
                            gameover();                           
                        }
                        else{
                            $("#pionek").html("Obecny ruch ma: "+zaznacz);
                            zaznacz = "O";
                            $(this).html('<b>O</b>');
                            $(this).css({ cursor: "no-drop" });
                            sprawdz(zaznacz);
                            ruchy--;
                        }
                    }
                }
                zawartosc = "";
            });         
        });
    </script>
</head>
<body>
    <header>
        <h1>Kółko i krzyżyk</h1>
        <div id="pionek"></div>
        <noscript>Twoja przeglądarka nie posiada potrzebnej technologii do odtworzenia tej aplikacji</noscript>
    </header>
    <main>
        <div id="alert"></div>
        <table id="plansza">
        <?php
            /* tworzenie planszy do gry w PHP oraz przypisanie numer id do każdego pudełka */
            $lp = 0;
            for($x = 0; $x <=2; $x++){
                print '<tr>';
                    for($y = 0; $y <=2; $y++){
                        $lp++;
                        print '<td id="'.$lp.'"></td>';
                    } 
                print '</tr>';
            }
        ?>
        </table>
        <div id="buttons">
            <button id="reset" onClick="window.location.reload();">Reset</button>
        </div>
    </main>
    <footer>
        Wersja aplikacji 1.6 (beta)<br/>
        Create by Kiewro Dorian
    </footer>
</body>
</html>