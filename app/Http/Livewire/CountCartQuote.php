<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CountCartQuote extends Component
{
    public $total = 0;


    protected $listeners = ['currentQuoteAdded'];

    public function currentQuoteAdded()
    {        
        $user = auth()->user();
        $currentQuote = $user->currentQuote;
        $contador = 0;
        
        if (auth()->user()->currentQuote) {

            foreach(auth()->user()->currentQuote->currentQuoteDetails as $currentQuote){
                if($currentQuote->location_id == $user->current_location){
                    $contador = $contador + 1;
                }
            }

            $this->total = $contador;
        } else {
            $this->total;
        } 
    }

    public function mount()
    {
        $user = auth()->user();
        $currentQuote = $user->currentQuote;
        $contador = 0;
        
        if (auth()->user()->currentQuote) {

            foreach(auth()->user()->currentQuote->currentQuoteDetails as $currentQuote){
              
                if($currentQuote->location_id == $user->current_location){
                    $contador = $contador + 1;
                }
            }

            $this->total = $contador;
        } else {
            $this->total;
        } 
    }
    public function render()
    {
        return view('livewire.count-cart-quote');
    }
}
