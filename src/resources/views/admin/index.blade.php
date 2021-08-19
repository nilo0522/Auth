<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>{{ config('app.name') }} - Admin Dashboard</title>

        <!-- Fonts -->
        
        

        <link href="https://fonts.googleapis.com/css?family=Nunito:100,200,300,400,500,600,700" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/964ddd7bbe.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
 
        <!-- Scripts -->
        
        <script src="{{asset('js/admin/app.js')}}" defer></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
      
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .outline-none {
                outline: 0!important;
            }
            .table-footer * {
                outline: none !important;
            }

            .table-head-row th {
              width: 250px;
            }

            button[disabled] {
                opacity: .5;
                cursor: not-allowed;
            }

            .spinner {
              display: flex;
              align-items: center;
              justify-content: center;
              min-height: 100vh;
            }

            .spinner:after {
              animation: changeContent .8s linear infinite;
              display: block;
              content: "⠋";
              font-size: 80px;
            }

            @keyframes changeContent {
              10% { content: "⠙"; }
              20% { content: "⠹"; }
              30% { content: "⠸"; }
              40% { content: "⠼"; }
              50% { content: "⠴"; }
              60% { content: "⠦"; }
              70% { content: "⠧"; }
              80% { content: "⠇"; }
              90% { content: "⠏"; }
            }

            .toggle__dot {
              top: -.25rem;
              left: -.25rem;
              transition: all 0.3s ease-in-out;
            }

            input:checked ~ .toggle__dot {
              transform: translateX(100%);
              background-color: #4299F5;
            }
            .pro-sidebar .pro-menu .pro-menu-item.pro-sub-menu .pro-inner-list-item .pro-inner-item:before {
            content: none !important;
            }
        </style>
    </head>
    <body class="bg-gray-200">
        <div id="app"></div>
    </body>
   

    
</html>
