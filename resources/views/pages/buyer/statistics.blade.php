@extends('layouts.cotizador')
@section('content')

<div class="container mx-auto w-full px-2 mt-8">

    <div class="font-semibold text-slate-700 flex items-center mx-20">
       
        <div class="w-full flex justify-between">
            <div class="flex">
                <a class="text-secondary mr-2" href="/">Inicio </a>
                <p class="text-secondary mr-2"> / </p>
                <a class="text-secondary mr-2" href="#">Estadísticas</a>

            </div>

            <div> 
                <form action="{{ route('download.stadistics') }}" method="POST">
                    @csrf                
                    <button type="submit" class="bg-primary text-black hover:bg-black hover:text-white font-bold py-2 px-4 rounded">
                        Descargar Estadísticas
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    
    <br>

    <div class="mx-20 mb-10">
        <table class="w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-black text-white">
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">Usuario</th>
                    <th class="py-2 px-4 border-b">Correo</th>
                    <th class="py-2 px-4 border-b">Actividad</th>
                    <th class="py-2 px-4 border-b">Descripción</th>
                    <th class="py-2 px-4 border-b">Fecha y hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stadistics as $stadistic)
                    <tr class="text-center">
                        <td class="py-2 px-4 border-b">{{ $loop->iteration}}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->type }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->value }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>

            
        </table>

        <style>
            .pagination {
                display: flex;
                justify-content: flex-end; /* Alinear a la derecha */
                flex-wrap: nowrap; /* Evitar que se envuelvan en varias líneas */
                gap: 4px; /* Espaciado entre los elementos */
            }

            .page-item {
                display: inline-block;
            }

            .page-link {
                display: block;
                padding: 0.5rem 0.75rem;
                margin-left: -1px;
                line-height: 1.25;
                color: #000000;
                background-color: #fff;
                border: 1px solid #dee2e6;
                text-decoration: none;
            }

            .page-link:hover {
                color: #0056b3;
                background-color: #e9ecef;
                border-color: #dee2e6;
            }
        </style>
        <div class="w-full flex justify-end mt-4">
            <div class="inline-flex items-center">
                {{ $stadistics->links() }}
            </div>
        </div>
    </div>
  
</div>
   

    
@endsection()
