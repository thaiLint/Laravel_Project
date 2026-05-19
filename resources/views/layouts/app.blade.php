<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartStay Dashboard</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            display:flex;
            background:#f1f5f9;
        }

        /* SIDEBAR */
        .sidebar{
            width:250px;
            height:100vh;
            background:#28346e;
            color:white;
            padding:30px 20px;
            position:fixed;
        }

        .logo{
            font-size:28px;
            font-weight:bold;
            margin-bottom:50px;
        }

        .menu{
            list-style:none;
        }

        .menu li{
            margin:25px 0;
        }

        .menu li a{
            color:white;
            text-decoration:none;
            font-size:18px;
            display:flex;
            align-items:center;
            padding:10px;
            border-radius:12px;
            transition:0.3s;
        }

        .menu li a:hover{
            background:#ffffff;
            color:#28346e;
            transform:translateX(8px);
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
        }

        .bottom-menu{
            position:absolute;
            bottom:30px;
        }

        .bottom-menu a{
            color:white;
            text-decoration:none;
            font-size:18px;
        }

        /* MAIN */
        .main{
            margin-left:250px;
            width:100%;
            padding:30px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .search{
            width:350px;
            padding:14px;
            border:none;
            border-radius:10px;
            background:#e2e8f0;
            font-size:16px;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .profile img{
            width:45px;
            height:45px;
            border-radius:50%;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        .card-top{
            background:#dbe4ff;
            padding:15px;
            text-align:center;
            font-size:20px;
        }

        .card-body{
            padding:30px;
            text-align:center;
        }

        .card-body h1{
            font-size:55px;
            color:#28346e;
        }

        .content{
            display:grid;
            grid-template-columns:2fr 1fr;
            gap:20px;
        }

        .chart-box{
            background:white;
            border-radius:20px;
            padding:20px;
            height:300px;
        }

        .chart{
            height:220px;
            margin-top:20px;
            display:flex;
            align-items:flex-end;
            gap:15px;
        }

        .bar{
            width:40px;
            background:#4f46e5;
            border-radius:10px 10px 0 0;
        }

        .tasks{
            margin-top:20px;
            background:white;
            border-radius:20px;
            padding:20px;
        }

        .task-grid{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:20px;
            margin-top:20px;
        }

        .task-item{
            display:flex;
            justify-content:space-between;
        }

        .small-card{
            background:white;
            border-radius:20px;
            padding:20px;
        }

        .small-chart{
            display:flex;
            align-items:flex-end;
            justify-content:center;
            gap:15px;
            height:200px;
            margin-top:20px;
        }

        .small-bar{
            width:45px;
            background:#28346e;
            border-radius:10px 10px 0 0;
        }

        /* RESPONSIVE */
        @media(max-width:1200px){
            .cards{ grid-template-columns:repeat(2,1fr); }
            .content{ grid-template-columns:1fr; }
        }

        @media(max-width:768px){
            body{ flex-direction:column; }

            .sidebar{
                width:100%;
                height:auto;
                position:relative;
            }

            .main{
                margin-left:0;
            }

            .cards{ grid-template-columns:1fr; }

            .chart{ gap:8px; }

            .bar{ width:25px; }

            .small-bar{ width:30px; }

            .task-grid{ grid-template-columns:1fr; }
        }
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            background:#f1f5f9;
            display:flex;
        }

        .sidebar{
            width:250px;
            height:100vh;
            background:#0f172a;
            color:white;
            position:fixed;
            padding:20px;
        }

        .sidebar h2{ margin-bottom:40px; }

        .sidebar ul{ list-style:none; }

        .sidebar ul li{ margin:20px 0; }

        .sidebar ul li a{
            color:white;
            text-decoration:none;
            font-size:18px;
        }

        .main{
            margin-left:250px;
            width:100%;
            padding:30px;
        }

    </style>
</head>

<body>

    {{-- Sidebar --}}
   @include('partials.sidebar')

    {{-- Main --}}
    <div class="main">
        @yield('content')
       
    </div>

</body>
</html>