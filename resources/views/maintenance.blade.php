<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Trader Rahaman Community</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            overflow: hidden;
            position: relative;
        }

        /* Animated background items */
        .bg-items {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .bg-item {
            position: absolute;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
        }

        .bg-item:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .bg-item:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .bg-item:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        .bg-item:nth-child(4) {
            width: 150px;
            height: 150px;
            bottom: 10%;
            right: 10%;
            animation-delay: 1s;
        }

        .bg-item:nth-child(5) {
            width: 100px;
            height: 100px;
            top: 50%;
            left: 5%;
            animation-delay: 3s;
        }

        .bg-item:nth-child(6) {
            width: 70px;
            height: 70px;
            top: 70%;
            right: 25%;
            animation-delay: 5s;
        }

        .bg-item:nth-child(7) {
            width: 90px;
            height: 90px;
            top: 5%;
            left: 50%;
            animation-delay: 2.5s;
        }

        .bg-item:nth-child(8) {
            width: 40px;
            height: 40px;
            bottom: 20%;
            left: 40%;
            animation-delay: 1.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.5;
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
                opacity: 1;
            }
        }

        /* Glowing lines */
        .glow-line {
            position: absolute;
            width: 2px;
            height: 100px;
            background: linear-gradient(to bottom, transparent, #e94560, transparent);
            animation: glow-move 8s infinite linear;
        }

        .glow-line:nth-child(9) {
            left: 10%;
            animation-delay: 0s;
        }

        .glow-line:nth-child(10) {
            left: 30%;
            animation-delay: 2s;
        }

        .glow-line:nth-child(11) {
            left: 50%;
            animation-delay: 4s;
        }

        .glow-line:nth-child(12) {
            left: 70%;
            animation-delay: 1s;
        }

        .glow-line:nth-child(13) {
            left: 90%;
            animation-delay: 3s;
        }

        @keyframes glow-move {
            0% {
                top: -100px;
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                top: 100%;
                opacity: 0;
            }
        }

        .container {
            text-align: center;
            z-index: 1;
            padding: 40px 20px;
        }

        .logo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 40px;
            box-shadow: 0 0 40px rgba(233, 69, 96, 0.4);
            animation: pulse 3s infinite ease-in-out;
            border: 4px solid rgba(255, 255, 255, 0.1);
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 40px rgba(233, 69, 96, 0.4);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 0 60px rgba(233, 69, 96, 0.6);
                transform: scale(1.02);
            }
        }

        .coming-soon {
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 10px;
            margin-bottom: 20px;
            text-shadow: 0 0 30px rgba(233, 69, 96, 0.5);
            animation: text-glow 2s infinite alternate;
        }

        @keyframes text-glow {
            from {
                text-shadow: 0 0 30px rgba(233, 69, 96, 0.5);
            }

            to {
                text-shadow: 0 0 50px rgba(233, 69, 96, 0.8), 0 0 80px rgba(233, 69, 96, 0.4);
            }
        }

        .subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 50px;
            font-weight: 300;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 25px 20px;
            min-width: 100px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .countdown-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(233, 69, 96, 0.3);
        }

        .countdown-number {
            font-size: 3rem;
            font-weight: 700;
            color: #e94560;
            line-height: 1;
            margin-bottom: 10px;
        }

        .countdown-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .release-date {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 20px;
        }

        .release-date span {
            color: #e94560;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .coming-soon {
                font-size: 2rem;
                letter-spacing: 5px;
            }

            .countdown-item {
                min-width: 70px;
                padding: 15px 10px;
            }

            .countdown-number {
                font-size: 2rem;
            }

            .logo {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>

<body>
    <!-- Background Items -->
    <div class="bg-items">
        <div class="bg-item"></div>
        <div class="bg-item"></div>
        <div class="bg-item"></div>
        <div class="bg-item"></div>
        <div class="bg-item"></div>
        <div class="bg-item"></div>
        <div class="bg-item"></div>
        <div class="bg-item"></div>
        <div class="glow-line"></div>
        <div class="glow-line"></div>
        <div class="glow-line"></div>
        <div class="glow-line"></div>
        <div class="glow-line"></div>
    </div>

    <div class="container">
        <img src="https://traderrahamancommunity.com/trc-logo.jpeg" alt="TRC Logo" class="logo">

        <h1 class="coming-soon">Coming Soon</h1>
        <p class="subtitle">Sesuatu yang luar biasa sedang dalam perjalanan</p>

        <div class="countdown">
            <div class="countdown-item">
                <div class="countdown-number" id="days">00</div>
                <div class="countdown-label">Hari</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="hours">00</div>
                <div class="countdown-label">Jam</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="minutes">00</div>
                <div class="countdown-label">Menit</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-number" id="seconds">00</div>
                <div class="countdown-label">Detik</div>
            </div>
        </div>

        <p class="release-date">Tanggal Rilis: <span>31 Januari 2026</span></p>
    </div>

    <script>
        // Set target date: January 31, 2026 00:00:00
        const targetDate = new Date('2026-01-31T00:00:00').getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const difference = targetDate - now;

            if (difference > 0) {
                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = String(days).padStart(2, '0');
                document.getElementById('hours').textContent = String(hours).padStart(2, '0');
                document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
                document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
            } else {
                // Countdown finished
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';

                document.querySelector('.coming-soon').textContent = "WE'RE LIVE!";
                document.querySelector('.subtitle').textContent = "Selamat datang!";
            }
        }

        // Update countdown every second
        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
</body>

</html>
