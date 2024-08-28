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
</div>
   

    
@endsection()
