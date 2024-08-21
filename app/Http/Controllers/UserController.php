<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function miCuenta() {

        if(auth()->user()->current_location != null){
            $actual_location = Location::find(auth()->user()->current_location);
        }else{
            $actual_location = null;
        }
                    
        $locations = Location::all()->pluck('name','id');
        $user = auth()->user();
        return view('pages.user.profile',compact('user', 'locations', 'actual_location'));
    }

    public function actualizarLocalidad(Request $request) {
        
        $user =  auth()->user();

        DB::table('users')->where('id', $user->id)->update([
            'current_location' => $request->location
        ]);

        return redirect()->back()->with('message', 'localidad cambiada correctamente');

    }
}
