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
</head>
<body>
    <div class="flex justify-between w-screen">
        <div class="text-red-600">Logo</div>
        <div>
            ETI ALMIRANTE TAMANDARÉ
        </div>
        <div>Logo</div>
    </div>
    
    <hr>
    
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus, 
        cumque veritatis similique modi magni repudiandae a fugiat, animi quo repellat 
        cupiditate, iste vitae. Sint labore est animi impedit nesciunt similique!
    </p>
    
    <p>Aluno: {{ $record->student->name }}</p>
    <p>Turma: {{ $record->student->class }}</p>
    
    <p>Foi enquadrado nos seguinte itens:</p>
    
    <ul>
        @foreach ($record->items as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>
    
    <div>
        ão ç
        <p>__________________________________</p>
        <p>{{ $record->user->name }}</p>
    </div>
</body>
</html>
