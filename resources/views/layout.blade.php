<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @yield('header')
    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 500;
            font-size: 20px;
            height: 100vh;
            margin: 0;
        }
        .full-section{
            display: grid;
            grid-template-columns: 30% 60% 10%;
            width: 500px;
        }
        .full-section span{
            color: mediumslateblue;
            font-weight: bold;
        }
        .info-section{
            padding: 5px;
        }
        .info-section img{
            width: 100%;
            height: 100px;
            padding: 0px;
        }
        .info-section ul{
            list-style-type: none;
            padding: 0px;
            margin: 0px;
            
        }
        .info-section a{
            position: relative;
        
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .cart-section{
            padding: 0px;
            width: 400px;
            text-align: center;
        }
        form {
            width: 400px;
            padding: 0px;
        }
        form input{
            width: 96%;
            margin-bottom: 10px;
            margin-left: 6px;
        }
        form textarea{
            width: 96%;
            margin-bottom: 10px;
            margin-left: 6px;
        }
        form a,form button{
            display: inline-flex;
            font-size: 20px;
            position: relative;
            left: 190px;
        }     
    </style>
</head>
<body>
    <div class="main-section">
        @yield('content')  
    </div>
</body>
</html>