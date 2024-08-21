@extends('layouts.cotizador')

@section('content')
<div style="min-height: 100vh;">


    <section class="-mt-10" style="position: relative;">
        <img src="{{ asset('img/bg-login.png') }}" alt="" style="width:100%; max-height:300px; object-fit: cover; filter: brightness(80%);">
    
        <div style="position: absolute; top: 100%; left: 50%; transform: translate(-50%, -50%); display: flex; flex-direction: column; align-items: center; z-index: 1;">
            <img src="{{ asset('img/user.png') }}" alt="" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; backgrownd-colorbackground-color:white;">
            <h3 class="text-black font-bold text-2xl" style="white-space: nowrap; margin-top: 10px;">{{ $user->name }}</h3>

        </div>
    </section>
    
    <section class="px-10" style="margin-top: 160px;">
        @if(session('message'))
            <div class="bg-primary border border-black text-black px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <h2 class="font-semibold text-lg mb-4">Mi información</h2>
       
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
           
                <div>
                    <p>Nombre</p>
                    <input type="text" id="name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nombre" required value="{{$user->name}}" />
                </div>
                <div>
                    <p>Teléfono</p>
                    <input type="text" id="phone" class="bg-whiteg border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingrese su número de teléfono" value="{{$user->phone}}" />
                </div>
                <div>
                    <p>Correo</p>
                    <input type="email" id="email" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingrese su correo electrónico" required value="{{$user->email}}" readonly/>
                    <div class="w-full">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-700 font-semibold">{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <p>Localidad</p>
                    <div class="flex items-center space-x-2">
                        <input type="text" id="phone" 
                               class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-4/5 p-2.5" 
                               value="{{ $actual_location != null ? $actual_location->name : 'No disponible' }}" />
                    
                        <button data-modal-target="edit-location-modal" data-modal-toggle="edit-location-modal" 
                                class="text-white bg-black hover:bg-primary hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-1/5" 
                                type="button">
                            Cambiar
                        </button>
                    </div>
                    
                    <div id="edit-location-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">

                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Cambiar localidad
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-location-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>


                                <form action="{{ route('user.updatelocate')}}" method="POST">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">

                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            Tus cotizaciones, solicitudes y muestras realizadas en otra región se mantendrán disponibles cuando vuelvas a la region donde fueron creadas.
                                        </p>


                                        <select id="location" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            @foreach($locations as $id => $name)
                                                <option  value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit" class="text-black bg-primary hover:bg-black hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cambiar</button>
                                        <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                                    </div>
    
                                </form>
                                
                            </div>


                        </div>
                    </div>

                </div>
                
               
            </div>

            
    </section>
</div>
    
    
@endsection