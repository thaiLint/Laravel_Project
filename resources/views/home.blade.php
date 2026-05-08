<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management</title>

    <style>
        body{
            margin:0;
            font-family:Arial;
            background:#f4f4f4;
        }
        .navbar h2{
            font-size: 20px;
            color: rgb(94, 93, 93);
        }
        .navbar{
            background:#0f172a;
            color:white;
            padding:20px;
            display:flex;
            justify-content:space-between;
        }
        .navbar a{
            color:white;
            text-decoration:none;
            margin-left:20px;
            font-size: 20px;
        }
        .navbar a:hover{
            color: blue;
        }

        .hero{
            height:90vh;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
            url('https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=1470&auto=format&fit=crop');
            background-size:cover;
            color:white;
        }

        .hero h1{
            font-size:60px;
        }

        .hero button{
            padding:15px 30px;
            border:none;
            background:#2563eb;
            color:white;
            font-size:18px;
            border-radius:5px;
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>SmartStay Hotel</h2>

        <div>
            <a href="">Home</a>
            <a href="">Rooms</a>
            <a href="">Booking</a>
            <a href="">Dashboard</a>
        </div>
    </div>
    <div class="hero">
        <h1>Welcome To SmartStay Hotel</h1>
        <p>Luxury Rooms & Best Services</p>

        <button>Book Now</button>
    </div>
</body>
</html>