<div class="container mx-auto max-w-7xl py-2">

    @if(session('message'))
        <div class="bg-green-500 text-white p-4 mb-4">
            <p class="text-lg">¡Éxito! Se ha realizado la cotización de tu producto correctamente, ingresa a la sección <b>MIS COTIZACIONES</b> .</p>
        </div>
    @endif

    @if(session('arte'))
        <div class="bg-green-500 text-white p-4 mb-4">
            <p class="text-lg">¡Arte agregado satisfactoriamente!</p>
        </div>
    @endif

    <div class="grid sm:grid-cols-7 grid-cols-1">
        <div class="sm:col-span-5 col-span-1 px-6">
            <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
                <a class="text-secondary" href="/">Inicio</a>
                <p class="text-secondary"> / </p>
                <a class="text-secondary" href="#">Carrito</a>
            </div>


            @if (count($cotizacionActual) > 0)
                @php
                    $quoteByScales = false;
                   
                @endphp
                @foreach ($cotizacionActual as $quote)

                    @php
                        $moreDetails = json_decode($quote->more_details,true);
                    @endphp
                    <div
                        class="flex justify-between border-t last:border-b border-gray-800 py-3 px-5 gap-2 items-center">
                        <div class="flex items-center">
                            <div>
                                <img src="{{ $quote->images_selected ?: ($quote->product->firstImage ? $quote->product->firstImage->image_url : asset('img/default.jpg')) }}"
                                    alt="" width="100">
                            </div>
                        </div>
                        <div class="flex-grow space-y-3">
                            <p class="font-bold text-lg">{{ $quote->product->name }}</p>
                            <div class="flex items-center space-x-3">
                                <p>Cantidad: <strong>{{ $quote->cantidad }}</strong> <span>PZ</span></p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <p>Proyecto N°: <strong>{{ $moreDetails[0]['proyecto']  }}</strong></p>
                            </div>
                            
                        </div>
                        <div class="h-full text-center pr-20">
                            @if ($quote->logo)
                                <!-- Modal toggle -->
                                <a data-modal-target="default-modal-{{$quote->id}}" data-modal-toggle="default-modal-{{$quote->id}}"  type="button">
                                    <div class="transition-transform transform-gpu hover:scale-105 cursor-pointer">
                                        <img src="{{ asset('storage/logos/' . $quote->logo) }}" class="h-20 w-auto">
                                    </div>
                                </a>

                                <!-- Main modal -->
                                <div id="default-modal-{{$quote->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="p-4 md:p-5 flex items-center justify-center">
                                                <img src="{{ asset('storage/logos/' . $quote->logo) }}" class="h-100 w-auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-center">Sin logo</p>
                            @endif
                        </div>
                        <div class="flex flex-col items-end space-y-2">
                            @php
                                $precioTotal = $quote->precio_total;
                            @endphp
                            <p class="font-bold text-lg">$ {{ number_format($precioTotal, 2, '.', ',') }} + IVA</p>
                                <!-- Modal toggle -->
                                <button data-modal-target="edit-modal-{{$quote->id}}" data-modal-toggle="edit-modal-{{$quote->id}}" class=" bg-primary text-black block w-full text-center text-sm underline rounded-sm font-semibold py-2 px-4" type="button">
                                    Editar cotización
                                </button>

                                <!-- Main modal -->
                                <div wire:ignore.self id="edit-modal-{{$quote->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                           
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Editar cotización
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal-{{$quote->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <label for="">Cantidad:</label><br>
                                                    <input type="number" value='{{$quote->cantidad}}' wire:model="cantidades.{{ $quote->id }}" min="1">  
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button data-modal-hide="default-modal" type="submit" class="text-black hover:text-white bg-primary hover:bg-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"  wire:click="updateQuote({{ $quote->id }})">Actualizar</button>
                                                    <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                                </div>
                                         
                                        </div>
                                    </div>
                                </div>
                           
                            {{-- {{ $quote }} --}}
                            @if (count($quote->haveSampleProduct($quote->product->id)) > 0)
                                @php
                                    // Obtener el id del proceso de muestra que viene en un array
                                    $sampleProcess = $quote->haveSampleProduct($quote->product->id)->toArray();
                                @endphp
                                <a href="{{ route('procesoMuestra', ['id' => $sampleProcess[0]['id']]) }}"
                                    class=" bg-[#662D91] text-white block w-full text-center text-sm underline rounded-sm font-semibold py-1 px-4">
                                    Ver Proceso
                                </a>
                                <button
                                    class="block w-full border-primary hover:border-primary-dark text-center rounded-sm font-semibold py-1 px-4"
                                    onclick="solicitarMuestra({{ $quote->id }})">
                                    Solicitar Muestra
                                </button>
                            @else
                                @if(isset( $moreDetails[0]['art']))
                                    <a class="mx-12 text-center block underline" href="{{ str_replace('public', 'storage', $moreDetails[0]['art']) }}" target="__blank">Ver arte</a>
                                @else
                                    <button data-modal-target="art-modal-{{$quote->id}}" data-modal-toggle="art-modal-{{$quote->id}}" class="block w-full border-2 border-primary hover:border-primary-dark text-center rounded-sm font-semibold py-1 px-4" type="button">
                                        Agregar arte
                                    </button>
                                @endif
  
                                <div id="art-modal-{{$quote->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <form method="POST" action="{{ route('compras.solicitararte') }}" enctype="multipart/form-data">
                                                @csrf 
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Agregar arte
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="art-modal-{{$quote->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <input type="text" name="id" id="id" value="{{$quote->id}}" hidden>
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Por favor, sube tus artes, en caso de que sea mas de un archivo, comprimelo y no exceda los 10 MB. 
                                                    </p>
                                                    <br>
                                                    <input type="file" name="file" id="file" class="w-full" required>
                                                </div>
                                                
                                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button type="submit" class="text-black hover:text-white bg-primary hover:bg-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Aceptar</button>
                                                    <button data-modal-hide="art-modal-{{$quote->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancelar</button>
                                                </div>
                                            </form>    
                                        </div>
                                    </div>
                                </div>
  
                            @endif
                                <button type="button" onclick='eliminar({{ $quote->id }})'
                                    class="block w-full text-center text-sm underline rounded-sm font-semibold py-1 px-4">
                                    Eliminar del carrito
                                </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="sm:col-span-2 col-span-1">
            
            <div class="py-8 px-6">
                <p class="text-md py-3 text-center font-bold">RESUMEN DEL PEDIDO</p>
                <div class="px-8 space-y-3">
                    {{--                     <div class="flex justify-between">
                        <p>Subtotal:</p>
                        <p class="font-bold">$ {{ $totalQuote }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Costo de envio:</p>
                        <p class="font-bold">$ {{ $totalQuote }}</p>
                    </div>
                    <hr class="border-black"> --}}
                    <div class="flex justify-between">
                        <p>Total:</p>
                        <p class="font-bold">$ {{ number_format(round($totalQuote, 2), 2, '.', ',') }} + IVA</p>
                        
                    </div>
                    <hr class="border-black">
                    <!-- <a href="{{ route('finalizar') }}" 
                        class="block w-full bg-[#000000] hover:bg-[#3D3D3D] text-white text-center rounded-sm font-semibold py-2 px-4">
                        Continuar con la compra
                    </a> -->
                    
                    <br>
                    <form wire:submit.prevent="generarPDF">
                        @csrf
                        @if(count($cotizacionActual) > 0)
                            <button type="submit" class="w-full bg-primary p-2 rounded text-center text-black font-semibold" target="_blank" id="pdfButton" style="z-index: 5;">
                                <span id="buttonText">COTIZAR</span>
                            </button>
                            @if($pdfDescargado)

                            @endif
                            <div class="flex">
                            <iframe id="info" style="margin-left:-24px;margin-top:-24px; z-index:-1; display:none;" src="https://giphy.com/embed/3oEjI6SIIHBdRxXI40" width="100" height="100" frameBorder="0" class="giphy-embed" ></iframe>
                            <p id="info-text" style="margin-left:-20px; display:none;"  >Generando cotizacion, por favor espere</p>
                            </div>
                        @endif
                    </form>

                    {{-- <div class="grid grid-cols-3 items-center justify-center">
                        <div style="width: 100%; height: 1px; background-color: rgb(192, 192, 192);"></div>
                        <div class="text-center">ó</div>
                        <div style="width: 100%; height: 1px; background-color: rgb(192, 192, 192);"></div>
                    </div>
                    
                    <form wire:submit.prevent="generarCompra">
                        @csrf
                        @if(count($cotizacionActual) > 0)
                            <button type="submit" class="w-full bg-primary p-2 rounded text-center text-black font-bold" target="_blank" id="pdfButton" style="z-index:5;">
                                <span id="buttonText">COMPRAR</span> 
                            </button>
                            <div class="flex">
                            <iframe id="info" style="margin-left:-24px;margin-top:-24px; z-index:-1; display:none;" src="https://giphy.com/embed/3oEjI6SIIHBdRxXI40" width="100" height="100" frameBorder="0" class="giphy-embed" ></iframe>
                            <p id="info-text" style="margin-left:-20px; display:none;"  >Generando cotizacion, por favor espere</p>
                            </div>
                        @endif
                    </form> --}}
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="hidden bg-slate-800 bg-opacity-50 justify-center items-center absolute top-0 right-0 bottom-0 left-0" id="modalSolicitarMuestra" style="z-index: 40;">
        <div class="bg-white px-16 py-6 rounded-sm text-center" style="width: 600px">
            <p class="text-xl mb-4 font-bold">Ingresa los datos para hacerte llegar la muestra</p>
            <div class="grid grid-cols-3 px-4">
    
                <div class="col-span-1 py-2 text-left">
                    <label for="tipo_evento">Tipo de muestra</label>
                </div>
    
                <div class="col-span-2 py-2 flex flex-coll">
                    <select id="type_sample" name="type_sample" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="type_sample">
                        <option value="fisica sin logotipo" selected>Muestra física sin Logotipo</option>
                        <option value="fisica con logotipo">Muestra física con logotipo</option>
                        <option value="virtual con logotipo">Muestra virtual con logotipo</option>
                    </select>
                </div>
    
                {{-- Nombre --}}
                <div class="col-span-1 py-2 text-left  @if($type_sample == 'virtual sin logotipo' || $type_sample == 'virtual con logotipo') hidden @endif">
                    <label for="nombre">Nombre: </label>
                </div>
                <div class="col-span-2 py-2 flex flex-col @if($type_sample == 'virtual sin logotipo' || $type_sample == 'virtual con logotipo') hidden @endif">
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="nombre">
                    @error('nombre')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
    
                {{-- Teléfono --}}
                <div class="col-span-1 py-2 text-left @if($type_sample == 'virtual sin logotipo' || $type_sample == 'virtual con logotipo') hidden @endif">
                    <label for="telefono">Telefono: </label>
                </div>
                <div class="col-span-2 py-2 @if($type_sample == 'virtual sin logotipo' || $type_sample == 'virtual con logotipo') hidden @endif">
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="telefono">
                    @error('telefono')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
    
                {{-- Dirección --}}
                <div class="col-span-1 py-2 text-left @if($type_sample == 'virtual sin logotipo' || $type_sample == 'virtual con logotipo') hidden @endif">
                    <label for="direcion">Direccion: </label>
                </div>
                <div class="col-span-2 py-2 @if($type_sample == 'virtual sin logotipo' || $type_sample == 'virtual con logotipo') hidden @endif">
                    <textarea name="direccion" id="direccion" cols="10" rows="3" class="mt-1 block w-full border-gray-200 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-stone-50 text-stone-500" wire:model="direccion" readonly>Corporativo HH Global</textarea>
                    @error('direccion')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
    
            </div>
            <button class="px-3 py-1 text-md " onclick="closeModal()">Cancelar</button>
            <button class="px-5 py-1 ml-2 rounded-sm text-md text-black font-semibold bg-primary hover:bg-primary-dark" wire:click="solicitarMuestra">Enviar</button>
        </div>
    </div>

    <script>
        function solicitarMuestra(id) {
            let modal = document.querySelector('#modalSolicitarMuestra')
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            @this.quote_id = id;
        }

        function closeModal() {
            let modal = document.querySelector('#modalSolicitarMuestra')
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        window.addEventListener('muestraSolicitada', event => {
            let modal = document.querySelector('#modalSolicitarMuestra')
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            Swal.fire({
                icon: event.detail.error ? "error" : "success",
                title: event.detail.msg,
                showConfirmButton: false,
                timer: 3000
            })
        })

        function eliminar(id) {
            Swal.fire({
                title: 'Esta seguro?',
                text: "Esta accion ya no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.eliminar(id)
                    Swal.fire(
                        'Eliminado!',
                        'El producto se ha eliminado.',
                        'success'
                    )
                }
            })
        }
    </script>
</div>
