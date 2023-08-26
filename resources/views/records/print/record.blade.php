<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .card-header::after {
            content: "";
            display: table;
            clear: both;
        }

        .card-header {
            width: 100vw;
            overflow: hidden;
        }

        .card-header .child-element {
            float: left;
            margin-right: 10px; /* Espaçamento entre os elementos filhos */
        }

        .image{
            width: 100px;
        }

        .image img{
            width: 100%;
        }

        .left{
            float: left;
        }

        .title{
            width: 500px;
            text-align: center;
            margin-top: 30px;
        }

        .title h3{
            margin: 0;
        }

        hr{
            margin-top: 30px;
        }

        .termo{
            text-align: center;
        }

        .rodape{
            text-align: center;
        }
        .responsavel{
            text-align: center;
            margin-top: 50px;;
        }
    </style>
</head>
<body>
    <div class="card-header">
        <div class="image left">
            <img src="{{ storage_path('app/public/img/brasao-prefeitura.png') }}" alt="brasao-prefeitura">
        </div>
        <div class="title left">
            <h3>PREFEITURA DE PALMAS</h3>
            <h3>SECRETARIA MUNICIPAL DE EDUCAÇÃO</h3>
            <h3>ETI ALMIRANTE TAMANDARÉ</h3>
        </div>
        <div class="image">
            <img src="{{ storage_path('app/public/img/Logo ETI Almirante Tamandare.png') }}" alt="logo-tamandare">
        </div>
    </div>
    
    <hr>

    <h3 class="termo">TERMO DE MEDIDA DISCIPLINAR</h3>

    <h3>MEDIDA DISCIPLINAR Nº: {{ formatNumberToThreeDigits($record->id) }}/{{ $record->created_at->format('Y') }}</h3>
    
    <p>Sr. Pai/Responsável,</p>
    <p> Informamos a V. Sª. que o aluno {{ $record->student->name }}, 
        matriculado na turma {{ $record->student->class }}, 
        obteve no dia {{ $record->created_at->format('d/m/Y') }} 
        uma medida disciplinar por motivo:
    </p>
        
    <ul>
        @foreach ($record->items as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>
    
    <div class="rodape">
        <p>__________________________________</p>
        <p>{{ $record->user->name }}</p>
    </div>

    <div class="responsavel">
        <p>__________________________________</p>
        <p>Responsável</p>
    </div>
</body>
</html>
