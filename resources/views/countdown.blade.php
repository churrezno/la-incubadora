<x-app-layout>

    <style>
        .gris {
            color: #909090;
        }
        p {
            font-size: 20px;
            line-height: normal;
            margin-bottom: 1.5rem;
            text-align: center;
            text-wrap: balance;
        }
        p.small {
            font-size: 18px;
        }
        .mt-3 {
            margin-top: 3rem;
        }
        #countdown {
            text-align: center;
            margin: -0.5rem 0 3rem;
        }
        #countdown ul {
            margin: 0;
            padding: 0;
        }
        #countdown li {
            display: inline-block;
            font-size: 1.375rem;
            list-style-type: none;
            padding: 0 0.125rem 1rem;
            text-transform: uppercase;
            width: 125px;
            max-width: 24%;
            background-color: white;
            border: 2px solid #f2f2f2;
            filter: drop-shadow(0px 5px 5px rgba(0,0,0,.125));
        }
        #countdown li span.number {
            display: block;
            font-size: 4rem;
        }
        a{
            color: #FC1048;
        }
        strong {
            font-size: 2rem;
            display: block;
            margin: 1rem 0 2rem;
        }
        #content {
            font-size: 3rem;
            display: none;
            text-align: center;
        }

        @media(min-width: 768px) {
            #countdown {
                margin-bottom: 8rem;
            }
            p {
                font-size: 24px;
            }
            strong {
                font-size: 3rem;
            }
            #countdown li span.number {
                font-size: 6rem;
            }
        }

    </style>

    <p>La Incubadora 2025 abre su convocatoria el <strong>15 de septiembre 10:00 h</strong></p>
    <p class="gris mt-3">YA SOLO FALTAN</p>   
    
    <div id="countdown">
        <ul>
            <li><span id="days" class="number"></span> <span id="days-label">días</span></li>
            <li><span id="hours" class="number"></span>h</li>
            <li><span id="minutes" class="number"></span>min</li>
            <li><span id="seconds" class="number"></span>seg</li>
        </ul>
    </div>
    <div id="content">¡¡ABRIMOS CONVOCATORIA!!</div>

    <p class="small gris mt-3">Tienes más información <a href="https://ecam-industria.es/la-incubadora/">aquí.</a></p>


    <script type="text/javascript">
        (function () {
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
            
            const countDownDate = new Date("Sep 15, 2025 10:00:00").getTime();
            x = setInterval(function() {    
                
                const now = new Date().getTime(),
                distance = countDownDate - now;
                
                document.getElementById("days").innerText = Math.floor(distance / (day)),
                document.getElementById("days-label").innerText = Math.floor(distance / (day)) === 1 ? 'día' : 'días',
                document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
                
                // When date is reached
                if (distance < 0) {
                    document.getElementById("countdown").style.display = "none";
                    document.getElementById("content").style.display = "block";
                    clearInterval(x);
                }
                //seconds
            }, 0)
        }());
    </script>

</x-app-layout>


