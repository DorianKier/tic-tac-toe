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
    <script src="script.js"></script>
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